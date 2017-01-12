<?php
require_once('config.php');
include('fldReports/courtsdrp.php');

 $evidd = $_POST['evidd'];
  $evt = $_POST['evt'];
 $evtdt = $_POST['evtdt'];
  $EventType = $_POST['EventType'];

  $query= mysql_query("update  caseevents set DetailsEvent='". $evt ."' , TheDate='". $evtdt ."' , IDEventType=". $EventType . "  where id  =  " .$evidd);
 
// $row = mysql_fetch_assoc($query);

 echo "sameh";

?>
