<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 09/03/2016
 * Time: 12:19
 */
require_once('config/config.php');
if (!loggedInSpc()){
    redirect('403.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rental - Mobil</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
echo $nav;
echo $sidebar;
?>
<!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Reservasi</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manajemen Reservasi</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Setoran</div>
                        <div class="text-muted">Manajemen Setoran</div>
                    </div>
                </div>
            </div>
        </div>
        <a href="tampilmobil.php">
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="panel panel-orange panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-4 widget-left">
                            <svg class="glyph stroked chevron left">
                                <use xlink:href="#stroked-chevron-left" />
                            </svg>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">Pelanggan</div>
                            <div class="text-muted">Manajemen Pelanggan</div>
                        </div>
                    </div>
                </div>
        </a>
    </div>

    <?php
    if(empty($_GET['action'])){
        $outputa.= '<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Reservasi</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">
                            <thead>
                                <tr>
                                    <th data-field="nama" data-sortable="true">Nama Pelanggan</th>
                                    <th data-field="pesan" data-sortable="true">Tanggal Pesan</th>
                                    <th data-field="pinjam" data-sortable="true">Tanggal Pinjam</th>
                                    <th data-field="kembali" data-sortable="true">Tanggal Kembali</th>
                                    <th data-field="mobil" data-sortable="true">Nama Mobil</th>
                                    <th data-field="merek" data-sortable="true">Merk</th>
                                    <th data-field="tipe" data-sortable="true">Type</th>
                                    <th data-field="plat" data-sortable="true">No Plat</th>
                                    <th data-field="sopir" data-sortable="true">Nama Sopir</th>
                                    <th data-field="total" data-sortable="true">Total</th>
                                    <th data-field="status" data-sortable="true">Status</th>
                                    <th data-field="action" data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            ';
        echo $outputa;
        $sql=mysql_query("select * from transaksisewa") or trigger_error("Query Failed: " . mysql_error());;
        while($data=mysql_fetch_array($sql)) {
        $output = '';
        //$sqlb=mysql_query("select * from merk WHERE KodeMerk='$data[KodeMerk]'");
        //$datab=mysql_fetch_assoc($sqlb);
        //$sqlc=mysql_query("select * from type WHERE IDType='$data[IDType]'");
        //$datac=mysql_fetch_assoc($sqlc);
        //$sqld=mysql_query("select * from pemilik WHERE KodePemilik='$data[KodePemilik]'");
        //$datad=mysql_fetch_assoc($sqld);
        $sqla = mysql_query("select * from kendaraan WHERE NoPlat='$data[NoPlat]'");
        $kendaraan = mysql_fetch_array($sqla);
        $sqla = mysql_query("select * from pelanggan WHERE NoKTP='$data[NoKTP]'");
        $pelanggan = mysql_fetch_array($sqla);
        $sqla = mysql_query("select * from merk WHERE KodeMerk='$kendaraan[KodeMerk]'");
        $merk = mysql_fetch_array($sqla);
        $sqla = mysql_query("select * from type WHERE IDType='$kendaraan[IDType]'");
        $type = mysql_fetch_array($sqla);
        $sqla = mysql_query("select * from sopir WHERE IDSopir='$data[IDSopir]'");
        $sopir = mysql_fetch_array($sqla);

        switch ($data['status']) {
            case -1:
                $status = 'Rejected';
                break;
            case 0:
                $status = 'Pending';
                break;
            case 1:
                $status = 'Approved/Mobil Disiapkan';
                break;
            case 2:
                $status = 'Mobil Dipinjam';
                break;
            case 3:
                $status = 'Booking Selesai/Mobil Kembali';
                break;
            case 4:
                $status = 'Terlambat, Bayar Denda';
                break;
            default:
                $status='No Data';
                ;
        }
        $output .= '<tr>
                                <td>' . $pelanggan['NamaPel'] . '</td>
                                <td>' . $data['TglPesan'] . '</td>
                                <td>' . $data['TglPinjam'] . '</td>
                                <td>' . $data['TglKembaliReal'] . '</td>
                                <td>' . $kendaraan['Nama Mobil'] . '</td>
                                <td>' . $merk['NmMerk'] . '</td>
                                <td>' . $type['NmType'] . '</td>
                                <td>' . $data['NoPlat'] . '</td>
                                <td>' . $sopir['NmSopir'] . '</td>
                                <td>' . $data['total'] . '</td>
                                <td>' . $status . '</td>
                                <td><a href="mngreservasi.php?id='.$data['NoTransaksi'].'&action=edit" style="height:50px">Edit </a><a href="mngreservasi.php?action=delete&id='.$data['NoTransaksi'].'"> Delete</a></td>
                            </tr>
                            ';
        echo $output;}
        $outputb.='
        </table>
    </div>
    </div>

    </div>
    </div>';
        echo $outputb;
    }
    else if($_GET['action']=='edit'){
        //Scan Transaksi Telat
        $current_date = date('d/m/Y');
        $time_date = date('H:i');
        $query = mysql_query("UPDATE transaksisewa SET status = '3' WHERE TglKembaliRencana < $current_date ");
        $btn='';
        if(isset($_GET['id']));
        {
            $query = mysql_query("Select * from transaksisewa WHERE NoTransaksi= '$_GET[id]'");
            $data = mysql_fetch_array($query);
            $sqla = mysql_query("select * from pelanggan WHERE NoKTP='$data[NoKTP]'");
            $plg = mysql_fetch_array($sqla);
            $sqla = mysql_query("select * from kendaraan WHERE NoPlat='$data[NoPlat]'");
            $kendaraan = mysql_fetch_array($sqla);
            $sqla = mysql_query("select * from pelanggan WHERE NoKTP='$data[NoKTP]'");
            $pelanggan = mysql_fetch_array($sqla);
            $sqla = mysql_query("select * from merk WHERE KodeMerk='$kendaraan[KodeMerk]'");
            $merk = mysql_fetch_array($sqla);
            $sqla = mysql_query("select * from type WHERE IDType='$kendaraan[IDType]'");
            $type = mysql_fetch_array($sqla);
            $sqla = mysql_query("select * from sopir WHERE IDSopir='$data[IDSopir]'");
            $sopir = mysql_fetch_array($sqla);
        }
        switch ($data['status']) {
            case 0:
                $btn .='
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-5">
                                    <button id="btn-submit" name="btn-submit-deny" class="btn btn-primary">Reject Reservasi</button>
                                    <button id="btn-submit" name="btn-submit-pass" class="btn btn-primary">Setujui Reservasi</button>

                                    <div class="col-md-3">
                                        <a href="mngreservasi.php" id="btn-back" name="btn-back" class="btn btn-primary">Kembali</a>
                                    </div>
                            </div>';
                $formtambahan .='<div class="form-group">
                            <label class="col-md-4 control-label" for="bbm">BBM</label>
                                <div class="col-md-5">
                                    <input id="nama" name="bbm" type="text" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="bbm">Biaya BBM</label>
                                <div class="col-md-5">
                                    <input id="nama" name="biayabbm" type="text" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="bbm">Kondisi Mobil Pertama</label>
                                <div class="col-md-5">
                                    <input id="nama" name="kondisi" type="text" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="km">Kilometer Pinjam</label>
                                <div class="col-md-5">
                                    <input id="nama" name="km" type="text" class="form-control input-md" required="">
                                </div>
                            </div>';
                break;
            case 1:
                $btn .='
                            <div class="form-group">
                                <label class="col-md-4 control-label"></label>
                                <div class="col-md-5">
                                    <button id="btn-submit" name="btn-submit-kembali" class="btn btn-primary">Mobil Telah Kembali</button>
                                    <div class="col-md-3">
                                        <a href="mngreservasi.php" id="btn-back" name="btn-back" class="btn btn-primary">Kembali</a>
                                    </div>
                            </div>';
                $formtambahan .='<div class="form-group">
                            <label class="col-md-4 control-label" for="bbm">BBM Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="bbm" type="number" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rsk">Kerusakan</label>
                                <div class="col-md-5">
                                    <input id="nama" name="kerusakan" type="text" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rsk">Biaya Kerusakan</label>
                                <div class="col-md-5">
                                    <input id="nama" name="biayakerusakan" type="number" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="mbl">Kondisi Mobil Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="kondisi" type="text" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="km">Kilometer Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="km" type="number" class="form-control input-md" required="">
                                </div>
                            </div>';
                break;
            case 3:
                $denda = hitungTelat($data['NoTransaksi'],$data['TglKembaliRencana'],$data['JamKembaliRencana']);
                $btn .='
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="reject"></label>
                                <div class="col-md-5">
                                    <button id="btn-submit" name="btn-submit-denda" class="btn btn-primary">Selesai Dengan Denda</button>
                                    <div class="col-md-3">
                                        <a href="mngreservasi.php" id="btn-back" name="btn-back" class="btn btn-primary">Kembali</a>
                                    </div>
                            </div>';
                $formtambahan.='<div class="form-group">
                            <label class="col-md-4 control-label" for="bbm">BBM Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="bbm" type="number" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rsk">Kerusakan</label>
                                <div class="col-md-5">
                                    <input id="nama" name="kerusakan" type="text" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="rsk">Biaya Kerusakan</label>
                                <div class="col-md-5">
                                    <input id="nama" name="biayakerusakan" type="number" class="form-control input-md" required="">

                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="mbl">Kondisi Mobil Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="kondisi" type="text" class="form-control input-md" required="">
                                </div>
                            </div>
                            <div class="form-group">
                            <label class="col-md-4 control-label" for="km">Kilometer Kembali</label>
                                <div class="col-md-5">
                                    <input id="nama" name="km" type="number" class="form-control input-md" required="">
                                </div>
                            </div>
                             <div class="form-group">
                            <label class="col-md-4 control-label" for="denda">Denda</label>
                                <div class="col-md-5">
                                    <input id="nama" name="denda" type="number" class="form-control input-md" required="" value = "'.$denda.'">
                                </div>
                            </div>';
                break;
            default:
                $btn='';
                ;
        }
        if(isset($_POST['btn-submit-pass'])){
            if(editSetujuiTransaksi($data['NoTransaksi'],$_POST['bbm'], $_POST['biayabbm'], $_POST['kondisi'], $_POST['km'])){
                statusTransaksi($data['status'],$data['NoTransaksi']);
                alert('Reservasi Disetujui');
                redirect('mngreservasi.php');
            }
            else {
                alert('Reservasi gaggal');
            }
        }
        else if(isset($_POST['btn-submit-deny'])){
            $stat = -2;
            statusTransaksi($stat,$data['NoTransaksi']);
        }
        else if(isset($_POST['btn-submit-kembali'])){
            if(editKembaliTransaksi($data['NoTransaksi'],$_POST['bbm'],$_POST['kerusakan'], $_POST['biayakerusakan'], $_POST['kondisi'], $_POST['km'])) {
                statusTransaksi($data['status'], $data['NoTransaksi']);
                alert('Reservasi Telah Selesai');
                redirect('mngreservasi.php');
            }
            else{
                alert('Reservasi gaggal');
            }
        }
        else if(isset($_POST['btn-submit-denda'])){
            if(editDendaTransaksi($data['NoTransaksi'],$_POST['bbm'],$_POST['kerusakan'], $_POST['biayakerusakan'], $_POST['kondisi'], $_POST['km'],$_POST['denda'])) {
                statusTransaksi($data['status'], $data['NoTransaksi']);
                alert('Denda Reservasi Telah Selesai');
                redirect('mngreservasi.php');
            }
            else{
                alert('Reservasi gaggal');
            }
        }
        $outputa.='<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="mngreservasi.php?action=edit&id='.$data['NoTransaksi'].'" method="post">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Mobil">Kode Booking</label>
                            <div class="col-md-5">
                                <input id="kdbook" name="kdbook" type="text" class="form-control input-md" required="" readonly value="'.$data['NoTransaksi'].'">
                            </div>
                        </div>
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Detail Mobil</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Mobil</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="mobil" type="text" placeholder="Nama Mobil" class="form-control input-md" required="" readonly value="'.$kendaraan['Nama Mobil'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Merk">Merk</label>
                                <div class="col-md-5">
                                    <input id="merk" name="merk" type="text" placeholder="Merk Mobil" class="form-control input-md" required="" readonly value="'.$merk['NmMerk'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Type">Type</label>
                                <div class="col-md-5">
                                    <input id="type" name="type" type="text" placeholder="Type Mobil" class="form-control input-md" required="" readonly value="'.$type['NmType'].'">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tarif</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="tarif" type="text" placeholder="Tarif" class="form-control input-md" required="" readonly value="'.$kendaraan['TarifPerJam'].'">

                                </div>
                            </div>

                            <!-- Data Diri -->
                            <br>
                            <legend>Data Diri Pelanggan</legend>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Nama">Nama</label>
                                <div class="col-md-5">
                                    <input id="nama" name="nama" type="text" class="form-control input-md" required="" readonly value="'.$plg['NamaPel'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Alamat">Alamat</label>
                                <div class="col-md-5">
                                    <input id="alamat" name="alamat" type="text" class="form-control input-md" required="" readonly value="'.$plg['AlamatPel'].'">

                                </div>
                            </div>
                             <div class="form-group">
                                <label class="col-md-4 control-label" for="Alamat">Alamat</label>
                                <div class="col-md-5">
                                    <input id="alamat" name="alamat" type="text" class="form-control input-md" required="" readonly value="'.$plg['TelpPel'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="TglPinjam">Tgl Pinjam</label>
                                <div class="col-md-5">
                                    <input id="tglpinjam" name="tglpinjam" type="date" class="form-control input-md" value="'.$data['TglPinjam'].'" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="TglKembali">Tgl Kembali</label>
                                <div class="col-md-5">
                                    <input id="tglkembali" name="tglkembali" type="date" class="form-control input-md" required value="'.$data['TglKembaliRencana'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Jampinjam">Jam Pinjam</label>
                                <div class="col-md-5">
                                    <input id="jampinjam" name="jampinjam"  type="time" placeholder="HH-MM-SS" class="form-control input-md" value="'.$data['JamPinjam'].'" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Jamkembali">Jam Kembali</label>
                                <div class="col-md-5">
                                    <input id="jamkembali" name="jamkembali"  type="time" placeholder="HH-MM-SS" class="form-control input-md" value="'.$data['JamKembaliRencana'].'" required>

                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Sopir">Sopir</label>
                                <div class="col-md-5">
                                    <input id="nama" name="sopir" type="text" class="form-control input-md" required="" readonly value="'.$sopir['NmSopir'].'">

                                </div>
                            </div>
                            <legend>Data Tambahan Reservasi</legend>
                            '.$formtambahan.';
                           '.$btn.';
                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>';
        echo $outputa;
    }
    ?>
    <!--/.row-->

    <!--/.row-->


</div>
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chart.min.js"></script>
<script src="js/chart-data.js"></script>
<script src="js/easypiechart.js"></script>
<script src="js/easypiechart-data.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap-table.js"></script>
<script>
    ! function ($) {
        $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
            $(this).find('em:first').toggleClass("glyphicon-minus");
        });
        $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);

    $(window).on('resize', function () {
        if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>
