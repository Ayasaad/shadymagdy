<?php
require_once('config.php');
$evt = $_POST['fnc'];

if($evt='getevnt'){
$CID = $_POST['CaseID'];

 


$query= mysql_query("select * from vwcases where ID =". $CID);


 //,$row['AutoNumber'],$row['Code'],$row['mon'],$row['monchar'],$row['LaterDate'],$row['TheDate']
while($row = mysql_fetch_array($query))
{	
$output[] = array ($row['ID'],$row['subject'],$row['sName'],$row['sName2'],$row['PaperType'],$row['CaseTypeName'],$row['StateName'],$row['AutoNumber'],$row['Code'],$row['mon'],$row['LaterDate'],$row['TheDate']);
}
if (!empty($output)){
	echo json_encode($output);
	}
}


?>