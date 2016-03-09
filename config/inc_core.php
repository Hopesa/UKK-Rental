<?php


function redirect($url){
    header("Location: $url");
}

function direct($url)
{
    echo "<script>window.location='".$url."';</script>";
}

function injek($var){
    return stripslashes(mysql_escape_string($var));
}
function alert($var){
    echo "<script>alert('$var');</script>";
}

function generateIDSopir(){
    $sql = "SELECT MAX(IDSopir) as maxid from sopir where IDSopir LIKE 'SP%'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_assoc($query);

    $maxid = $slc['maxid'];

    $id = (int) substr($maxid,2,3);
    $id++;

    $newid = "SP".sprintf("%03s", $id);

    if($newid)
        return $newid;
    else
        return false;
}
function generateTransaksi(){
    $sql = "SELECT MAX(NoTransaksi) as maxid from transaksisewa where NoTransaksi LIKE 'TS%'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_assoc($query);

    $maxid = $slc['maxid'];

    $id = (int) substr($maxid,2,4);
    $id++;

    $newid = "TS".sprintf("%04s", $id);

    if($newid)
        return $newid;
    else
        return false;
}

function hitungHari($kdbook){
    $sql = "SELECT PERIOD_DIFF(TglKembaliRencana,TglPinjam) as selisih from transaksisewa WHERE NoTransaksi= '" .$kdbook. "' ";
    $query = mysql_query($sql);
    $row = mysql_fetch_assoc($query);
    return $row['selisih'];
}