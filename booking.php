<?php
/**
 * Created by PhpStorm.
 * User: Bilal
 * Date: 05/03/2016
 * Time: 19:12
 */
require_once('config/config.php');
if (!loggedIn()){
    redirect('403.php');
}
$tgl = '';
$kembali ='';
if(isset($_GET['id']));
{
    $query = mysql_query("Select * from kendaraan WHERE NoPlat = '$_GET[id]'");
    $data = mysql_fetch_array($query);
    $query = mysql_query("select * from merk WHERE KodeMerk='$data[KodeMerk]'");
    $datamerk = mysql_fetch_array($query);
    $query = mysql_query("select * from type WHERE IDType='$data[IDType]'");
    $datatype = mysql_fetch_array($query);
    $query = mysql_query("Select * from pemilik WHERE KodePemilik = '$data[KodePemilik]'");
    $dataext = mysql_fetch_array($query);
    $idTrs = generateTransaksi();
}
if(isset($_POST['btn-submit']))
{
    $kdbook = $_POST['kdbook'];
    //$plat = $_POST['plat'];
    $tglpinjam = $_POST['tglpinjam'];
    $jampijam = $_POST['jampinjam'];
    $tglkembali = $_POST['tglkembali'];
    $jamkembali = $_POST['jamkembali'];
    $ktp = $_SESSION['ktp'];
    $plat = $data['NoPlat'];
    $sopir = $_POST['sopir'];

    $tglpesan = date("Y-m-d");

    $query = mysql_query("Select * from sopir WHERE IDSopir = '$sopir'");
    $dataspr = mysql_fetch_array($query);


    if($tglkembali < $tglpinjam)
    {
        alert("Tanggal Kembali Kurang Dari Tanggal Pinjam");
        $_SESSION['tglpinjam'] = $_POST['tglpinjam'];
        $_SESSION['jampinjam'] = $_POST['jampinjam'];
        $_SESSION['jamkembali'] = $_POST['jamkembali'];


    }
    else if(addBookCar($kdbook, $tglpinjam, $jampijam, $tglkembali, $jamkembali, $ktp, $sopir, $plat, $tglpesan))
    {
        $tgl .=''.$tglpinjam.' '.$jampijam.'';
        $kembali .=''.$tglkembali.' '.$jamkembali.'';
        $ts1 = strtotime(str_replace('/', '-', $tgl));
        $ts2 = strtotime(str_replace('/', '-', $kembali));
        $diff = abs(abs($ts1 - $ts2)/60);
        $hari = (int) hitungHari($kdbook);
//        $jam = round((strtotime($jampijam) - strtotime($jamkembali)));
//        $tarif = $data['TarifPerJam'] * 24;
        $hargambl = (int) $data['TarifPerJam'] / 60;
        $hargaspr = (int) $dataspr['TarifPerJam'] / 60;
        $total = ($diff * $hargambl)+ ($diff * $hargaspr);
        addTotalTransaksi($kdbook,$total);
        unset($_SESSION['tglpinjam']);
        unset($_SESSION['jampinjam']);
        unset($_SESSION['jamkembali']);

        alert("Anda Memesan $hari hari, atau $diff menit dengan total harga $total");
        direct("tampilmobiluser.php");
    }
    else
    {
        alert("Gagal Memesan");
        direct("booking.php?id=$plat");
    }
}
elseif(isset($_POST['btn-back']))
{
    direct("tampilmobiluser.php");
}
echo $output;
?>
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
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><span>Administrasi</span>Rental</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg><?php echo $_SESSION['nama']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="profile.php">
                                <svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg> Profile</a>
                        </li>
                        <li>
                            <a href="#">
                                <svg class="glyph stroked cancel">
                                    <use xlink:href="#stroked-cancel"></use>
                                </svg> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
    <!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <ul class="nav menu">
        <li class="active">
            <a href="index.html">
                <svg class="glyph stroked home">
                    <use xlink:href="#stroked-home" />
                </svg>
                Dashboard</a>
        </li>

        <li><a href="charts.html">Laporan</a></li>
        <li><a href="tables.html">Data Mobil</a></li>

        <li role="presentation" class="divider"></li>
        <li>
            <a href="login.html">
                <svg class="glyph stroked male-user">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-male-user"></use>
                </svg> Login Page</a>
        </li>
    </ul>

