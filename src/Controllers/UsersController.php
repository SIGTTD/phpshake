<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 22.10.2018
 * Time: 22:04
 */

namespace Controllers;

use Exceptions\NotFoundException;
use Models\Users\UserActivationService;
use Services\EmailSender;
use Services\UsersAuthService,
	Models\Users\User,
	Exceptions\InvalidArgumentException;

class UsersController extends AbstractController {
	public function signUp() {
		if (!empty($_POST)) {
			try {
				$user = User::signUp($_POST);
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
				return;
			}
			if ($user instanceof User) {
				$code = UserActivationService::createActivationCode($user);
				EmailSender::send($user, 'Activation', 'userActivation.php', [
					'userId' =>$user->getId(),
					'code' => $code
				]);
				$this->view->renderHtml('users/signUpSuccessful.php');
				return;
			}
		}
		$this->view->renderHtml('users/signUp.php', [], 'Sign Up');
	}
	public function activate(int $userId, string $activationCode) {
		$user = User::getById($userId);
		if ($user === null) {
			$this->view->renderHtml('errors/500.php', ['error' => 'User not found']);
			return;
		}
		$isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
		if (!$isCodeValid) {
			$this->view->renderHtml('errors/500.php', ['error' => 'Wrong link']);
			return;
		} else {
			$user->activate();
			UserActivationService::deleteCode($userId);
			$this->view->renderHtml('users/activationSuccessful.php');
			return;
		}
	}
	public function login() {
		if (!empty($_POST)) {
			try {
				$user = User::login($_POST);
				UsersAuthService::createToken($user);
				session_start();
				$_SESSION['u_id'] = $_COOKIE['PHPSESSID'];
				header('Location: /');
				exit();
			} catch (InvalidArgumentException $e) {
				$this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
				return;
			}
		}
		$this->view->renderHtml('users/login.php', []);
	}
	public function logout() {
		try {
			UsersAuthService::deleteToken();
			header('Location: /');
			exit();
		} catch (NotFoundException $e) {
			$this->view->renderHtml('errors/500.php', ['error' => $e->getMessage()]);
		}
	}
}