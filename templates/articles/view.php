<?php include __DIR__ . '/../header.php'; ?>
	<h1><?= $article->getName() ?></h1>
	<p><?= $article->getParsedText() ?></p>
	<p>Author: <?= $article->getAuthor()->getNickname() ?></p>
	<?php
        if ($user !== null && $user->getRole() === 'admin') {
            echo '<a href="/articles/' . $article->getId() . '/edit">Редактировать</a>';
        }
	?>
    <br><br><br><hr><br>
	<?php if ($user !== null): ?>
    <h3>Добавить комментарий</h3>
    <br>
    <form action="/articles/<?= $article->getId() ?>/comment" method="post">
		<?php if(!empty($error)): ?>
			<div style="color: red;"><?= $error ?></div><br>
		<?php endif; ?>
        <textarea name="comment" rows="4" cols="60"><?= $_POST['comment'] ?? '' ?></textarea><br>
        <br>
        <input type="submit" value="Добавить">
    </form>
	<?php else: ?>
	<h3>Авотризируйтесь, чтобы добаавить комментарий</h3>
	<?php endif; ?>
    <br>
    <h2>Комментарии</h2>
	<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <h3><?= $comment->getComment() ?></h3>
		<p>Author: <?= $comment->getAuthor()->getNickname() ?></p>
		<?php if($user !== null && ($user->getRole() === 'admin' || $user->getNickname() === $comment->getAuthor()->getNickname())): ?>
			<a href="/articles/<?= $article->getId() ?>/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
		<?php endif; ?>
        <hr>
    <?php endforeach; ?>
	<?php else: ?>
	<p>Комментариев пока нет... Напишите первый!</p>
	<?php endif; ?>
<?php include __DIR__ . '/../footer.php'; ?>