<?php
/**
 * Created by PhpStorm.
 * User: v.karpenko
 * Date: 07.09.2018
 * Time: 10:53
 */

if ($_GET['x1'] && $_GET['x2']) {
	$calcResult = include_once __DIR__ . 'calc.php';
	echo '<em>Calculating result:</em><br>' . $x1 . $op . $x2 . '.';
} else {
	echo "
	<form method='get' action='calc.php'>
		<label>First element<input type='text' name='x1'></label>
		<br>
		<select name='op'>
			<option value='+'>+</option>
			<option value='-'>-</option>
			<option value='*'>*</option>
			<option value='/'>/</option>
			<option value='**'>**</option>
			<option value='sq'>sq</option>
			<option value='!'>!</option>
		</select>
		<br>
		<label>Second element<input type='text' name='x2'></label>
		<br>
		<input type='submit' value='Go!'>
	</form>
	";
	if (!$_GET['x1']) {
		echo "<em>Missing x1.";
	}
	if (!$_GET['x2']) {
		echo "<em>Missing x2.";
	}
}