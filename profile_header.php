<?php
$username="";
  session_start();
  if(!isset($_SESSION['username']) or empty($_SESSION['username']))
  {
    header("location: index.php");
  }
  $username=$_SESSION['username'];       //current logged in wala user(MASTER)
 $servername='localhost';
 $usernameadmin='root';
 $password='12345';
 $db='socialmedia';
$conn=mysql_connect("$servername","$usernameadmin","$password") or die(mysql_error());
mysql_select_db($db) or die(mysql_error());
?>
<html>
<head>
<title>friendzone</title>
<link rel="stylesheet" type="text/css" href="./css/style.css"/>
 <script src="js/jquery-1.12.1.min.js"></script>
 <script type="text/javascript">
 function sendpost(){
	/*$(document).ready(function() {
	 
		//##### Add record when Add Record Button is click #########
		/*$("#FormSubmit").click(function (e) {
				//e.preventDefault();
				*/
				if($("#contentText").val()==='')
				{
					alert("Please enter some text!");
					return false;
				}
			/* 	var myData = 'content_txt='+ $("#contentText").val(); //build a post data structure
				jQuery.ajax({
				type: "POST", // Post / Get method
				url: "send_post.php", //Where form data is sent on submission
				data:myData, //Form variables
				success:function(response){
					$(".profilePosts").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
				});*/
				else{
					var myData=$("#contentText").val();
					var selectFriend=$("#post_to").val();
					$.post('send_post.php',{mypost:myData,myfriend:selectFriend},function(response){
                     $("#and").html(response).show();
					});
				}

		//});*/
	 
	//});*/
}
</script>
 <!--<script src="./js/main.js" type="text/javascript"></script>-->
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
					  <?php 
						/*	$sql=mysql_query("SELECT * FROM friendrequests WHERE user_to='$username'");
							while($rowget=mysql_fetch_assoc($sql)) {
									$user_from=$rowget["user_from"];
									?>
									<a href="http://localhost/$user_from"><?php echo $user_from;?></a>
							<?php
						}*/
					  ?>
				<a href="friends.php"><img src="./img/friendrequest.png" width="35px" height="35px"/></a>	
				<a href="#">findfriends</a>
			    <a href="logout.php">logout</a>
			    <a href=<?php echo $username;?>><?php echo $username;?></a>
			    <a href="account_setting.php">Account Setting</a>
			</div>
		</div>
	</div>
	<div id="wrapper">