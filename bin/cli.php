<?php

require __DIR__ . '/../vendor/autoload.php';

try {
	unset($argv[0]);
	/*
	spl_autoload_register(function (string $className) {
		require_once __DIR__ . '\\..\\src\\' . str_replace('/', '\\', $className) . '.php';
	});
	*/
	$className = '\\Cli\\' . array_shift($argv);
	if (!class_exists($className)) {
		throw new Exceptions\CliException('Class "' . $className . '" not found');
	}

	$params = [];
	foreach ($argv as $argument) {
		preg_match('/^-(.+)=(.+)$/', $argument, $matches);
		if (!empty($matches)) {
			$paramName = $matches[1];
			$paramValue = $matches[2];

			$params[$paramName] = $paramValue;
		}
	}
	if (!is_subclass_of($className, Cli\AbstractCommand::class)) {
		throw new Exceptions\CliException('Class "' . $className . '" not for CLI');
	}

	$class = new $className($params);
	$class->execute();

} catch (\Exceptions\CliException $e) {
	echo 'Error: ' . $e->getMessage();
}