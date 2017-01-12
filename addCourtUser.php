<?php 
require_once('config.php');

$UID = $_POST['USID'];
$courtID = $_POST['courtID'];
$sq="insert into usercourt (CourtID,UserID) values (".$courtID.",".$UID.")";
 $query= mysql_query($sq);
echo $sq;



 ?>