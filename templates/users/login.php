<?php include __DIR__ . '/../header.php'; ?>
	<div style="text-align: center;">
		<?php if ($user === null): ?>
		<h1>Вход</h1>
		<?php if (!empty($error)): ?>
			<div style="background-color: red;padding: 5px;margin: 15px"><?= $error ?></div>
		<?php endif; ?>
		<form action="/users/login" method="post">
			<label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
			<br><br>
			<label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
			<br><br>
			<input type="submit" value="Войти">
		</form>
		<?php else: ?>
		<h2>Вы уже авторизированы</h2>
		<?php endif; ?>
	</div>
<?php include __DIR__ . '/../footer.php'; ?>