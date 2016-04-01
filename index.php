<?php include("./inc/header.php"); ?>
<?php include("./inc/conntosql.php"); ?>
<?php 
//Initializing Registratino-form varibale initialization...
	 $register=@$_POST["Register"];
	 $Login=@$_POST["Login"];
	// $_SESSION["username"]="";
	 $user_login="";
	 $password_login="";
	 $fullname="";
	 $email="";
	 $username=""; 
	 $password="";
	 $gender="";
	 $check_email="";
	 $check_email_rows="";
	 $check_username="";
	 $check_username_rows="";
//Registration-form validation...
	 //check if form is registered
     if($register)
     {
	     $fullname=strip_tags(@$_POST["FullName"]);
		 $email=strip_tags(@$_POST["Email"]);
		 $username=strip_tags(@$_POST["UserName"]);
		 $password=strip_tags(@$_POST["Password"]);
		 $gender=strip_tags(@$_POST["Gender"]);
		 $d=date("Y-m-d");
       //check if email already exists 
     if ($email) 
       {
             $check_email=mysql_query("SELECT email FROM users WHERE email='$email'");
             $check_email_rows=mysql_num_rows($check_email);
             if($check_email_rows==0)
            {
       	        if($username)
       	        {
                    $check_username=mysql_query("SELECT username FROM users WHERE username='$username'");
            	    $check_username_rows=mysql_num_rows($check_email);
            	    if($check_username_rows==0)
            	    {
       	           	   if ($fullname && $email && $username && $password && $gender) 
       	           	   {
       	           	   
       	           	       if (strlen($fullname)<30 || strlen($username)<30) 
       	           	       {
       	           	    	   if (strlen($password)<30 || strlen($password)>5) 
       	           	    	   {
       	           	    			$password=md5($password);
       	           	    	        $movetotable=mysql_query("INSERT INTO users(id,fullname,username,email,gender,password,signup_date,activated)VALUES('','$fullname','$username','$email','$gender','$password','$d','0')") or die(mysql_error());
       	           	    	        if($movetotable)
       	           	    	        {
       	           	    	        	echo "user registered";
       	           	    	        }
       	           	    	   }
       	           	    	   else
       	           	    	   {  
        	           	    	   	echo "length of password is not between 5-30 ..5-weak...10-moderate...15>strong";
       	           	    	   }
       	           	      }
       	           	       else
       	           	       {  
        	           	       	     echo "length of username or fullname exceeds the limit!!...should be less than 30";
       	           	       }
       	           	   }
       	           	   else
       	           	   {
        	           	        echo "all fields are not filled!!";
       	           	   }
       	           	}
       	           	else
       	           	{
       	            		echo "username already exists!!";
       	           	}
       	        }
       	        else
       	        { 
       	            echo "username not valid!!";           
       	        }
       	    }
       	    else
       	    {
       	    	echo "email already exists!!";
       	    }
       }
       else 
       { 
       	echo "email not valid!!";   
       }
    }

   //USER LOGIN---
    if($Login)
    {
    	$user_login=@$_POST["user_login"];
    	$password_login=@$_POST["password_login"];
    	echo $user_login;
    	echo $password_login;
	    if(isset($user_login) && isset($password_login))
	    {
	    	//$user_login=@$_POST["user_login"]
	    	//$password_login=@$_POST["password_login"]
	    	//$user_login=preg_replace('#[^a-zA-Z0-9]#i', '',$_POST["user_login"]);
	    	//$password_login=preg_replace('#[^a-zA-Z0-9]#i', '',$_POST["user_login"]);
	    	$password_login_md5=md5($password_login);
	    	$sql=mysql_query("SELECT id,username from users WHERE (username='$user_login' OR email='$user_login') AND password='$password_login_md5' limit 1");
	    	$usercount=mysql_num_rows($sql);
	    	if($usercount==1)
	    	{
	           while ($row=mysql_fetch_array($sql)) 
	           {
	            	$id=$row['id'];
	            	$user_login=$row['username'];
	           }
	           $_SESSION['username']=$user_login;
	           header("location:home.php");
	    	}
	    	else{
	    		echo "information is incorrect";
	    		exit();
	    	}
	    }
    }
?>
	<div class="main">
	   <div class="tableindex">
		<table id="tableindexwrapper">
			<tr>
			  <td><h2>Facebook helps you connect and share with the people </h2></td>
			  <td><h2>Sign Up!!</h2></td>
			</tr>
			<tr>
			  <td><h2>in your life </h2></td>
			  <td><h2>It's free and anyone can join</h2></td>
			</tr>
			<tr>
			 <td valign="top"><img src="./img/facebook-map.png" width="630" height="250"/></td>
			 <td valign="top" margin-left="20px" padding-left="10px">
				 <form action="#" method="POST">
				     <input type="text" name="FullName" placeholder="Fullname"></input><br/><br/>
				     <input type="text" name="UserName" placeholder="Username"></input><br/><br/>
				     <input type="text" name="Email" placeholder="Your Email"></input><br/><br/> 
				     <input type="text" name="Password" placeholder="New password"></input><br/><br/>
				     <select name="Gender">
							        <option value="defaultopt" selected>Select Sex</option>
							     	<option value="female">Female</option>
							     	<option value="male">Male</option>
				                </select><br/><br/>
	                 <input type="submit" name="Register" value="Signup!" class="submitbutton"></input>
				 </form>
			</td>
			</tr>
		</table>
	  </div>  
	</div>
<?php include("./inc/footer.html"); ?>