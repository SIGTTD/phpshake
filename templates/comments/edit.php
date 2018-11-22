<?php include __DIR__ . '/../header.php'; ?>
	<h1>Редактирование коментария</h1>
<?php if(!empty($error)): ?>
	<div style="color: red;"><?= $error ?></div>
<?php endif; ?>
	<form action="/articles/<?= $articleId ?>/comments/<?= $comment->getId() ?>/edit" method="post">
		<label for="text">Комментарий</label><br>
		<textarea name="comment" rows="4" cols="60"><?= $_POST['comment'] ?? $comment->getComment() ?></textarea><br>
		<br>
		<input type="submit" value="Изменить">
	</form>
<?php include __DIR__ . '/../footer.php'; ?>