<?php
require_once('config.php');
$gids = $_POST['gids'];




$query= mysql_query("select * from groups where GroupID =". $gids);

$ids="";
 //,$row['AutoNumber'],$row['Code'],$row['mon'],$row['monchar'],$row['LaterDate'],$row['TheDate']
while($row = mysql_fetch_array($query))
{	
	
	if ($ids=='') {$ids =  $row['CaseID'];}
	else{$ids .=  ',' . $row['CaseID'];}
	
}
echo $ids;
?>