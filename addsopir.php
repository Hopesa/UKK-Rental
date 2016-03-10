<?php
/**
 * Created by PhpStorm.
 * User: Bilal
 * Date: 3/6/2016
 * Time: 7:43 PM
 */

require_once('config/config.php');
if (!loggedInSpc()){
    redirect('403.php');
}
$newid = generateIDSopir();
if(isset($_GET['id']) == $newid);
{
    /*$query = mysql_query("Select * from kendaraan WHERE NoPlat = '$_GET[id]'");
    $data = mysql_fetch_array($query);*/

}

if(isset($_POST['btn-submit']))
{
    $id_sopir = $_POST['id_sopir'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $nosim= $_POST['nosim'];
    $tarif = $_POST['tarif'];

    $datasopir = add_driver($id_sopir, $nama, $alamat, $telp, $nosim, $tarif);

    /*$datamobil = add_kendaraan($plat,$tahun,$tarif,$merk,$tipe,$mobil,$deskripsi);
    $datapemilik = add_Pemilik($pemilik,$kode,$telepon,$alamat,$plat);*/
    if($datasopir)
    {
        echo "<script> alert('Success'); </script>";
        direct("addsopir.php");
    }
    else
    {
        $error = "Wrong Details !"; //Or Invalid Pass
    }
}
?>

<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="style/style.css" type="text/css" />
</head>
<form class="form-horizontal" action="" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Form Name</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Ktp">ID Sopir</label>
            <div class="col-md-5">
                <input id="id_sopir" name="id_sopir" type="text" placeholder="" class="form-control input-md" required value="<?php echo $newid; ?>" readonly >
            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Nama">Nama Sopir</label>
            <div class="col-md-5">
                <input id="nama" name="nama" type="text" placeholder="Nama Sopir" class="form-control input-md" required>

            </div>
        </div>

        <!-- Text input-->

        <div class="form-group">
            <label class="col-md-4 control-label" for="Alamat">Alamat</label>
            <div class="col-md-5">
                <input id="alamat" name="alamat" type="text" placeholder="Alamat" class="form-control input-md" required >

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="Telepon">Telepon</label>
            <div class="col-md-5">
                <input id="telp" name="telp"  placeholder="Telepon" class="form-control input-md" required>

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Sim">No. SIM</label>
            <div class="col-md-5">
                <input id="nosim" name="nosim" type="text" placeholder="No. SIM" class="form-control input-md" required>

            </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="Tarif">Tarif</label>
            <div class="col-md-5">
                <input id="tarif" name="tarif" type="text" placeholder="Tarif" class="form-control input-md" required>

            </div>
        </div>

        <?php
        if(isset($error))
        {
        ?>
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;
            <?php echo $error; ?> !
        </div>
        <?php
        }
        ?>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="confirm"></label>
            <div class="col-md-4">
                <button id="btn-submit" name="btn-submit" class="btn btn-primary">Add</button>
            </div>
        </div>

    </fieldset>
</form>
</html>

