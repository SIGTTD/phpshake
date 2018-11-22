<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 01.09.2018
 * Time: 11:52
 */

error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

try {
	session_start();
	function myAutoLoader(string $className)
	{
		require_once __DIR__ . '\\src\\' . $className . '.php';
	}
	//spl_autoload_register('myAutoLoader');

//----------------------------------------------------------
/*
	echo '<link rel="stylesheet" href="/style.css"</link>';
	echo "<a href='/'>home</a><br>";
//echo "<a href='/?class=" . $class[1] . "&status=" . $status . "'>go</a><br>";
	echo "<a href='calc/'>calc</a><br>";
	echo "<a href='auth/'>auth</a>";
	echo "<br><br><hr>";
*/
	$user = new \Models\Users\User('John');
	$article = new \Models\Articles\Article('Title', 'Text', $user);
//echo $article->getTitle() .  "<br>" . $article->getText() . "<br>" .  $article->getAuthor()->getName();

	if (false) {
		$dbh = new \PDO('mysql:host=localhost;dbname=users;', 'root', '');
		$dbh->exec('SET NAMES UTF8');
		$stm = $dbh->prepare('INSERT INTO data (`name`, `year`, `server`) VALUES (:name, :year, :server)');
		$stm->bindValue('name', 'John');
		$stm->bindValue('year', '1122');
		$stm->bindValue('server', $_SERVER['REQUEST_URI']);
		$stm->execute();
		$stm = $dbh->prepare('SELECT * FROM `data`');
		$stm->execute();
		$all = $stm->fetchAll();
		echo $all[0];
	}

//--------------------------------------------------------------

	$route = $_GET['route'] ?? '';
	$routes = require __DIR__ . '/src/routes.php';
	$isRouteFound = false;
	foreach ($routes as $pattern => $controllerAndAction) {
		preg_match($pattern, $route, $matches);
		if (!empty($matches)) {
			$isRouteFound = true;
			break;
		}
	}
	if (!$isRouteFound) {
		throw new \Exceptions\NotFoundException('Page not found');
	}
	unset($matches[0]);
	$controllerName = $controllerAndAction[0];
	$actionName = $controllerAndAction[1];
	$controller = new $controllerName();
	$controller->$actionName(...$matches);
} catch (Exceptions\DbException $e) {
	$view = new View(__DIR__ . '/templates/errors');
	$view->renderHtml('500.php', ['error' => $e->getMessage(), 'code' => $e->getCode()], 500, 500);
} catch (Exceptions\NotFoundException $e) {
	$view = new View(__DIR__ . '/templates/errors');
	$view->renderHtml('404.php', ['error' => $e->getMessage(), 'code' => $e->getCode()], '404 Not found', 404);
} catch (Exceptions\UnauthorizedException $e) {
	$view = new View(__DIR__ . '/templates/errors');
	$view->renderHtml('401.php', ['error' => $e->getMessage(), 'code' => $e->getCode()], 401, 401);
} catch (Exceptions\ForbiddenException $e) {
	$view = new View(__DIR__ . '/templates/errors');
	$view->renderHtml('403.php', ['error' => $e->getMessage(), 'code' => $e->getCode()], 'Forbidden', 403);
}
