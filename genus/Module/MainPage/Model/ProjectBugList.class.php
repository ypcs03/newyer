<?php
include_once MyApp::$moduleDir."/SQL/CallDBInterface.php";
include_once(App::$rootDir.'/Model/function/dividePage.function.php');
Class ProjectBugList
{
	private  $maxProjectDisplay = 10;
	public  $maxPage;
	public 	$begin;
	public 	$end;
	
	public function getData($projectArray,$otherArray,$indexSelect)
	{
		$ret=getBugInfoArray($projectArray,$otherArray);
		$bugList = array();
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			$sumTotalProject = $ret["NumberKey"]["totalNumber"];
			foreach( $ret["DataKey"] as $temp)
			{
				$bug = array(
					'id'=>$temp["bug_id"],
					'link'=>'debugPage.php?id=0',
					'level'=>$temp["seriousLevel"],
					'type'=>$temp["BugType"],
					'state'=>$temp["BugActive"],
					'creator'=>$temp["C_Nickname"],
					'incharge'=>$temp["H_Nickname"],
					'time'=>'2013.07.12 15:00:00',
					'description'=> $temp["Outline"], );
				array_push($bugList, $bug);
				
			}
		}
		
		$this->maxPage=(int)($sumTotalProject/$this->maxProjectDisplay) + (($sumTotalProject%$this->maxProjectDisplay)==0?0:1);
		getIndexValue($indexSelect,$this->begin,$this->end,$this->maxPage);
		return $bugList;
	}
}