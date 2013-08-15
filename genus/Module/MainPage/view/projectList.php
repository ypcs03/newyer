<?php
include_once(App::$rootDir.'/component/smarty/smarty_dir.php');
include_once MyApp::$moduleDir."/Model/ProjectList.class.php";
MyApp::setSmartyEntry(__FILE__);

if(isset($_GET["projectList"]))
{
	$indexSelect = $_GET["projectList"];
}else
{
	$indexSelect = 1;
}

$cProjectList = new ProjectList();

$maxProjectDisplay = 10;
$queryArray=array();
$otherArray=array("sortrow"=>"Pjtitle","sorttype"=>"UP","Pageindex"=>$indexSelect,"NumberPg"=>$maxProjectDisplay);
$projectList = $cProjectList->getData($queryArray,$otherArray,$indexSelect);

$begin = $cProjectList->begin;
$end = $cProjectList->end;
$max = $cProjectList->maxPage;

$smarty->assign('begin',$begin);
$smarty->assign('end',$end);
$smarty->assign('indexSelect',$indexSelect);
$smarty->assign('max',$max);

$smarty->assign('projectList',$projectList);


MyApp::setSmartyFetch($smarty->fetch(MyApp::$moduleDir.'/template/projectList.html'));

if(MyApp::checkSmartyEntry(__FILE__))
{
	$smarty->display(MyApp::$moduleDir.'/template/projectList.html');
}