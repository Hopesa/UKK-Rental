<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 10/03/2016
 * Time: 09:58
 */
require_once('config/config.php');
if(!loggedInSpc()){
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
            <li class="active">Pemilik</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manajemen Sopir</h1>
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
                            <div class="large">Mobil</div>
                            <div class="text-muted">Manajemen Mobil</div>
                        </div>
                    </div>
                </div>
        </a>
    </div>

    <?php
    if(empty($_GET['action'])){
        $outputa='';
        $outputa.= '<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Sopir</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">

                            <thead>
                                <tr>
                                    <th data-field="pemilik" data-sortable="true">Pemilik</th>
                                    <th data-field="alamat" data-sortable="true">Alamat</th>
                                    <th data-field="telepon" data-sortable="true">Telepon</th>
                                    <th data-field="mobilt" data-sortable="true">No SIM</th>
                                    <th data-field="mobilt" data-sortable="true">Tarif</th>
                                    <th data-field="action" data-clickable="true">Action</th>
                                </tr>
                            </thead>
                            ';
        echo $outputa;
        $sql=mysql_query('select * from sopir') or trigger_error("Query Failed: " . mysql_error());;
        while($data=mysql_fetch_array($sql)){
            $output ='';
            $output .='<tr>
                                <td>'.$data['NmSopir'].'</td>
                                <td>'.$data['AlamatSopir'].'</td>
                                <td>'.$data['TelpSopir'].'</td>
                                <td>'.$data['NoSIM'].'</td>
                                <td>'.$data['TarifPerJam'].'</td>
                                <td><a href="pemilik.php?id='.$data['KodePemilik'].'&action=edit" style="height:50px">Edit </a><a href="deletepemilik.php?id='.$data['KodePemilik'].'"> Delete</a></td>
                            </tr>
                            ';
            echo $output;
            $output = '';}
        $outputb ='';
        $outputb.='
        </table>

        <a href="pemilik.php?action=add">Add Pemilik</a>
    </div>
    </div>

    </div>
    </div>';
        echo $outputb;
    }
    else if($_GET['action']=='edit'){
        if(isset($_GET['id']));
        {
            $query = mysql_query("Select * from pemilik WHERE KodePemilik = '$_GET[id]'");
            $data = mysql_fetch_array($query);
        }
        if(isset($_POST['btn-edit']))
        {
            $ktp = $_POST['ktp'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telp'];

            if(edit_pemilik($ktp,$alamat,$telepon))
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
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="pemilik.php?action=edit" method="post">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Form Name</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="KTP">No KTP</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="ktp" type="text" placeholder="No KTP"
                                           class="form-control input-md" required="" readonly
                                           value="'.$data['KodePemilik'].'">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Nama Pemilik</label>
                                <div class="col-md-5">
                                    <input id="plat" name="nama" type="text" placeholder="Plat Nomor Mobil"
                                           class="form-control input-md" readonly value="'.$data['NmPemilik'].'">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Alamat</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="alamat" type="text" placeholder="Tarif"
                                           class="form-control input-md" required=""
                                           value="'.$data['AlamatPemilik'].'">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Telepon</label>
                                <div class="col-md-5">
                                    <input id="pemilik" name="telp" type="number" placeholder="Telepon Pemilik"
                                           class="form-control input-md" value="'.$data['TelpPemilik'].'">

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
        if(isset($_POST['btn-submit']))
        {
            $pemilik = $_POST['nama'];
            $kode = $_POST['ktp'];
            $telepon = $_POST['telp'];
            $alamat = $_POST['alamat'];

            if(add_Pemilik($pemilik,$kode,$telepon,$alamat))
            {
                $output = 'Success';
                echo $output;
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
                <div class="panel-heading">Tambah Pemilik</div>
                <div class="panel-body">
                    <form class="form-horizontal" action="pemilik.php?action=add" method="post">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="KTP">No KTP</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="ktp" type="number" placeholder="No KTP"
                                           class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Nama Pemilik</label>
                                <div class="col-md-5">
                                    <input id="plat" name="nama" type="text" placeholder="Nama Pemilik"
                                           class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="alamat">Alamat</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="alamat" type="text" placeholder="Alamat"
                                           class="form-control input-md" required="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Telepon</label>
                                <div class="col-md-5">
                                    <input id="pemilik" name="telp" type="number" placeholder="Telepon Pemilik"
                                           class="form-control input-md" required="">

                                </div>
                            </div>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit" class="btn btn-primary">Tambah</button>
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