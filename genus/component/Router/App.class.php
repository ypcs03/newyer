<?php 

class App
{
	static public $rootDir;
	static public $moduleDir;
	static public $router;
	
	static public $rootUrl;
	static public $moduleUrl;
	static public $entryUrl;
	
	
	
	
	static public function init($file)
	{
		static $inited;
		if (empty($inited))
		{
			$inited = true;
			self::$rootDir = dirname($file);
			
			
			self::$rootUrl = 'http://'.$_SERVER["SERVER_NAME"] . dirname($_SERVER["SCRIPT_NAME"]);
			self::$entryUrl = 'http://'.$_SERVER["SERVER_NAME"] . $_SERVER["SCRIPT_NAME"];
			
			//$tmp = self::$rootUrl;
			//$tmp = self::$entryUrl;
			//$tmp = "";
			
			// router
			self::$router = array();
			if (!empty($_SERVER["PATH_INFO"]))
			{
				$path = strtolower($_SERVER["PATH_INFO"]);
				$path = trim($path, " /");
				if (!empty($path))
				{
					self::$router = explode("/", $path);
				}
			}
		}
	}
	
	//static public function modulePath($moduleName)
	//{
	//	return "/module/" . $moduleName;		
	//}
	
	static public function smarty()
	{
		static $inst;
		if (empty($inst))
		{
			require_once self::root . "/lib/smarty/Smarty.class.php";
			$inst = new Smarty();
		}
		return $inst;
	}
	
	
	static private $smartyEntryTag;
	static public function setSmartyEntry($tag)
	{
		if ((isset($tag))&&(!isset(self::$smartyEntryTag)))
		{
			self::$smartyEntryTag = $tag;
		}
	}
	static public function checkSmartyEntry($tag)
	{
		if (isset(self::$smartyEntryTag)
			&& $tag === self::$smartyEntryTag)
		{
			return true;
		}
		
		return false;
	}
	
	
}
