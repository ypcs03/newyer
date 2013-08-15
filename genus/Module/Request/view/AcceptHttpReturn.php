<?php
	/*
	 * 这个php主要是用于接收前端接口的请求，并且进行分析，来调用SqlStringMysql
	 */
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'errorCodeDefine.php');
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'WriteLog.php');
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'ExecuteMysql.php');
	
	$g_userKeys=array("user_id","Nickname","Email","Telephone","Password","Createtime");
	$g_CuserKeys=array("C_user_id","C_Nickname","C_Email","C_Telephone","C_Password","C_Createtime");
	$g_AuserKeys=array("A_user_id","A_Nickname","A_Email","A_Telephone","A_Password","A_Createtime");
	$g_HuserKeys=array("H_user_id","H_Nickname","H_Email","H_Telephone","H_Password","H_Createtime");
	$g_projectKeys=array("project_id","Pjtitle","PjInfo","State","Createtime");
	$g_pjrelationKeys=array("user_id","project_id","Relation","Createtime");
	$g_bugKeys=array("bug_id","project_id","serialnumber","seriousLevel","BugType","Outline","Createtime");
	$g_bugdisposeKeys=array("user_id","bug_id","Relation","BugActive","Supply","Disposetime");
	$g_otherKeys=array("S_sortrow","S_sorttype","S_Pageindex","S_NumberPg","S_user_id","S_Nickname","S_Email",
		"S_Telephone","S_Password","S_Createtime","S_project_id","S_Pjtitle","S_PjInfo","S_State","S_bug_id",
		"S_serialnumber","S_seriousLevel","S_BugType","S_Outline","S_Relation","S_BugActive","S_Supply");	
	
	if($_SERVER['REQUEST_METHOD']=='POST') 
	{
		$acceptArray=array();
		foreach ($_REQUEST as $key => $value) 
		{
			//Log::writeLog($key.":".$value);
			$acceptArray[$key]=$value;
		    //echo "Key: $key; Value: $value<br />\n";
		}
		dispatchTask($acceptArray);
	}
	else
	{
		
	}	
	
	function dispatchTask($acceptArray)
	{
		$PostType=$acceptArray["PostType"];
		switch($PostType)
		{
			case Post_AddUser:
				accept_AddUser($acceptArray);
				break;
			case Post_getUser:
				accept_getUser($acceptArray);
				break;
			case Post_addAProject:
				accept_addAProject($acceptArray);
				break;
			case Post_updateAProject:
				accept_updateAProject($acceptArray);
				break;
			case Post_addProjectMember:
				accept_addProjectMember($acceptArray);
				break;
			case Post_delAProject:
				accept_delAProject($acceptArray);
				break;
			case Post_getProject:
				accept_getProject($acceptArray);
				break;
			case Post_getProjectMember:
				accept_getProjectMember($acceptArray);
				break;
			case Post_addABug:
				accept_addABug($acceptArray);
				break;
			case Post_delABug:
				accept_delABug($acceptArray);
				break;
			case Post_tranfBugHand:
				accept_tranfBugHand($acceptArray);
				break;
			case Post_getBug:
				accept_getBug($acceptArray);
				break;
			case Post_getBugDispose:
				accept_getBugDispose($acceptArray);
				break;
			case Post_addaBugDispose:
				addaBugDispose($acceptArray);
				break;
			default:    
			;
		}
	}
	/*
	 * 
	 */
	function accept_AddUser($acceptArray)
	{
		//Log::writeLog($acceptArray);
		$userInfo=array();
		global $g_userKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		//Log::writeLog($userInfo);
		$retData=addAUserinfo_sql($userInfo);
		$intD=(int)$retData;

		$mergeData=array();	
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			$mergeData["DataKey"]=array("user_id"=>$intD);
		}
		else
		{
			if(User_Exist==$intD)
			{
				$mergeData["ErrorKey"]=array("code"=>User_Exist,"msg"=>"User_Exist.");
			}
			else
			{
				$mergeData["ErrorKey"]=array("code"=>DB_Error,"msg"=>"DB_Error.");
			}
		}

		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_getUser($acceptArray)
	{
		$userInfo=array();
		$otherInfo=array();
		global $g_userKeys;
		global $g_otherKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$otherInfo=makeupArray($acceptArray,$g_otherKeys);
		$retData=getUserArray_sql($userInfo,$otherInfo);
		$mergeData=array();	
		if(!is_array($retData))
		{
			$intD=$retData;
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB operating error.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			if(array_key_exists("Number",$retData))
			{
				$NumberData=$retData["Number"];
				unset($retData["Number"]); 
				$mergeData["DataKey"]=$retData;
				$mergeData["NumberKey"]=$NumberData;
			}
			else
			{
				$mergeData["DataKey"]=$retData;
			} 
		}
		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_addAProject($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$projectInfo=makeupArray($acceptArray,$g_projectKeys);
		
		$retData=addAProject_sql($projectInfo,$userInfo);
		
		$intD=(int)$retData;
		$mergeData=array();
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			$mergeData["DataKey"]=array("project_id"=>$intD);
		}
		else
		{
			if(DataInfo_Exist==$intD)
			{
				$mergeData["ErrorKey"]=array("code"=>DataInfo_Exist,"msg"=>"DataInfo_Exist.");
			}
			else
			{
				$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB_Error.");
			}
		}

		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_updateAProject($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$projectInfo=makeupArray($acceptArray,$g_projectKeys);
		echo updateAProject_sql($projectInfo,$userInfo);
	}
	/*
	 * 
	 */
	function accept_addProjectMember($acceptArray)
	{
		$cuserInfo=array();
		$adduserInfo=array();
		$projectInfo=array();
		global $g_AuserKeys;
		global $g_CuserKeys;
		global $g_projectKeys;
		$adduserInfo=makeupArray($acceptArray,$g_AuserKeys);
		$cuserInfo=makeupArray($acceptArray,$g_CuserKeys);	
		$projectInfo=makeupArray($acceptArray,$g_projectKeys);
		$retData=addProjectMember_sql($projectInfo,$adduserInfo,$cuserInfo);
		$intD=(int)$retData;

		$mergeData=array();
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
				//$retData["project_id"]=array("project_id"=>$intD);
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB_Error.");
		}

		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_delAProject($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$projectInfo=makeupArray($acceptArray,$g_projectKeys);
		echo delAProject_sql($projectInfo,$userInfo);
	}
	/*
	 * 
	 */
	function accept_getProject($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		$otherInfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		global $g_otherKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$isAll=false;
		$isUser=true;
		if(count($userInfo)<=0)
		{
			$isUser=false;
			$projectInfo=makeupArray($acceptArray,$g_projectKeys);
			if(count($projectInfo)<=0)
			{
				$isAll=true;
			}
		}
		$otherInfo=makeupArray($acceptArray,$g_otherKeys);
		if($isAll)
		{
			$retData=getProjectArray_sql(array(),$otherInfo);	
		}
		else
		{
			if($isUser)
			{
				$retData=getProjectArray_sql($userInfo,$otherInfo);	
			}
			else
			{
				$retData=getProjectArray_sql($projectInfo,$otherInfo);	
			}
		}
		$mergeData=array();
		if(!is_array($retData))
		{
			$intD=$retData;			
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB operating error.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			if(array_key_exists("Number",$retData))
			{
				$NumberData=$retData["Number"];
				unset($retData["Number"]); 
				$mergeData["DataKey"]=$retData;
				$mergeData["NumberKey"]=$NumberData;
			}
			else
			{
				$mergeData["DataKey"]=$retData;
			}
		}
		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_getProjectMember($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		$otherInfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		global $g_otherKeys;
		$isUser=true;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		if(count($userInfo)<=0)
		{
			$projectInfo=makeupArray($acceptArray,$g_projectKeys);
			$isUser=false;
		}
		$otherInfo=makeupArray($acceptArray,$g_otherKeys);
		if($isUser)
		{
			$retData= getProjectMember_sql($userInfo,$otherInfo);
		}
		else
		{
			$retData= getProjectMember_sql($projectInfo,$otherInfo);
		}
		$mergeData=array();
		if(!is_array($retData))
		{
			$intD=$retData;
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB operating error.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			if(array_key_exists("Number",$retData))
			{
				$NumberData=$retData["Number"];
				unset($retData["Number"]); 
				$mergeData["DataKey"]=$retData;
				$mergeData["NumberKey"]=$NumberData;
			}
			else
			{
				$mergeData["DataKey"]=$retData;
			}
		}
		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_addABug($acceptArray)
	{
		$userInfo=array();
		$projectInfo=array();
		$buginfo=array();
		global $g_userKeys;
		global $g_projectKeys;
		global $g_bugKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$projectInfo=makeupArray($acceptArray,$g_projectKeys);
		$buginfo=makeupArray($acceptArray,$g_bugKeys);
		$retData= addABuginfo_sql($buginfo,$projectInfo,$userInfo);

		$intD=(int)$retData;
		$mergeData=array();
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			$mergeData["DataKey"]=array("bug_id"=>$intD);
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB_Error.");
		}

		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function accept_delABug($acceptArray)
	{
		$userInfo=array();
		$buginfo=array();
		global $g_userKeys;
		global $g_bugKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$buginfo=makeupArray($acceptArray,$g_bugKeys);
		return delABuginfo_sql($buginfo,$userInfo);
	}
	/*
	 * 
	 */
	function accept_tranfBugHand($acceptArray)
	{
		$auserInfo=array();
		$huserInfo=array();
		$buginfo=array();
		global $g_bugKeys;
		global $g_HuserKeys;
		global $g_CuserKeys;
		$cuserInfo=makeupArray($acceptArray,$g_CuserKeys);
		$huserInfo=makeupArray($acceptArray,$g_HuserKeys);
		$buginfo=makeupArray($acceptArray,$g_bugKeys);
		$retData= tranfBugHand_sql($buginfo,$cuserInfo,$huserInfo);

		$intD=(int)$retData;
		$mergeData=array();
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB_Error.");
		}

		$jsondata=json_encode($mergeData);	
		echo "$jsondata";	
	}
	/*
	 * 
	 */
	function accept_getBug($acceptArray)
	{
		$userInfo=array();
		$buginfo=array();
		$otherInfo=array();
		$projectInfo=array();
		global $g_userKeys;
		global $g_bugKeys;
		global $g_otherKeys;
		global $g_projectKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$otherInfo=makeupArray($acceptArray,$g_otherKeys);
		$isUser=true;
		if(count($userInfo)<=0)
		{
			$isUser=false;
			$projectInfo=makeupArray($acceptArray,$g_projectKeys);
			if(count($userInfo)<=0)
			{
				$retData= Param_Error;
			}
		}
		if($isUser)
		{
			$retData= getBugArray_sql($userInfo,$otherInfo);
		}
		else
		{
			$retData= getBugArray_sql($projectInfo,$otherInfo);
		}
		$mergeData=array();
		if(!is_array($retData))
		{
			$intD=$retData;
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB operating error.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			if(array_key_exists("Number",$retData))
			{
				$NumberData=$retData["Number"];
				unset($retData["Number"]); 
				$mergeData["DataKey"]=$retData;
				$mergeData["NumberKey"]=$NumberData;
			}
			else
			{
				$mergeData["DataKey"]=$retData;
			}
		}
		$jsondata=json_encode($mergeData);
		echo "$jsondata";	
	}
	/*
	 * 
	 */
	function accept_getBugDispose($acceptArray)
	{
		$userInfo=array();
		$buginfo=array();
		$bugdispose=array();
		$otherInfo=array();
		global $g_userKeys;
		global $g_bugKeys;
		global $g_otherKeys;
		global $g_bugdisposeKeys;
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$isUser=true;
		if(count($userInfo)<=0)
		{
			$isUser=false;
			$buginfo=makeupArray($acceptArray,$g_bugKeys);
			//if(count($buginfo)<=0)
			//{
			//	$bugdispose=makeupArray($acceptArray,$g_bugdisposeKeys);
			//}
		}
		$otherInfo=makeupArray($acceptArray,$g_otherKeys);
		if($isUser)
		{
			$retData= getBugDispose_sql($userInfo,$otherInfo);
		}
		else
		{
			$retData= getBugDispose_sql($buginfo,$otherInfo);
		}
		$mergeData=array();
		if(!is_array($retData))
		{
			$intD=$retData;

			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB operating error.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
			if(array_key_exists("Number",$retData))
			{
				$NumberData=$retData["Number"];
				unset($retData["Number"]); 
				$mergeData["DataKey"]=$retData;
				$mergeData["NumberKey"]=$NumberData;
			}
			else
			{
				$mergeData["DataKey"]=$retData;
			}
		}
		$jsondata=json_encode($mergeData);
		echo "$jsondata";	
	}
	/*
	 * 
	 */
	function addaBugDispose($acceptArray)
	{
		$buginfo=array();
		$bugdispose=array();
		$userInfo=array();
		global $g_bugKeys;
		global $g_bugdisposeKeys;
		global $g_userKeys;
		$buginfo=makeupArray($acceptArray,$g_bugKeys);
		$bugdispose=makeupArray($acceptArray,$g_bugdisposeKeys);
		$userInfo=makeupArray($acceptArray,$g_userKeys);
		$retData=  addaBugDispose_sql($buginfo,$bugdispose,$userInfo);

		$intD=(int)$retData;
		$mergeData=array();
		if($intD>=0)
		{
			$mergeData["ErrorKey"]=array("code"=>SUCCESS,"msg"=>"SUCCESS.");
		}
		else
		{
			$mergeData["ErrorKey"]=array("code"=>$intD,"msg"=>"DB_Error.");
		}

		$jsondata=json_encode($mergeData);
		echo "$jsondata";
	}
	/*
	 * 
	 */
	function makeupArray($sourceArray,$baseArray)
	{
		$retArray=array();
		//Log::writeLog($baseArray);
		foreach($sourceArray as $k=>$v)
		{
			if(in_array($k,$baseArray))
			{
				$tmpKey=$k;
				$key=$k;
				$titl=substr($tmpKey,0,2);
				if ((strcasecmp($titl, "S_") == 0)||(strcasecmp($titl, "C_") == 0)||
				(strcasecmp($titl, "A_") == 0)||(strcasecmp($titl, "H_") == 0))
				{
					$key=substr($tmpKey,2);
				}
				$retArray[$key]=$v;
			}	
		}
		return $retArray;
	} 
?>