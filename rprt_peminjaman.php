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
                <h1 class="page-header">Laporan Pendapatan 1 Bulan Terakhir</h1>
            </div>
        </div>

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
                            <div class="large">Total</div>
                            <div class="text-muted"><?php echo totalPendapatan();?></div>
                        </div>
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