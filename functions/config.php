<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 01/03/2016
 * Time: 05:14
 * This File is to Fetch All Necessary Classes and Functions
 */

// start the session before any output.
session_start();
/***********
Remember to use PDO
 ************/
mysql_connect('localhost', 'root', '') or trigger_error("Unable to connect to the database: " . mysql_error());
mysql_select_db('rental_mobil') or trigger_error("Unable to switch to the database: " . mysql_error());
/***************
Encryption Hashes
 ****************/
define('SALT1', '24859f@#$#@$');
define('SALT2', '^&@#_-=+Afda$#%');
// require the function file
require_once('function.php');
// default the error variable to empty.
$_SESSION['error'] = "";
// declare stuff here so we do not have to do this on each page.
$output="";
$sOutput="";
// json response array
$response = array("error" => FALSE);