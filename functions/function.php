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
        $sql = "SELECT username FROM login WHERE username = '" . $eUsername . "' LIMIT 1";
        // Note the use of trigger_error instead of or die.
        $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
            // Create our insert SQL by hashing the password and using the escaped Username.
            $sql = "INSERT INTO login (`username` , `password`) VALUES ('" . $eUsername . "', '" . hashPassword($pPassword, SALT1, SALT2) . "');";
            $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
            $sql = "SELECT IDUser FROM login WHERE username = '$eUsername'";
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
        $sql = "SELECT IDUser FROM login WHERE username = '$user'";
        $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
        $dataid = mysql_fetch_assoc($query);
        $_SESSION['userid'] = $dataid["IDUser"];
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
    $sql = "SELECT UserName FROM login
		WHERE UserName = '" . mysql_real_escape_string($pUsername) . "' AND Password = '" . hashPassword($pPassword, SALT1, SALT2) . "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in!

    $row = mysql_fetch_assoc($query);
    echo $row['UserName'];
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_assoc($query);
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['loggedin'] = true;
        return true;
    }
    return false;
}
function create_transaction(){

    }
function edit_transaction(){

    }
function delete_transaction(){

    }