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