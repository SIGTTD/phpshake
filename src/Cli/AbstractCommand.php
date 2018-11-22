<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 31.10.2018
 * Time: 20:19
 */

namespace Cli;


use Exceptions\CliException;

abstract class AbstractCommand {
	private $params;

	public function __construct(array $params)
	{
		$this->params = $params;
		$this->checkParams();
	}

	abstract public function execute();

	abstract protected function checkParams();

	protected function getParam(string $paramName) {
		return $this->params[$paramName] ?? null;
	}

	protected function ensureParamExists(string $paramName)	{
		if (!isset($this->params[$paramName])) {
			throw new CliException('Param with name "' . $paramName . '" is not set!');
		}
	}
}