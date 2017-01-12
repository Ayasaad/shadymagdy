<?php
require_once('config.php');

$CID = $_POST['CaseID'];
$query= mysql_query("SELECT
    `commercial`.CaseID,`commercial`.ID, commercial.cmrState, commercial.cdate
    , `commercialstates`.`state`
FROM
    `lawyerdb1`.`commercialstates`
    INNER JOIN `lawyerdb1`.`commercial` 
        ON (`commercialstates`.`id` = `commercial`.`cmrState`)  where commercial.CaseID = ". $CID);
 
$dtable="";
 while($row = mysql_fetch_array($query))
	 { 
$dtable.= "<tr>
											<td>" .$row['ID'] . "</td>
											<td>" .$row['state'] . "</td>
											<td>" .$row['cdate'] . "</td>
											 
										</tr>";


	 }
	  echo $dtable;

?>