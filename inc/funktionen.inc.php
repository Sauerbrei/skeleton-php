<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 19:42
 */

function bereinige(string $string , $encoding = 'UTF-8') {
	return htmlspecialchars(
		strip_tags($string),
		ENT_QUOTES | ENT_HTML5,
		$encoding);
}

function redirect(string $url) {
	header("Location: " . $url);
	exit;
}

function holePersonen() {
	$file = dirname(__FILE__) . '/../model/personen.db';
	$personen = unserialize(file_get_contents($file));
	if (!$personen) {
		$personen = array();
	}
	return $personen;
}

function holePerson($id) {
	$personen = holePersonen();
	if (isset($personen[$id])) {
		return $personen[$id];
	}
	return false;
}

function speicherePerson($person) {
	$personen = holePersonen();
	$file = dirname(__FILE__) . '/../model/personen.db';
	if ($person) {
		$newPerson = new Person($person);
		$personen[] = $newPerson;
		file_put_contents($file, serialize($personen));
		return true;
	}
	return false;
}