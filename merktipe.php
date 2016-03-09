<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 06/03/2016
 * Time: 21:20
 */
require_once('config/config.php');
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
                        </svg> User <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="#">
                                <svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg> Profile</a>
                        </li>
                        <li>
                            <a href="#">
                                <svg class="glyph stroked gear">
                                    <use xlink:href="#stroked-gear"></use>
                                </svg> Settings</a>
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

        <li><a href="laporan.php">Laporan</a></li>
        <li><a href="tampilmobil.php">Data Mobil</a></li>




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
            <li class="active">Merk Dan Tipe</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manajemen Merk Dan Tipe</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row"><a href="tampilmobil.php">
        <div class="col-xs-12 col-md-6 col-lg-4">
            <div class="panel panel-blue panel-widget ">
                <div class="row no-padding">
                    <div class="col-sm-3 col-lg-4 widget-left">
                        <svg class="glyph stroked chevron left">
                            <use xlink:href="#stroked-chevron-left" />
                        </svg>
                    </div>
                    <div class="col-sm-9 col-lg-7 widget-right">
                        <div class="large">Mobil</div>
                        <div class="text-muted">Manajemen Mobil</div>
                    </div>
                </div>
            </div>
        </div></a>
    </div>

    <?php
    if(empty($_GET['action'])){
        $outputa.= '<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Merk</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">

                            <thead>
                                <tr>
                                    <th data-field="merk" data-sortable="true">Nama Merk</th>
                                    <th data-field="jml" data-sortable="true">Jumlah Mobil</th>
                                    <th data-field="ket" data-sortable="true">Keterangan</th>
                                    <th data-field="action" data-clickable="true">Action</th>
                                </tr>
                            </thead>
                            ';
        echo $outputa;
        $sql=mysql_query('select * from merk') or trigger_error("Query Failed: " . mysql_error());;
        while($data=mysql_fetch_array($sql)){
            $output ='';
            $sqlb=mysql_query("select * from kendaraan WHERE KodeMerk='$data[KodeMerk]'");
            $jumlah=mysql_num_rows($sqlb);

            $output .='<tr>
                                <td>'.$data['NmMerk'].'</td>
                                <td>'.$jumlah.'</td>
                                <td>'.$data['Keterangan'].'</td>
                                <td><a href="merktipe.php?id='.$data['KodeMerk'].'&action=editmerk" style="height:50px">Edit </a><a href="delete.php?id='.$data['KodeMerk'].'"> Delete</a></td>
                            </tr>
                            ';
            echo $output;
            $output = '';}
        $outputb.='
        </table>

        <a href="merktipe.php?action=Merk">Tambah Merk Baru</a>
    </div>
    </div>

    </div>
    </div>';
        echo $outputb;
        $outputc.= '<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Tipe Mobil</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">

                            <thead>
                                <tr>
                                    <th data-field="tipe" data-sortable="true">Tipe Mobil</th>
                                    <th data-field="jml" data-sortable="true">Jumlah Mobil</th>
                                    <th data-field="ket" data-sortable="false">Keterangan</th>
                                    <th data-field="action" data-clickable="false">Action</th>
                                </tr>
                            </thead>
                            ';
        echo $outputc;
        $sql=mysql_query('select * from type') or trigger_error("Query Failed: " . mysql_error());;
        while($data=mysql_fetch_array($sql)){
            $output ='';
            $sqlb=mysql_query("select * from kendaraan WHERE IDType='$data[IDType]'");
            $jumlah=mysql_num_rows($sqlb);

            $output .='<tr>
                                <td>'.$data['NmType'].'</td>
                                <td>'.$jumlah.'</td>
                                <td>'.$data['Keterangan'].'</td>
                                <td><a href="merktipe.php?id='.$data['IDType'].'&action=edittipe" style="height:50px">Edit </a><a href="deletepemilik.php?id='.$data['IDType'].'"> Delete</a></td>
                            </tr>
                            ';
            echo $output;
            $output = '';}
        $outputd.='
        </table>

        <a href="merktipe.php?action=Tipe">Tambah Tipe Baru</a>
    </div>
    </div>

    </div>
    </div>';
        echo $outputd;
    }
    else if($_GET['action']=='editmerk'){
        if(isset($_GET['id']));
        {
            $query = mysql_query("Select * from merk WHERE KodeMerk = '$_GET[id]'");
            $data = mysql_fetch_array($query);
        }
        if(isset($_POST['btn-edit']))
        {
            $kode = $_POST['kodemerk'];
            $nama = $_POST['namamerk'];
            $ket = $_POST['ket'];

            if(edit_merk($kode,$nama,$ket))
            {
                $output = 'Success';
            }
            else
            {
                $output = "Wrong Details !";
                echo $output;
                exit; //Stop
            }
        }

        $outputa.=' <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Merk</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="merktipe.php?action=editmerk" method="post">
                        <fieldset>

                            <!-- Form Name -->

                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-5" style="display: none;">
                                    <input id="mobil" name="kodemerk" type="text" placeholder="No KTP"
                                           class="form-control input-md" required="" readonly
                                           value="'.$data['KodeMerk'].'">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Nama Merk</label>
                                <div class="col-md-5">
                                    <input id="plat" name="namamerk" type="text" placeholder="Plat Nomor Mobil"
                                           class="form-control input-md"value="'.$data['NmMerk'].'">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Keterangan</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="ket" type="text" placeholder="Tarif"
                                           class="form-control input-md" required=""
                                           value="'.$data['Keterangan'].'">

                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-edit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>';
        echo $outputa;
    }
    else if($_GET['action']=='edittipe'){
        if(isset($_GET['id']));
        {
            $query = mysql_query("Select * from type WHERE IDType = '$_GET[id]'");
            $data = mysql_fetch_array($query);
        }
        if(isset($_POST['btn-edit']))
        {
            $kode = $_POST['kodetype'];
            $nama = $_POST['namatype'];
            $ket = $_POST['ket'];

            if(edit_tipe($kode,$nama,$ket))
            {
                $output = 'Success';
            }
            else
            {
                $output = "Wrong Details !";
                echo $output;
                exit; //Stop
            }
        }

        $outputa.=' <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Tipe</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="merktipe.php?action=edittipe" method="post">
                        <fieldset>

                            <!-- Form Name -->

                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-5" style="display: none;">
                                    <input id="mobil" name="kodetype" type="text" placeholder="No KTP"
                                           class="form-control input-md" required=""
                                           value="'.$data['IDType'].'">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tipe</label>
                                <div class="col-md-5">
                                    <input id="plat" name="namatype" type="text" placeholder="Plat Nomor Mobil"
                                           class="form-control input-md" value="'.$data['NmType'].'">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Keterangan</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="ket" type="text" placeholder="Tarif"
                                           class="form-control input-md" required=""
                                           value="'.$data['Keterangan'].'">

                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-edit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>

        </div>
    </div>';
        echo $outputa;
    }
    else {
        if(isset($_POST['btn-submit-Merk']))
        {
            $nama = $_POST['nama'];
            $ket = $_POST['ket'];

            if(tambah_merk($nama,$ket))
            {
                $output = 'Success';
            }
            else
            {
                $output = "Wrong Details !";
                echo $output;
                exit; //Stop
            }
        }
        else if(isset($_POST['btn-submit-Tipe']))
        {
            $nama = $_POST['nama'];
            $ket = $_POST['ket'];

            if(tambah_tipe($nama,$ket))
            {
                $output = 'Success';
            }
            else
            {
                $output = "Wrong Details !";
                echo $output;
                exit; //Stop
            }
        }
        if($_GET['action']=='Tipe'){
            $act='Tipe';
        }
        else if($_GET['action']=='Merk'){
            $act='Merk';
        }
        $outputa.=' <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah '.$act.' Baru</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="merktipe.php?action='.$act.'" method="post">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nama">'.$act.'</label>
                                <div class="col-md-5">
                                    <input id="nama" name="nama" type="text" placeholder="Nama '.$act.'"
                                           class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="ket">Keterangan</label>
                                <div class="col-md-5">
                                    <input id="ket" name="ket" type="text" placeholder="Keterangan"
                                           class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit-'.$act.'" class="btn btn-primary">Tambah</button>
                                </div>
                            </div>

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