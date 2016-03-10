<?php
/**
 * Created by PhpStorm.
 * User: Bilal
 * Date: 3/7/2016
 * Time: 11:30 PM
 */

function addBookCar($kdbook, $tglpinjam, $jampinjam, $tglkembali, $jamkembali, $ktp, $sopir, $plat, $tglpesan)
{
    $sql = "insert into transaksisewa (NoTransaksi, TglPesan, TglPinjam, JamPinjam, TglKembaliRencana, JamKembaliRencana, NoKTP, NIK, IDSopir, NoPlat)
            VALUES  ('$kdbook','$tglpesan','$tglpinjam','$jampinjam','$tglkembali','$jamkembali','$ktp','0','$sopir','$plat')";
    $query = mysql_query($sql) or die(mysql_error());

    if ($query) {
        return true;
    }
    return false;
}

function addTotalTransaksi($kdbook, $total)
{
    $sql = "UPDATE transaksisewa SET total='$total' WHERE NoTransaksi='$kdbook'";
    $query = mysql_query($sql);

    if ($query) {
        return true;
    }
    return false;
}
function statusTransaksi($status,$NoTransaksi){
    $stat = $status + 1;
    $query = mysql_query("UPDATE transaksisewa SET status = '$stat' WHERE NoTransaksi = '$NoTransaksi'");
    if ($query){
        return true;
    }
    return false;
}
function editSetujuiTransaksi($NoTransaksi,$bbm, $hargabbm, $kondisi, $kilometer){
    $query = mysql_query("UPDATE transaksisewa SET KilometerPinjam = '$kilometer',BBMPinjam = '$bbm',BiayaBBM = '$hargabbm',KondisiMobilPinjam = '$kondisi' WHERE NoTransaksi = '$NoTransaksi'");
    if ($query){
        return true;
    }
    return false;
}
function editKembaliTransaksi($NoTransaksi,$bbm,$kerusakan,$biayakerusakan, $kondisi, $kilometer){
    $current_date = date('d/m/Y');
    $time_current = date('H:i');
    $query = mysql_query("SELECT * FROM transaksisewa WHERE NoTransaksi = '$NoTransaksi'");
    $data = mysql_fetch_array($query);
    $biayabbm = ((int)$data['BBMPinjam'] - (int)$bbm) * (int) $data['BiayaBBM'];
    $total = (int)$data['total'] + $biayabbm + $biayakerusakan;
    hitungSetoran($NoTransaksi,$total);
    $query = mysql_query("UPDATE transaksisewa SET KilometerPinjam = '$kilometer',BBMKembali = '$bbm',KondisiMobilKembali = '$kondisi',BiayaBBM  = '$biayabbm',Kerusakan = '$kerusakan',BiayaKerusakan = '$biayakerusakan', total = '$total', TglKembaliReal = '$current_date', JamKembaliReal = '$time_current' WHERE NoTransaksi = '$NoTransaksi'");
    if ($query){
        return true;
    }
    return false;
}
function editDendaTransaksi($NoTransaksi,$bbm,$kerusakan,$biayakerusakan, $kondisi, $kilometer,$denda){
    $current_date = date('Y/m/d');
    $time_current = date('H:i');
    $query = mysql_query("SELECT * FROM transaksisewa WHERE NoTransaksi = '$NoTransaksi'");
    $data = mysql_fetch_array($query);
    $biayabbm = ((int)$data['BBMPinjam'] - (int)$bbm) * (int) $data['BiayaBBM'];
    $total = (int)$data['total'] + $biayabbm + $biayakerusakan + $denda;
    $query = mysql_query("UPDATE transaksisewa SET KilometerPinjam = '$kilometer',BBMKembali = '$bbm',KondisiMobilKembali = '$kondisi',BiayaBBM  = '$biayabbm',Kerusakan = '$kerusakan',BiayaKerusakan = '$biayakerusakan', total = '$total', TglKembaliReal = '$current_date', JamKembaliReal = '$time_current', Denda = '$denda' WHERE NoTransaksi = '$NoTransaksi'");
    if ($query){
        return true;
    }
    return false;
}
function hitungTelat($NoTransaksi,$TglKembaliRencana,$JamKembaliRencana){
    $current_date = date('Y/m/d');
    $time_current = date('H:i');
    $kembali ='';
    $tgl ='';
    $kembali .=''.$current_date.' '.$time_current.'';
    $query = mysql_query("SELECT * FROM transaksisewa WHERE NoTransaksi = `$NoTransaksi`");
    $data = mysql_fetch_array($query);
    $tgl.=''.$TglKembaliRencana.' '.$JamKembaliRencana.'';
    $kembali .=''.$current_date.' '.$time_current.'';
    $ts1 = strtotime(str_replace('/', '-', $tgl));
    $ts2 = strtotime(str_replace('/', '-', $kembali));
    $diff = abs($ts2 - $ts1)/3600;
    $denda = $diff;
    if ($denda){
        return $denda;
    }
    return false;
}
function hitungSetoran($NoTransaksi,$total){
    $query = mysql_query("SELECT * FROM transaksisewa WHERE NoTransaksi = '$NoTransaksi'");
    $data = mysql_fetch_array($query);
    $setoran = $total * 0.2;
    $current_date = date('Y-m-d');
    $query = mysql_query("Select * from kendaraan WHERE NoPlat = '$data[NoPlat]'");
    $datax = mysql_fetch_array($query);
    $query = mysql_query("Select * from pemilik WHERE KodePemilik = '$datax[KodePemilik]'");
    $dataext = mysql_fetch_array($query);
    $query = mysql_query("INSERT INTO setoran (TglSetoran, Jumlah, KodePemilik, NIK) VALUES ('$current_date','$setoran','$dataext[KodePemilik]','0')");
    if ($query){
        return true;
    }
    return false;
}
function generateKodeSetoran(){
    $sql = "SELECT MAX(NoSetoran) as maxid from setoran where setoran.NoSetoran LIKE 'ST%'";
    $query = mysql_query($sql);
    $slc = mysql_fetch_assoc($query);
    $maxid = $slc['maxid'];
    $id = (int) substr($maxid,2,4);
    $id++;
    $newid = "ST".sprintf("%04s", $id);
    if($newid)
        return $newid;
    else
        return false;
}
