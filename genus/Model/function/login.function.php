<?php
if(isset($_POST["user"]) && isset($_POST["password"]))
{
	
	$bLogin = loginValidater($_POST["user"],$_POST["password"],$userInfo);
	if($bLogin === 1)
	{
		$_SESSION["Login"] = $userInfo;
	}else
	{
	}
}
else 
{
	
}