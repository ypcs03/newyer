<?php
include_once(App::$rootDir.'/component/smarty/smarty_dir.php');
MyApp::setSmartyEntry(__FILE__);

MyApp::setSmartyFetch($smarty->fetch(MyApp::$moduleDir.'/template/popup.html'));
if(MyApp::checkSmartyEntry(__FILE__))
{
	$smarty->display(MyApp::$moduleDir.'/template/popup.html');
}