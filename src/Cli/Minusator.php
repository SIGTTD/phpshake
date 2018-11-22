<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 31.10.2018
 * Time: 20:23
 */

namespace Cli;

class Minusator extends AbstractCommand {
	public function execute() {
		echo $this->getParam('x') - $this->getParam('y');
	}
	protected function checkParams() {
		$this->ensureParamExists('x');
		$this->ensureParamExists('y');
	}
}