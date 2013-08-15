<?php

$dir = dirname(__FILE__);

// target php
$target = $dir . "/view";
if (count(App::$router) > 0)
{
	foreach (App::$router as $value)
	{
		$target = $target . "/" . $value;
	}
}
else 
{
	$target = $target . "/AcceptHttpReturn";
}
$target = $target . ".php";

if (!file_exists($target))
{
	exit("sorry, view not found: " . $target);
}

//include MyApp::$moduleDir."/SQL/testInterface.php";
//echo $target;
include $target;