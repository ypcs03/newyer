<?php
	include_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'PdoPack.php');
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'WriteLog.php');
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'errorCodeDefine.php');
	
	 if(file_exists(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'MysqlCfg.xml'))
	{
		$xml_Object=simplexml_load_file(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'MysqlCfg.xml'); //将XML中的数据,读取到数组对象中  
		$db_config["engine"]    = $xml_Object->sEngine;
		$db_config["host"]    = $xml_Object->sHost;    //服务器地址 
    	$db_config["username"]    = $xml_Object->sUser;        //数据库用户名 
    	$db_config["password"]    = $xml_Object->sPassWord;        //数据库密码 
    	$db_config["database"]    = $xml_Object->sDatabase;        //数据库名称 
    	$db_config["charset"]    = $xml_Object->sCode;  
    	$db_config["option"]   =$xml_Object->sOption;
	}
	else
	{
		echo "<br> MysqlCfg.xml file is not exist <br>";  
	};
	/*
	 * 
	 */
	function addAUserinfo_sql($userInfo)
	{
		if(array_key_exists("Email",$userInfo))
		{
			$tmp=array("Email"=>$userInfo["Email"]);
			$retArray=getUserArray_sql($tmp,null);
			//Log::writeLog($retArray);
			if((is_array($retArray))&&(count($retArray)>0))
			{
				if(array_key_exists("Number",$retArray))
				{
					if((int)$retArray["Number"]["totalNumber"]>0)
					{
						Log::writeLog("User_Exist");
						return User_Exist;
					}
				}
				else
				{
					return DB_Error;
				}
			}
		}
		if(!array_key_exists("Nickname",$userInfo))
		{
			$userInfo["Nickname"]="default_name";
		}
		if(!array_key_exists("Telephone",$userInfo))
		{
			$userInfo["Telephone"]="123456789";
		}
		$strSql="INSERT INTO userinfo(Nickname,Email,Telephone,Password)" .
				"VALUES (:Nickname,:Email,:Telephone,:Password)";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		$connection->prepare($strSql);
		$ret=$connection->execute(array(':Nickname'=>$userInfo["Nickname"],':Email'=>$userInfo["Email"],
			':Telephone'=>$userInfo["Telephone"],':Password'=>$userInfo["Password"]));
		if($ret)
		{
			$user_id=$connection->lastInsertId(null);
			return 	$user_id;
		}
		else
		{
			return DB_Error;
		}
		//return $connection->errorCode();
	}
	/*
	 * 
	 */
	function getUserArray_sql($userInfo,$otherInfo)
	{
		$strSql="SELECT * FROM userinfo ";
		$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM userinfo ";
		$sqlArray=array();
		//Log::writeLog($userInfo);
		if(count($userInfo)>0)
		{
			if(array_key_exists("user_id",$userInfo))
			{
				$strSql="SELECT * FROM userinfo WHERE user_id=:user_id ";
				$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM userinfo WHERE user_id=:user_id ";
				$sqlArray[":user_id"]=(int)$userInfo["user_id"];
			}
			else if(array_key_exists("Email",$userInfo))
			{
				$strSql="SELECT * FROM userinfo WHERE Email=:Email ";
				$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM userinfo WHERE Email=:Email ";
				$sqlArray[":Email"]=$userInfo["Email"];
				if(array_key_exists("Password",$userInfo))
				{
					$sqlArray[":Password"]=$userInfo["Password"];
					$strSql="SELECT * FROM userinfo WHERE Email=:Email and Password=:Password ";
					$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM userinfo WHERE Email=:Email and Password=:Password ";
				}
			}else
			{
				Log::writeLog("userInfo key wrongful.");
			}
		}
	
		$strSql=joggleOtherArraySQL($otherInfo,$strSql);
		//Log::writeLog($strSql);
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		//Log::writeLog($strSql);
		$connection->prepare($strSql);
		if(count($sqlArray)>0)
		{
			//Log::writeLog($sqlArray);
			$ret=$connection->execute($sqlArray);
		}
		else
		{
			Log::writeLog("sqlArray is null.");
			$ret=$connection->execute(null);
		}
		
		if($ret)
		{
			$resultArray=$connection->fetchAllAssoc();
			//Log::writeLog("0000SDSD");
			$connection->prepare($strSql_Totalnb);
			if(count($sqlArray)>0)
			{
				Log::writeLog($sqlArray);
				$ret2=$connection->execute($sqlArray);
			}
			else
			{
				Log::writeLog("sqlArray is null.");
				$ret2=$connection->execute(null);
			}
			if($ret2)
			{
				$totalNumber=$connection->fetchOneAssoc();
				$resultArray["Number"]=$totalNumber;
			}
			//Log::writeLog($resultArray);
			return $resultArray;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function addAProject_sql($projectInfo,$userInfo)
	{
		$retArray=getProjectArray_sql($projectInfo,array());//Pjtitle
		if((is_array($retArray))&&(count($retArray)>0))
		{
			Log::writeLog("DataInfo_Exist");
			return DataInfo_Exist;
		}
		if(!array_key_exists("PjInfo",$projectInfo))
		{
			$projectInfo["PjInfo"]="default Project information";
		}
		if(!array_key_exists("State",$userInfo))//State为1表示项目是激活，0表示是关闭
		{
			$projectInfo["State"]=1;
		}
		$strSqlpj="INSERT INTO projectinfo(Pjtitle,PjInfo,State)" .
				"VALUES (:Pjtitle,:PjInfo,:State)";
		if(!array_key_exists("user_id",$userInfo))
		{
			$retArray=getUserArray_sql($userInfo,array());
			if((count($retArray)>1)||(count($retArray)<=0))
			{
				Log::writeLog("User info Error");
				return User_InfoError;
			}
			else
			{
				$userInfo["user_id"]=$retArray[0]["user_id"];
			}
		}
		$strSqlpjrelation="INSERT INTO projectrelation(user_id,project_id,Relation)" .
				"VALUES (:user_id,:project_id,:Relation)";//user_id","project_id","Relation","Createtime"
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		$connection->beginTransaction();
		
		$connection->prepare($strSqlpj);
		$ret1=$connection->execute(array(":Pjtitle"=>$projectInfo["Pjtitle"],":PjInfo"=>$projectInfo["PjInfo"],
			":State"=>$projectInfo["State"]));
		if($ret1)
		{
			$project_id=$connection->lastInsertId(null);
		}
		else
		{
			
		}
		$connection->prepare($strSqlpjrelation);
		$ret2=$connection->execute(array(":user_id"=>$userInfo["user_id"],":project_id"=>$project_id,
			":Relation"=>1));//Relation 为1 表示是project 的创建者，2表示是项目的成员
		if($ret1&&$ret2)
		{
			$connection->commit();
			return $project_id;
		}
		else
		{
			$connection->rollBack();
			return Add_InfoError;
		}
	}
	/*
	 * 
	 */
	function updateAProject_sql($projectInfo,$userInfo)
	{
		if(!array_key_exists("user_id",$userInfo))
		{
			$retArray=getUserArray_sql($userInfo,array());
			if((count($retArray)>1)||(count($retArray)<=0))
			{
				Log::writeLog("User info Error");
				return User_InfoError;
			}
			else
			{
				$userInfo["user_id"]=$retArray[0]["user_id"];
			}
		}
		$strSqlauthority="SELECT id FROM projectrelation WHERE project_id=:project_id and user_id=:user_id and" .
				" Relation=:Relation ";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		$connection->beginTransaction();
		
		$connection->prepare($strSqlauthority);
		$ret=$connection->execute(array(":user_id"=>$userInfo["user_id"],":Relation"=>1,
			":project_id"=>$projectInfo["project_id"]));//Relation 为1 表示是project 的创建者，2表示是项目的成员 
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(!array_key_exists("id",$resultArray))
			{
				return authority_Error;
			}
		}
		else
		{
			
		}
		$strSqlpj="UPDATE projectinfo SET PjInfo=:PjInfo WHERE project_id=:project_id";
		$connection->prepare($strSqlpj);
		$ret=$connection->execute(array(":PjInfo"=>$projectInfo["PjInfo"],":project_id"=>$projectInfo["project_id"]));
		if($ret)
		{
			return SUCCESS;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function addProjectMember_sql($ProjectInfoArray,$adduserArray,$cuserInfo)
	{
		$strSqlauthority="SELECT id FROM projectrelation WHERE project_id=:project_id and user_id=:user_id and" .
				" Relation=:Relation ";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSqlauthority);
		$ret=$connection->execute(array(":user_id"=>$cuserInfo["user_id"],":Relation"=>1,
		":project_id"=>$ProjectInfoArray["project_id"]));//Relation 为1 表示是project 的创建者，2表示是项目的成员 
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(!array_key_exists("id",$resultArray))
			{
				return authority_Error;
			}
		}
		else
		{
			Log::writeLog("execute Error");
		}
		
		$strSqlpjrelation="INSERT INTO projectrelation(user_id,project_id,Relation)" .
				"VALUES (:user_id,:project_id,:Relation)";
		
		$connection->prepare($strSqlpjrelation);
		$ret=$connection->execute(array(":user_id"=>$adduserArray["user_id"],":project_id"=>$ProjectInfoArray["project_id"],
			":Relation"=>2));//Relation 为1 表示是project 的创建者，2表示是项目的成员 
		if($ret)
		{
			return SUCCESS;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function delAProject_sql($projectInfo,$userInfo)
	{
		$strSqlauthority="SELECT id FROM projectrelation WHERE project_id=:project_id and user_id=:user_id and" .
				" Relation=:Relation ";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSqlauthority);
		$ret=$connection->execute(array(":user_id"=>$userInfo["user_id"],":Relation"=>1,
			":project_id"=>$projectInfo["project_id"]));//Relation 为1 表示是project 的创建者，2表示是项目的成员 
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(!array_key_exists("id",$resultArray))
			{
				return authority_Error;
			}
		}
		else
		{
			
		}
		$strSqlpj="UPDATE projectinfo SET State=:State WHERE project_id=:project_id";
		$connection->prepare($strSqlpj);
		$ret=$connection->execute(array(":State"=>0,":project_id"=>$projectInfo["project_id"]));//State为1表示项目是激活，0表示是关闭
		if($ret)
		{
			return SUCCESS;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function getProjectArray_sql($queryArray,$otherInfo)
	{
		Log::writeLog("getProjectArray_sql:");
		$strSql="SELECT * FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
				" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and " .
				"projectinfo.State=:State and projectrelation.Relation=:Relation) as tmpPj";
		//$strSql_Totalnb COUNT(*) as totalNumber
		$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
				" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and " .
				"projectinfo.State=:State and projectrelation.Relation=:Relation) as tmpPj";
		//return $strSql;
		$isAll=false;
		$isUser=true;
		$isExist=false;
		if(count($queryArray)<=0)
		{
			$isAll=true;
			$strSql=$strSql." left join userinfo on tmpPj.user_id=userinfo.user_id ";
		}
		else
		{
			if(array_key_exists("user_id",$queryArray))
			{
				$strSql="SELECT * FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
				" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and projectrelation.user_id=:user_id and projectinfo.State=:State" .
				" and projectrelation.Relation=:Relation)as tmpPj";
				$strSql=$strSql." left join userinfo on tmpPj.user_id=userinfo.user_id ";
				
				$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
				" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and projectrelation.user_id=:user_id and projectinfo.State=:State" .
				" and projectrelation.Relation=:Relation)as tmpPj left join userinfo on tmpPj.user_id=userinfo.user_id ";
			}
			else
			{
				if(array_key_exists("project_id",$queryArray))
				{
					$strSql="SELECT * FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
					" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and projectinfo.project_id=:project_id " .
					" and projectrelation.Relation=:Relation and projectinfo.State=:State)as tmpPj";
					$strSql=$strSql." left join userinfo on tmpPj.user_id=userinfo.user_id ";
					
					$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM (SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo,projectrelation.user_id" .
					" FROM projectinfo,projectrelation WHERE projectrelation.project_id=projectinfo.project_id and projectinfo.project_id=:project_id " .
					" and projectrelation.Relation=:Relation and projectinfo.State=:State)as tmpPj left join userinfo on tmpPj.user_id=userinfo.user_id ";
				}
				else
				{
					$isExist=true;
					$strSql="SELECT projectinfo.project_id,projectinfo.Pjtitle,projectinfo.PjInfo" .
					" FROM projectinfo,userinfo WHERE projectinfo.Pjtitle=:Pjtitle ";
					
					//$strSql_Totalnb=
				}
				$isUser=false;
			}
		}
		//return $strSql;
		//Log::writeLog("000000000000:".$strSql);
		
		$strSql=joggleOtherArraySQL($otherInfo,$strSql);
		
		Log::writeLog($strSql);
		
		global $db_config;
		$connection =SPDO::getInstance($db_config);	
		$connection->prepare($strSql);
		$ret2=false;
		if($isAll)
		{
			$ret=$connection->execute(array(":Relation"=>1,":State"=>1));
			if($ret)
			{
				$resultArray=$connection->fetchAllAssoc();
				$connection->prepare($strSql_Totalnb);
				$ret2=$connection->execute(array(":Relation"=>1,":State"=>1));
				//Log::writeLog("000000000000:");
			}
		}
		else
		{
			if($isUser)
			{
				$ret=$connection->execute(array(":Relation"=>1,":user_id"=>$queryArray["user_id"],":State"=>1));
				if($ret)
				{
					$resultArray=$connection->fetchAllAssoc();
					$connection->prepare($strSql_Totalnb);
					$ret2=$connection->execute(array(":Relation"=>1,":user_id"=>$queryArray["user_id"],":State"=>1));
				}
			}
			else
			{
				if($isExist)
				{
					$ret=$connection->execute(array(":Pjtitle"=>$queryArray["Pjtitle"]));	
				}
				else
				{
					$ret=$connection->execute(array(":Relation"=>1,":project_id"=>$queryArray["project_id"],":State"=>1));
					if($ret)
					{
						$resultArray=$connection->fetchAllAssoc();
						$connection->prepare($strSql_Totalnb);
						$ret2=$connection->execute(array(":Relation"=>1,":project_id"=>$queryArray["project_id"],":State"=>1));
					}
				}
			}	
		}
		if($ret2)
		{
			//Log::writeLog("222222222");
			$totalNumber=$connection->fetchOneAssoc();
			$resultArray["Number"]=$totalNumber;
		}
		//Log::writeLog($resultArray);
		if($ret)
		{
			return $resultArray;
		}
		else
		{
			return DB_Error;//return $connection->errorCode();
		}
	}
	/*
	 * 
	 */
	function getProjectMember_sql($queryArray,$otherInfo)
	{
		$strSql="SELECT userinfo.user_id,userinfo.Email,userinfo.Telephone,userinfo.Password,userinfo.Createtime" .
				",userinfo.Nickname FROM userinfo,projectrelation ";
		//$strSql_Totalnb COUNT(*) as totalNumber
		$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM userinfo,projectrelation ";
		Log::writeLog($queryArray);
		if(array_key_exists("project_id",$queryArray))
		{
			$strSql=$strSql."WHERE projectrelation.user_id=userinfo.user_id and projectrelation.project_id=:project_id and projectrelation.Relation=:Relation";
			$strSql_Totalnb==$strSql_Totalnb."WHERE projectrelation.user_id=userinfo.user_id and projectrelation.project_id=:project_id and projectrelation.Relation=:Relation";
		}
		else
		{
			return Array_KeyError;
		}
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSql);
		Log::writeLog($strSql);
		
		$ret=$connection->execute(array(":Relation"=>2,":project_id"=>$queryArray["project_id"]));
		if($ret)
		{
			$resultArray=$connection->fetchAllAssoc();
			$connection->prepare($strSql_Totalnb);
			$ret2=$connection->execute(array(":Relation"=>2,":project_id"=>$queryArray["project_id"]));
			if($ret2)
			{
				$totalNumber=$connection->fetchOneAssoc();
				$resultArray["Number"]=$totalNumber;
			}
			return $resultArray;
		}
		else
		{
			return DB_Error;//return $connection->errorCode();
		}
	}
	/*
	 * 
	 */
	function addABuginfo_sql($buginfoArray,$projectArray,$userArray)
	{
		$strSqlus="SELECT userinfo.user_id,userinfo.Nickname FROM userinfo,projectrelation WHERE userinfo.user_id=" .
				"projectrelation.user_id and projectrelation.project_id=:project_id and projectrelation.Relation=:Relation";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSqlus);
		$ret=$connection->execute(array(":Relation"=>1,":project_id"=>$projectArray["project_id"]));
		if($ret)
		{
			$huserInfo=$connection->fetchOneAssoc();
		}
		else
		{
			return DB_Error;//return $connection->errorCode();
		}
		if(!array_key_exists("State",$buginfoArray))
		{
			$buginfoArray["State"]=1;
		}
		
		$connection->beginTransaction();
		
		$strSqlbg="INSERT INTO buginfo (project_id,serialnumber,seriousLevel,State,BugType,Outline)" .
				" VALUES(:project_id,:serialnumber,:seriousLevel,:State,:BugType,:Outline)";
				
		$connection->prepare($strSqlbg);
		$ret1=$connection->execute(array(":project_id"=>$projectArray["project_id"],":serialnumber"=>$buginfoArray["serialnumber"],
		 ":seriousLevel"=>$buginfoArray["seriousLevel"],":State"=>$buginfoArray["State"],
		 ":BugType"=>$buginfoArray["BugType"],":Outline"=>$buginfoArray["Outline"]));
		if($ret1)
		{
			$bug_id=$connection->lastInsertId(null);
		}
		else
		{
			
		}
		$strSqlbgRel="INSERT INTO bugdispose (user_id, bug_id, Relation, BugActive, Supply)" .
				" VALUES(:user_id,:bug_id,:Relation,:BugActive,:Supply)";//Relation 1是创建者，2是负责人，3是其他人
		//BugActive 1:active 2:fixed 3:over
		$connection->prepare($strSqlbgRel);
		
		$ret2=$connection->execute(array(":user_id"=>$userArray["user_id"],":bug_id"=>$bug_id,
		 ":Relation"=>1,":BugActive"=>1,":Supply"=>"default information"));
		 
		$ret3=$connection->execute(array(":user_id"=>$huserInfo["user_id"],":bug_id"=>$bug_id,
		 ":Relation"=>2,":BugActive"=>1,":Supply"=>"default information"));
		 
		if($ret1&&$ret2&&$ret3)
		{
			$connection->commit();
			return $bug_id;
		}
		else
		{
			$connection->rollBack();
			return Add_InfoError;
		}
	}
	/*
	 * 
	 */
	function delABuginfo_sql($buginfo,$userInfo)
	{
		$strSql="UPDATE buginfo SET State=:State WHERE bug_id=:bug_id";
		$strSqlauthority="SELECT id FROM bugdispose WHERE user_id=:user_id and Relation=:Relation ";
		
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSqlauthority);
		$ret=$connection->execute(array(":user_id"=>$userInfo["user_id"],"Relation"=>1));
		$isCuer=false;
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(array_key_exists("id",$resultArray))
			{
				$isCuer=true;
			}
		}
		if(!$isCuer)
		{
			$ret=$connection->execute(array(":user_id"=>$userInfo["user_id"],"Relation"=>2));
			if($ret)
			{
				$resultArray=$connection->fetchOneAssoc();
				if(!array_key_exists("id",$resultArray))
				{
					return authority_Error;
				}
			}
		}
		$connection->prepare($strSql);
		$ret=$connection->execute(array(":bug_id"=>$buginfo["bug_id"],"State"=>0));
		if($ret)
		{
			return SUCCESS;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function tranfBugHand_sql($buginfo,$cuserInfo,$huserInfo)
	{
		$strSqlauthority="SELECT id FROM bugdispose WHERE user_id=:user_id and Relation=:Relation ";
		global $db_config;
		//Log::writeLog($cuserInfo);
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSqlauthority);
		
		$ret=$connection->execute(array(":user_id"=>$cuserInfo["user_id"],":Relation"=>1));
		
		$isCuer=false;
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(array_key_exists("id",$resultArray))
			{
				$isCuer=true;
			}
		}
		if(!$isCuer)
		{
			$ret=$connection->execute(array(":user_id"=>$cuserInfo["user_id"],":Relation"=>2));
			if($ret)
			{
				$resultArray=$connection->fetchOneAssoc();
				if(!array_key_exists("id",$resultArray))
				{
					return authority_Error;
				}
			}	
		}
		
		$strSqlHand="SELECT projectrelation.user_id FROM projectrelation,buginfo " .
				"WHERE projectrelation.user_id=:user_id and projectrelation.project_id=buginfo.project_id " .
				"and buginfo.bug_id=:bug_id";
		$connection->prepare($strSqlHand);
		$ret=$connection->execute(array(":user_id"=>$huserInfo["user_id"],":bug_id"=>$buginfo["bug_id"]));
		if($ret)
		{
			$resultArray=$connection->fetchOneAssoc();
			if(!array_key_exists("user_id",$resultArray))
			{
				return authority_Error;
			}
		}
		$strSql="UPDATE bugdispose SET user_id=:user_id WHERE bug_id=:bug_id and Relation=:Relation";
		$connection->prepare($strSql);
		$ret=$connection->execute(array(":user_id"=>$huserInfo["user_id"],":bug_id"=>$buginfo["bug_id"],":Relation"=>2));
		if($ret)
		{
			return SUCCESS;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function getBugArray_sql($queryArray,$otherInfo)
	{
		if(!array_key_exists("project_id",$queryArray))
		{
			return Array_KeyError;
		}	
		//$strSql_Totalnb COUNT(*) as totalNumber
		$strSql="SELECT * FROM (SELECT buginfo.bug_id, buginfo.serialnumber, buginfo.seriousLevel, buginfo.BugType, buginfo.Outline,bugdispose.BugActive," .
				"userinfo.user_id as C_user_id,userinfo.Nickname as C_Nickname " .
				"FROM buginfo,userinfo,bugdispose " .
				"WHERE buginfo.project_id=:project_id and buginfo.bug_id=bugdispose.bug_id and bugdispose.Relation=:cRelation " .
				"and bugdispose.user_id=userinfo.user_id)TmpTba " .
				"left join (SELECT buginfo.bug_id,userinfo.user_id as H_user_id,userinfo.Nickname as H_Nickname FROM buginfo,userinfo,bugdispose " .
				"WHERE buginfo.project_id=:project_id and buginfo.bug_id=bugdispose.bug_id and bugdispose.Relation=:hRelation" .
				" and bugdispose.user_id=userinfo.user_id)" .
				"TmpTbb on TmpTba.bug_id=TmpTbb.bug_id";
				
		$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM (SELECT buginfo.bug_id, buginfo.serialnumber, buginfo.seriousLevel, buginfo.BugType, buginfo.Outline,bugdispose.BugActive," .
				"userinfo.user_id as C_user_id,userinfo.Nickname as C_Nickname " .
				"FROM buginfo,userinfo,bugdispose " .
				"WHERE buginfo.project_id=:project_id and buginfo.bug_id=bugdispose.bug_id and bugdispose.Relation=:cRelation " .
				"and bugdispose.user_id=userinfo.user_id)TmpTba " .
				"left join (SELECT buginfo.bug_id,userinfo.user_id as H_user_id,userinfo.Nickname as H_Nickname FROM buginfo,userinfo,bugdispose " .
				"WHERE buginfo.project_id=:project_id and buginfo.bug_id=bugdispose.bug_id and bugdispose.Relation=:hRelation" .
				" and bugdispose.user_id=userinfo.user_id)" .
				"TmpTbb on TmpTba.bug_id=TmpTbb.bug_id";
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSql);
		$ret=$connection->execute(array(":project_id"=>$queryArray["project_id"],":cRelation"=>1,":hRelation"=>2));
		if($ret)
		{
			$resultArray=$connection->fetchAllAssoc();
			$connection->prepare($strSql_Totalnb);
			$ret2=$connection->execute(array(":project_id"=>$queryArray["project_id"],":cRelation"=>1,":hRelation"=>2));
			if($ret2)
			{
				$totalNumber=$connection->fetchOneAssoc();
				$resultArray["Number"]=$totalNumber;
			}
			return $resultArray;
		}
		else
		{
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function getBugDispose_sql($queryArray,$otherInfo)
	{
		$strSql="";
		$strSql_Totalnb="";
		if(count($queryArray)<=0)
		{
			return Param_Error;
		}
		$isUser=true;
		//$strSql_Totalnb COUNT(*) as totalNumber
		if(array_key_exists("bug_id",$queryArray))
		{
			$strSql="SELECT * FROM bugdispose WHERE bugdispose.bug_id=:bug_id and bugdispose.Relation=:Relation";
			$isUser=false;
			$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM bugdispose WHERE bugdispose.bug_id=:bug_id and bugdispose.Relation=:Relation";
		}
		else
		{
			$strSql="SELECT * FROM bugdispose WHERE bugdispose.user_id=:user_id and bugdispose.Relation=:Relation";
			$strSql_Totalnb="SELECT COUNT(*) as totalNumber FROM bugdispose WHERE bugdispose.user_id=:user_id and bugdispose.Relation=:Relation";
		}
		
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$connection->prepare($strSql);
		Log::writeLog($strSql);
		$ret2=false;
		if($isUser)
		{
			$ret=$connection->execute(array(":user_id"=>$queryArray["user_id"],":Relation"=>3));
			if($ret)
			{
				$resultArray=$connection->fetchAllAssoc();
				$connection->prepare($strSql_Totalnb);
				$ret2=$connection->execute(array(":user_id"=>$queryArray["user_id"],":Relation"=>3));
			}
		}
		else
		{
			$ret=$connection->execute(array(":bug_id"=>$queryArray["bug_id"],":Relation"=>3));
			if($ret)
			{
				$resultArray=$connection->fetchAllAssoc();
				$connection->prepare($strSql_Totalnb);
				$ret2=$connection->execute(array(":bug_id"=>$queryArray["bug_id"],":Relation"=>3));
			}
		}
		if($ret2)
		{
			$totalNumber=$connection->fetchOneAssoc();
			$resultArray["Number"]=$totalNumber;
		}
		if($ret)
		{
			//$resultArray=$connection->fetchAllAssoc();
			return $resultArray;
		}
		else
		{
			return DB_Error;
		}
		
	}
	/*
	 * 
	 */
	function addaBugDispose_sql($buginfo,$bugdispose,$userInfo)
	{
		global $db_config;
		$connection =SPDO::getInstance($db_config);
		
		$strSql="INSERT INTO bugdispose (user_id, bug_id, Relation, BugActive, Supply)" .
				" VALUES(:user_id,:bug_id,:Relation,:BugActive, :Supply)";//Relation 1是创建者，2是负责人，3是其他人
		
		$connection->beginTransaction();		
		$connection->prepare($strSql);
		$ret=$connection->execute(array(":bug_id"=>$buginfo["bug_id"],":user_id"=>$userInfo["user_id"],
			":Relation"=>3,":BugActive"=>$bugdispose["BugActive"], ":Supply"=>$bugdispose["Supply"]));
		if($ret)
		{
			$BugDispose_id=$connection->lastInsertId(null);
			//return 	$BugDispose_id;
		}	
		$strSqlupdate="UPDATE bugdispose SET BugActive=:BugActive WHERE bug_id=:bug_id and Relation=:Relation";		
		$connection->prepare($strSqlupdate);
		$ret2=$connection->execute(array(":bug_id"=>$buginfo["bug_id"],
			":Relation"=>1,":BugActive"=>$bugdispose["BugActive"]));
		if($ret&&$ret2)
		{
			$connection->commit();
			return 	$BugDispose_id;
		}	
		else
		{
			$connection->rollBack();
			return DB_Error;
		}
	}
	/*
	 * 
	 */
	function joggleOtherArraySQL($otherInfo,$strSql)
	{
		$retStr=$strSql;
		//Log::writeLog("555:".$strSql);
		if(count($otherInfo)>0)
		{
			if(array_key_exists("sortrow",$otherInfo))
			{
				if(array_key_exists("sorttype",$otherInfo))
				{
					if("UP"==$otherInfo["sorttype"])
						$retStr=$retStr." ORDER BY ".$otherInfo["sortrow"]." ASC";
					else
						$retStr=$retStr." ORDER BY ".$otherInfo["sortrow"]." DESC";
				}
				else
				{
					$retStr=$retStr." ORDER BY".$otherInfo["sortrow"]." ASC";
				}
			}
			if((array_key_exists("Pageindex",$otherInfo))&&(array_key_exists("NumberPg",$otherInfo)))
			{
				//if(1==(int)$otherInfo["Paged"])
				$number=(int)$otherInfo["NumberPg"];
				$begin=((int)$otherInfo["Pageindex"]-1)*$number;
				$retStr=$retStr." LIMIT ".$begin.",".$number;
			}	
		}
		//Log::writeLog("222222222".$retStr);
		return $retStr;
	}
?> 