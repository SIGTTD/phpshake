<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 31.10.2018
 * Time: 20:06
 */

namespace Cli;

use Exceptions\CliException;

class Summator extends AbstractCommand {
	public function execute() {
		echo $this->getParam('a') + $this->getParam('b');
	}
	protected function checkParams() {
		$this->ensureParamExists('a');
		$this->ensureParamExists('b');
	}
}