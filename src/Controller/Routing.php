<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 21.04.2017
 * Time: 08:23
 */

class Routing {
	public function __construct($controller , $action) {
		$doController = 'NotFoundController';
		$doAction = 'index';

		$controllerName = ucfirst($controller) . 'Controller';
		$actionName = ucfirst($action) . 'Action';
		if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $controllerName . '.php')) {
			$doController = $controllerName;
		}
		require $doController . '.php';

		/** @var $myController ABaseController */
		$myController = new $doController();

		if (method_exists($myController, $actionName)) {
			$doAction = $action;
		} else {
			require 'NotFoundController.php';
			$myController = new NotFoundController();
			$doAction = 'actionNotFound';
		}
		$myController->run($doAction);
	}
}