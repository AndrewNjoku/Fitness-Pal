<?php
mysql_pconnect("igor.gold.ac.uk", "ma301an", "Koolck94") or die("Could not connect");
mysql_select_db("fullcalendar") or die("Could not select database");


$rs = mysql_query("SELECT * FROM evenement ORDER BY start ASC");
$arr = array();

while($obj = mysql_fetch_object($rs)) {
$arr[] = $obj;
}
echo json_encode($arr);
?>