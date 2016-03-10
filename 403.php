<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 03/03/2016
 * Time: 08:24
 */

echo '<!DOCTYPE html>
<html>
    <head>
        <title>Index</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body {
                height: 100%;
            }
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 300;
                font-family: "Lato";
            }
            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }
            .content {
                text-align: center;
                display: inline-block;
            }
            .title {
                font-size: 70px;
                color: red;
            }
            a {
            color:deepskyblue;
            text-decoration: none;
            font-weight: 600;
            }
            a:hover {
            color:dodgerblue;
            text-decoration: none;
            font-weight: 600;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
            <img src="faraday-logo.png" height="300">
                <div class="title">403 Access Denied<br><a href="index.php">Ke Index</a></div>
            </div>
        </div>
    </body>
</html>';
    exit;

?>