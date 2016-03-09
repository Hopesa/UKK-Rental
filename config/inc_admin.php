<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 05/03/2016
 * Time: 20:18
 * Functions for Admins Operations
 */

function cekPrivilage(){
    $nik = $_SESSION['nik'];
    $query = mysql_query("SELECT * FROM login where NIK ='$nik'");
    if($query){
        $data = mysql_fetch_array($query);
        $pr = $data['TypeUser'];
        if ($pr=='Admin'){
            $priv = 1;
        }
        else{
            $priv = 0;
        }
        return $priv;
    }
    return false;
}

function generateNIK(){
    //This function cost 2 coffee
    $sql = "SELECT MAX(NIK) as maxid from karyawan where NIK LIKE 'NIK%'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_array($query);

    $maxid = $slc['maxid'];

    $id = (int) substr($maxid,3,4);
    $id++;

    $newid = "NIK".sprintf("%03s", $id);

    if($newid)
        return $newid;
    else
        return false;
}
function edit_kendaraan($tarif,$desc,$plat){
    $sql = "UPDATE kendaraan SET TarifPerJam = '$tarif', Deskripsi = '$desc' WHERE NoPlat = '$plat'";
    $query = mysql_query($sql) or die(mysql_error());
    if ($query) {
        return true;
    }
    return false;
}

function add_kendaraan($plat,$tahun,$tarif,$merk,$tipe,$mobil,$desc){
    $query = mysql_query("SELECT * FROM type WHERE NmType = '$tipe';");
    $idtype = mysql_fetch_array($query);
    $query = mysql_query("SELECT * FROM merk WHERE NmMerk = '$merk';");
    $idmerk = mysql_fetch_array($query);
    $status = 'Baru';
    $sql = "INSERT INTO kendaraan (`NoPlat`, `NamaMobil`, `Tahun`, `TarifPerJam`, `StatusRental`, `IDType`, `KodeMerk`)
VALUES  ('$plat','$mobil','$tahun','$tarif','$status','$idtype[IDType]','$idmerk[KodeMerk]');";
    $query = mysql_query($sql) or die(mysql_error());

    if ($query) {
        return true;
    }
    return false;
}


function delete_vehicle($license){
}
function service_vehicle($license,$codeservice,$date,$cost){
}

function edit_driver($id_driver,$nama,$alamat,$telp,$sim,$salary){
}
function add_driver($id_sopir,$nama,$alamat,$telp,$nosim,$tarif){
    $sql = "insert into sopir (IDSopir, NmSopir, AlamatSopir, TelpSopir, NoSIM, TarifPerJam)
VALUES  ('$id_sopir','$nama','$alamat','$telp','$nosim','$tarif')";
    $query = mysql_query($sql) or die(mysql_error());

    if ($query) {
        return true;
    }
    return false;
}

function delete_driver($id_driver){
}

function add_pemilik($pemilik,$kode,$telepon,$alamat,$plat){

    $sql = "INSERT INTO pemilik (KodePemilik, NmPemilik, AlamatPemilik, TelpPemilik, NoPlat)
VALUES ('$kode','$pemilik','$alamat','$telepon','$plat')";
    $query = mysql_query($sql) or die(mysql_error());

    if ($query) {
        return true;
    }
    return false;
}

function delete_pemilik(){
}
function Setoran_pemilik(){
}


