<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 29.10.2018
 * Time: 20:31
 */

namespace Controllers;


use Exceptions\ForbiddenException;
use Models\Articles\Article;
use Models\Articles\Rubric;
use Models\Comments\Comment;
use Models\Users\User;

class AdminController extends AbstractController {
	public function users() {
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Admin panel only for admins :)', 403);
		}
		$users = User::findAll('DESC');
		$this->view->renderHtml('admin/users.php', ['users' => $users], 'Admin | Users');
		return;
	}
	public function articles() {
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Admin panel only for admins :)', 403);
		}
		$articles = Article::findAll('DESC');
		$this->view->renderHtml('admin/articles.php', ['articles' => $articles], 'Admin | Articles');
		return;
	}
	public function comments() {
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Admin panel only for admins :)', 403);
		}
		$comments = Comment::findAll('DESC');
		$this->view->renderHtml('admin/comments.php', ['comments' => $comments], 'Admin | Comments');
		return;
	}
	public function rubrics() {
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Admin panel only for admins :)', 403);
		}
		$rubrics = Rubric::findAll('DESC');
		$this->view->renderHtml('admin/rubrics.php', ['rubrics' => $rubrics], 'Admin | Rubrics');
		return;
	}
}