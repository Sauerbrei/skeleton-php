<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 21.04.2017
 * Time: 07:42
 */

class IndexController extends ABaseController {

	/**
	 *
	 */
	protected function indexAction() {
		$this->addContext('personen', Person::findAll());
	}

	/**
	 *
	 */
	protected function zeigeAction() {
		if ($person = holePerson($_GET['id'])) {
			$this->addContext('person', $person);
		} else {
			redirect('index.php?controller=notFound&action=idNotFound');
		}
	}

	/**
	 *
	 */
	protected function neuAction() {
		if ($_POST) {
			$person = new Person($_POST);
			$person->save();
		}
	}
}