<?php include("./inc/home_header.php");?>
<?php include("./inc/conntosql.php");?>
<?php
		if(isset($username))
		{
					echo "<u><b>Upload profile picture</b></u>";
					echo "<hr></hr>";
					?>
					<form action="account_setting.php" method="POST" enctype="multipart/form-data">
						<table name="editprofilepic" id="editprofilepic">
							<tr>
								<td><input type="file" name="profilepic" id="profilepic"></input></td>
								<td><input type="submit" name="uploadprofilepic"></input></td>
							</tr>
						</table>
					</form>
					<?php
					if(@$_POST["uploadprofilepic"])
					{
								$image_srcname="";
								$ext_array="";
								$ext="";
								$image_srcname=$_FILES["profilepic"]["name"];
								$ext_array=array('gif','jpg','png','jpeg');
								$ext=strtolower(pathinfo($image_srcname,PATHINFO_EXTENSION));		//IMAGE EXTENSION
								if(isset($image_srcname) && $image_srcname!=" ")
								{
									if(in_array($ext, $ext_array))
									{
										$chars="abcdefghijklmnoprstuvwxyzABCDEFGHIJKLMNOPRSTUVWXYZ0123456789";
										$random_dir=substr(str_shuffle($chars),0,15);
										mkdir("userdata/profilepics/$random_dir");
										if(file_exists("userdata/profilepics/$random_dir/".$image_srcname))
										{
													?>
														<div class="alert alert-danger">
									  					<strong>!</strong><?php echo @$_FILES["profilepic"]["name"];?> Image alrady exixts
													    </div>
												<?php
										}
										else
										{
											if(move_uploaded_file(@$_FILES["profilepic"]["tmp_name"],"userdata/profilepics/$random_dir/".$image_srcname))
											{
												
														$image_srcname="$random_dir/".$image_srcname;
														$sqlpicload=mysql_query("UPDATE users SET profilepic='$image_srcname' WHERE username='".$_SESSION["username"]."'");
														header("Location: account_setting.php");
												
													/*if($sqlpicload)
													{
												?>
														<div class="alert alert-success">
									  					<strong>Successfully uploaded!</strong><?php echo "userdata/profilepics/$random_dir/".$image_srcname;?>
														</div>
														<?php
													}*/

											}
									    }
									}

								}
								else
								{
											?>
														<div class="alert alert-danger">
									  					<strong>!</strong>select a pic
													    </div>
										<?php
								}
					}
					?>
					<?php
						echo "<hr></hr>";
						 echo "<u><b>Edit your profile</b></u>";
						echo "<hr></hr>";
				    ?>
				     <form action="account_setting.php" method="POST">
						    <table name="editprofiletable" id="editprofiletable">
							    <tr>
							    	<td>Old Password</td>
							    	<td><input type="text" name="Password" id="oldpassword"></input></td>
							    </tr>
							    <tr>
							    	<td>New Password</td>
							    	<td><input type="text" name="newpassword" id="newpassword"></input></td>
							    </tr>
							    <tr>
							    	<td>Confirm Password</td>
							    	<td><input type="text" name="confirmpassword" id="confirmpassword"></input></td>
							    </tr>
							    <tr>
							    	<td>Fullname</td>
							    	<td><input type="text" name="fullname" id="fullname"></input></td>
							    </tr>
							    <tr>
							    	<td>Username</td>
							    	<td><input type="text" name="usernameprofile" id="usernameprofile"></input></td>
							    </tr>
							    <tr>
							    	<td>About yout</td>
							    	<td><textarea name="aboutyou" id="aboutyou" value="aboutyou"></textarea></td>
							    </tr>
						    </table>
					    <input type="submit" name="sendediteddata" value="submit" id="sendediteddata"></input>
				     </form>
				                    <?php
				  if(@$_POST["sendediteddata"]) 
				  	{
						    	$oldpassword="";
						    	$dbpassword="";
						    	$newpassword="";
						    	$confirmpassword="";
						    	$fullname="";
						    	$usernameprofile="";
						    	$aboutyou="";
						    	$oldpassword=@$_POST["Password"];
						    	$oldpassword_md5=md5($oldpassword);
						    	$oldpassword=strip_tags($oldpassword);
						    	$newpassword=@$_POST["newpassword"];
						    	$confirmpassword=@$_POST["confirmpassword"];
						    	$usernameprofile=@$_POST["usernameprofile"];
						    	$fullname=@$_POST["fullname"];
						    	$aboutyou=@$_POST["aboutyou"];
						    	$sql=mysql_query("SELECT * FROM users WHERE username='".$_SESSION['username']."'");
						    	if($row=mysql_fetch_array($sql))
						    	{
						    		$dbpassword=$row["password"];
						    		//echo "$dboldpassword:=".$dboldpassword;
						    	}
						    	if($oldpassword!="")
						    	{
									    	if($oldpassword_md5==$dbpassword)
									    	{
											    		if($newpassword!="")
											    		{
													    			if($confirmpassword!="")
													    			{
													    				if($confirmpassword==$newpassword && (strlen($confirmpassword)>5 && strlen($confirmpassword)<30))
													    				    {
													    					  $confirmpassword=md5($confirmpassword);
													    					   $updatesql=mysql_query("UPDATE users SET password='$confirmpassword' WHERE username='".$_SESSION['username']."'");
													  				  		}
													    				else{
													    					?>
															    				<div class="alert alert-danger">
															  					<strong>!</strong>Passwords do not match.
															  					<strong>or</strong>
															  					<strong>!</strong> Length of password is inappropriate.
																			    </div>
													    	                  <?php
													    				    }
													    			}
													    			else
													    			{
													    				?>
													    				<div class="alert alert-danger">
													  					<strong>!</strong>Confirm the password.
																	    </div>
													    	            <?php
													    			}
											    	    }
											    	else{
											    		?>
										 					     <div class="alert alert-danger">
											  					<strong>!</strong>provide new password.
															    </div>
											    	<?php
										      		    }
										    }	
										   else
										   {
												   	?>
												   					<div class="alert alert-danger">
												  					<strong>!</strong>incorrect password.
																    </div>
												   <?php
										   }
								}
							if(isset($usernameprofile) && $usernameprofile!="")
							{
						           $updatesqlusrname=mysql_query("UPDATE users SET username='$usernameprofile' WHERE username='".$_SESSION['username']."'");
							}
							if(isset($fullname) && $fullname!="")
							{
						           $updatesqlfullname=mysql_query("UPDATE users SET fullname='$fullname' WHERE username='".$_SESSION['username']."'");
							}
				  	}
		}
		else
		{
			echo "<hr>You must login first!</hr>";
		}
        include("./inc/footer.html"); 
?>