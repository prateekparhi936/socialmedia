<?php
  session_start();
  /*if(!isset($_SESSION['user_login']))
  {
  }
  else
  {
    header("location: home.php");
  }
  */
?>
<html>
<head>
<title>friendzone</title>
<link rel="stylesheet" type="text/css" href="./css/style.css"/>
</head>
<body>
	<div class="header">
		<div id="wrapper">
			<div class="logo">
				<img src="./img/logo_facebook.jpg"/>
			</div>
			<!--<div class="search_box">
				<form method="GET" action="search.php" id="search">
	 				 <input name="q" type="text" size="60" placeholder="Search..." />
				</form>
			</div>
			-->
			<div class="tablelogin">
			<table width="400px">
				<tr>
					<td width="80px" ><h1 style="color:#FFFFFF;font-size: 12px;">E-mail or username</h1></td>
					<td><h1 style="color: #FFFFFF;font-size: 12px;">password</h1></td>
					<td></td>
				</tr>
				<tr>
				  <form method="POST" action="index.php" id="login">
		 				 <td><input name="user_login" type="text"  style="width: 150px; height: 20px;"/></td>
		 				 <td><input name="password_login" type="text"  style="width: 150px; height: 20px;"/></td>
		 				 <td><input type="submit" value="Login" name="Login"/></td>
		 		</form>
				</tr>
				<tr>
				    <td><h1 style="color: #FFFFFF;font-size: 10px;">keep me login</h1></td>
				    <td><h1 style="color: #FFFFFF;font-size: 10px;">Forgotten password?</h1></td>
				    <td></td>
				</tr>
			</table>
			</div>
		</div>
	</div>

<!--
header with navigation
<html>
<head>
<title>friendzone</title>
<link rel="stylesheet" type="text/css" href="./css/style.css"/>
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
				<a href="#">Home</a>
				<a href="#">About</a>
			    <a href="#">Sign Up</a>
			    <a href="#">Sign In</a>
			</div>
		</div>
	</div>
-->