<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 15.10.2018
 * Time: 11:04
 */

namespace Models;

use Services\Db;

abstract class ActiveRecordEntity implements \JsonSerializable
{
	/** @var int */
	protected $id;

	public function getId(): int {
		return $this->id;
	}
	public function __set($name, $value) {
		$camelCaseName = $this->underscoreToCamelCase($name);
		$this->$camelCaseName = $value;
	}
	private function mapPropertiesToDbFormat(): array {
		$reflector = new \ReflectionObject($this);
		$properties = $reflector->getProperties();
		$mappedProperties = [];
		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
			$mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
		}
		return $mappedProperties;
	}
	private function underscoreToCamelCase(string $source): string {
		return lcfirst(str_replace('_', '', ucwords($source, '_')));
	}
	private function camelCaseToUnderscore(string $source): string {
		return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
	}
	public static function findAll(string $orderBy = 'ASC') {
		$db = Db::getInstance();
		return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER BY id ' . $orderBy . ';', [], static::class);
	}
	public static function getById(int $id) {
		$db = Db::getInstance();
		$entities = $db->query(
			'SELECT * FROM `' . static::getTableName() . '` WHERE id = :id',
			[':id' => $id],
			static::class
		);
		return $entities ? $entities[0] : null;
	}
	public static function getByParam($param, $val) {
		$db = Db::getInstance();
		$entities = $db->query(
			'SELECT * FROM `' . static::getTableName() . '` WHERE ' . $param . ' = :' . $param,
			[':' . $param => $val],
			static::class
		);
		return $entities ? $entities[0] : null;
	}
	public function save() {
		$mappedProperties = $this->mapPropertiesToDbFormat();
		if ($this->id !== null) {
			$this->update($mappedProperties);
		} else {
			$this->insert($mappedProperties);
		}
	}
	public function update(array $mappedProperties) {
		$columns2params = [];
		$params2values = [];
		$index = 1;
		foreach ($mappedProperties as $column => $value) {
			$param = ':param' . $index;
			$columns2params[] = $column . ' = ' .$param;
			$params2values[':param' . $index] = $value;
			$index++;
		}
		$sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id = ' . $this->id;
		$db = Db::getInstance();
		$db->query($sql, $params2values, static::class);
	}
	public function insert(array $mappedProperties) {
		$filteredProperties = array_filter($mappedProperties);
		$columns = [];
		$paramsNames = [];
		$params2Values = [];
		foreach ($filteredProperties as $columnName => $value) {
			$columns[] = '`' . $columnName . '`';
			$paramName = ':' . $columnName;
			$paramsNames[] = $paramName;
			$params2Values[$paramName] = $value;
		}
		$columnsViaSemicolon = implode(', ', $columns);
		$paramsNamesViaSemicolon = implode(', ', $paramsNames);
		$sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ')';
		$db = Db::getInstance();
		$db->query($sql, $params2Values, static::class);
		$this->id = $db->getLastInsert();
		$this->refresh();
	}
	private function refresh() {
		$objectFromDb = static::getById($this->id);
		$reflector = new \ReflectionObject($objectFromDb);
		$properties = $reflector->getProperties();
		foreach ($properties as $property) {
			$property->setAccessible(true);
			$propertyName = $property->getName();
			$this->$propertyName = $property->getValue($objectFromDb);
		}
	}
	public function delete() {
		$db = Db::getInstance();
		$db->query('DELETE FROM ' . static::getTableName() . ' WHERE id = ' . $this->id, [], static::class);
		$this->id = null;
	}
	public static function findOneByColumn(string $columnName, $value) {
		$db = Db::getInstance();
		$result = $db->query(
			'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
			[':value' => $value],
			static::class
		);
		if ($result === []) {
			return null;
		}
		return $result[0];
	}
	public function jsonSerialize()
	{
		return $this->mapPropertiesToDbFormat();
	}
	abstract protected static function getTableName(): string;
}
