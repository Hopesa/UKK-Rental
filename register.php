<?php

require_once 'config/config.php';

if (loggedin() != "") {
    redirect('admin.php');
}

if (isset($_POST['btn-signup'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username == "") {
        $error[] = "provide username !";
    } else if ($password == "") {
        $error[] = "provide password !";
    } else if (strlen($password) < 6) {
        $error[] = "Password must be atleast 6 characters";
    } else {
        register($username, $password);
        redirect('register.php?joined');


    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Sign up : cleartuts</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="style/style.css" type="text/css"/>
</head>

<body>
<div class="container">
    <div class="form-container">
        <form method="post">
            <h2>Sign up.</h2>
            <hr/>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    ?>
                    <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp;
                        <?php echo $error; ?>
                    </div>
                    <?php
                }
            } else if (isset($_GET['joined'])) {
                ?>
                <div class="alert alert-info">
                    <i class="glyphicon glyphicon-log-in"></i> &nbsp; Account Succesfully registered and added <a
                        href='admindash.php'>Admin Login</a> here
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Enter Username"
                       value="<?php if (isset($error)) {
                           echo $username;
                       } ?>"/>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password"/>
            </div>
            <div class="clearfix"></div>
            <hr/>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="btn-signup">
                    <i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br/>
            <label>have an account ! <a href="login.php">Sign In</a></label>
        </form>
    </div>
        </div>

</body>

</html>