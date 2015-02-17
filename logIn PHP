<?php	
	$db =mysql_connect("localhost","root","");
	$found = mysql_select_db("FitnessPal")or die("couldnt connect");
	
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
