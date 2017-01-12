<?php
require_once('config.php');

$CID = $_POST['CaseID'];
$query= mysql_query("SELECT    caseevents.ID  , users.first_name   , caseevents.CaseID    , caseevents.DetailsEvent    , caseevents.TheDate    , caseevents.CDate    , caseevents.EventState, caseevents.parent    , eventstats.evStateName FROM      caseevents   
	LEFT JOIN  eventstats         ON (caseevents.EventState = eventstats.ID)  
	LEFT JOIN  users         ON (caseevents.enduser = users.ID)   where parent = ". $CID);

$dtable="";
while($row = mysql_fetch_array($query))
{ 
	$dtable.= "<tr title='" .$row['ID'] . "'  id='" .$row['ID'] . "'>

	<td>" . $row['DetailsEvent'] . "<br /><span style='font-size:9px;color:brown;'>   " . $row['CDate'] . "</span></td>
	<td>" . $row['TheDate']      . "</td>
	<td>" . $row['evStateName']  . "<br /><span style='font-size:9px;color:brown;'>   " . $row['first_name'] . "</span></td>
	<td> <a  class='btn icn-only purple mini prtevthread'> الاخطار <i class='m-icon-swapleft icon-print'></i></a></td>
</tr>";


}
echo $dtable;






?>