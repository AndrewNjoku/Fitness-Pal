<?php
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username&&$password)
	{
		mysql_connect("igor.gold.ac.uk","username","password"); //amend this line
		mysql_select_db("username_FitnessPal") or die ("Could not connect"); //amend this line

		$query =mysql_query("SELECT * FROM customer WHERE `userName`='$username'");
		$numrows = mysql_num_rows($query);
		if($numrows!=0)
		{
			while ($row =mysql_fetch_assoc($query))
			{
				$dbusername = $row['userName'];
				$dbpassword = $row['password'];
				$_SESSION['customerName'] = $username;
			}
			//check to if they match
			if($username==$dbusername && md5($password)==$dbpassword)
			{
				require("php/member.php");
			}
			else
				echo "incorrect password!";
				//include("index.html");
		}
		else 
			{
				die("that user doesnt exist! <br> <a href=index.html>Login</a>");
				
			}
	}else 
		{
			die("please enter a username and a password");
		}

?>
