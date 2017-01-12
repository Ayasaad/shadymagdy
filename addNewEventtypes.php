<?php

include('config.php');

$typeName = $_POST["typeName"];



  $query= mysql_query("insert into eventtypes (TypeName) 
  			  values ('".$typeName ."')");

echo "تم الاضافة بنجاح";



?>