<?php include __DIR__ . '/../header.php'; ?>
	<h2><a href="/articles/add">Добавить статью</a></h2>
	<hr>
<?php foreach ($articles as $article): ?>
	<h2><a href="/articles/<?= $article->getId() ?>"><?= $article->getName() ?></a></h2>
	<a href="/articles/<?= $article->getId() ?>/edit">Редактировать</a>
	<p><?= $article->getTextShort() ?></p>
	<p>Created <?= $article->getCreatedAt() ?> | By - <?= $article->getAuthor()->getNickname() ?></p>
	<hr>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>