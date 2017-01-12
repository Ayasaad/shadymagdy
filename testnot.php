<?php  
require_once('dbop.php');

include('header.php');

$uuid=$_SESSION['USID'];




 //$array = array('lastname', 'email', 'phone');
// $comma_separated = implode(",", $array);

// echo $comma_separated; // lastname,email,phone
$parent[]='';
$queryoo2= mysql_query(" SELECT parent FROM caseevents WHERE id IN ( SELECT ID FROM caseevents WHERE eventstate IN (5,2) 
	AND parent NOT IN ( SELECT parent FROM caseevents WHERE parent IS NOT NULL AND eventstate =1 ))");

while($rowf = mysql_fetch_array($queryoo2))
{
	$parent[] = $rowf['parent'];
}
$comma_separated = ltrim(implode(",", $parent), ",");



$sq="SELECT
`casesmaster`.`ID`
, `caseevents`.`DetailsEvent`
, `caseevents`.`TheDate`
, `caseevents`.`CDate`
, `casesmaster`.`Code`
, `persons`.`sName`
, `casesmaster`.`subject`
FROM
`lawyerdb1`.`usercourt`
INNER JOIN `lawyerdb1`.`courts` 
ON (`usercourt`.`CourtID` = `courts`.`ID`)
INNER JOIN `lawyerdb1`.`users` 
ON (`usercourt`.`UserID` = `users`.`id`)
INNER JOIN `lawyerdb1`.`casesdetails` 
ON (`casesdetails`.`Court` = `courts`.`ID`)
INNER JOIN `lawyerdb1`.`casesmaster` 
ON (`casesdetails`.`CaseMasterID` = `casesmaster`.`ID`)
INNER JOIN `lawyerdb1`.`persons` 
ON (`casesmaster`.`CustomerID` = `persons`.`ID`)
INNER JOIN `lawyerdb1`.`caseevents` 
ON (`caseevents`.`CaseID` = `casesmaster`.`ID`)
WHERE caseevents.id IN ( SELECT ID FROM caseevents WHERE `TheDate` < CURDATE() AND ISNULL( `parent`) 
AND (NOT( `ID` IN(SELECT
`caseevents`.`parent`
FROM `caseevents`
WHERE (`caseevents`.`parent` IS NOT NULL)))))   AND  `users`.`ID` = " . $uuid . "   OR `caseevents`.`WithUser` = "  . $uuid ;

 $query= mysql_query($sq);
$dtable="";


while($row = mysql_fetch_array($query))
{
	$dtable.='
	<tr>
	<td><a href="#">' . $row['DetailsEvent']  . '</td>
	<td class="hidden-phone">' . $row['TheDate']  . '</td>
	<td>' . $row['sName']  . '</td>
	<td> <span class="label label-success label-mini">' . $row['subject']  . '</span></td>
	<td><a class="btn mini green-stripe showEvnts" href="pgCases.php?cccd=' . $row['ID']  . '&mark=1" id="'. $row['ID']  .'" >' . $row['Code']  . '</a></td>
	</tr>';
}










?>
