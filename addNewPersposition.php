<?php

include('config.php');

$PositionName = $_POST["PositionName"];



  $query= mysql_query("insert into customerposition (PositionName) 
  			  values ('".$PositionName ."')");

echo "تم الاضافة بنجاح";



?>