<?php

/*this file is used to connect to the db
 * dbhost:127.0.0.1
 * user:root
 * pwd:
 * database:newyer
 */
	$username = "root";
	$pwd = "";
	$dbhost = "127.0.0.1";
	$dbname = "newyer";

	$sql = new PDO('mysql:host=127.0.0.1; dbname=newyer', $username, $pwd);
	
	$usrid = 2;
	$sqlstring = "SELECT * FROM tb_news WHERE USRID = '$usrid' OR NEWSID IN (SELECT NEWSID FROM tb_comment WHERE USRID = '$usrid')";
	
	$result = $sql->prepare($sqlstring);
	$result -> execute();

	print "result <br>";
	
	while ($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		print "<br><br>";
		print_r($row);
		
	}
	
/*	$index = 0;
	$num = 11;
	$USRID = 1;
	
	
	//$sqlstring = "SELECT * FROM tb_news WHERE USRID = '$USRID'";
	//$sqlstring = "SELECT * FROM (SELECT * FROM tb_news WHERE USRID = '$USRID' ORDER BY TIME ASC) LIMIT 0,$num";
	//$sqlstring = "SELECT * FROM (SELECT * FROM tb_news WHERE USRID IN ('$USRID' , 2) ORDER BY USRID desc) A LIMIT 0,$num";
	$sqlstring = "SELECT * FROM 
				(SELECT * FROM tb_news 
					WHERE USRID IN 
						(SELECT FRIENDID FROM tb_friend WHERE USRID = '$USRID') 
						OR USRID = '$USRID' 
						ORDER BY USRID DESC) A 
						LIMIT 0,14";
	$sql_comment = "SELECT * FROM tb_comment WHERE NEWSID = '$comment'";
	//$sqlstring = "SELECT TOP '$num' USRID,NEWSID,CONTENT,TIME FROM tb_news \
	//	WHERE USRID ='$USRID') ORDER BY TIME asc";

	/*
	$sqlstring = "SELECT TOP '$num' USRID,NEWSID,CONTENT,TIME FROM tb_news \
		WHERE USRID IN('$USRID',SELECT ID FROM tb_friend WHERE ID ='$USRID') ORDER BY TIME asc";
	*/
	
	/*$result = $sql->prepare($sqlstring);
	$result -> execute();

	print "result <br>";
	 
	$j = 0;
	while ($arry = $result->fetch(PDO::FETCH_ASSOC))
	{
		//get the comment of every news
		
		$news = array( 'ID' => $arry['USRID'],
						'CONTENT' => $arry['CONTENT'],
						'TIME'    => $arry['TIME'],
						'HEAD'    => $arry['IMG']
						); 
		
		$newsid = $arry['NEWSID'];
		$sql_comment = "SELECT * FROM tb_comment WHERE NEWSID = '$newsid'";
		$comment_news = $sql->prepare($sql_comment);
		$comment_news -> execute();
		$i = 0;
		while ($comment_all = $comment_news->fetch(PDO::FETCH_ASSOC))
		{
			$comment[$i] = array('ID' => $comment_all['USRID'],
							'TIME'=> $comment_all['TIME'],
							'CONTENT' => $comment_all['CONTENT'],
							'HEAD' => $comment_all['IMG']
							);
			
			print "comment<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			print_r($comment[$i]);
			print "<br>";
			
			$i ++;
		}
		
		for ($j = 0; $j < count($comment); $j ++)
		{
			print_r($comment[$j]);
		}
		
		
		print "news <br><b>";
		print_r($news);
		print "</b><br><br>";
		$j ++;
	}*/	
	
	
	
	
	/*
	$inmail = "278677131@qq.com";
	
	$rs = $sql->prepare("SELECT * FROM tb_login WHERE MAIL='$inmail'");
	$rs->execute();
	
	//print $rs->fetchColumn();
	$sf = $rs->fetch(PDO::FETCH_ASSOC);
	print_r($sf);
	print $sf['MAIL'];
	*/
	//print "<br>";
	
	//$row = $rs->fetch( PDO::FETCH_ASSOC);
	
		
	
	
	
	/*
	$db_connect=mysql_connect($dbhost,$username,$pwd) \
		or die("Unable to connect to the MySQL!");
	mysql_select_db($dbname,$db_connect) or die("can't connect to the $dbname");
	*/