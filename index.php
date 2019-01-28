<?php

require_once 'config.php';
require_once 'library/framework/Autoloader.php';

$autoloader = Framework_Autoloader::getInstance();
$autoloader->addDir('app')
    ->addDir('library')
    ->addDir('classes');

$database = new Framework_Database();
$database->setAdapter(new Framework_Database_Adapter_Mysql());
$connection = $database->getConnection(DB_HOST, DB_NAME, DB_USER, DB_PASS);

$modelRegistry = Framework_Model_Registry::getInstance();
$modelRegistry->setConnection($connection);

$mvc = Framework_Mvc::getInstance();
$mvc->setDefaultRoute(['Book', 'show']);
$output = $mvc->run()->getOutput();

$request = new Framework_Controller_Request();


$layout = new Framework_Layout();
$layout->isLoggedIn = UserStorage::getInstance()->isLoggedIn();
$layout->isAdmin = UserStorage::getInstance()->isAdmin();
$layout->username = UserStorage::getInstance()->getUsername();

$layout->load('Default');
$layout->mvc = $output;

echo $layout->render();