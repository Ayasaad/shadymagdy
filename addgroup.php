<?php session_start();
require_once('dbop.php');
$txevnt1 = $_POST['txevnt1'];
$txevnt2 = $_POST['txevnt02'];
$txevnt3 = $_POST['txevnt3'];


echo insData("groupinfo","Code,GName,Discr,TheUser",  "'". $txevnt1."','".$txevnt2."','".$txevnt3."',".  $_SESSION['USID'] );


?>