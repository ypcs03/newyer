<?php
	require_once realpath(dirname(__FILE__).'/../class/loginfo.php');
	require_once realpath(dirname(__FILE__).'/../class/errorCodeDefine.php');
	
	loginfo::logout();

	$url=GLOBELURL."main";
	echo "<script>location.href='$url';</script>";