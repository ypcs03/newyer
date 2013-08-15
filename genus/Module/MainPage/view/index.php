<?php
	MyApp::setSmartyEntry(__FILE__);

	require_once realpath(dirname(__FILE__).'/../class/errorCodeDefine.php');
	require_once realpath(dirname(__FILE__).'/../class/news.php');
	include_once(MyApp::$rootDir.'/component/smarty/smarty_dir.php');
	
	session_start();
	$USRID = $_SESSION['usrid'];
	
	$index_news = new newsinfo($USRID);
	
	
	
	
	
	
	$smarty->assign('usrname',$_SESSION['usrid']);
	
	$smarty->assign('modulePath',MyApp::$moduleUrl.'/');
	$smarty->display(MyApp::$moduleDir.'/template/index.html');
	
	