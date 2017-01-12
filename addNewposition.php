<?php

include('config.php');

$positionName = $_POST["positionName"];



  $query= mysql_query("insert into positions (positionName) 
  			  values ('".$positionName ."')");

echo "تم الاضافة بنجاح";



?>