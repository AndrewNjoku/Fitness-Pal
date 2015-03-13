<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password)

{

$connect = mysql_connect("localhost","root","") or die ("couldn't connect!");
mysql_select_db("phplogin") or die("couldn't find db");

$query =mysql_query("SELECT * FROM users WHERE username='$username'");

$numrows = mysql_num_rows($query);

if ($numrows!=0)

{
while ($row =mysql_fetch_assoc($query))

{

	$dbusername = $row['username'];
	$dbpassword = $row['password'];
	

	

}

//check to if they match
if ($username==$dbusername&&md5($password)==$dbpassword)
{

	echo "You're in! <a href='member.php'>Click</a> here to enter the member page.";
	$_SESSION['username']=$dbusername;
}
	else
		echo "incorrect password!";


}

	else
		die("that user doesnt exist!");



}
	else 
		die("please enter a username and a password");

?>