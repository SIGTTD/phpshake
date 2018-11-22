<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 04.10.2018
 * Time: 14:15
 */

namespace Models\Articles;

use Exceptions\InvalidArgumentException;
use Models\ActiveRecordEntity;
use Models\Users\User;

class Article extends ActiveRecordEntity {
	/** @var string */
	protected $name;
	/** @var string */
	protected $text;
	/** @var string */
	protected $authorId;
	/** @var string */
	protected $createdAt;
	/** @var string */
	protected $rubricId;

	public function setName($newName) {
		$this->name = $newName;
	}
	public function setText($newText) {
		$this->text = $newText;
	}
	public function setRubric($rubric) {
		$this->rubricId = $rubric;
	}
	public function setAuthor(User $author) {
		$this->authorId = $author->getId();
	}
	public function getName(): string {
		return $this->name;
	}
	public function getText(): string {
		return $this->text;
	}
	public function getRubric() {
		return Rubric::getById($this->rubricId);
	}
	public function getParsedText(): string
	{
		$parser = new \Parsedown();
		return $parser->text($this->getText());
	}
	public function getTextShort(): string {
		return strlen($this->text) > 100 ?
			mb_substr($this->text, 0,100) . '...' :
			mb_substr($this->text, 0,100);
	}
	public function getAuthor() {
		return User::getById($this->authorId);
	}
	/**
	 * @return string
	 */
	public function getCreatedAt(): string {
		return $this->createdAt;
	}
	protected static function getTableName(): string {
		return 'articles';
	}
	public static function createFromArray(array $fields, User $author): Article {
		if (empty($fields['name'])) {
			throw new InvalidArgumentException('Не передано название статьи');
		}
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст');
		}
		$article = new Article();
		$article->setAuthor($author);
		$article->setName($fields['name']);
		$article->setText($fields['text']);
		$article->setRubric($fields['rubricId']);
		$article->save();
		return $article;
	}
	public function updateFromArray(array $fields): Article {
		if (empty($fields['name'])) {
			throw new InvalidArgumentException('Не передано название статьи');
		}
		if (empty($fields['text'])) {
			throw new InvalidArgumentException('Не передан текст');
		}
		$this->setName($fields['name']);
		$this->setText($fields['text']);
		$this->save();
		return $this;
	}
}