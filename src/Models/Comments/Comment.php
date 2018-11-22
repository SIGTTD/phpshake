<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 27.10.2018
 * Time: 12:10
 */

namespace Models\Comments;

use Exceptions\InvalidArgumentException;
use Models\ActiveRecordEntity;
use Models\Articles\Article;
use Models\Users\User;
use Services\Db;

class Comment extends ActiveRecordEntity {
	/** @var string */
	protected $authorId;
	/** @var string */
	protected $articleId;
	/** @var string */
	protected $comment;
	/** @var string */
	protected $createdAt;

	protected static function getTableName(): string {
		return 'comments';
	}
	public function setComment($newComment) {
		$this->comment = $newComment;
	}
	public function setAuthor(User $author) {
		$this->authorId = $author->getId();
	}
	public function setArticle(Article $article) {
		$this->articleId = $article->getId();
	}
	public function getComment(): string {
		return $this->comment;
	}
	public function getAuthor() {
		return User::getById($this->authorId);
	}
	public function getArticle() {
		return Article::getById($this->articleId);
	}
	/**
	 * @return string
	 */
	public function getCreatedAt(): string {
		return $this->createdAt;
	}
	public static function createFromArray(array $fields, User $author, Article $article) {
		if (empty($fields['comment'])) {
			throw new InvalidArgumentException('Kомментарий пуст');
		}
		$comment = new Comment();
		$comment->setAuthor($author);
		$comment->setArticle($article);
		$comment->setComment($fields['comment']);
		$comment->save();
		return $comment;
	}
	public function updateFromArray(array $fields) {
		if (empty($fields['comment'])) {
			throw new InvalidArgumentException('Комментарий пуст');
		}
		$this->setComment($fields['comment']);
		$this->save();
		return $this;
	}
	public static function findComments(int $articleId) {
		$db = Db::getInstance();
		$entities = $db->query('SELECT * FROM ' . static::getTableName() . ' WHERE article_id = :article_id', ['article_id' => $articleId], static::class);
		return $entities ?? null;
	}
}