/*******Esnure that this php file should be saved on igor************
/*******this php file workss with signUpTable.html
/*******make sure you import the right table. find create.sql file 

<?php
	mysql_connect("igor.gold.ac.uk","username","password");  //dont forget to amend this line
	mysql_select_db("databasename") or die ("Could not connect");  //dont forget to amend this line
	if(isset($_POST['submit']))	
	{
		$first_name = mysql_escape_string($_POST['firstname']);
		$last_name = mysql_escape_string($_POST['lastname']);
		$user_gender = mysql_escape_string($_POST['gender']);
		$user_email = mysql_escape_string($_POST['email']);
		$username = mysql_escape_string($_POST['username']);
		$user_password = mysql_escape_string($_POST['password']);
		$re_password = mysql_escape_string($_POST['rePassword']);
		$date = date("Y-m-d");

		if(!$first_name||!$last_name||!$user_gender||!$user_email||!$username||!$user_password )
		{
			echo "<b>Please fill in all fields</b></br>";
			echo "<a href ='signUpTable.html'>Back</a>";
			exit();
			
		}
		else if(strlen($user_password)>25 || strlen($user_password)<6 )
		{
			echo "Password must be between 6 and 25 charcters";
			echo "<a href=signUpTable.html>Back</a>";

		}
		else if(!($user_password==$re_password))
		{
			echo "Your password isnt match <br> Please try again<br>";
			echo "<a href=signUpTable.html>Back</a>";
	
		}
		else 
		{
			$user_password = md5($user_password);
			$sql=mysql_query("SELECT* FROM customer WHERE `email`='$user_email'");
			if(mysql_num_rows($sql)>0)
			{
				echo "Your email is already in database<br>";
				echo "<a href=signUpTable.html>Back</a>";	
			}
			
			else if($first_name&&$last_name&&$user_gender&&$user_email&&$username&&$user_password)
			{
				$query= mysql_query("INSERT INTO customer(fName,lName,gender,email,userName,password,registeredDate)
				 	VALUES('$first_name','$last_name','$user_gender','$user_email','$username','$user_password','$date')");
				if($query)
				{
					echo "Registration is successful<br>";
					echo "<a href=index.html>Login</a>";
				}
			}
		}
		
	}
?>




