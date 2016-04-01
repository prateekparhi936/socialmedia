<?php include("./inc/profile_header.php"); ?>
<?php include("./inc/conntosql.php"); ?>
<?php
$user_to_name="";             //jis user Ko hum search kar rhe hai(SLAVE)            
$fullname="";
if(isset($_GET['u']))
	{
		$user_to_name=mysql_real_escape_string($_GET['u']);               

		if(ctype_alnum($user_to_name))
		{
           $check=mysql_query("SELECT username,fullname FROM users WHERE username='$user_to_name'");
           if(mysql_num_rows($check)==1)
           {
           	 $get=mysql_fetch_assoc($check);
           	 $user_to_name=$get['username'];
           	 $fullname=$get['fullname'];
           }
           else
		   {
		      echo "<meta http-equiv=\"refresh\"content=\"0;url=http://localhost/index.php\">";
		      exit();
		   }
		}
	}
?>
<div class="postForm">
<form>
       <textarea name="content_txt" id="contentText" cols="70" rows="4" style="height: auto;"></textarea>
       <select name="post_to" id="post_to">
       <option value="shareto">you</option>
       <?php
	       $selectuser=mysql_query("SELECT friends from users WHERE username='$username'");
	       $selectfriend=explode(',',$selectfriend);
	       while($rowpostfriend=mysql_fetch_assoc($selectuser)){
       			  $selectfriend=explode(',',$rowpostfriend['friends']);
       			   foreach($selectfriend as $item){
       ?>
     	<option value="<?php echo $item;?>"><?php echo $item;?></option>
     	<?php
        }
    }
     	?>
     	</select>
       <input type="submit" name="submitform" id="FormSubmit" value="postit" Onclick="sendpost()" style="float: right; color: #3b5998;"/>
  </form>
</div>
<div class="profilePosts">
	<?php
	//include db configuration file
	//MySQL query
	  $getpostquery=mysql_query("SELECT * FROM posts WHERE user_posted_to='$user_to_name' ORDER BY id DESC");
	//get all records from add_delete_record table
	while($row = mysql_fetch_array($getpostquery))
	{
	     echo "<div id='and'><b>".$row['added_by']."</b>- ".$row['body']."<a href='#'' style='text-decoration-color: none; text-decoration-line: none;'>Reply</a><br></div>";   //reply code pending...
   }
	?>
</div>

<?php
//------------ set default pic of user----------
$getquery=mysql_query("SELECT * from users WHERE username='$user_to_name'");
if($rowq=mysql_fetch_array($getquery))
{
				if($rowq['gender']=='male' && $rowq['profilepic']=" " && empty($rowq['profilepic']))
				{
			?>
					<img src="img/defaultpicm.jpg" alt="<?php echo $user_to_name;?>'s profile" title="<?php echo $user_to_name?>'s profile" width="180px" height="180px"/>
			<?php
			    }
			else if($rowq['gender']=='female' && $rowq['profilepic']=" " && empty($rowq['profilepic']))
			{
				?>
				<img src="img/defaultpicf.jpg" alt="<?php echo $user_to_name;?>'s profile" title="<?php echo $user_to_name?>'s profile" width="180px" height="180px "/>
			<?php
			}
			else{
					$imagequery=mysql_query("SELECT profilepic from users WHERE username='$user_to_name'");
					if($rowimage=mysql_fetch_assoc($imagequery))
					{
						$image=$rowimage['profilepic'];
						?>
						<img src="userdata/profilepics/<?php echo $image;?>" alt="<?php echo $user_to_name;?>'s profile" title="<?php echo $user_to_name?>'s profile" width="180px" height="180px "/>	
					<?php
					}
			}
}
?>
</br>
<?php
$request="";
$request=@$_POST['addfriend'];
 if(isset($request) && $request!=""){
 	$friendrequestquery=mysql_query("INSERT INTO friendrequests(id_friend,user_from,user_to)VALUES('','$username','$user_to_name')");
 	header("Location: http://localhost/$username");
 }
?>
<div class="friendrequest">
	<form action="" method="POST">
		<input type="submit" name="addfriend" value="AddFriend"></input>
	</form>
</div>
<div class="textHeader"><?php echo $user_to_name;?>'s Profile</div>
<div class="profileLeftSideContent">some content about this profile</div>
<div class="textHeader"><?php echo $user_to_name;?>'s Friends</div>s
<div class="profileLeftSideContent">
<?php
 $userfriends=mysql_query("SELECT friends FROM users WHERE username='$username'");
 while($rowfriends=mysql_fetch_array($userfriends)){
 	$friend_array=explode(',' , $rowfriends['friends']);
 	foreach($friend_array as $item) {
 		$sqlfr=mysql_query("SELECT * FROM users WHERE username='$item'") or die("error in query");
 		if($rowsqlfr=mysql_fetch_array($sqlfr))
 		{
 			if($rowsqlfr['profilepic']!=" "){
?>
	<a href="http://localhost/<?php echo $rowsqlfr['username'];?>"><img src="userdata/profilepics/<?php echo $rowsqlfr['profilepic'];?>" height="50px" width="40px"/></a>&nbsp;
<?php
}
else
{
	if($rowsqlfr['gender']=='female'){
	?>
	<a href="http://localhost/<?php echo $rowsqlfr['username'];?>"><img src="img/defaultpicf.jpg" width="50px" height="40px "/></a>&nbsp;
	<?php
   }
   else{
   	?>
   	<a href="http://localhost/<?php echo $rowsqlfr['username'];?>"><img src="img/defaultpicm.jpg" width="50px" height="40px "/></a>&nbsp;
   <?php
}
}
}
}
}
?>
<?php include("./inc/footer.html"); ?>