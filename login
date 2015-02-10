***********************login html************************

<!DOCTYPE html>
<html>
<head>
	
	<!-- <link rel= "stylesheet" href="loginTableCss.css"/> -->
</head>
<body>
<!-- 	<div id="Intro">
		<img src="Heading.png"  width="110" height="30"  >
	</div>
	<div id="light">
		<img src="Lightning.png" width="110" height="200">
	</div> -->

	<div id="heading">
		<h3>FitnessPal login</h3>
	</div>
	<form action="logIn.php" method="POST">
		<div id="logname">
			Username <input type="text" name="uName"/><br>
		</div>
		<div id="pass">
			Password <input type="password" name="pass"/>
		</div>
		<br />
		<div id="go">
			<input type="Submit" value="Login" name="Submit"><br />
			<!-- <a href="signUpTable.html">Sign up?</a> -->
			<a href="signUpTable.html">SING UP?</a>

		</div>
	</form>
</body>
</html>



***************************login.php**********************************
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
