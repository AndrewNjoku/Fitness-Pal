<?php

session_start();

$email = $_POST['Email'];
$password = $_POST['password'];

if ($email&&$password)

{

$connect = mysql_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
mysql_select_db("ma301an_FitnessPal1") or die("couldn't find db");

$query =mysql_query("SELECT * FROM login WHERE Email='$email'");

$numrows = mysql_num_rows($query);

if ($numrows!=0)

{
while ($row =mysql_fetch_assoc($query))

{

	$dbusername = $row['Email'];
	$dbpassword = $row['password'];
	

	

}

//check if they match
if ($email==$dbusername&&md5($password)==$dbpassword)
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
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
TRY THIS AND SEE IF IT IS WORKING
<?php	
	$db =mysql_connect("igor.gold.ac.uk","ma301an","Koolck94");
	$found = mysql_select_db("ma301an_FitnessPal1") or die("couldn't connect");
	
	if(isset($_POST['submit']))
	{
		$username=mysql_escape_string($_POST['uName']);
		$password=mysql_escape_string($_POST['pass']);
		if(!$username||!$password)
		{
			echo("You must fill all fields!<br>");
			echo "<a href=logIntable.html>Back</a>";
			exit();
		}
		$sql=mysql_query("SELECT* FROM login WHERE `userName`='$username'
			AND `password`='$password'");
		if(mysql_num_rows($sql)>0)
		{
			echo("You logged in");
			echo $query;
			exit();
		}
		else 
			echo "Incorrect username and password <br>";
			echo "<a href=logIntable.html>Back</a>";
	}
	else 
	{
		
	}
?>


