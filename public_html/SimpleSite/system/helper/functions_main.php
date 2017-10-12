<?php
global $C;
$C=new stdClass();

function __autoload($class_name)
{
	global $C;
	//die($class_name);
	include($C->INCPATH."classes/class_".$class_name.".php");
}
?>
