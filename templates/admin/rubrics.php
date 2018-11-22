<?php include __DIR__ . '/../header.php'; ?>
	<h2><a href="/rubrics/add">Добавить рубрику</a></h2>
	<hr>
<?php foreach ($rubrics as $rubric): ?>
	<h2><?= $rubric->getRubric() ?></h2>
	<p>Количество постов: <?php echo count($rubric->getPosts()); ?></p>
	<hr>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>