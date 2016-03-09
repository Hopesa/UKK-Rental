<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 09/03/2016
 * Time: 2:26
 * This File Contains Common HTML Elements
 */
$nav='';
$header='';
$menu='';
$menuli='';
$script='';
$title='';
$profile='';
$sidebar='';

if(cekPrivilage()=='1'){
    $privilage = 'Admin';
    $menuli.='
        <li><a href="karyawan.php">Data Karyawan</a></li>';
}
else{
    $privilage = 'Karyawan';
}

$nav.='
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
                        </svg>'.$_SESSION['username'].'<span class="caret"></span></a>
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
                            <a href="login.php?action=logout">
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
</nav>';
$sidebar.='
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
        <li><a href="tampilmobil.php">Data Mobil</a></li>
        <li><a href="pemilik.php">Data Pemilik</a></li>
        <li><a href="sopir.php">Data Sopir</a></li>
        <li><a href="pelanggan.php">Data Pelanggan</a></li>
        <li><a href="reservasi.php">Data Reservasi</a></li>
        <li><a href="laporan.php">Laporan</a></li>
        '.$menuli.'

        <li role="presentation" class="divider"></li>
        <li>
            <a href="login.php?action=logout">
                <svg class="glyph stroked male-user">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-male-user"></use>
                </svg>Logout</a>
        </li>
    </ul>

</div>';