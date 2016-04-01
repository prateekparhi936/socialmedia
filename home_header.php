<?php
  session_start();
  if(!isset($_SESSION['username']) or empty($_SESSION['username']))
  {
    header("location: index.php");
  }
  $username=$_SESSION['username'];
?>
<html>
<head>
<title>friendzone</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css"/>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="js/jquery-1.9.1.min.js"></script>
	</head>
<body>
	<div class="header">
		<div id="wrapper">
			<div class="logo">
				<img src="./img/logo_facebook.jpg"/>
			</div>
			<div class="search_box">
				<form method="GET" action="search.php" id="search">
	 				 <input name="q" type="text" size="60" placeholder="Search..." />
				</form>
			</div>
			<div id="menu">
				<a href="friends.php"><img src="./img/friendrequest.png" width="35px" height="35px"/></a>
				<a href="#">findfriends</a>
			    <a href="logout.php">logout</a>
			    <a href=<?php echo $username;?>>Profile</a>
			    <a href="account_setting.php">Account Setting</a>
			</div>
		</div>
	</div>