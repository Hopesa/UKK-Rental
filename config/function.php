<?php

function redirect($url)
{
    header("Location: $url");
}

function registerkaryawan($pUsername, $pPassword, $type, $kode, $NmKaryawan, $AlamatKaryawan, $TelpKaryawan) { //User Account, Not that "Account"
    // First check we have data passed in.
    if (!empty($pUsername) && !empty($pPassword)) {
        $queryinfo = mysql_query("INSERT INTO karyawan (NIK, NmKaryawan, AlamatKaryawan, TelpKaryawan)
        VALUES ('$kode', '$NmKaryawan', '$AlamatKaryawan', '$TelpKaryawan')");
            $sql = "INSERT INTO login (`UserName`, `Password`, `TypeUser`, `NIK`) VALUES ('" . $pUsername . "', '" . md5($pPassword) . "','".$type."','".$kode."');";
            $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
                    if ($query && $queryinfo) {
                return true;
        }
    }
    return false;
}
function editkaryawan($pUsername,$kode, $NmKaryawan, $AlamatKaryawan, $TelpKaryawan) { //User Account, Not that "Account"
    // First check we have data passed in.

        $queryinfo = mysql_query("UPDATE karyawan SET NmKaryawan='$NmKaryawan', AlamatKaryawan='$AlamatKaryawan', TelpKaryawan='$TelpKaryawan' WHERE NIK = '$kode'");
        $query = mysql_query("UPDATE login SET UserName='$pUsername' WHERE NIK = '$kode'") or trigger_error("Query Failed: " . mysql_error());
        if ($query && $queryinfo) {
            return true;
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
        session_destroy();
        unset($_SESSION['user_session']);
        unset($_SESSION['username']);
        return true;
}
function validateUser($pUsername, $pPassword) {
    // See if the username and password are valid.
    $sql = "SELECT UserName FROM login WHERE UserName = '" . mysql_real_escape_string($pUsername) . "' AND Password = '" . md5($pPassword). "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in! 
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_assoc($query);
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['loggedin'] = true;
        return true;
    }
    else
        return false;
}