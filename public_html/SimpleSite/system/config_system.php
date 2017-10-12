<?php
global $C;
$C=new stdClass();
$C->INCPATH= dirname(__FILE__).'/'; 
//die($C->INCPATH);
$C->CACHE_MECHANISM="";
if(! file_exists($C->INCPATH.'config_main.php') ) {
		exit;
	}
	require_once($C->INCPATH.'config_main.php');
	
	chdir( $C->INCPATH );
	$C->DEBUG_MODE		= in_array($_SERVER['REMOTE_ADDR'], $C->DEBUG_USERS);
	//print_r($C->DEBUG_USERS);die;
		if( $C->DEBUG_MODE ) 
		{
			ini_set( 'error_reporting', E_ALL | E_STRICT);
			ini_set( 'display_errors',			1	);
		}

?>