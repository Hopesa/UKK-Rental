<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 05/03/2016
 * Time: 19:12
 */
require_once('config/config.php');

if (!loggedInSpc()){
    redirect('403.php');
}
if(isset($_POST['btn-submit']))
{
    if($_POST['pemilikbaru'] !== 'Pemilik'){

        $pemilik = $_POST['pemilikbaru'];
        $kode = $_POST['kode'];
        $telepon = $_POST['telp'];
        $alamat = $_POST['alamat'];
        add_Pemilik($pemilik,$kode,$telepon,$alamat);
    }
    else{
        $kode = $_POST['kodelama'];
    }
        $mobil = $_POST['mobil'];
        $tipe = $_POST['tipe'];
        $plat = $_POST['plat'];
        $merk = $_POST['produsen'];
        $tahun = $_POST['tahun'];
        $tarif = $_POST['tarif'];
        $deskripsi = $_POST['deskripsi'];

    $datamobil = add_kendaraan($plat,$tahun,$tarif,$merk,$tipe,$mobil,$deskripsi,$kode);
    if($datamobil)
    {
        $output = 'Success';
    }
    else
    {
        $output = "Wrong Details !";
    }
}
echo $output;
?>
<html>
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
            <h1 class="page-header">Tambahkan Mobil</h1>
        </div>
    </div>
    <!--/.row-->


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <form class="form-horizontal" action="addmobil.php" method="post">
                        <fieldset>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Mobil</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="mobil" type="text" placeholder="Nama Mobil" class="form-control input-md" required="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tipe</label>
                                <div class="col-md-5">
                                    <select class="form-control input-md" name="tipe">
                                        <?php
                                        $sql=mysql_query('select * from type') or trigger_error("Query Failed: " . mysql_error());;
                                        while($data=mysql_fetch_array($sql)) {
                                            $output = '';
                                            $output .= '<option value="'.$data['IDType'].'">' . $data['NmType'] . '</option>';
                                            echo $output;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Plat">No Plat</label>
                                <div class="col-md-5">
                                    <input id="plat" name="plat" type="text" placeholder="Plat Nomor Mobil" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Merk">Produsen</label>
                                <div class="col-md-5">
                                    <select class="form-control input-md" name="produsen">
                                        <?php
                                        $sql=mysql_query('select * from merk') or trigger_error("Query Failed: " . mysql_error());;
                                        while($data=mysql_fetch_array($sql)) {
                                            $output = '';
                                            $output .= '<option value="'.$data['KodeMerk'].'">' . $data['NmMerk'] . '</option>';
                                            echo $output;
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Tahun">Tahun Produksi</label>
                                <div class="col-md-5">
                                    <input id="tahun" name="tahun" type="text" placeholder="Tahun Kendaraan" class="form-control input-md">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tarif</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="tarif" type="text" placeholder="Tarif" class="form-control input-md" required="">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Nama Pemilik</label>
                                <div class="col-md-5">
                                    <textarea id="deskripsi" name="deskripsi"  placeholder="Deskripsi Mobil" class="form-control input-md"></textarea>

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Nama Pemilik</label>
                                <div class="col-md-5">

                                        <select class="form-control input-md" name="kodelama" onchange="if(this.options[this.selectedIndex].value=='customOption'){toggleField(this,this.nextSibling); this.selectedIndex='0';}">
                                            <option></option>
                                            <option value="customOption">Tambahkan Pemilik Baru</option>
                                            <?php
                                            $sql=mysql_query('select * from pemilik') or trigger_error("Query Failed: " . mysql_error());;
                                            while($data=mysql_fetch_array($sql)) {
                                                $output = '';
                                                $output .= '<option value="' . $data['KodePemilik'] . '">' . $data['NmPemilik'] . '</option>';
                                                echo $output;
                                            }
?>
                                        </select><section style="display:none;" disabled="disabled" onblur="if(this.value==''){toggleField(this,this.previousSibling);}"><input class="form-control input-md" name="pemilikbaru" value="Pemilik">


                                    <br>




                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="kode" name="kode" type="text" placeholder="No KTP Pemilik" class="form-control input-md" >

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="telp" name="telp" type="text" placeholder="Telepon Pemilik" class="form-control input-md">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input id="alamat" name="alamat" type="text" placeholder="Alamat Pemilik" class="form-control">

                                </div>
                            </div>
                            </section>

                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit" class="btn btn-primary">submit</button>
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
</html>
