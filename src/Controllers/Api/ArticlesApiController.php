<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 02.11.2018
 * Time: 23:07
 */

namespace Controllers\Api;


use Controllers\AbstractController;
use Exceptions\NotFoundException;
use Models\Articles\Article;
use Models\Users\User;

class ArticlesApiController extends AbstractController
{
	public function view(int $articleId)
	{
		$article = Article::getById($articleId);

		if ($article === null) {
			throw new NotFoundException();
		}

		$this->view->displayJson([
			'articles' => [$article]
		]);
	}

	public function add()
	{
		$input = $this->getInputData();
		$articleFromRequest = $input['articles'][0];

		$authorId = $articleFromRequest['author_id'];
		$author = User::getById($authorId);

		$article = Article::createFromArray($articleFromRequest, $author);
		$article->save();

		header('Location: /api/articles/' . $article->getId(), true, 302);
	}
}