<?php 
 
require_once('config.php');


$ccidd = $_POST['ccidd2'];

if(!empty($_POST['detposf2'])) {  	$detposf = $_POST['detposf2'];  } else {$detposf = 'null';}
$detcnumber = $_POST['detcnumber2'];
if(!empty($_POST['detperspos2'])) {  	$detperspos = $_POST['detperspos2'];  } else   {$detperspos = 'null' ;}
if(!empty($_POST['detperspos22'])) {  	$detperspos2 = $_POST['detperspos22'];  } else {$detperspos2 = 'null';}
$detcercil = $_POST['detcercil2'];
$detflor = $_POST['detflor2'];
$dethall = $_POST['dethall2'];
if(!empty($_POST['detcourt2'])) {  	$detcourt = $_POST['detcourt2'];  } else {$detcourt = 'null';}

$detsecrt = $_POST['detsecrt2'];
$detgu = $_POST['detgu2'];

mysql_query("UPDATE casesdetails set nowin = 0 where CaseMasterID= ".$ccidd );
$sql ="INSERT INTO casesdetails (CaseMasterID,POSITION, CaseNumber, Circle  , CustPos, EnemytPos, FLOOR, Hall  ,Secretary ,Court, Gedge ,nowin ) values (". $ccidd .",". $detposf ." ,'". $detcnumber ."','". $detcercil . "',". $detperspos2 . " ,". $detperspos ." , '". $detflor ."','". $dethall ."','". $detsecrt ."',". $detcourt ." , '". $detgu ."',1 )";
mysql_query($sql);


 

echo $sql;

?>