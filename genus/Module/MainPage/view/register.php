<?php
	require_once realpath(dirname(__FILE__).'/../class/loginfo.php');
	require_once realpath(dirname(__FILE__).'/../class/errorCodeDefine.php');
	
	MyApp::setSmartyEntry(__FILE__);
	include_once(MyApp::$rootDir.'/component/smarty/smarty_dir.php');
	$smarty->assign('modulePath',MyApp::$moduleUrl.'/');
	
	$user_mail = trim($_POST['email']);
    $user_pwd = trim($_POST['password']);
    
	if($_POST['type'] == "company")
		$type = 'c';
	elseif ($_POST['type'] == "person")
		$type = 'p';
		
    $rg = new loginfo();
    $rs = $rg->register($user_mail, $user_pwd, $type);
    
    switch ($rs){
    	case SUCCESS:
    			session_start();
    			$_SESSION['usrid'] = $rg->getid();
   				if(MyApp::checkSmartyEntry(__FILE__)){
					$smarty->display(MyApp::$moduleDir.'/template/index.html');
   				}
    		break;
    	case USR_EXISTED:
			    if(MyApp::checkSmartyEntry(__FILE__)){
			    	$smarty->assign('errorinfo',"user existed!");
					$smarty->display(MyApp::$moduleDir.'/template/login.html');
   				}
    		break;
    	case DB_Error:
    			if(MyApp::checkSmartyEntry(__FILE__)){
					$smarty->assign('errorinfo',"failed to insert the info to the database!");
    				$smarty->display(MyApp::$moduleDir.'/template/login.html');
   				}
    		break;
    	default:
    		die();
    }