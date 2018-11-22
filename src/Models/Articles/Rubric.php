<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 01.11.2018
 * Time: 10:06
 */

namespace Models\Articles;


use Exceptions\InvalidArgumentException;
use Models\ActiveRecordEntity;
use Services\Db;

class Rubric extends ActiveRecordEntity {
	protected $rubric;

	public function getRubric() {
		return $this->rubric;
	}
	public function setRubric(string $rubric) {
		return $this->rubric = $rubric;
	}
	public static function getTableName(): string {
		return 'rubrics';
	}
	public function getPosts() {
		$db = Db::getInstance();
		$posts = $db->query('SELECT * FROM articles WHERE rubric_id = :rubric_id', ['rubric_id' => $this->getId()], static::class);
		return $posts;
	}
	public static function createFromArray(array $fields): Rubric
	{
		if (empty($fields['rubric'])) {
			throw new InvalidArgumentException('Не передано название рубрики');
		}
		$rubric = new Rubric();
		$rubric->setRubric($fields['rubric']);
		$rubric->save();
		return $rubric;
	}
}