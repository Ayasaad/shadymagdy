<?php

include('config.php');

$EventState = $_POST["EventState"];



  $query= mysql_query("insert into eventstats (evStateName) 
  			  values ('".$EventState ."')");

echo "تم الاضافة بنجاح";



?>