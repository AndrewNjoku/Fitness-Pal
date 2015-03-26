 <?php

// session_start();

// $email = $_POST['Email'];
// $password = $_POST['password'];

// if ($email&&$password)

// {

// $connect = mysql_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
// mysql_select_db("ma301an_FitnessPal1") or die("couldn't find db");

// $query =mysql_query("SELECT * FROM login WHERE Email='$email'");

// $numrows = mysql_num_rows($query);

// if ($numrows!=0)

// {
// while ($row =mysql_fetch_assoc($query))

// {

// 	$dbusername = $row['Email'];
// 	$dbpassword = $row['password'];
	

	

// }

// //check if they match
// if ($email==$dbusername&&md5($password)==$dbpassword)
// {

// 	echo "You're in! <a href='member.php'>Click</a> here to enter the member page.";
// 	$_SESSION['username']=$dbusername;
// }
// 	else
// 		echo "incorrect password!";


// }

// 	else
// 		die("that user doesnt exist!");



// }
// 	else 
// 		die("please enter a username and a password");

// ?>
// // XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
// TRY THIS AND SEE IF IT IS WORKING
<?php	
	session_start();
	$username = $_POST['Email'];
	$password = $_POST['Password'];
	if($username&&$password)
	{
		$db =mysql_connect("igor.gold.ac.uk","ma301an","Koolck94");
		$found = mysql_select_db("ma301an_FitnessPal1") or die("couldn't connect");

		$query =mysql_query("SELECT * FROM register WHERE `email`='$username'");
		$numrows = mysql_num_rows($query);
		if($numrows!=0)
		{
			while ($row =mysql_fetch_assoc($query))
			{
				$dbusername = $row['email'];
				$dbpassword = $row['password'];
				$_SESSION['customerName'] = $username;
			}
			//check to if they match
			if($username==$dbusername && md5($password)==$dbpassword)
			{
				//require("php/member.php");
				echo"you are logged in";
			}
			else
				echo "incorrect password!";
				//include("index.html");
		}
		else 
			{
				//die("that user doesnt exist! <br> <a href=index.html>Login</a>");
				
			}
	}else 
		{
			//die("please enter a username and a password");
		}

?>


