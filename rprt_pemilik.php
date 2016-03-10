<?php
/**
 * Created by PhpStorm.
 * User: Bilal
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
                            </svg> <?php echo $_SESSION['nama']; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="profile.php">
                                    <svg class="glyph stroked male-user">
                                        <use xlink:href="#stroked-male-user"></use>
                                    </svg> Profile</a>
                            </li>
                            <li>
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
                <a href="profile_pemilik.php">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home" />
                    </svg>
Dashboard</a>
            </li>

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
                <div class="panel panel-default">
                    <div class="panel-heading">Laporan Mobil Anda</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="pesan" data-sort-order="desc">

                            <thead>
                                <tr>
                                    <th data-field="mobil" data-sortable="true">Nama Mobil</th>
                                    <th data-field="merek" data-sortable="true">Merk</th>
                                    <th data-field="tipe" data-sortable="true">Type</th>
                                    <th data-field="plat" data-sortable="true">No Plat</th>
                                    <th data-field="nama" data-sortable="false">Nama Pelanggan</th>
                                    <th data-field="sopir" data-sortable="true">Nama Sopir</th>
                                    <th data-field="pesan" data-sortable="true">Tanggal Pesan</th>
                                    <th data-field="pinjam" data-sortable="true">Tanggal Pinjam</th>
                                    <th data-field="kembali" data-sortable="true">Tanggal Kembali Rencana</th>
                                    <th data-field="kembali" data-sortable="true">Tanggal Kembali Real</th>

                                    <!--<th data-field="total" data-sortable="true">Total</th> -->
                                    <!--<th data-field="status" data-sortable="true">Status</th> -->
                                </tr>
                            </thead>
                            <?php
                            $kdpemilik = $_SESSION['kode_pemilik'];
                            $sql = mysql_query("select * from kendaraan where KodePemilik='$kdpemilik'");
                            while($milik = mysql_fetch_array($sql)){
                            //$ktp = $_SESSION['ktp'];
                            $plat = $milik['NoPlat'];
                            $sqlx=mysql_query("select * from transaksisewa WHERE NoPlat='$plat'") or trigger_error("Query Failed: " . mysql_error());;
                            while($data=mysql_fetch_array($sqlx)) {
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

                                $output .= '<tr>
                                <td>' . $kendaraan['Nama Mobil'] . '</td>
                                <td>' . $merk['NmMerk'] . '</td>
                                <td>' . $type['NmType'] . '</td>
                                <td>' . $data['NoPlat'] . '</td>
                                <td>' . $pelanggan['NamaPel'] . '</td>
                                <td>' . $sopir['NmSopir'] . '</td>
                                <td>' . $data['TglPesan'] . '</td>
                                <td>' . $data['TglPinjam'] . '</td>
                                <td>' . $data['TglKembaliRencana'] . '</td>
                                <td>' . $data['TglKembaliReal'] . '</td>

                                <td>' . $merk['NmMerk'] . '</td>
                                <td>' . $type['NmType'] . '</td>
                                <td>' . $data['NoPlat'] . '</td>
                            </tr>
                            ';
                                //if($data['StatusRental']==1)
                                echo $output;
                                //$output = '';
                            }
                            }
?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
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
        });
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
        </script>
</body>

</html>