<?php
	// Fichier SPDO.php
	require_once(realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'WriteLog.php');
	 
	class SPDO
	{    
		/* Instance de la classe SPDO    
		 * @var SPDO    
		 * @access private */      
		private $PDOInstance = null;         
		/* Instance de la classe SPDO    
		 * @var SPDO    
		 * @access private    
		 * @static */    
		private static $instance = null;         
		/* Constante:    
		 * @var string */     
		//const DEFAULT_SQL_USER = '*******'; // =>  exemple 'root'         
		/* Constante:    
		 * @var string */     
		//const DEFAULT_SQL_HOST = '*******';  // => exemple = 'localhost'         
		/* Constante:   
		 * @var string */     
		//const DEFAULT_SQL_PASS = '*******'; // =>    
		/* Constante:   
		 * @var string */     
		//const DEFAULT_SQL_DTB = '*******'; // => 
		/*
		 * engine = 'mysql'; host = 'localhost'; database = '';
		 * dns = engine.':dbname='.database.";host=".host; 
	     * 配置信息 $config=array('engine'=>xxx,'host'=>xxx,'database'=>xxx,'username'=>xxx,'password'=>xxx,'option'=>xxx)
	     * @var array
	     */
	    protected $Config; 
	     
		private $PDOStatement=null;       
		/* Constructeur de la classe SPDO    
		 * @param void    
		 * @return void    
		 * @acess private    
		 * @see PDO::__construct() */      
		private function __construct($config)    
		{              
			try        
			{
				$this->Config=$config;      
				// Nouvelle instance PDO :             
				//$this->PDOInstance = new PDO('mysql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS);
				$dns=$this->Config['engine'].':dbname='.$this->Config['database'].";host=".$this->Config['host'].";charset=".$this->Config['charset']; 
				if(is_array($this->Config['option'])) 
				{
					$this->PDOInstance = new PDO($dns,$this->Config['username'],$this->Config['password'],$this->Config['option']);
				}
				else
				{
					$this->PDOInstance = new PDO($dns,$this->Config['username'],$this->Config['password']);
				}          
				//            
				$this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);        
			}        
			catch (PDOException $e)        
			{            
				echo "<b>Erreur PDO:</b> ".$e->getMessage()."<br />\n";        
			}      
		}         
		/* 对象复制函数，抛出异常保持单例模式    
		 * @access private */    
		private function __clone()    
		{        
			throw new Exception('Prohibited object copy;');    
		}         
		/* 获得单例对象
		 * retourne  SPDO */    
		public static function getInstance($config)    
		{        
			if(is_null(self::$instance))        
			{                  
				self::$instance = new SPDO($config);        
			}        
			return self::$instance;    
		}         
		/* Initiates a transaction 
		 * 开始事务   
		*@return <bool>  */    
		public function beginTransaction()    
		{        
			return $this->PDOInstance->beginTransaction();    
		}        
		/* Commits a transaction
		 * 提交事务    
		 * @return <bool> */    
		public function commit()    
		{        
			return $this->PDOInstance->commit();   
		}  
		/* Rolls back a transaction
		  * 回滚一个事务    
		  * @return <bool> */    
		public function rollBack()    
		{        
		 	return $this->PDOInstance->rollBack();    
		}        
		/* Fetch the SQLSTATE associated with the    last operation on the database handle    
		 * @return <string> */    
		public function errorCode()    
		{       
			return $this->PDOInstance->errorCode();    
		}         
		/* Fetch extended error information associated with    the last operation on the database handle    
		 * @return <array> */    
		public function erroInfo()    
		{        
			return $this->PDOInstance->errorInfo();    
		}         
		/* Executes an SQL statement, return the number of affected row 
		 * 执行一条SQL语句并返回影响的行数  主要用于insert update delete 
		 * @param <String> $statement    
		 * @return <int> */    
		public function exec($statement)    
		{   
			//Log::writeLog($statement);  
			return $this->PDOInstance->exec($statement);    
		}             
		/* Retrieve a database connection attribute 
		 * 返回一个数据库连接属性    
		 * @param <int> $attribute    
		 * @return <mixed> */    
		public function getAttribute($attribute)    
		{        
			return $this->PDOInstance->getAttribute($attribute);    
		}         
		/* Return an array of available PDO drivers
		 * 返回一个可用驱动的数组     
		 * @return <array> */    
		public function getAvailabelDrivers()    
		{        
			return $this->PDOInstance->getAvailableDrivers();    
		}         
		/* Returns the ID of the last inserted row or sequence value 
		 * 返回最新插入到数据库的行（的ID）   
		 * @param <type> $name    
		 * @return <type> */    
		public function lastInsertId($name)    
		{        
			return $this->PDOInstance->lastInsertId($name);    
		}         
		/* Prepare an SQL statement, returning a result set as PDOStatement object    
		 * @param <String> $statement    
		 * @return <type> */    
		public function prepare($statement,$driver_options=false)    
		{        
			if (!$driver_options)        
			{            
				$driver_options=array();       
			}    
			$this->PDOStatement= $this->PDOInstance->prepare($statement,$driver_options); 
			return $this->PDOStatement;  
		} 
		/* PDOStatement object execute prepare   
		 * @param <String> $input_array    
		 * @return <type> bool */    
		public function execute($input_array)    
		{ 
			if((is_array($input_array))&&(count($input_array)>0))    
				return $this->PDOStatement->execute($input_array);
			else  
				return $this->PDOStatement->execute();
		}         
		/* Executes an SQL statement, returning a result set as PDOStatement object  
		 * 执行一条SQL语句并返回一个结果集  
		 * @param <string> $statement    
		 * @return PDOStatement 
		 */   
		public function query($statement)    
		{       
			try        
			{    
				$this->PDOStatement= $this->PDOInstance->query($statement);    
				//return $this->PDOInstance->query($statement);
				return $this->PDOStatement;        
			}         
			catch (PDOException $e)        
			{            
				echo $e->getMessage();        
			}    
		}        
		/* Quotes a string for use in a query   
		 * 为某个SQL中的字符串添加引号 
		 * @param <type> $input    
		 * @param <type> $parametre_type    
		 * @return <type> */    
		 public function quote($input, $parametre_type=0)    
		 {        
		 	return $this->PDOInstance->quote($input,$parametre_type);    
		 }         
       
		 /*Set an attribute    
		  * 设置一个数据库连接属性
		  * @param <int> $attribute    
		  * @param <mixed> $value    
		  * @return <bool> */    
		 public function setAttribute($attribute, $value)    
		 {        
		 	return $this->PDOInstance->setAttribute($attribute,$value);    
		 }         
		 /*Execute query and return one row in assoc array
		  *  执行sql查询并且 仅仅返回以键值作为下标的查询的结果集，名称相同的数据只返回一个    
		  * @param <string> $statement    
		  * @return <type> */    
		 public function queryFetchAllAssoc($statement)    
		 {        
		 	return $this->PDOInstance->query($statement)->fetchAll(PDO::FETCH_ASSOC);    
		 }         
		 /* @param <type> $statement 
		  * 执行sql查询并且 以对象的形式返回结果集   
		  * @return <type> */    
		 public function queryFetchAllObj($statement)    
		 {        
		 	return $this->PDOInstance->query($statement)->fetchAll(PDO::FETCH_OBJ);    
		 }
		 /*
		  * 执行sql查询并且 同时返回以键值和数字作为下标的查询的结果集 
		  */         
		 public function queryFetchAllBoth($statement)    
		 {        
		 	return $this->query($statement)->fetchAll(PDO::FETCH_BOTH);    
		 } 
		 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行
	     * @return mixed
	     */
	     public function fetchOneAssoc()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_ASSOC);
	  	 }
		 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行
	     * @return mixed
	     */
	     public function fetchOneObj()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_OBJ);
	  	 }
	  	 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行
	     * @return mixed
	     */
	     public function fetchOneBoth()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_BOTH);
	  	 }
	  	 		 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行array
	     * @return mixed
	     */
	     public function fetchAllAssoc()
	     {
	        return $this->PDOStatement->fetchAll(PDO::FETCH_ASSOC);
	  	 }
		 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行array
	     * @return mixed
	     */
	     public function fetchAllObj()
	     {
	        return $this->PDOStatement->fetchAll(PDO::FETCH_OBJ);
	  	 }
	  	 /*
	     * 从一个 PDOStatement 对象相关的结果集中获取下一行 fetch_style 参数决定 POD 如何返回行array
	     * @return mixed
	     */
	     public function fetchAllBoth()
	     {
	        return $this->PDOStatement->fetchAll(PDO::FETCH_BOTH);
	  	 }          
		 /*Close a connection database    
		  * @access public    
		  * @return <void> */    
		 public function close()    
		 {        
		 	$this->PDOInstance = null;    
		 }     
	}		 
?>
