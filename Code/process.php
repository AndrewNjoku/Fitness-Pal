

<?php



session_start();




if($type == 'new') {
	
	$connect = mysqli_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
    mysqli_select_db("ma301an_FitnessPal1") or die("couldn't find db");
	
 &nbsp $startdate = $_POST['startdate'].'+'.$_POST['zone'];
 &nbsp $title = $_POST['title'];
 &nbsp $insert = mysqli_query($con,"INSERT INTO calendar(`title`, `startdate`, `enddate`, `allDay`) VALUES('$title','$startdate','$startdate','false')");
 &nbsp $lastid = mysqli_insert_id($con);
 &nbsp echo json_encode(array('status'=>'success','eventid'=>$lastid));
}

if($type == 'changetitle') {
	
	$connect = mysqli_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
    mysqli_select_db("ma301an_FitnessPal1") or die("couldn't find db");
	
	
   $eventid = $_POST['eventid'];
   $title = $_POST['title'];
   $update = mysqli_query($con,"UPDATE calendar SET title='$title' where id='$eventid'");
   if($update)
     echo json_encode(array('status'=>'success'));
   else
     echo json_encode(array('status'=>'failed'));
}

if($type == 'resetdate') {
	
	
	$connect = mysqli_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
    mysqli_select_db("ma301an_FitnessPal1") or die("couldn't find db");


   $title = $_POST['title'];
   $startdate = $_POST['start'];
   $enddate = $_POST['end'];
   $eventid = $_POST['eventid'];
   $update = mysqli_query($con,"UPDATE calendar SET title='$title', startdate = '$startdate', enddate = '$enddate' where id='$eventid'");
   if($update)
     echo json_encode(array('status'=>'success'));
   else
     echo json_encode(array('status'=>'failed'));
}

if($type == 'remove') {
	
	$connect = mysqli_connect("igor.gold.ac.uk","ma301an","Koolck94") or die ("couldn't connect!");
    mysqli_select_db("ma301an_FitnessPal1") or die("couldn't find db");
	
   $eventid = $_POST['eventid'];
   $delete = mysqli_query($con,"DELETE FROM calendar where id='$eventid'");
   if($delete)
     echo json_encode(array('status'=>'success'));
   else
     echo json_encode(array('status'=>'failed'));
}


?>