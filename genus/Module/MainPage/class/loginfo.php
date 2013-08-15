<?php
	require_once (realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'errorCodeDefine.php') );
	
	//include (realpath(dirname(__FILE__).DERECTORY_SEPARATOR.'conn.php'));	
	class loginfo{
		private $usrid;
		//private $sql;
		
		function __construct(){
			$this->usrid = 0;
		}
				
		/*FOR REGISTER
		 */		
		function getmail($inmail) {
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'conn.php');
			
			$sqlsting = "SELECT COUNT(*) FROM tb_login WHERE MAIL = '$inmail'";
			$result = $sql->query($sqlsting);
			$arry = $result -> fetch();
			$num = $arry[0];
	
			/*
			echo $inmail;
			print_r($arry);
			echo $num;*/
			
			if ($num == 0)
				return 	USR_NOT_EXISTED;
			else 
				return USR_EXISTED;	
		}
		
		function confimpwd($inmail,$usrpwd){
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'conn.php');
			$sqlsting = "SELECT * FROM tb_login WHERE MAIL='$inmail'";
			$result = $sql->prepare($sqlsting);
			$result -> execute();
			
			$arry = $result -> fetch(PDO::FETCH_ASSOC);
			print_r($arry);
			
			echo $arry['PWD'];
			
			
			if(md5($usrpwd) == $arry['PWD'])
			{
				$this->usrid = $arry['ID'];
				return LOGIN;
			}
			else 
				return PWD_ERROR;
		}
		
		function getid()
		{
			return $this->usrid;
		}
		
		function register($mail,$usrpwd,$type){
			/*
			 * the data must be checked before submit
			 * here assume the data transmit in is correct
			 */
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'conn.php');
			$usr = self::getmail($mail);
			
			if($usr == USR_NOT_EXISTED){
				$sqlstring = "INSERT INTO tb_login(MAIL,PWD,TYPE) values(:mail, :usrpwd, :type)";
				$usrpwd = md5($usrpwd);
				$rs = $sql->prepare($sqlstring);
				$rs->bindParam(':mail',$mail);
				$rs->bindParam(':usrpwd',$usrpwd);
				$rs->bindParam(':type',$type);
				if($rs->execute())
					return SUCCESS;
				else 
					return DB_ERROR;
			}
			else 
				return $usr;		
		}
		
		static function logout(){
			session_start();
			if(isset($_SESSION["usrid"])){
				session_unset();
				session_destroy();
			}
		}
	}
	
	
	class user {
		private $id;
		private $name;
		
		function getnameById($id)
		{
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'conn.php');
			$sqlstring = "SELECT * FROM tb_";		
		}
	}