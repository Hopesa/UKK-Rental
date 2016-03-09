<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 05/03/2016
 * Time: 20:18
 * Functions for Admins Operations
 */


function add_kendaraan($plat,$tahun,$tarif,$merk,$tipe,$mobil,$desc,$kode){
    $query = mysql_query("SELECT * FROM type WHERE NmType = '$tipe';");
    $idtype = mysql_fetch_array($query);
    if(mysql_num_rows($query)< 1){
        $query = mysql_query("INSERT INTO type (NmType) VALUES ('$tipe');");
        $query = mysql_query("SELECT * FROM type WHERE NmType = '$tipe';");
        $idtype = mysql_fetch_array($query);
    }
    $query = mysql_query("SELECT * FROM merk WHERE NmMerk = '$merk';");
    $idmerk = mysql_fetch_array($query);
    if(mysql_num_rows($query)< 1){
        $query = mysql_query("INSERT INTO merk (NmMerk) VALUES ('$merk');");
        $query = mysql_query("SELECT * FROM merk WHERE NmMerk = '$merk';");
        $idmerk = mysql_fetch_array($query);
    }
    $status = 1;
    $sql = "INSERT INTO kendaraan (`NoPlat`, `Nama Mobil`, `Tahun`, `TarifPerJam`, `StatusRental`, `IDType`, `KodeMerk`,`KodePemilik`, `Deskripsi`)
VALUES  ('$plat','$mobil','$tahun','$tarif','$status','$idtype[IDType]','$idmerk[KodeMerk]','$kode','$desc');";
    $query = mysql_query($sql) or die (mysql_error());

    if ($query) {
        return true;
    }
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
function generateIDSopir(){
    //This function cost 2 coffee
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

function add_pemilik($pemilik,$kode,$telepon,$alamat){

    $sql = "INSERT INTO pemilik (KodePemilik, NmPemilik, AlamatPemilik, TelpPemilik)
VALUES ('$kode','$pemilik','$alamat','$telepon')";
    $query = mysql_query($sql) or die(mysql_error());

    if ($query) {
        return true;
    }
    return false;
}
function edit_pemilik($ktp,$alamat,$telepon){
    $query = mysql_query("UPDATE pemilik SET AlamatPemilik = '$alamat', TelpPemilik = '$telepon' WHERE KodePemilik = '$ktp'");
    if ($query){
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

