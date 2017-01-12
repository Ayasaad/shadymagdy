<?php
require_once('config.php');

//scanperson

$CaseID = $_POST['CaseID'];
$artyp =  $_POST['artyp'];

if($artyp==1){
	$query= mysql_query("DELETE from scan where ID  = ". $CaseID);
}else  
{
	$query= mysql_query("DELETE  FROM scanperson WHERE  ID = ". $CaseID);
} 

 

?>