<?php
include('config.php');

$thename = $_POST["thename"];
 $theswitch ="";
 if (!empty($_POST['optionsRadios2'])){ 
 	 $theswitch = $_POST['optionsRadios2']; 

 }




  $query= mysql_query("insert into scaninfo (pName,Spisialist) 
  			  values ('".$thename ."',". $theswitch .")");

echo "تم الاضافة بنجاح";
?>