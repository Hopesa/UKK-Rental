<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 04/03/2016
 * Time: 09:39
 */

include_once 'config/config.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <title>welcome - <?php print($userRow['user_email']); ?></title>
</head>

<body>

<div class="header">
    <div class="left">
        <label><a href="http://www.codingcage.com/">Coding Cage - Programming Blog</a></label>
    </div>
    <div class="right">
        <label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
    </div>
</div>
<div class="content">
    welcome : <?php print($userRow['user_name']); ?>
</div>
</body>
</html>