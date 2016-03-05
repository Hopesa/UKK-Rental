<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 02/03/2016
 * Time: 06:21
 * This File contains all needed functions and classes
 * No Database Operational yet
 * Ignore Undefined
 */
function createAccount($pUsername, $pPassword) { //User Account, Not that "Account"
    // First check we have data passed in.
    if (!empty($pUsername) && !empty($pPassword)) {
        // escape the $pUsername to avoid SQL Injections
        $eUsername = mysql_real_escape_string($pUsername);
        $sql = "SELECT username FROM user_data WHERE username = '" . $eUsername . "' LIMIT 1";
        // Note the use of trigger_error instead of or die.
        $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
        // Error checks (Should be explained with the error)
//        if ($uLen <= 4 || $uLen >= 11) {
//            $_SESSION['error'] = "Username must be between 4 and 11 characters.";
//        }elseif ($pLen < 6) {
//            $_SESSION['error'] = "Password must be longer then 6 characters.";
//        }elseif (mysql_num_rows($query) == 1) {
//            $_SESSION['error'] = "Username already exists.";
//        }else {
            // All errors passed lets
            // Create our insert SQL by hashing the password and using the escaped Username.
            $sql = "INSERT INTO user_data (`username` , `password`) VALUES ('" . $eUsername . "', '" . hashPassword($pPassword, SALT1, SALT2) . "');";
            $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
            $sql = "SELECT user_id FROM user_data WHERE username = '$eUsername'";
            $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
            if ($query) {
                return true;
        }
    }
    return false;
}
function hashPassword($pPassword, $pSalt1="2345#$%@3e", $pSalt2="taesa%#@2%^#") {
    return sha1(md5($pSalt2 . $pPassword . $pSalt1));
}
function loggedIn() {
    // check both loggedin and username to verify user.
    if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
        $sql = "SELECT user_id FROM user_data WHERE username = '$user'";
        $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
        $dataid = mysql_fetch_assoc($query);
        $_SESSION['userid'] = $dataid["user_id"];
        return true;
    }
    return false;
}
function logoutUser() {
    // using unset will remove the variable
    // and thus logging off the user.
    unset($_SESSION['username']);
    unset($_SESSION['loggedin']);
    unset($_SESSION['userid']);
    return true;
}
function validateUser($pUsername, $pPassword) {
    // See if the username and password are valid.
    $sql = "SELECT username FROM user_data
		WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in!
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_assoc($query);
        $_SESSION['username'] = $row['username'];
        $_SESSION['loggedin'] = true;
        return true;
    }
    return false;
}
//Functions for Data Manipulation
class Transaction
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function create_transaction(){

    }
    public function edit_transaction(){

    }
    public function delete_transaction(){

    }

}
class Vehicle
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function edit_vehicle($license,$year,$tariff,$status, $type){

    }
    public function add_vehicle($license,$year,$tariff,$status, $type){

    }
    public function delete_vehicle($license){

    }
    public function service_vehicle($license,$codeservice,$date,$cost){

    }

}
class Driver
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    public function edit_driver($id_driver,$nama,$alamat,$telp,$sim,$salary){

    }
    public function add_driver($nama,$alamat,$telp,$sim,$salary){

    }
    public function delete_driver($id_driver){

    }
}
class Owner { private $db; function __construct($DB_con) { $this->db = $DB_con; }
    public function edit_Owner(){

    }
    public function add_Owner(){

    }

    public function delete_Owner(){

    }
    public function Salary_Owner(){

    }
}