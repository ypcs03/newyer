<?php
include_once 'Model/class/MyApp.class.php';

MyApp::init(__FILE__);
$module = array_shift(App::$router);
if (empty($module))
{
	$module = "MainPage";
}
App::$moduleDir = App::$rootDir . "/module/" . $module;
App::$moduleUrl = App::$rootUrl . "/module/" . $module;

$target = App::$moduleDir . "/index.php";
if (!file_exists($target)) 
{
	exit( "sorry, module not found: " . $target);
}

include $target;