<?php
require('functions/config.php');
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 05/03/2016
 * Time: 13:03
 */
if(loggedIn()){
    header("Location:index.php");
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-box">

    <div class="login-hn"><img src=""></div>
    <div class="login-black-box">
        <div class="login-form">
            <h1>Register</h1>
            <form action="register_act.php?action=register" method="post">
                <input style="border-bottom:none;" type="text" name="username" placeholder="Username">
                <input type="password" name="pass" placeholder="Password">
                <button>Sign In</button>
            </form>
        </div>
    </div>

</div>
</body>
</html>
