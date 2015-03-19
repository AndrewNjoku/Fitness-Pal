<?php
mysql_connect("localhost","root","");  //amend this part
mysql_select_db("Fitnesspal") or die("no database is selected");
if(isset($_POST['type']))
{
	if($_POST['type'] == "login")
	{
		$username = $_POST['UserName'];
		$password = $_POST['password'];
		$query = "SELECT* FROM register WHERE UserName = '$username' and password ='$password'";
		$result = mysql_query($query);
		
		while($row = mysql_fetch_assoc($result))
		{
			$output[] = $row;
		}
		echo json_encode($output);
		
	}
}
else
{
	echo "invalidddd";
}
?>
