<?php
include('config.php');

$CourtName = $_POST["CourtName"];



  $query= mysql_query("insert into courts (CourtName) 
  			  values ('".$CourtName ."')");

echo "تم الاضافة بنجاح";
?>