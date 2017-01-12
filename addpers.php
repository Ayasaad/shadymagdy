<?php
include('config.php');
$pname =$_POST["pname"];
$idnum=$_POST["idnum"];
$nat=$_POST["nat"];
$ptype=$_POST["ptype"];



$sq="insert into persons (sName,CardID,Natunality,PersType) values ('".$pname."','".$idnum."',".$nat.",".$ptype.")";
 $query= mysql_query($sq);

echo $sq;
?>