</div>
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
            <li class="active">Mobil</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Booking Mobil</h1>
        </div>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="Mobil">Kode Booking</label>
                            <div class="col-md-5">
                                <input id="kdbook" name="kdbook" type="text" class="form-control input-md" required="" readonly value="<?php echo $idTrs;?>">
                            </div>
                        </div>
                        <fieldset>



                            <!-- Form Name -->
                            <legend>Detail Mobil</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Mobil</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="mobil" type="text" placeholder="Nama Mobil" class="form-control input-md" required="" readonly value="<?php echo $data['Nama Mobil']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Merk">Merk</label>
                                <div class="col-md-5">
                                    <input id="merk" name="merk" type="text" placeholder="Merk Mobil" class="form-control input-md" required="" readonly value="<?php echo $datamerk['NmMerk']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Type">Type</label>
                                <div class="col-md-5">
                                    <input id="type" name="type" type="text" placeholder="Type Mobil" class="form-control input-md" required="" readonly value="<?php echo $datatype['NmType']?>">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tarif</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="tarif" type="text" placeholder="Tarif" class="form-control input-md" required="" readonly value="<?php echo $data['TarifPerJam']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Deskripsi</label>
                                <div class="col-md-5">
                                    <textarea id="deskripsi" name="deskripsi"  placeholder="Deskripsi Mobil" readonly class="form-control input-md" ><?php echo $data['Deskripsi']?></textarea>

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Nama Pemilik</label>
                                <div class="col-md-5">
                                    <input id="pemilik" name="pemilik" type="text" placeholder="Nama Pemilik" class="form-control input-md" value="<?php echo $dataext['NmPemilik']?>" readonly>

                                </div>
                            </div>

                            <!-- Data Diri -->
                            <br>
                            <legend>Data Diri Anda</legend>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Nama">Nama</label>
                                <div class="col-md-5">
                                    <input id="nama" name="nama" type="text" class="form-control input-md" required="" readonly value="<?php echo $_SESSION['nama']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Alamat">Alamat</label>
                                <div class="col-md-5">
                                    <input id="alamat" name="alamat" type="text" class="form-control input-md" required="" readonly value="<?php echo $_SESSION['alamat']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="TglPinjam">Tgl Pinjam</label>
                                <div class="col-md-5">
                                    <input id="tglpinjam" name="tglpinjam" type="date" class="form-control input-md" value="<?php echo $_SESSION['tglpinjam']?>" required>

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="TglKembali">Tgl Kembali</label>
                                <div class="col-md-5">
                                    <input id="tglkembali" name="tglkembali" type="date" class="form-control input-md" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Jampinjam">Jam Pinjam</label>
                                <div class="col-md-5">
                                    <input id="jampinjam" name="jampinjam"  type="time" placeholder="HH-MM-SS" class="form-control input-md" value="<?php echo $_SESSION['jampinjam']?>" required>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Jamkembali">Jam Kembali</label>
                                <div class="col-md-5">
                                    <input id="jamkembali" name="jamkembali"  type="time" placeholder="HH-MM-SS" class="form-control input-md" value="<?php echo $_SESSION['jamkembali']?>" required>

                                </div>
                            </div>
                            <br>

                            <legend>Data Tambahan</legend>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Sopir">Nama Sopir</label>
                                <div class="col-md-5">

                                    <select class="form-control input-md" name="sopir" onchange="if(this.options[this.selectedIndex].value=='customOption'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                                        <!--<option value="tidak">Tidak Memakai Sopir</option>-->
                                        <?php
                                        $sql=mysql_query('select * from sopir') or trigger_error("Query Failed: " . mysql_error());;
                                        while($data=mysql_fetch_array($sql)) {
                                            $output = '';
                                            $output .= '<option value="' . $data['IDSopir'] . '">' . $data['NmSopir'] . '</option>';
                                            echo $output;
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>
                                        <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit" class="btn btn-primary">Book!</button>


                                    <div class="col-md-4">
                                        <a href="tampilmobiluser.php" id="btn-back" name="btn-back" class="btn btn-primary">Kembali</a>
                                    </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <!--/.row-->

    <!--/.row-->


</div>
<!--/.main-->
<script>
    function toggleField(hideObj,showObj){
        hideObj.disabled=true;
        hideObj.style.display='none';
        showObj.disabled=false;
        showObj.style.display='inline';
        showObj.focus();
    }
</script>
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
    });
    $(window).on('resize', function () {
        if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
</script>
</body>

</html>
