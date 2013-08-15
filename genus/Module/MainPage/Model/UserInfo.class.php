<?php
include_once MyApp::$moduleDir."/SQL/CallDBInterface.php";

Class UserInfo
{
	private $_user;
	private $_passwork;
	private $_userInfo;
	
	static public function loginCheck()
	{
		if(isset($_SESSION["UserInfo"]))
		{
			return true;
		}
	}
	
	public function login($queryArray,$otherArray)
	{
		$ret=getUserInfoArray($queryArray,$otherArray);
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			if(array_count_values($ret["NumberKey"])==0)
			{
				return false;
			}
			foreach( $ret["DataKey"] as $temp)
			{
				$userInfo = array(
					'user_id'=>$temp["user_id"],
					'Nickname'=>$temp["Nickname"],
					'Email'=>$temp["Email"],
					'Telephone'=>$temp["Telephone"],
					'Password'=>$temp["Password"],
					'Createtime'=>$temp["Createtime"],);				
			}
			$this->_userInfo = $userInfo;
			$_SESSION["UserInfo"] = $userInfo;
			return true;
		}
		return false;
	}
	
	public function addUser($infoArray)
	{
		$ret=addAUserInfo($infoArray);
		if(isset($ret["ErrorKey"]) && $ret["ErrorKey"]["code"]==0)
		{
			return true;
		}
		return false;
	}
	
	public function returnUserInfo()
	{
		return $this->_userInfo;
	}
	
	public function logout()
	{
		unset($_SESSION["UserInfo"]);
	}
	
}