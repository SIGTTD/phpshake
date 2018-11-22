<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 06.10.2018
 * Time: 15:51
 */

class View {
	private $templatesPath;
	private $extraVars = [];

	public function __construct(string $templatesPath) {
		$this->templatesPath = $templatesPath;
	}
	public function setVar(string $name, $value) {
		$this->extraVars[$name] = $value;
	}
	public function renderHtml(string $templateName, array $vars = [], string $title = 'My blog', int $code = 200) {
		http_response_code($code);
		if (empty($this->extraVars)) {
			$extraVars = false;
		} else {
			$extraVars = true;
		}
		extract($this->extraVars);
		extract($vars);

		ob_start();
		include $this->templatesPath . '/' . $templateName;
		$buffer = ob_get_contents();
		ob_end_clean();

		echo $buffer;
	}
	public function displayJson($data, int $code = 200)
	{
		header('Content-type: application/json; charset=utf-8');
		http_response_code($code);
		echo json_encode($data);
	}
}