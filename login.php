<?php

require_once 'config/config.php';

if(loggedInSpc())
{
    redirect('admindash.php');
}

if(isset($_POST['btn-login']))
{
    $uname = $_POST['username'];
    $upass = $_POST['password'];
    $uname = stripslashes($uname);
    $upass = stripslashes($upass);
    $uname = mysql_real_escape_string($uname);
    $upass = mysql_real_escape_string($upass);

    $ok=loginKaryawan($uname,$upass);

    if($ok)
    {
        redirect('admindash.php'); //If Success redirect to Admin Dashboard
    }
    else
    {
        $error = "Wrong Details !"; //Or Invalid Pass
    }
}
if(isset($_GET['action'])){
    if ($_GET='logout'){
        logoutUser(); //Logout the user
    }
}
?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Login : cleartuts</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="style/style.css" type="text/css" />
    </head>

    <body>
        <div class="container">
            <div class="form-container">
                <form method="post">
                    <h2>Sign in.</h2>
                    <hr />
                    <?php
            if(isset($error))
            {
                ?>
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;
                            <?php echo $error; ?> !
                        </div>
                        <?php
            }
            ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Your Password" required />
                            </div>
                            <div class="clearfix"></div>
                            <hr />
                            <div class="form-group">
                                <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                                    <i class="glyphicon glyphicon-log-in"></i>&nbsp;SIGN IN
                                </button>
                            </div>
                            <br />
                            <label>Add more account? <a href="register.php">Add Account</a></label>
                </form>
            </div>
        </div>

    </body>
    </html