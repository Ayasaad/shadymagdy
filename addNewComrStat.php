<?php

include('config.php');

$stateName = $_POST["stateName"];



  $query= mysql_query("insert into commercialstates (state) 
  			  values ('".$stateName ."')");

echo "تم الاضافة بنجاح";



?>