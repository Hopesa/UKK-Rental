<?php
include_once 'config/config.php';
error_reporting(0);
if(loggedin()=="")
{
    redirect('login_pelanggan.php');
}

?>

<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>User Profile</title>
    <!-- BOOTSTRAP STYLE SHEET -->
    <link href="style/bootstrap.css" rel="stylesheet" />
    <!-- FONT-AWESOME STYLE SHEET FOR BEAUTIFUL ICONS -->
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
    <div class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Profile</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav ">
                    <li><a href="#">HOME</a></li>
                    <li><a href="historypelanggan.php">HISTORY</a></li>
                    <li><a href="tampilmobiluser.php">MOBIL</a></li>
                    <li><a href="profile.php?logout">LOGOUT</a></li>
                </ul>
            </div>

        </div>
    </div>
    <!-- NAVBAR CODE END -->


    <div class="container">
        <section style="padding-bottom: 50px; padding-top: 50px;">
            <div class="row">
                <form class="col-md-4" method="post" action=profile.php?update>
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
                <div class="col-md-8">
                    <div class="alert alert-info">
                        <h2>User : <?php echo $_SESSION['username']?></h2>
                        <h4>User Profile </h4>
                    </div>
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


        </section>
        <!-- SECTION END -->
    </div>
</body>
</html>
