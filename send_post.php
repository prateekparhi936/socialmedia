<?php session_start(); ?>
<?php include("./inc/conntosql.php"); ?>
<?php
if(isset($_POST["mypost"]) && strlen($_POST["mypost"])>0) 
{	
	  $added_by=$_SESSION['username'];
	  $date_added=date("Y-m-d");
	  $contentToSave = filter_var($_POST["mypost"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	  $user_posted_to=@$_POST["myfriend"];
	  if($user_posted_to=='shareto'){
	  	 $user_posted_to=$added_by;
	  }
      $postquery=mysql_query("INSERT INTO posts(id,body,date_added,added_by,user_posted_to) VALUES('','$contentToSave','$date_added','$added_by','$user_posted_to')");
      echo "<div id='and'><b>".$added_by."</b>- ".$contentToSave."<br></div>";
	/*if(mysql_query($postquery))
	{
		    $getpostquery=mysql_query("SELECT * FROM posts WHERE user_posted_to='$selectfriend' ORDER BY id DESC");
			while($row = mysql_fetch_array($getpostquery))
			{
				  //echo $row["added_by"];
				//  echo $row["body"];
	        }
	} 
	/*$getpostquery=mysql_query("SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC");
			while($row = mysql_fetch_array($getpostquery))
			{
			  //echo $row["added_by"];
			  echo $row["body"]."<br>";
	        }
	        */
}
/*if(isset($_POST["post"]) && !empty($_POST["post"]))
{
 
  $post=$_POST["post"];
  if($post!="")
  {
	  $user_posted_to="prateek";
	  $added_by="prateek";
	  $date_added=date("Y-m-d");
	  $postquery=mysql_query("INSERT INTO posts VALUES('','$post','$date_added','$added_by','$user_posted_to')") or die(mysql_error());
  }
  else{
  	echo "please write something in your post befor sending!!"
  }
}*/
/*$posts=$_POST['postarea'];
$username=$_SESSION["username"];
 if($post!="")
  {
	  $user_posted_to="prateek";
	  $added_by="prateek";
	  $date_added=date("Y-m-d");
	  $postquery=mysql_query("INSERT INTO posts(id,body,date_added,added_by,user_posted_to) VALUES('','$posts','$date_added','$added_by','$user_posted_to')");
	  $getpostquery=mysql_query("SELECT * FROM posts WHERE user_posted_to='$username' ORDER BY id DESC LIMIT 10");
	  //echo $post;
	  while($row=mysql_fetch_array($getpostquery)) {
	  	//echo $row['date_added']."<br>";
	  		echo $row["body"];
	  	 	echo "</b>".$added_by."</b> ".$body."<br>";
	  }
	//   echo $post;
  }
  else{
  	echo "please write something in your post befor sending!!";
  }
  */
?>