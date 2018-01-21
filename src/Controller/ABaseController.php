<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 21.04.2017
 * Time: 07:38
 */
abstract class ABaseController {
	protected $template = '';
	protected $context = [];

	/**
	 * @param $key
	 * @param $val
	 * @return ARouteBase
	 */
	protected function addContext($key, $val): ABaseController {
		$this->context[$key] = $val;
		return $this;
	}

	/**
	 * @return string
	 */
	protected function getTemplate(): string {
		return $this->template;
	}

	/**
	 * @param string $template
	 * @return ARouteBase
	 */
	protected function setTemplate(string $template , $controller = NULL): ABaseController {
		$controllerFile = $controller ?? get_class($this);
		$file =
			dirname(__FILE__) . DIRECTORY_SEPARATOR .
			'..' . DIRECTORY_SEPARATOR .
			'..' . DIRECTORY_SEPARATOR .
			'templates' . DIRECTORY_SEPARATOR .
			$controllerFile . DIRECTORY_SEPARATOR .
			$template . '.tpl.php';
		$this->template = $file;
		return $this;
	}

	/**
	 * @param $action
	 */
	public function run($action) {
		$this->setTemplate($action);
		$this->addContext('action', $action);
		$method = $action . 'Action';
		if (method_exists($this, $method)) {
			$this->$method();
		}
		$this->render();
	}

	/**
	 * renders the templates via
	 * two-step-rendering
	 */
	protected function render() {
		extract($this->context);
		$template = $this->getTemplate();
		require
			dirname(__FILE__) . DIRECTORY_SEPARATOR .
			'..' . DIRECTORY_SEPARATOR . '..' .
			DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR .
			'layout.tpl.php';
	}

}