<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 08.09.2018
 * Time: 11:03
 */

if (!empty($_FILES['attach'])) {
	if (is_uploaded_file($_FILES['attach']['tmp_name'])) {
		$file = $_FILES['attach'];
		$filePath = __DIR__ . "\\uploads\\" . $file['name'];
		$allowedExtensions = ['jpg', 'png', 'gif', 'pdf'];
		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
		if (!in_array($extension, $allowedExtensions)) {
			$error = 'Wrong extension';
		} elseif ($file['size'] > 4000000) {
			$error = 'File is too big';
		} elseif ($file['error'] !== UPLOAD_ERR_OK) {
			$error = 'File is not uploaded';
		} elseif (file_exists($filePath)) {
			$error = 'File exists';
		} elseif (!move_uploaded_file($file['tmp_name'], $filePath)) {
			$error = 'Uploading error';
		} else {
			$uploadResult = 'http://phpshake.rur/uploads/' . $file['name'];
		}
	}
}
echo "<a href='/'>home</a><br>";
if (!empty($error)) {
	echo $error;
} elseif (!empty($uploadResult)) {
	echo $uploadResult;
}
echo "<style>body {background: #381b36; color: #fef;} 
	a {color: #784e78; text-shadow: 1px 1px 0px #fefefe;}</style>";
echo "
	<form method='post' action='/upload.php' enctype='multipart/form-data'>
		<input type='file' name='attach'>
		<input type='submit' name='submit' value='upload'>
	</form>";
