<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 06/03/2016
 * Time: 21:20
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
                <li class="active">Mobil</li>
            </ol>
        </div>
        <!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manajemen Mobil</h1>
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
                            <div class="large">Supir</div>
                            <div class="text-muted">Manajemen Supir</div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="pemilik.php">
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="panel panel-orange panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-4 widget-left">
                            <svg class="glyph stroked chevron left">
                                <use xlink:href="#stroked-chevron-left" />
                            </svg>
                        </div>
                        <div class="col-sm-9 col-lg-7 widget-right">
                            <div class="large">Pemilik</div>
                            <div class="text-muted">Manajemen Pemilik</div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <a href="merktipe.php">
            <div class="col-xs-12 col-md-6 col-lg-4">
                <div class="panel panel-teal panel-widget">
                    <div class="row no-padding">
                        <div class="col-sm-3 col-lg-4 widget-left">
                            <svg class="glyph stroked chevron left">
                                <use xlink:href="#stroked-chevron-left" />
                            </svg>
                        </div>
                        <div class="col-sm-9 col-lg-8 widget-right">
                            <div class="large">Merk dan Tipe</div>
                            <div class="text-muted">Manajemen Merk dan Tipe</div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Semua Mobil</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">

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
                                    <th data-field="action" data-clickable="true">Action</th>
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
                                <td><a href="editmobil.php?id='.$data['NoPlat'].'" style="height:50px">Edit </a><a href="deletemobil.php?id='.$data['NoPlat'].'"> Delete</a></td>
                            </tr>
                            ';
                            echo $output;
                                $output = '';}
?>
                        </table>

                        <a href="addmobil.php">add mobil</a>
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