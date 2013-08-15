<?php
MyApp::setSmartyEntry(__FILE__);

require_once realpath(dirname(__FILE__).'/../class/errorCodeDefine.php');
include_once(MyApp::$rootDir.'/component/smarty/smarty_dir.php');

$smarty->assign('modulePath',MyApp::$moduleUrl.'/');

/*include_once(MyApp::$moduleDir.'/view/header.php');
$smarty->assign('tplHeader',MyApp::getSmartyFetch());

include_once(MyApp::$moduleDir.'/view/projectList.php');
$smarty->assign('tplProjectList',MyApp::getSmartyFetch());

include_once(MyApp::$moduleDir.'/view/projectBugList.php');
$smarty->assign('tplProjectBugList',MyApp::getSmartyFetch());

include_once(MyApp::$moduleDir.'/view/footer.php');
$smarty->assign('tplFooter',MyApp::getSmartyFetch());

include_once(MyApp::$moduleDir.'/view/popup.php');
$smarty->assign('tplPopup',MyApp::getSmartyFetch());*/

session_start();

if(isset($_COOKIE["usrid"]))
{
	echo "2222";
	$_SESSION["usrid"] = $_COOKIE["usrid"];
}
if(!isset($_SESSION["usrid"])){
	MyApp::checkSmartyEntry(__FILE__);
	$smarty->display(MyApp::$moduleDir.'/template/login.html');
}
else if(MyApp::checkSmartyEntry(__FILE__))
{
	$url=GLOBELURL."sd";
	echo $url;
	echo "<script>location.href='http://localhost/genus/index.php/MainPage/index';</script>";
	//$smarty->display(MyApp::$moduleDir.'/template/index.html');
}
else 
	echo "";