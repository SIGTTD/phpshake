<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($comments as $comment): ?>
	<h3><?= $comment->getComment() ?></h3>
	<a href="/articles/<?= $comment->getArticle()->getId() ?>/comments/<?= $comment->getId() ?>/edit">Редактировать</a>
	<p>Created <?= $comment->getCreatedAt() ?> | By - <?= $comment->getAuthor()->getNickname() ?></p>
	<hr>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>