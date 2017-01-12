<?php
include('config.php');

$stateName = $_POST["stateName"];



  $query= mysql_query("insert into casestates (StateName) 
  			  values ('".$stateName ."')");

echo "تم الاضافة بنجاح";
?>