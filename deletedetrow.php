<?php


require_once('config.php');

//scanperson

$detID = $_POST['detID'];
 

 
	$query= mysql_query("DELETE from casesdetails where ID  = ". $detID);
 



?>