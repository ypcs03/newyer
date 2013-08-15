<?php
	class newsinfo{
		/**
		 * tb_news tb_comment used the head
		 * 
		 * $news_all stored the all news about the usr and his friends
		 * $comment stored all the comments
		 * find the comment of $news_all[$i] in $comment[$i]
		 */
		public $news_all;
		public $news_myself;
		public $comment;
		private $USRID;
		public $last_num;

		function __construct($usrid)
		{
			$this->USRID = $usrid;
		}
		
		function insertnews($txt,$head,$nickname)
		{
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'/conn.php');
			$usrid = $this->USRID;
			
			$sqlstring = "INSERT INTO tb_news(USRID,CONTENT,IMG) VALUES(:usrid,:content,:img,:nickname)";
			$rs = $sql -> prepare($sqlstring);
			$rs -> bindParam(':usrid',$usrid);
			$rs -> bindParam(':content',$txt);
			$rs -> bindParam(':img',$head);
			$rs -> bindParam(':nickname',$nickname);
			
			$rs -> execute();			
		}
		
		function insertcomment($newsid,$content,$head,$nickname)
		{
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'/conn.php');
			//$sql_search_head = "SELECT * FROM tb_personalinfo WHERE ID = '$com_usrid'";
			$sqlstring = "INSERT INTO tb_comments(NEWSID,CONTENT,USRID,IMG,NICKNAME) 
											VALUES(:newsid,:content,:comusrid,:head_img,:nickname)";			
			$com_usrid = $this->USRID;
			$rs = $sql -> prepare($sqlstring);
					
			$rs -> execute(array(':newsid'=>$newsid,
								 ':content'=>$content,
								 ':comusrid'=>$com_usrid,
								 ':head_img'=>$head,
							     ':nickname'=>$nickname));		
		}
		
		/*$usrid: specificy user
		 * get all the comments of the news that has captured
		 */
		function Allnews_comments()
		{
			$usrid = $this->USRID;
			$this->news_all = self::getnews($usrid);
			
			for($i = 0; $i < count($this->news_all); $i ++)
			{
				$newsid = $this->news_all[$i]['NEWSID'];
								
				$this->comment[$i]= self::getcommentByNewsid($newsid);			
			}
		}
		
		/*
		 * get all the news about me
		 * $index  from which record we want to get(begin with 0)
		 * $num    the nummber of news we want to get
		 */
		function getmynews($index = 0,$num = 10)
		{
			$usrid = $this->USRID;
			$sql_selfnews = "SELECT * FROM tb_news WHERE USRID = '$usrid' 
							OR NEWSID IN 
							(SELECT NEWSID FROM tb_comment WHERE USRID = '$usrid')";
			
			$news_me = self::getnews($sql_selfnews, $index, $num);
			$this->news_myself = $news_me;
			return $news_myself;
		}
		
		/*
		 * get all the news including myself, my friends ,the commpany I paid attention and so on
		 */
		function getallnews($index = 0,$num = 10)
		{
			$USRID = $this->USRID;
			$sql_allfriend = "SELECT * FROM 
				(SELECT * FROM tb_news 
					WHERE USRID IN 
						(SELECT FRIENDID FROM tb_friend WHERE USRID = '$USRID') 
						OR USRID = '$USRID' 
						ORDER BY USRID DESC) A 
						LIMIT $index,$num";
			$news_a = self::getnews($sql_allfriend, $index, $num);
			$this->news_all = $news_a;
			return $news_a;
		}
		
				
		function getnews($sqlstring, $index,$num){
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'/conn.php');
			$news_num = 0;
			$USRID = $this->USRID;
			/**
			 * 
			 * select the news about my friends and me to showup in the index page
			 * @var unknown_type
			 */
			/*$sqlstring = "SELECT * FROM 
				(SELECT * FROM tb_news 
					WHERE USRID IN 
						(SELECT FRIENDID FROM tb_friend WHERE USRID = '$USRID') 
						OR USRID = '$USRID' 
						ORDER BY USRID DESC) A 
						LIMIT $index,$num";*/
			$result = $sql->prepare($sqlstring);
			$result -> execute();
			
			while ($arry = $result->fetch(PDO::FETCH_ASSOC))
			{
				$news[$news_num] = array( 'ID' => $arry['USRID'],
						'CONTENT' => $arry['CONTENT'],
						'TIME'    => $arry['TIME'],
						'HEAD'    => $arry['IMG'],
						'NEWSID'  => $arry['NEWSID'],
						'NICKNAME'=> $arry['NICKNAME']
						); 
				$news_num ++;
			}	
			return $news;	
		}
		
		function getcommentByNewsid($newsid, $index=0,$num = 5)
		{
			include realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'/conn.php');
						
			$comment_index = 0;
			$sql_comment = "SELECT * FROM tb_comment WHERE NEWSID = '$newsid'";
			$comment_news = $sql->prepare($sql_comment);
			$comment_news -> execute();
			
			while ($comment_all = $comment_news -> fetch(PDO::FETCH_ASSOC))
			{
				$comment[$comment_index] = array('ID' => $comment_all['USRID'],
							'TIME'=> $comment_all['TIME'],
							'CONTENT' => $comment_all['CONTENT'],
							'HEAD' => $comment_all['IMG'],
							'NICKNAME'=>$comment_all['NICKNAME']
							);
				$comment_index ++;
			}
			return $comment;		
		}
	}	
	
	$test = new newsinfo();
	$test->Allnews_comments(1);
	
	for ($news_index = 0 ;$news_index < count($test->news_all); $news_index ++ )
	{
		print_r($test->news_all[$news_index]);
		for ($comment_index = 0; $comment_index < count($test->comment[$news_index]); $comment_index ++)
		{
			print "<br>comment $news_index&nbsp;&nbsp;$comment_index;<br>";
			print_r ($test->comment[$news_index]);
			print "<br>";
		}
		print "<br><br>";
	}
	