<?php


require_once('config.php');

//scanperson

$permID = $_POST['permID'];
 

 
	$query= mysql_query("DELETE from usersinroles where ID  = ". $permID);
 


?>