<?php
	mysql_connect("igor.gold.ac.uk","ma301an","Koolck94");
	mysql_select_db("ma301an_myBlog") or die ("Could not connect");

	if(isset($_POST['submit']))	
	{
		$first_name = mysql_escape_string($_POST['firstname']);
		$user_email = mysql_escape_string($_POST['email']);
		$user_password = mysql_escape_string($_POST['password']);
		$re_password = mysql_escape_string($_POST['rePassword']);
		$date = date("Y-m-d");

		if(!$first_name||!$user_email||!$user_password )
		{
			echo "<b>Please fill in all fields</b></br>";
			echo "<a href=signUpTable.html>Back</a>";
			
		}
		else if(strlen($user_password)>25 || strlen($user_password)<6 )
		{
			echo "Password must be between 6 and 25 charcters";

		}
		else if(!($user_password==$re_password))
		{
			echo "Your password doesnt match <br> Please try again<br>";
			echo "<a href=signUpTable.html>Back</a>";
			exit();
		}
		else 
			$user_password = md5($user_password);
			
		$sql=mysql_query("SELECT* FROM Login WHERE `email`='$user_email'");
		if(mysql_num_rows($sql)>0)
		{
			echo "is already in database";	
		}
		
		if($first_name&&$user_email&&$user_password&&$re_password)
		{
			$query="INSERT INTO customer(fName,email,registeredDate)
				VALUES('$first_name','$user_email','$date')";
			$query1="INSERT INTO Login(email,password)
				VALUES('$username','$user_password')";	
			
			if(mysql_query($query)&&mysql_query($query1))
			{
				echo "Registration is successful<br>";
				echo "$first_name $last_name is now a member";
			}
		}
	}
?>