<?php include __DIR__ . '/../header.php'; ?>
<title><?php echo $title ?? '401' ?></title>
<h1>Вы не авторизованы</h1>
Для доступа к этой странице нужно <a href="/users/login">войти на сайт</a>
<?php include __DIR__ . '/../footer.php'; ?>