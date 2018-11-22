<?php include __DIR__ . '/../header.php'; ?>
	<h1>Создание новой рубрики</h1>
<?php if (!empty($error)): ?>
	<div style="color: red;"><?= $error ?></div>
<?php endif; ?>
	<form action="/rubrics/add" method="post">
		<label for="name">Название рубрики</label><br>
		<input type="text" name="rubric" id="name" value="<?= $_POST['rubric'] ?? '' ?>" size="50">
		<br><br>
		<input type="submit" value="Создать">
	</form>
<?php include __DIR__ . '/../footer.php'; ?>