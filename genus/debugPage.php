<?php
include_once(dirname(__FILE__).'/component/smarty/smarty_dir.php');
include_once('view/header.php');
$smarty->assign('tplHeader',$smarty->fetch('template/header.html'));

include_once('view/popup.php');
$smarty->assign('tplPopup',$smarty->fetch('template/popup.html'));

$smarty->display('template/debugPage.html');