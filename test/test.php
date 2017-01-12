<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>	</title>
</head>
<body>
<?php
require_once('../config.php');
include('../FunctionSelectSystem.php');
$query= mysql_query("select * from nationalities");

	  while($row = mysql_fetch_array($query))
	 {

				 $enduser = selectonce("select NatuName from nationalities2 where id = " .$row['ID'] ,"NatuName");
				  mysql_query("update nationalities set NatuName = '". $enduser . "' where id = " .$row['ID'] );

				  $arr .=  $enduser . '<br />';
	 }

// $row['ID'] 
	 echo $arr;
?>
</body>
</html>
