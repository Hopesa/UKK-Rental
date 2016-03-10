<?php
include_once 'config/config.php';
error_reporting(0);
if(!loggedin())
{
    redirect('login_pelanggan.php');
}

?>

<html>
<head>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Icons-->
    <script src="js/lumino.glyphs.js"></script>

    <!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
    <link href="style/font-awesome.css" rel="stylesheet" />
     <!-- CUSTOM STYLE CSS -->
    <style type="text/css">
               .btn-social {
            color: white;
            opacity: 0.8;
        }

            .btn-social:hover {
                color: white;
                opacity: 1;
                text-decoration: none;
            }

        .btn-facebook {
            background-color: #3b5998;
        }

        .btn-twitter {
            background-color: #00aced;
        }

        .btn-linkedin {
            background-color: #0e76a8;
        }

        .btn-google {
            background-color: #c32f10;
        }
    </style>
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
            <a class="navbar-brand" href="#"><span>Pelanggan</span>Rental</a>
            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <svg class="glyph stroked male-user">
                            <use xlink:href="#stroked-male-user"></use>
                        </svg> <?php echo $_SESSION['nama']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="profile.php?logout">
                                <svg class="glyph stroked male-user">
                                    <use xlink:href="#stroked-male-user"></use>
                                </svg> Profile</a>
                        </li>
                        <li>
                        <li>
                            <a href="profile.php?logout">
                                <svg class="glyph stroked cancel">
                                    <use xlink:href="profile.php?logout"></use>
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
            <a href="profile.php">
                <svg class="glyph stroked home">
                    <use xlink:href="#stroked-home" />
                </svg>
                Dashboard</a>
        </li>

        <li><a href="historypelanggan.php">History Pemesanan</a></li>
        <li><a href="tampilmobiluser.php">Pesan Mobil</a></li>




        <li role="presentation" class="divider"></li>
        <li>
            <a href="profile.php?logout">
                <svg class="glyph stroked male-user">
                    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-male-user"></use>
                </svg>Logout</a>
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
                <div class="panel-heading">Profil</div>
                <div class="panel-body">
                    <div class="row">
                        <form class="col-md-8" method="post" action=profile.php?update>
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>" readonly>
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['nama']; ?>">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo $_SESSION['alamat']; ?>">
                            <label>No. Telp</label>
                            <input type="text" name="telp" class="form-control" value="<?php echo $_SESSION['telp']; ?>">
                            <br>
                            <button name="data" class="btn btn-success">Update Details</button>
                            <br /><br/>
                    </div>
                    <div class="col-md-8 no-padding">
                        <div class="form-group col-md-8">
                            <h3>Change YOur Password</h3>
                            <br />
                            <label>Enter Old Password</label>
                            <input name="oldpass" type="password" class="form-control">
                            <label>Enter New Password</label>
                            <input name="newpass" type="password" class="form-control">
                            <label>Confirm New Password</label>
                            <input name="renewpass" type="password" class="form-control" />
                            <br>
                            <button name="pass" class="btn btn-warning">Change Password</button>
                        </div>
                    </div>
                </div>
                <!-- ROW END -->
                <?php
                if(isset($_GET['logout'])) {
                    logoutUser();
                    alert("Anda Terlah Berhasil Logout");
                    direct("profile.php ");
                }

                if(isset($_GET['update'])) {

                    $nama = $_POST['nama'];
                    $alamat = $_POST['alamat'];
                    $telp = $_POST['telp'];
                    $oldpass = $_POST['oldpass'];
                    $newpass = $_POST['newpass'];
                    $renewpass = $_POST['renewpass'];

                    if(isset($_POST['data'])){
                        if ((updatePelanngan($nama, $alamat, $telp)) == true) {
                            direct("profile.php");
                        }
                        else
                            echo "gagal mengedit";
                    }
                    elseif(isset($_POST['pass'])){
                        if ((updatePassPelanggan($oldpass)) == true) {
                            if($newpass==$renewpass) {
                                if(strlen($newpass) >= 6)
                                {
                                    direct("profile.php");
                                }
                                else
                                    echo "Password must be atleast 6 characters";
                            }
                            else
                                echo "password anda tidak cocok";
                        }
                        else
                            echo "password lama anda s  alah";
                    }
                }
                ?>
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
