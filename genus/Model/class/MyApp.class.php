<?php
include_once "component/Router/App.class.php";

interface checkFileIncludeInterface
{
	
	static public function setFileInclude();
	static public function checkFileInclude();
}

Class MyApp extends App //implements checkFileIncludeInterface
{
	static public $viewPath;
	static public $modulePath;
	static private $___file____;
	static private $smartyFetch;
	
	static public function setFileInclude($file)
	{
		if(!empty(self::$___file____))
		{
			$___file____ = $file;
		}
	}
	
	static public function checkFileInclude($file)
	{
		return (self::$___file___ === $file);
	}
	
	static public function setSmartyFetch($fetch)
	{
		self::$smartyFetch = $fetch;
	}
	
	static public function getSmartyFetch()
	{
		return self::$smartyFetch;
	}
}