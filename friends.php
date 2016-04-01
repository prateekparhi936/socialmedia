<?php include("./inc/home_header.php"); ?>
<?php include("./inc/conntosql.php"); ?>

<div class="container">
  <h2>Friend requests</h2>
  <hr></hr>       
  <table class="table table-hover">
    <tbody>
    <?php 
		$sql1=mysql_query("SELECT * FROM friendrequests WHERE user_to='$username'");
		if(mysql_num_rows($sql1)==0)
		{
			?>
			<tr>
	        <td>No Friend Requests</td>
	        <td></td>
	        <td></td>
	        <td></td>
	     </tr>
		 <?php
	    }
		else
		{
					while($rowget=mysql_fetch_assoc($sql1)) 
					{
						$status=$rowget['status'];
						echo "status: ".$status;
						if($status==0)
						{
						    $user_from=$rowget["user_from"];
						    //display all new requests
						?>				  
						     <tr>
						        <td><a href="http://localhost/<?php echo $user_from;?>"><?php echo $user_from;?></a></td>
						        <td><form action="" method="POST"><input type="hidden" name="requestsenderconfirm" value="<?php echo $user_from ;?>"></input></td>
						        <td><input type="submit" name="confirmrequest" value="Confirm Request"></input></form></td>
						        <td><form action="" method="POST"><input type="hidden" name="requestsenderdelete" value="<?php echo $user_from ;?>"></input></td>
						        <td><input type="submit" name="deleterequest" value="Delete Request"></input></form></td>
						     </tr>
				      <?php
				  		}
			       }
			       $sql2=mysql_query("SELECT user_to FROM friendrequests WHERE user_from='$username' and status=1");
			       while($rows=mysql_fetch_assoc($sql2))
			       { //request confirmation
			       	if(mysql_num_rows($rows)>0)
			       	{
				       	?>
				       		<tr>
					       		<td><?php echo $rows['user_to']; ?> has accepted your request</td>
					       		<td></td>
					       		<td></td>
					       		<td></td>
				       		</tr>
				        <?php
			        }
			       }
			       if(@$_POST["confirmrequest"])
			       {
			       		$confirmsender=@$_POST["requestsenderconfirm"];   //confirm request action and add as friends
			       		 $update_friendrequest_status=mysql_query("UPDATE friendrequests SET status=1 WHERE user_from='$confirmsender' and user_to='$username'");
			       		$sqlq=mysql_query("SELECT friends FROM users WHERE username='$username'");
			       		while($row=mysql_fetch_assoc($sqlq))
			       		{
			       					$addfriendquery1=mysql_query("UPDATE users SET friends=CONCAT(friends,'$confirmsender,') WHERE username='$username'");	
			       					$addfriendquery2=mysql_query("UPDATE users SET friends=CONCAT(friends,'$username,') WHERE username='$confirmsender'");
			       		}
			       		header("Location: friends.php");
			       }
	    }
      ?>
    </tbody>
  </table>
</div>
<?php include("./inc/footer.html"); ?>