<?php

require_once('config.php');
   
$CID = $_POST['CaseID'];
 
$query= mysql_query("delete from caseevents where ID  = ". $CID);
 


?>