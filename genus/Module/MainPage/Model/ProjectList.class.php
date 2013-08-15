<?php
include_once MyApp::$moduleDir."/SQL/CallDBInterface.php";
include_once(App::$rootDir.'/Model/function/dividePage.function.php');
Class ProjectList
{
	private  $maxProjectDisplay = 10;
	public  $maxPage;
	public 	$begin;
	public 	$end;
	
	static function getProjectIndex()
	{
		if(isset($_GET["projectList"]))
		{
			$indexSelect = $_GET["projectList"];
		}else
		{
			$indexSelect = 1;
		}
		return $indexSelect;
	}
	
	public function getData($queryArray,$otherArray,$indexSelect)
	{
		$ret=getProjectInfoArray($queryArray,$otherArray);
		$projectList = array();
		$sumTotalProject = 0;
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			$sumTotalProject = $ret["NumberKey"]["totalNumber"];
			foreach( $ret["DataKey"] as $temp)
			{
				$project = array(
				'name'=>$temp["Pjtitle"],
				'incharge'=>$temp["Nickname"],
				'time'=>$temp["Createtime"], );
				//$projectList = array_slice($array, $offset) ($project);
				array_push($projectList, $project);
			}
		}
		
		$this->maxPage=(int)($sumTotalProject/$this->maxProjectDisplay) + (($sumTotalProject%$this->maxProjectDisplay)==0?0:1);
		getIndexValue($indexSelect,$this->begin,$this->end,$this->maxPage);
		return $projectList;
	}
	
	public function getProjectInfo($queryArray,$otherArray)
	{
		$ret=getProjectInfoArray($queryArray,$otherArray);
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			foreach( $ret["DataKey"] as $temp)
			{
				$project = array(
				'name'=>$temp["Pjtitle"],
				'incharge'=>$temp["Nickname"],
				'time'=>$temp["Createtime"], );
				//$projectList = array_slice($array, $offset) ($project);
				//array_push($projectList, $project);
			}
		}
		return $project;
	}
	
	public function getProjectMember($queryArray,$otherArray)
	{
		$ret=getProjectMemberArray($queryArray,$otherArray);
		$memberList=array();
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			foreach( $ret["DataKey"] as $temp)
			{
				$user = array(
				'id'=>$temp["user_id"],
				'name'=>$temp["Nickname"], );
				//$projectList = array_slice($array, $offset) ($project);
				array_push($memberList, $user);
			}
		}
		$memberStr='';
		foreach ($memberList as $temp)
		{
			$memberStr = $memberStr.($temp['name'].' , ');
		}
		return $memberStr;
	}
}