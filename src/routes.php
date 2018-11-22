<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 06.10.2018
 * Time: 12:58
 */

return [
	'~^articles/(\d+)$~' => [\Controllers\ArticlesController::class, 'view'],
	'~^articles/(\d+)/comments/(\d+)/edit$~' => [\Controllers\ArticlesController::class, 'editComment'],
	'~^articles/(\d+)/comment$~' => [\Controllers\ArticlesController::class, 'comment'],
	'~^articles/(\d+)/edit$~' => [\Controllers\ArticlesController::class, 'edit'],
	'~^articles/add$~' => [\Controllers\ArticlesController::class, 'add'],
	'~^articles/(\d+)/delete$~' => [\Controllers\ArticlesController::class, 'delete'],
	'~^users/login$~' => [\Controllers\UsersController::class, 'login'],
	'~^users/logout$~' => [\Controllers\UsersController::class, 'logout'],
	'~^users/register$~' => [\Controllers\UsersController::class, 'signUp'],
	'~^users/(\d+)/activate/(.+)$~' => [\Controllers\UsersController::class, 'activate'],
	'~^admin/users$~' => [\Controllers\AdminController::class, 'users'],
	'~^admin/articles$~' => [\Controllers\AdminController::class, 'articles'],
	'~^admin/comments$~' => [\Controllers\AdminController::class, 'comments'],
	'~^admin/rubrics$~' => [\Controllers\AdminController::class, 'rubrics'],
	'~^hello/(.*)$~' => [\Controllers\MainController::class, 'sayHello'],
	'~^bye/(.*)$~' => [\Controllers\MainController::class, 'sayBye'],
	'~^$~' => [\Controllers\MainController::class, 'main'],
	'~^rubric/(.+)$~' => [\Controllers\MainController::class, 'rubrics'],
	'~^rubrics/add$~' => [\Controllers\MainController::class, 'addRubric'],
];