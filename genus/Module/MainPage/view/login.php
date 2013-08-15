<?php
	require_once realpath(dirname(__FILE__).'/../class/loginfo.php');
	require_once realpath(dirname(__FILE__).'/../class/errorCodeDefine.php');
		
	MyApp::setSmartyEntry(__FILE__);
	session_start();
	if(!isset($_SESSION["usrid"]))
	{
		$user_mail = $_POST['email'];
        $user_pwd = $_POST['password'];
        $type = $_POST['type'];        	
        
        $lg = new loginfo;
        $result = $lg->confimpwd($user_mail,$user_pwd);
               
        if($result == LOGIN){
        	if ($type == "auto")
        		setcookie("usrid","$lg->getid()",time()+120);//set the auto login effictive period 120seconds
        	$_SESSION["usrid"]=$lg->getid();
        	//if login successfully then jump to the main page
        	echo "<script>location.href='http://localhost/genus/index.php/MainPage/main';</script>";
        }
        elseif ($result == PWD_ERROR){
        	include_once(MyApp::$rootDir.'/component/smarty/smarty_dir.php');
        	$smarty->assign("loginfo","password error or email incorrect!");
					$smarty->assign('modulePath',MyApp::$moduleUrl.'/');	
        	if(MyApp::checkSmartyEntry(__FILE__)){
        		$smarty->display(MyApp::$moduleDir.'/template/login.html');
        	}
        }
        else 
        	echo "<script>location.href='http://localhost/genus/index.php/MainPage/main';</script>";
	}
	else 
		echo "<script>location.href='http://localhost/genus/index.php/MainPage/index';</script>";;

	
	