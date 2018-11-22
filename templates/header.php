<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title ?? 'Мой блог' ?></title>
	<link rel="stylesheet" href="/style.css">
</head>
<body>
<table class="layout">
	<tr>
		<td colspan="2" class="header">
			<a href="/" style="text-decoration: none; color: inherit;">Мой блог</a>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right;">
			<?php if ($extraVars): ?>
			<?= !empty($user) ?
				'Hi, ' . $user->getNickname() . ' | <a href="/users/logout">Logout</a>' :
				'<a href="/users/login">Login</a> | <a href="/users/register">Register</a>' ?>
				<?php if ($user !== null && $user->getRole() === 'admin'): ?>
				<br>
				<a href="/admin/users">Admin panel</a>
				<?php endif; ?>
			<?php endif; ?>
		</td>
	</tr>
	<?php if(isset($rubricExistance)): ?>
	<tr>
		<td style="text-align: center; font-size: 25px;">|
		<?php foreach ($rubrics as $rubric): ?>
			<a href="/rubric/<?= $rubric->getRubric() ?>"><?= mb_convert_case($rubric->getRubric(), MB_CASE_TITLE) ?></a>
		|
		<?php endforeach; ?>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td>