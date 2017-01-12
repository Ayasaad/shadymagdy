<?php

require_once('config.php');
include('fldReports/courtsdrp.php');

$ccidd = $_POST['ccidd'];


if(!empty($_POST['detposf'])) {  	$detposf = $_POST['detposf'];  } else {$detposf = 'null';}
$detcnumber = $_POST['detcnumber'];
if(!empty($_POST['detperspos'])) {  	$detperspos = $_POST['detperspos'];  } else   {$detperspos = 'null' ;}
if(!empty($_POST['detperspos2'])) {  	$detperspos2 = $_POST['detperspos2'];  } else {$detperspos2 = 'null';}
$detcercil = $_POST['detcercil'];
$detflor = $_POST['detflor'];
$dethall = $_POST['dethall'];
if(!empty($_POST['detcourt'])) {  	$detcourt = $_POST['detcourt'];  } else {$detcourt = 'null';}

$detsecrt = $_POST['detsecrt'];
$detgu = $_POST['detgu'];

$ssqll="update  casesdetails set POSITION= ". $detposf ." , CaseNumber='". $detcnumber ."' , Circle='". $detcercil . "' , CustPos=". $detperspos2 . " , EnemytPos=". $detperspos ." ,FLOOR= '". $detflor ."',Hall='". $dethall ."',Secretary='". $detsecrt ."',Court=". $detcourt ." ,Gedge= '". $detgu ."'      where ID  =  " .$ccidd;

$query= mysql_query($ssqll);

echo 	  $ssqll ;

?>


