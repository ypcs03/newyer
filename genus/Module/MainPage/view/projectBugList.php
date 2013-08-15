<?php
include_once(App::$rootDir.'/component/smarty/smarty_dir.php');
include_once MyApp::$moduleDir."/Model/ProjectBugList.class.php";
include_once MyApp::$moduleDir."/Model/ProjectList.class.php";
MyApp::setSmartyEntry(__FILE__);

if(isset($_GET["projectBugList"]))
{
	$indexSelect = $_GET["projectBugList"];
}else
{
	$indexSelect = 1;
}



$cProjectBugList = new ProjectBugList();

$projectArray=array("project_id"=>1);
$otherArray=array();

$bugList = $cProjectBugList->getData($projectArray, $otherArray, $indexSelect);

$begin = $cProjectBugList->begin;
$end = $cProjectBugList->end;
$max = $cProjectBugList->maxPage;

$smarty->assign('begin',$begin);
$smarty->assign('end',$end);
$smarty->assign('indexSelect',$indexSelect);
$smarty->assign('max',$max);

$cProject = new ProjectList();
$queryArray=array("project_id"=>1);
$otherArray=array();
$project = $cProject->getProjectInfo($queryArray, $otherArray);
$project['member'] = $cProject->getProjectMember($queryArray, $otherArray);



$smarty->assign('bugList',$bugList);
$smarty->assign('projectInfo',$project);


MyApp::setSmartyFetch($smarty->fetch(MyApp::$moduleDir.'/template/projectBugList.html'));

if(MyApp::checkSmartyEntry(__FILE__))
{
	$smarty->display(MyApp::$moduleDir.'/template/projectBugList.html');
}