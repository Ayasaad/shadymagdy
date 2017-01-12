<?php
require_once('config.php');



$ccidd = $_POST['HiddenCaseIDFcomm'];

if(!empty($_POST['commerstate'])) {  	$commerstate = $_POST['commerstate'];  } else {$commerstate = 'null';}

$sql ="INSERT INTO commercial (CaseID,cmrState, cdate ) values (". $ccidd .",". $commerstate ." ,'".date("Y/m/d")."')";
mysql_query($sql);
echo $sql;
?>