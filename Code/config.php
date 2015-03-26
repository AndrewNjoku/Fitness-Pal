<?php
$con = mysqli_connect('igor.gold.ac.uk','ma301an','Koolck94','Fitness_Pal1');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
?>

