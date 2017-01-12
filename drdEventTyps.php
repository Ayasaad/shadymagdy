<?php
require_once('config.php');

$EvntTypes= mysql_query("select * from eventtypes");

$evttyps ='';
while ( $rowevt =mysql_fetch_array($EvntTypes)) {

 
$evttyps .= '<option value="Category 1">'.$rowevt["TypeName"].'</option>';
														 
}

echo $evttyps;

?>