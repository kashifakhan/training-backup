<?php
//require_once("themes/defaults/1504869439.html");
$SCRIPT_START_TIME	= microtime(TRUE);
chdir(dirname(__FILE__));
require_once('helper/functions_main.php');
require_once('config_system.php');
session_start();
$catched=new cache();

$db=new mysql($C->DB_HOST,$C->DB_USER,$C->DB_PASS,$C->DB_NAME);
$db2= & $db;
if($C->INSTALLED)
{
	return ;
}
$network=new network();
$network->Load();
$page=new page();
$page->Load();
?>