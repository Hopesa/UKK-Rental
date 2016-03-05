<?php
require_once('functions/config.php');

if(!loggedIn()){
	header("Location:login.php");
}
?>
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
			font-weight: 800;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="content">
		<div class="title">Login Success <a href="login_act.php?logout"> Logout</a></div>
	</div>
</div>
</body>
</html>