<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 12.10.2018
 * Time: 10:10
 */

namespace Services;

use Exceptions\DbException;

class Db {
	/** @var \PDO */
	private $pdo;
	private static $instance;

	private function __construct() {
		$dbOptions = (require __DIR__ . '/../settings.php')['db'];

		try {
			$this->pdo = new \PDO(
				'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
				$dbOptions['user'],
				$dbOptions['password']);
			$this->pdo->exec('SET NAMES UTF8');
		} catch (\PDOException $e) {
			throw new DbException('Ошибка при подключении к базе данных: ' . $e->getMessage(), 500);
		}
	}
	public function query(string $sql, $params=[], string $className = 'stdClass') {
		$sth = $this->pdo->prepare($sql);
		$result = $sth->execute($params);
		if (false === $result) {
			return NULL;
		}
		return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
	}
	public static function getInstance() {
		if (self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	public function getLastInsert(): int {
		return (int) $this->pdo->lastInsertId();
	}
}