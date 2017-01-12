<?php
require_once('config.php');



function selectonce($squr,$neededval){
	$query=mysql_query($squr)  ;
	$row = mysql_fetch_assoc($query);
	$returned=$row[$neededval];
	return $returned;
//echo $squr;

}


 

?>