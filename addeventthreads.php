<?php session_start(); 
require_once('dbop.php');


$CID = $_POST['CaseID'];
  $evnt = $_POST['evnt'];
  $evntstat = $_POST['evntstat'];
 $TheDate = $_POST['TheDate'];
$idthread = $_POST['idthread'];
$uidd=$_SESSION['USID'];


$IDEventType = selectonce("select IDEventType from caseevents where id =  ". $idthread  , "IDEventType");


$qsup="insert into caseevents (CaseID,DetailsEvent,EventState,TheDate,cdate,enduser,parent,IDEventType) 	     		 	values (".$CID .",'".$evnt."',".$evntstat.",'".$TheDate."','". date("Y/m/d") ."',". $uidd .",". $idthread .",". $IDEventType .")";
 $query= mysql_query($qsup);
 
  //$query= mysql_query($qsup);
  echo $qsup;
?>
