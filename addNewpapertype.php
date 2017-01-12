<?php

include('config.php');

$PaperType = $_POST["PaperType"];



  $query= mysql_query("insert into papertypes (PaperType) 
  			  values ('".$PaperType ."')");

echo "تم الاضافة بنجاح";



?>