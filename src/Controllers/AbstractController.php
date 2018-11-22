<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 24.10.2018
 * Time: 15:24
 */

namespace Controllers;

use Models\Articles\Rubric;
use Services\UsersAuthService,
	View,
	Models\Users\User;

class AbstractController {
	/** @var View  */
	protected $view;
	/** @var User|null */
	protected $user;

	public function __construct() {
		$this->user = UsersAuthService::getUserByToken();
		$rubrics = Rubric::findAll();
		$this->view = new View(__DIR__ . '/../../templates');
		$this->view->setVar('user', $this->user);
		$this->view->setVar('rubrics', $rubrics);
	}
	protected function getInputData()
	{
		return json_decode(
			file_get_contents('php://input'),
			true
		);
	}
}