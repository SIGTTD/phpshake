<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 05.10.2018
 * Time: 14:34
 */

namespace Controllers;

use Exceptions\ForbiddenException;
use Exceptions\InvalidArgumentException;
use Exceptions\UnauthorizedException;
use Models\Articles\Article;
use Models\Articles\Rubric;

class MainController extends AbstractController {
	public function main() {
		$articles = Article::findAll();
		$this->view->renderHtml(
			'main.php',
			['articles' => $articles, 'user' => $this->user, 'rubricExistance' => 1]);
	}
	public function rubrics($rubricName) {
		$articles = Article::findAll();
		$rubricChosen = Rubric::getByParam('rubric', $rubricName);
		$this->view->renderHtml('rubric.php', ['articles' => $articles,
			'user' => $this->user,
			'rubricChosen' => $rubricChosen,
			'rubricExistance' => 1]);
	}
	public function addRubric() {
		if ($this->user === null) {
			throw new UnauthorizedException('Not authorized', 401);
		}
		if ($this->user->getRole() !== 'admin') {
			throw new ForbiddenException('Add can only admin', 403);
		}
		if (!empty($_POST)) {
			try {
				$rubric = Rubric::createFromArray($_POST);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('articles/addRubric.php', ['error' => $e->getMessage()]);
				return;
			}
			header('Location: /rubric/' . $rubric->getId(), true, 302);
			exit();
		}
		$this->view->renderHtml('articles/addRubric.php');
	}
}