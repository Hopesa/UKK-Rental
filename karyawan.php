<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 05/03/2016
 * Time: 19:12
 */
require_once('config/config.php');

if(cekPrivilage()!==1){
    alert('Anda tidak diperbolehkan mengakses page ni');
    redirect('403.php');
}
if (!loggedInSpc()){
    redirect('403.php');
}
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
            <h1 class="page-header">Manajemen Karyawan</h1>
        </div>
    </div>
    <!--/.row-->
<!--/.sidebar-->
<?php

if(empty($_GET['action'])){
    $outputa='';
    $outputa.= '<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Karyaaan</div>
                    <div class="panel-body">
                        <table data-toggle="table" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="nama" data-sort-order="desc">

                            <thead>
                                <tr>
                                    <th data-field="nik" data-sortable="true">NIK</th>
                                    <th data-field="user" data-sortable="true">Username</th>
                                    <th data-field="nama" data-sortable="true">Nama</th>
                                    <th data-field="tipe" data-sortable="true">Tipe</th>
                                    <th data-field="alamat" data-sortable="true">Alamat</th>
                                    <th data-field="telepon" data-sortable="true">Telepon</th>
                                    <th data-field="action" data-clickable="true">Action</th>
                                </tr>
                            </thead>
                            ';
    echo $outputa;
    $sql=mysql_query("SELECT karyawan.NIK,karyawan.AlamatKaryawan,karyawan.NmKaryawan,karyawan.TelpKaryawan,login.NIK,login.TypeUser,login.UserName FROM karyawan INNER JOIN login ON login.NIK = karyawan.NIK") or trigger_error("Query Failed: " . mysql_error());;
    while($data=mysql_fetch_array($sql)){
        $output ='';

        $output .='<tr>
                                <td>'.$data['NIK'].'</td>
                                <td>'.$data['UserName'].'</td>
                                <td>'.$data['NmKaryawan'].'</td>
                                <td>'.$data['TypeUser'].'</td>
                                <td>'.$data['AlamatKaryawan'].'</td>
                                <td>'.$data['TelpKaryawan'].'</td>
                                <td><a href="karyawan.php?action=edit&id='.$data['NIK'].'" style="height:50px">Edit </a><a href=""> Delete</a></td>
                            </tr>
                            ';
        echo $output;
        $output = '';}
    $outputb ='';
    $outputb.='
        </table>

        <a href="karyawan.php?action=add">Add Karyawan</a>
    </div>
    </div>

    </div>
    </div>';
    echo $outputb;
}
    else if(($_GET['action'])=='add'){
    if(isset($_POST['btn-submit']))
    {
        $Username = $_POST['user'];
        $Pass = $_POST['pass'];
        $type = $_POST['type'];
        $NmKaryawan = $_POST['nama'];
        $AlamatKaryawan = $_POST['alamat'];
        $TelpKaryawan = $_POST['telp'];
        $kode = $_POST['kode'];

        if(registerkaryawan($Username, $Pass, $type, $kode, $NmKaryawan, $AlamatKaryawan, $TelpKaryawan))
        {
            $output = 'Success';
        }
        else
        {
            $output = "Wrong Details !";
        }
    }
    $NIK = generateNIK();
    $output.='


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Karyawan</div>
                <div class="panel-body">
                    <form class="form" style="margin-bottom: 20px;" action="karyawan.php?action=add" method="post">
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="lead">
                                    <i class="icon-github text-contrast"></i>
                                    Informasi Login
                                </div>
                                <small class="text-muted">Isi informasi login karyawan</small>
                            </div>
                            <div class="col-sm-7 col-sm-offset-1">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" id="username" placeholder="Username" type="text" name="user">
                                </div>
                                <div class="form-group">
                                    <label>Tipe Karyawan</label>
                                     <select class="form-control input-md" name="type">
                                            <option value="Admin">Admin</option>
                                            <option value="Karyawan">Karyawan</option>
                                        </select>
                                </div>
                                <hr class="hr-normal">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" id="password" placeholder="Password" type="password" name="pass" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input class="form-control" id="password-confirmation" placeholder="Password confirmation" type="password" name="pass1" required>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="hr-normal">
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="lead">
                                    <i class="icon-user text-contrast"></i>
                                    Personal info Karyawan
                                </div>
                                <small class="text-muted">Masukkan info diri karyawan disini.</small>
                            </div>
                            <div class="col-sm-7 col-sm-offset-1">
                            <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" id="lastname" placeholder="Last name" type="text" name="kode" value="'.$NIK.'" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" id="firstname" placeholder="Nama" type="text" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" id="lastname" placeholder="Alamat" type="text" name="alamat">
                                </div>
                               <div class="form-group">
                                    <label>Telepon</label>
                                    <input class="form-control" id="telp" placeholder="Last name" type="number" name="telp">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-submit" class="btn btn-primary">Submit</button>
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


</div>';
    echo $output;
}
    else if(($_GET['action'])=='edit'){
        $query = mysql_query("SELECT karyawan.NIK,karyawan.AlamatKaryawan,karyawan.NmKaryawan,karyawan.TelpKaryawan,login.NIK,login.TypeUser,login.UserName FROM karyawan INNER JOIN login on login.NIK = karyawan.NIK WHERE karyawan.NIK = '$_GET[id]'");
        $data = mysql_fetch_array($query);
        if(isset($_POST['btn-edit']))
    {

        $Username = $_POST['user'];
        $NmKaryawan = $_POST['nama'];
        $AlamatKaryawan = $_POST['alamat'];
        $TelpKaryawan = $_POST['telp'];
        $kode = $_POST['kode'];

        if(editkaryawan($Username, $kode, $NmKaryawan, $AlamatKaryawan, $TelpKaryawan))
        {
            $output = 'Success';
        }
        else
        {
            $output = "Wrong Details !";
        }
    }
    $output.='


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Karyawan</div>
                <div class="panel-body">
                    <form class="form" style="margin-bottom: 20px;" action="karyawan.php?action=edit" method="post">
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="lead">
                                    <i class="icon-github text-contrast"></i>
                                    Informasi Login
                                </div>
                                <small class="text-muted">Isi Informasi login karyawan</small>
                            </div>
                            <div class="col-sm-7 col-sm-offset-1">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" id="username" placeholder="Username" type="text" name="user" value="'.$data['UserName'].'">
                                </div>
                                <div class="form-group">
                                    <label>Tipe Karyawan</label>
                                     <select class="form-control input-md" name="type">
                                            <option value="Admin">Admin</option>
                                            <option value="Karyawan">Karyawan</option>
                                        </select>
                                </div>
                                </div>
                            </div>
                        </fieldset>
                        <hr class="hr-normal">
                        <fieldset>
                            <div class="col-sm-4">
                                <div class="lead">
                                    <i class="icon-user text-contrast"></i>
                                    Personal info Karyawan
                                </div>
                                <small class="text-muted">Masukkan info diri karyawan disini.</small>
                            </div>
                            <div class="col-sm-7 col-sm-offset-1">
                            <div class="form-group">
                                    <label>NIK</label>
                                    <input class="form-control" id="lastname" placeholder="Last name" type="text" name="kode" value="'.$data['NIK'].'" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" id="firstname" placeholder="Nama" type="text" name="nama" value="'.$data['NmKaryawan'].'">
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input class="form-control" id="lastname" placeholder="Alamat" type="text" name="alamat" value="'.$data['AlamatKaryawan'].'">
                                </div>
                               <div class="form-group">
                                    <label>Telepon</label>
                                    <input class="form-control" id="telp" placeholder="Last name" type="number" name="telp" value="'.$data['TelpKaryawan'].'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="confirm"></label>
                                <div class="col-md-4">
                                    <button id="btn-submit" name="btn-edit" class="btn btn-primary">Submit</button>
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


</div>';
    echo $output;
}
?>
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
