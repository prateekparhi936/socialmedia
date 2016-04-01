<?php 
 $servername='localhost';
 $usernameadmin='root';
 $password='12345';
 $db='socialmedia';
$conn=mysql_connect("$servername","$usernameadmin","$password") or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
?>