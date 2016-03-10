<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 03/03/2016
 * Time: 08:24
 */
error_reporting(0);
include_once('config/config.php');
if (loggedInSpc()){
    redirect('admindash.php');
}
else if(loggedIn()){
    redirect('profile.php');
}
echo '<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .content {
                text-align: center;
                display: inline-block;
            }
            .title {
                font-size: 70px;
                color: red;
                font-family: "Lato";
            }
            a {
            color:deepskyblue;
            text-decoration: none;
            font-weight: 600;
                font-family: "Lato";
            }
            a:hover {
            color:dodgerblue;
            text-decoration: none;
            font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
            <img src="faraday-logo.png" height="300">
                <div class="title">Index Rental Mobil<br><a href="login.php">Login Petugas</a>|<a href="login_pelanggan.php">Login Pelanggan</a><br><a href="register_pelanggan.php">Register Pelanggan</a></div>
            </div>';


?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <table data-toggle="table" data-sort-order="desc">

                    <thead>
                    <tr>
                        <th data-field="id" data-sortable="false">No Plat</th>
                        <th data-field="nama" data-sortable="true">Nama Mobil</th>
                        <th data-field="tahun" data-sortable="true">Tahun</th>
                        <th data-field="status" data-sortable="true">Status</th>
                        <th data-field="merek" data-sortable="true">Merek</th>
                        <th data-field="tipe" data-sortable="true">Tipe</th>
                        <th data-field="tarif" data-sortable="true">Tarif</th>
                        <th data-field="pemilik" data-sortable="true">Pemilik</th>
                        <th data-field="alamat" data-sortable="true">Alamat Pemilik</th>
                    </tr>
                    </thead>
                    <?php
                    $sql=mysql_query('select * from kendaraan') or trigger_error("Query Failed: " . mysql_error());;
                    while($data=mysql_fetch_array($sql)){
                        $output ='';
                        $sqlb=mysql_query("select * from merk WHERE KodeMerk='$data[KodeMerk]'");
                        $datab=mysql_fetch_assoc($sqlb);
                        $sqlc=mysql_query("select * from type WHERE IDType='$data[IDType]'");
                        $datac=mysql_fetch_assoc($sqlc);
                        $sqld=mysql_query("select * from pemilik WHERE KodePemilik='$data[KodePemilik]'");
                        $datad=mysql_fetch_assoc($sqld);
                        if($data['StatusRental']==1){
                            $status = 'Tersedia';
                        }
                        else{
                            $status = 'Not Avaiable';
                        }
                        $output .='<tr>
                                <td>'.$data['NoPlat'].'</td>
                                <td>'.$data['Nama Mobil'].'</td>
                                <td>'.$data['Tahun'].'</td>
                                <td>'.$status.'</td>
                                <td>'.$datab['NmMerk'].'</td>
                                <td>'.$datac['NmType'].'</td>
                                <td>'.$data['TarifPerJam'].'</td>
                                <td>'.$datad['NmPemilik'].'</td>
                                <td>'.$datad['AlamatPemilik'].'</td>
                                </tr>
                            ';
                        echo $output;
                        $output = '';}
                    ?>
                </table>
            </div>
        </div>

    </div>
</div>
</div>
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