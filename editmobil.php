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
if(isset($_GET['id']));
{
    $query = mysql_query("Select * from kendaraan WHERE NoPlat = '$_GET[id]'");
    $data = mysql_fetch_array($query);
    $query = mysql_query("Select * from pemilik WHERE KodePemilik = '$data[KodePemilik]'");
    $dataext = mysql_fetch_array($query);
}
if(isset($_POST['btn-submit']))
{

    $plat = $_POST['plat'];
    $tarif = $_POST['tarif'];
    $deskripsi = $_POST['deskripsi'];


    if(edit_kendaraan($tarif,$deskripsi,$plat))
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
                    <form class="form-horizontal" action="editmobil.php" method="post">
                        <fieldset>

                            <!-- Form Name -->
                            <legend>Form Name</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Mobil</label>
                                <div class="col-md-5">
                                    <input id="mobil" name="mobil" type="text" placeholder="Nama Mobil" class="form-control input-md" required="" readonly value="<?php echo $data['Nama Mobil']?>">

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Plat">No Plat</label>
                                <div class="col-md-5">
                                    <input id="plat" name="plat" type="text" placeholder="Plat Nomor Mobil" class="form-control input-md" readonly value="<?php echo $data['NoPlat']?>">

                                </div>
                            </div>

                            <!-- Text input-->

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Mobil">Tarif</label>
                                <div class="col-md-5">
                                    <input id="tarif" name="tarif" type="text" placeholder="Tarif" class="form-control input-md" required="" value="<?php echo $data['TarifPerJam']?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Deskripsi</label>
                                <div class="col-md-5">
                                    <textarea id="deskripsi" name="deskripsi"  placeholder="Deskripsi Mobil" class="form-control input-md" ><?php echo $data['Deskripsi']?></textarea>

                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Pemilik">Nama Pemilik</label>
                                <div class="col-md-5">
                                    <input id="pemilik" name="pemilik" type="text" placeholder="Nama Pemilik" class="form-control input-md" value="<?php echo $dataext['NmPemilik']?>" readonly>

                                </div>
                            </div>


                            <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit" class="btn btn-primary">Edit</button>
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
