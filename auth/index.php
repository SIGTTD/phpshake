<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 11.09.2018
 * Time: 21:32
 */

require __DIR__ . '\auth.php';
$login = getUserLogin();
?>
<html>
<head>
	<title>Главная страница</title>
</head>
<body>
<?php if ($login === null): ?>
	<a href="/auth/login.php">Авторизуйтесь</a>
<?php else:
	$files = scandir(__DIR__ . '/uploads');
	$links = [];
	foreach ($files as $fileName) {
		if ($fileName === '.' || $fileName === '..') {
			continue;
		}
		$links[] = 'http://phpshake.rur:81/auth/uploads/' . $fileName;
	}
	foreach ($links as $link):?>
        <a href="<?= $link ?>"><img src="<?= $link ?>" height="80px"></a>
	<?php endforeach; ?>
	Добро пожаловать, <?= $login ?>
	<br>
	<a href="/auth/logout.php">Выйти</a>
<?php endif; ?>
<a href="/auth/upload.php">Upload</a>
</body>
</html>