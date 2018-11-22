<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($users as $user): ?>
	<h2><?= $user->getNickname() ?></h2>
	<p>Joined <?= $user->getCreatedAt() ?> | Role - <?= $user->getRole() ?> | <?= $user->getEmail() ?></p>
	<p>Количество комментариев: <?php echo count($user->getComments()); ?></p>
	<hr>
<?php endforeach; ?>
<?php include __DIR__ . '/footer.php'; ?>