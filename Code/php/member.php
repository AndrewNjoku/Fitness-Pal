<?php

session_start();

error_reporting(E_ALL^E_NOTICE);

if($_SESSION['username'])

echo "Welcome, ".$_SESSION['username']."!<br><a href='logout.php'>Logout</a><br><a href='changepassword.php'>Change password</a>";

else

die ("You must be logged in!");



?>