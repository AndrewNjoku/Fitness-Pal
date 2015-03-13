<?php



$submit = &$_POST['submit'];


//form data
$fullname = strip_tags(@$_POST['fullname']);
$username = strip_tags(@$_POST['username']);
$password = (strip_tags(@$_POST['password']));
$repeatpassword = (strip_tags(@$_POST['repeatpassword']));
$date = date("Y-m-d");


if ($submit)

{

//check for existance
if ($fullname&&$username&&$password&&$repeatpassword)

{

    if ($password==$repeatpassword)
	{
	
	//chech char of user
	if (strlen($username)>25||strlen($fullname)>25)
	{
		echo "Length of username or fullname is too long!";
	}
	else
	{
	
	//check password length
	if (strlen($password)>25||strlen($password)<6)
	{
	
	echo "Password must be between 6 and 25 charcters";
	
	}
	else
	{	
	
	//register the user!

	//encrypt password
	$password = md5($password);
	$repeatpassword = md5($repeatpassword);

	//open database
	$connect = mysql_connect("localhost","root","");
	mysql_select_db("phplogin");//select database
	
	//generate random number for activation process
	


$queryreg = mysql_query("

INSERT INTO users VALUES('','$fullname','$username','$password', '$date')


");

 
die ("You have been registered! Return to main menu <a href='index.html'>Return</a> to login.");

	}
		
	}
	
	}
	else
		echo "Your password do not much";

}

else
	echo "Please fill in <b>all<b/> fields!";
}


?>

<html>
    
      <head>
    
        <link rel="stylesheet" type="text/css" href="index.css"/>
    </head>

        <form action='register.php' method='POST'>
      
      <p class="fullname">
          <input name="fullname" type="text"  class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="fullname" id="username" />
      </p>
        
               <input name="username" type="text"  class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="username" id="username" />
      </p>
    
                  <input name="password" type="password"  class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="Choose a password" id="username" />
      </p>

              <input name="repeatpassword" type="password"  class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="repeat password" id="username" />
      </p>


      
<div class="submit">
        <input type="submit" name='submit' value="Register" id="button-blue"/>
        <div class="ease"></div>


</form>
</html>