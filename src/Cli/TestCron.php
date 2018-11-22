<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 31.10.2018
 * Time: 21:31
 */

namespace Cli;


class TestCron extends AbstractCommand {
	protected function checkParams() {
		$this->ensureParamExists('x');
		$this->ensureParamExists('y');
	}
	public function execute() {
		var_dump(200);
		$result = file_put_contents('1.log', date(DATE_ISO8601) . PHP_EOL, FILE_APPEND);
		var_dump($result);
	}
}