<?php
require_once('config.php');

	$CID = $_POST['CaseID'];
	$detID = $_POST['detID'];




 
	$query= mysql_query("  update  casesdetails set nowin = NULL where casemasterid  = ". $CID);

 
	$query= mysql_query("  update  casesdetails set nowin = 1 where id  = ". $detID);
echo  $detID . "-".$CID

?>