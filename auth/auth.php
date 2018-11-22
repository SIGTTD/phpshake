<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 11.09.2018
 * Time: 21:38
 */

function checkAuth(string $login, string $password): bool
{
	$users = require __DIR__ . '\usersDB.php';
	foreach ($users as $user) {
		if ($user['login'] === $login
			&& $user['password'] === $password
		) {
			return true;
		}
	}
	return false;
}
function getUserLogin()
{
	$loginFromCookie = $_COOKIE['login'] ?? '';
	$passwordFromCookie = $_COOKIE['password'] ?? '';
	if (checkAuth($loginFromCookie, $passwordFromCookie)) {
		return $loginFromCookie;
	}
	return null;
}