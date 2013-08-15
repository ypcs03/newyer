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
	     * ������Ϣ $config=array('engine'=>xxx,'host'=>xxx,'database'=>xxx,'username'=>xxx,'password'=>xxx,'option'=>xxx)
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
		/* �����ƺ������׳��쳣���ֵ���ģʽ    
		 * @access private */    
		private function __clone()    
		{        
			throw new Exception('Prohibited object copy;');    
		}         
		/* ��õ�������
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
		 * ��ʼ����   
		*@return <bool>  */    
		public function beginTransaction()    
		{        
			return $this->PDOInstance->beginTransaction();    
		}        
		/* Commits a transaction
		 * �ύ����    
		 * @return <bool> */    
		public function commit()    
		{        
			return $this->PDOInstance->commit();   
		}  
		/* Rolls back a transaction
		  * �ع�һ������    
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
		 * ִ��һ��SQL��䲢����Ӱ�������  ��Ҫ����insert update delete 
		 * @param <String> $statement    
		 * @return <int> */    
		public function exec($statement)    
		{   
			//Log::writeLog($statement);  
			return $this->PDOInstance->exec($statement);    
		}             
		/* Retrieve a database connection attribute 
		 * ����һ�����ݿ���������    
		 * @param <int> $attribute    
		 * @return <mixed> */    
		public function getAttribute($attribute)    
		{        
			return $this->PDOInstance->getAttribute($attribute);    
		}         
		/* Return an array of available PDO drivers
		 * ����һ����������������     
		 * @return <array> */    
		public function getAvailabelDrivers()    
		{        
			return $this->PDOInstance->getAvailableDrivers();    
		}         
		/* Returns the ID of the last inserted row or sequence value 
		 * �������²��뵽���ݿ���У���ID��   
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
		 * ִ��һ��SQL��䲢����һ�������  
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
		 * Ϊĳ��SQL�е��ַ���������� 
		 * @param <type> $input    
		 * @param <type> $parametre_type    
		 * @return <type> */    
		 public function quote($input, $parametre_type=0)    
		 {        
		 	return $this->PDOInstance->quote($input,$parametre_type);    
		 }         
       
		 /*Set an attribute    
		  * ����һ�����ݿ���������
		  * @param <int> $attribute    
		  * @param <mixed> $value    
		  * @return <bool> */    
		 public function setAttribute($attribute, $value)    
		 {        
		 	return $this->PDOInstance->setAttribute($attribute,$value);    
		 }         
		 /*Execute query and return one row in assoc array
		  *  ִ��sql��ѯ���� ���������Լ�ֵ��Ϊ�±�Ĳ�ѯ�Ľ������������ͬ������ֻ����һ��    
		  * @param <string> $statement    
		  * @return <type> */    
		 public function queryFetchAllAssoc($statement)    
		 {        
		 	return $this->PDOInstance->query($statement)->fetchAll(PDO::FETCH_ASSOC);    
		 }         
		 /* @param <type> $statement 
		  * ִ��sql��ѯ���� �Զ������ʽ���ؽ����   
		  * @return <type> */    
		 public function queryFetchAllObj($statement)    
		 {        
		 	return $this->PDOInstance->query($statement)->fetchAll(PDO::FETCH_OBJ);    
		 }
		 /*
		  * ִ��sql��ѯ���� ͬʱ�����Լ�ֵ��������Ϊ�±�Ĳ�ѯ�Ľ���� 
		  */         
		 public function queryFetchAllBoth($statement)    
		 {        
		 	return $this->query($statement)->fetchAll(PDO::FETCH_BOTH);    
		 } 
		 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����
	     * @return mixed
	     */
	     public function fetchOneAssoc()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_ASSOC);
	  	 }
		 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����
	     * @return mixed
	     */
	     public function fetchOneObj()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_OBJ);
	  	 }
	  	 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����
	     * @return mixed
	     */
	     public function fetchOneBoth()
	     {
	        return $this->PDOStatement->fetch(PDO::FETCH_BOTH);
	  	 }
	  	 		 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����array
	     * @return mixed
	     */
	     public function fetchAllAssoc()
	     {
	        return $this->PDOStatement->fetchAll(PDO::FETCH_ASSOC);
	  	 }
		 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����array
	     * @return mixed
	     */
	     public function fetchAllObj()
	     {
	        return $this->PDOStatement->fetchAll(PDO::FETCH_OBJ);
	  	 }
	  	 /*
	     * ��һ�� PDOStatement ������صĽ�����л�ȡ��һ�� fetch_style �������� POD ��η�����array
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
