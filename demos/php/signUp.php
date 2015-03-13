<?php
	mysql_connect("igor.gold.ac.uk","root","");
	mysql_select_db("FitnessPal") or die ("Could not connect");

	if(isset($_POST['submit']))	
	{
		$first_name = mysql_escape_string($_POST['firstname']);
		$last_name = mysql_escape_string($_POST['lastname']);
		$user_gender = mysql_escape_string($_POST['sex']);
		$user_email = mysql_escape_string($_POST['email']);
		$username = mysql_escape_string($_POST['username']);
		$user_password = mysql_escape_string($_POST['password']);
		$re_password = mysql_escape_string($_POST['rePassword']);
		$date = date("Y-m-d");

		if(!$first_name||!$last_name||!$user_gender||!$user_email||!$username||!$user_password )
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
			echo "Your password isnt match <br> Please try again<br>";
			echo "<a href=signUpTable.html>Back</a>";
			exit();
		}
		else 
			$user_password = md5($user_password);
			
		$sql=mysql_query("SELECT* FROM customer WHERE `email`='$user_email'");
		if(mysql_num_rows($sql)>0)
		{
			echo "is already in database";	
		}
		
		if($first_name&&$last_name&&$user_gender&&$user_email&&$username&&$user_password&&$re_password)
		{
			$query="INSERT INTO customer(fName,lName,gender,email,registeredDate)
				VALUES('$first_name','$last_name','$user_gender','$user_email','$date')";
			$query1="INSERT INTO login(userName,password)
				VALUES('$username','$user_password')";	
			
			if(mysql_query($query)&&mysql_query($query1))
			{
				echo "Registration is successful<br>";
				echo "$first_name $last_name is now a member";
			}
		}
	}
?>