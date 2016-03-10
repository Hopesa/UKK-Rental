<?php

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
function addPelanggan($pKTP, $pNama, $pAlamat, $pTelp, $pUsername, $pPassword) { //User Account, Not that "Account"
    // First check we have data passed in.
    if (!empty($pUsername) && !empty($pPassword) && !empty($pKTP)) {
        // escape the $pUsername to avoid SQL Injections
        $eUsername = mysql_real_escape_string($pUsername);
        //$sql = "SELECT Username FROM login_pelanggan WHERE Username = '" . $eUsername . "' LIMIT 1";
        // Note the use of trigger_error instead of or die.
        //$query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
            // Create our insert SQL by hashing the password and using the escaped Username.
        $sql = "INSERT INTO login_pelanggan (NoKTP, Username, Password) VALUES ('" . $pKTP . "','" . $eUsername . "', '" . md5($pPassword) . "');";
        $sql2 = "INSERT INTO pelanggan (NoKTP, NamaPel, AlamatPel, TelpPel) VALUES ('" . $pKTP . "','" . $pNama . "', '" . $pAlamat . "', '" . $pTelp . "');";
        $query2 = mysql_query($sql2) or trigger_error("Query Failed: " . mysql_error());
        $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
        if ($query2) {
            if ($query) {
                return true;
            }   
        }
        else
            return false;
    }
    return false;
}
function logoutUser() {
    unset($_SESSION['username']);
    unset($_SESSION['ktp']);
    session_destroy();


        return true;
}
function loggedIn() {
    // check both loggedin and username to verify user.
    if (isset($_SESSION['loggedin']) && isset($_SESSION['username'])) {
        return true;
    }
    return false;
}
function loggedInSpc() {
    // check both loggedin and username to verify admin.
    if (isset($_SESSION['ptgs']) && isset($_SESSION['username'])) {
        return true;
    }
    return false;
}
function loggedInPmk() {
    // check both loggedin and username to verify admin.
    if (isset($_SESSION['pmk']) && isset($_SESSION['username'])) {
        return true;
    }
    return false;
}
function loginKaryawan($pUsername, $pPassword) {
    // See if the username and password are valid.
    $sql = "SELECT * FROM login WHERE UserName = '" . mysql_real_escape_string($pUsername) . "' AND Password = '" . md5($pPassword). "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in! 
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_array($query);
        $_SESSION['nik']= $row['NIK'];
        $_SESSION['username'] = $row['UserName'];
        $_SESSION['tipe']= $row['TypeUser'];
        $_SESSION['ptgs'] = true;
        return true;
    }
    else
        return false;
}

function loginPelanggan($pUsername, $pPassword) {
    // See if the username and password are valid.
    $sql = "SELECT * FROM login_pelanggan WHERE Username = '" . mysql_real_escape_string($pUsername) . "' AND Password = '" . md5($pPassword). "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in! 
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_assoc($query);
        $sql1 = "select * from pelanggan where NoKTP='".$row['NoKTP']."' ";
        $sql2 = mysql_query($sql1);
        $slc = mysql_fetch_array($sql2);
        
        $_SESSION['username'] = $row['Username'];
        $_SESSION['ktp'] = $row['NoKTP'];
        $_SESSION['id_session'] = $row['id_session'];
        $_SESSION['nama'] = $slc['NamaPel'];
        $_SESSION['alamat'] = $slc['AlamatPel'];
        $_SESSION['telp'] = $slc['TelpPel'];
        $_SESSION['loggedin'] = true;
        return true;
    }
    else
        return false;
}
function loginPemilik($pUsername, $pPassword) {
    // See if the username and password are valid.
    $sql = "SELECT * FROM pemilik WHERE username = '" . mysql_real_escape_string($pUsername) . "' AND pass = '" . md5($pPassword). "' LIMIT 1";
    $query = mysql_query($sql) or trigger_error("Query Failed: " . mysql_error());
    // If one row was returned, the user was logged in!
    if (mysql_num_rows($query) == 1) {
        $row = mysql_fetch_assoc($query);
        $sql1 = "select * from pemilik where KodePemilik='".$row['KodePemilik']."' ";
        $sql2 = mysql_query($sql1);
        $slc = mysql_fetch_array($sql2);
        $_SESSION['username'] = $row['username'];
        $_SESSION['kode_pemilik'] = $row['KodePemilik'];
        $_SESSION['nama'] = $slc['NmPemilik'];
        $_SESSION['alamat'] = $slc['AlamatPemilik'];
        $_SESSION['telp'] = $slc['TelpPemilik'];
        $_SESSION['pmk'] = true;
        return true;
    }
    else
        return false;
}
function updatePelanngan($pNama, $pAlamat, $pTelp){
    $sql = "UPDATE pelanggan SET NamaPel='".$pNama."', AlamatPel='".$pAlamat."', TelpPel='".$pTelp."' WHERE NoKTP= '".$_SESSION['ktp']."' ";
    $query = mysql_query($sql);
    $query2 = mysql_query("SELECT * FROM pelanggan where NoKTP='".$_SESSION['ktp']."'");
    $slc = mysql_fetch_array($query2);
    $_SESSION['nama'] = $slc['NamaPel'];
    $_SESSION['alamat'] = $slc['AlamatPel'];
    $_SESSION['telp'] = $slc['TelpPel'];
    if($query)
        return true;
    else
        return false;
}

function updatePassPelanggan($pPass)
{
    $sql = "SELECT * FROM login_pelanggan WHERE NoKTP='" . $_SESSION['ktp'] . "'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_array($query);
    if (md5($pPass) == $slc['Password']) {
        $pPass=md5($pPass);
        $sql2 = "UPDATE login_pelanggan SET Password='".$pPass."' WHERE NoKTP= '".$_SESSION['ktp']."'";
        $query2 = mysql_query($sql2);

        if($query2)
            return true;
        else
            return false;
    }
    else{
        return false;
    }
}
function updatePemilik($pNama, $pAlamat, $pTelp){
    $sql = "UPDATE pemilik SET NmPemilik='".$pNama."', AlamatPemilik='".$pAlamat."', TelpPemilik='".$pTelp."' WHERE KodePemilik= '".$_SESSION['kode_pemilik']."'";
    $query = mysql_query($sql);
    $query2 = mysql_query("SELECT * FROM pemilik where KodePemilik='".$_SESSION['kode_pemilik']."'");
    $slc = mysql_fetch_array($query2);
    $_SESSION['nama'] = $slc['NmPemilik'];
    $_SESSION['alamat'] = $slc['AlamatPemilik'];
    $_SESSION['telp'] = $slc['TelpPemilik'];
    if($query)
        return true;
    else
        return false;
}

function updatePassPemilik($pPass)
{
    $sql = "SELECT * FROM pemilik WHERE KodePemilik='" . $_SESSION['kode_pemilik'] . "'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_array($query);
    if (md5($pPass) == $slc['pass']) {
        $pPass=md5($pPass);
        $sql2 = "UPDATE pemilik SET pass='".$pPass."' WHERE KodePemilik= '".$_SESSION['kode_pemilik']."'";
        $query2 = mysql_query($sql2);

        if($query2)
            return true;
        else
            return false;
    }
    else{
        return false;
    }
}