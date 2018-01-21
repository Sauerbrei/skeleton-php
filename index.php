<?php
/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 19:31
 */
require_once 'src/Entities/ABase.php';
require_once 'src/Controller/ABaseController.php';
require_once 'src/Core/DB.php';
require_once 'src/Entities/Person.php';
require_once 'src/Entities/Adresse.php';
require_once 'src/Controller/Routing.php';
require_once 'inc/funktionen.inc.php';

$db = new DB([
	'host'		=> 'localhost',
	'user'		=> 'root',
	'password'	=> '',
	'db'		=> 'test'
]);
$db->connect();
Person::setDatabase($db->getConnection());
Adresse::setDatabase($db->getConnection());

$controller = $_GET['controller'] ?? 'index';
$action = $_GET['action'] ?? 'index';

$route = new Routing($controller, $action);
