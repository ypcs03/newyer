<?php
MyApp::setSmartyEntry(__FILE__);
include_once(App::$rootDir.'/component/smarty/smarty_dir.php');
$smarty->assign('mainLink','index.php');
MyApp::setSmartyFetch($smarty->fetch(MyApp::$moduleDir.'/template/header.html'));


if(MyApp::checkSmartyEntry(__FILE__))
{
	$smarty->display(MyApp::$moduleDir.'/template/header.html');
}