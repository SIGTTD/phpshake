<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 23.10.2018
 * Time: 15:49
 */

namespace Services;

use Exceptions\NotFoundException;
use Models\Users\User;

class UsersAuthService {
	public static function createToken(User $user) {
		$token = $user->getId() . ':' . $user->getAuthToken();
		setcookie('token', $token, 0, '/', '', false, true);
	}
	public static function deleteToken() {
		if (isset($_COOKIE['token'])) {
			setcookie('token', '', -1, '/', '', false, true);
		} else {
			throw new NotFoundException('Cookie not found');
		}
	}
	public static function getUserByToken() {
		$token = $_COOKIE['token'] ?? '';
		if (empty($token)) {
			return null;
		}
		//[$userId, $authToken] = explode(':', $token, 2);
		$temp = explode(':', $token, 2);
		$userId = $temp[0];
		$authToken = $temp[1];

		$user = User::getById((int) $userId);
		if ($user === null) {
			return null;
		}
		if ($user->getAuthToken() !== $authToken) {
			return null;
		}
		return $user;
	}
}