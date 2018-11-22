<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 12.10.2018
 * Time: 11:59
 */

namespace Controllers;

use Exceptions\ForbiddenException;
use Exceptions\InvalidArgumentException;
use Exceptions\UnauthorizedException;
use Models\Articles\Article;
use Exceptions\NotFoundException;
use Models\Articles\Rubric;
use Models\Comments\Comment;

class ArticlesController extends AbstractController {
	public function view(int $articleId) {
		$article = Article::getById($articleId);
		if ($article === null) {
			throw new NotFoundException('Article not found', 404);
		}
		$comments = Comment::findComments($articleId);
		$this->view->renderHtml('articles/view.php', [
			'article' => $article,
			'user' => $this->user,
			'comments' => $comments
		]);
	}
	public function edit(int $articleId) {
		$article = Article::getById($articleId);
		if ($article === null) {
			throw new NotFoundException();
		}
		if ($this->user === null) {
			throw new UnauthorizedException('Not authorized', 401);
		}
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Edit can only admin', 403);
		}
		if (!empty($_POST)) {
			try {
				$article->updateFromArray($_POST);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('articles/edit.php', ['error' => $e->getMessage()]);
				return;
			}
			header('Location: /articles/' . $article->getId(), true, 302);
			exit();
		}
		$this->view->renderHtml('articles/edit.php', ['article' => $article]);
	}
	public function add() {
		if ($this->user === null) {
			throw new UnauthorizedException('Not authorized', 401);
		}
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Add can only admin', 403);
		}
		$rubrics = Rubric::findAll();
		if (!empty($_POST)) {
			try {
				$article = Article::createFromArray($_POST, $this->user);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('articles/add.php', ['error' => $e->getMessage()]);
				return;
			}
			header('Location: /articles/' . $article->getId(), true, 302);
			exit();
		}
		$this->view->renderHtml('articles/add.php', ['rubcirs' => $rubrics]);
	}
	public function delete(int $articleId) {
		$article = Article::getById($articleId);
		if ($article === null) {
			throw new NotFoundException();
		}
		$article->delete();
	}
	public function editComment(int $articleId, int $commentId) {
		$comment = Comment::getById($commentId);
		if ($comment === null) {
			throw new NotFoundException();
		}
		if ($this->user === null) {
			throw new UnauthorizedException('Not authorized', 401);
		}
		if ($this->user->getNickname() !== $comment->getAuthor()->getNickname() && $this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Edit can only admin or author', 403);
		}
		if (!empty($_POST)) {
			try {
				$comment->updateFromArray($_POST);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('comments/edit.php', ['error' => $e->getMessage(), 'comment' => $comment, 'articleId' => $articleId], 'Edit Comment');
				return;
			}
			header('Location: /articles/' . $comment->getArticle()->getId(), true, 302);
			exit();
		}
		$this->view->renderHtml('comments/edit.php', ['comment' => $comment, 'articleId' => $articleId]);
	}
	public function comment(int $articleId) {
		$article = Article::getById($articleId);
		$comments = Comment::findComments($articleId);
		if (!empty($_POST)) {
			try {
				$comment = Comment::createFromArray($_POST, $this->user, $article);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('articles/view.php', [
					'article' => $article,
					'user' => $this->user,
					'comments' => $comments,
					'error' => $e->getMessage()
				]);
				return;
			}
			header('Location: /articles/' . $article->getId(), true, 302);
			exit();
		}
	}
}