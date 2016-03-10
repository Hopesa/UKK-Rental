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

function add_kendaraan($plat,$tahun,$tarif,$merk,$tipe,$mobil,$desc,$kode){
    $status = 1;
    $sql = "INSERT INTO kendaraan (`NoPlat`, `Nama Mobil`, `Tahun`, `TarifPerJam`, `StatusRental`, `IDType`, `KodeMerk`,`KodePemilik`, `Deskripsi`)
VALUES  ('$plat','$mobil','$tahun','$tarif','$status','$tipe','$merk','$kode','$desc');";
    $query = mysql_query($sql) or die (mysql_error());

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

function add_pemilik($kode,$pemilik,$alamat,$telp,$username,$password){

    $sql = "INSERT INTO pemilik (KodePemilik, NmPemilik, AlamatPemilik, TelpPemilik, username, pass)
VALUES ('$kode','$pemilik','$alamat','$telp','$username','".md5($password)."')";
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
function edit_merk($kode,$nama,$ket){
    $query = mysql_query("UPDATE merk SET NmMerk = '$nama', Keterangan = '$ket' WHERE KodeMerk = '$kode'");
    if ($query){
        return true;
    }
    return false;
}
function tambah_merk($nama,$ket){
    $query = mysql_query("INSERT INTO merk (NmMerk,Keterangan) VALUES ('$nama','$ket');");
    if ($query){
        return true;
    }
    return false;
}
function edit_tipe($kode,$nama,$ket){
    $query = mysql_query("UPDATE type SET NmType = '$nama', Keterangan = '$ket' WHERE IDType = '$kode'");
    if ($query){
        return true;
    }
    return false;
}
function tambah_tipe($nama,$ket){
    $query = mysql_query("INSERT INTO type (NmType,Keterangan) VALUES ('$nama','$ket');");
    if ($query){
        return true;
    }
    return false;
}

