<?php include __DIR__ . '/header.php'; ?>
	<?php if ($user !== null && $user->getRole() === 'admin'): ?>
	<h2><a href="/articles/add">Добавить статью</a></h2>
	<hr>
	<?php endif; ?>
<?php foreach ($articles as $article): ?>
    <h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
    <p><?= $article->getText() ?></p>
    <hr>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>