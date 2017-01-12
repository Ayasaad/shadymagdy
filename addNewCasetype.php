<?php

include('config.php');

$typeName = $_POST["typeName"];



  $query= mysql_query("insert into casetypedetails (CaseTypeDetailsName) 
  			  values ('".$typeName ."')");

echo "تم الاضافة بنجاح";



?>