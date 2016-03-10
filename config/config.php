<?php

// start the session before any output.
session_start();
error_reporting(E_ALL & ~E_NOTICE ^ E_DEPRECATED);
/***********
Remember to use PDO (But..
 ************/
mysql_connect('localhost', 'root', '') or trigger_error("Unable to connect to the database: " . mysql_error());
mysql_select_db('rental_mobil') or trigger_error("Unable to switch to the database: " . mysql_error());
/***************
Encryption Hashes
 ****************/
define('SALT1', '24859f@#$#@$');
define('SALT2', '^&@#_-=+Afda$#%');
// require the function file
require_once ('inc_user.php');
require_once ('inc_admin.php');
require_once ('inc_core.php');
require_once ('inc_element.php');
require_once ('inc_tran.php');
// default the error variable to empty.
$_SESSION['error'] = "";
// declare stuff here so we do not have to do this on each page.
$output="";
$outputa='';
$outputb='';
$outputc='';
$outputd='';
$outpute='';
$soutput='';
// json response array
$response = array("error" => FALSE);