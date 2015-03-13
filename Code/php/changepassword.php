<?php

session_start();

$user = $_SESSION['username'];

if ($user)
	{
	//user is logged in

	if(isset($_POST['submit']))
	{
	//check fields
	$oldpassword = md5($_POST['oldpassword']);
	$newpassword = md5($_POST['newpassword']);
	$repeatnewpassword = md5($_POST['repeatnewpassword']);
	
	//check password against db
	$connect = mysql_connect("localhost", "root","");
	mysql_select_db("phplogin");
	
	
	$queryget = mysql_query("SELECT password FROM users WHERE username='$user'") or die ("Query didnt work");
	$row = mysql_fetch_assoc($queryget);
	
	$oldpassworddb = $row['password'];
	
		
	//check password
	if ($oldpassword==$oldpassworddb)
	{
	
	//check two new password
	if ($newpassword==$repeatnewpassword)
	{
	//success
	//chnage password in db
		
		$querychange = mysql_query("
		
		UPDATE users SET password='$newpassword' WHERE username='$user'
		");
		session_destroy();
		die("Your password has been chnaged. <a href='index.php'>Return</a> to the main page.");
	}
	else
		die("New passwords don't match!");
	
	}
	else 
		die("Old password doesnt match");
	
	}
		else
{

echo"

<form action='changepassword.php' method='POST'>
	Old password: <input type='text' name='oldpassword'><p>
	New password: <input type='password' name='newpassword'><br>
	Repeat new password: <input type='password' name='repeatnewpassword'><p>
	<input type='submit' name='submit' value='change password'>

</form>
";

}

}
else
	die("You must be logged in to change your password");


?>