<?php	
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

if (isset($_GET))
{
foreach ($_GET as $key => $val)
	$clean["$key"] = htmlspecialchars($val);
}

if (isset($_POST))
{
foreach ($_POST as $key => $val)
	$clean["$key"] = htmlspecialchars($val);
}

if (isset($clean["url"]))
	$url = $clean["url"];

require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
