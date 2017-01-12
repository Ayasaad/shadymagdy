<?php  session_start(); 
include('dbop.php');



$parent[]='';
$queryoo2= mysql_query(" SELECT ID FROM caseevents WHERE `TheDate` < CURDATE() AND ISNULL( `parent`) 
	AND (NOT( `ID` IN(SELECT
		`caseevents`.`parent`
		FROM `caseevents`
		WHERE (`caseevents`.`parent` IS NOT NULL))))");

while($rowf = mysql_fetch_array($queryoo2))
{
	$parent[] = $rowf['ID'];
}
$comma_separated = ltrim(implode(",", $parent), ",");





$sqqql="SELECT
`casesmaster`.`ID`
, `caseevents`.`DetailsEvent`
, `caseevents`.`IDEventType`
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
WHERE caseevents.id IN ( ". $comma_separated .") 
AND  `users`.`ID` = " . $_SESSION['USID'] . "   OR `caseevents`.`WithUser` = "  . $_SESSION['USID'] . "  order by TheDate desc  LIMIT 20";



$querypub= mysql_query($sqqql);
$notilab="";
$ddt="";
while($rownote = mysql_fetch_array($querypub))
	{ if ( $rownote['TheDate'] == date("Y-m-d")) {$ddt = "اليوم";} else {$ddt=$rownote['TheDate'];} 

if ( $rownote['IDEventType'] == 5) {$lblsty='<span class="label label-success"><i class="icon-plus">';} 
else if ( $rownote['IDEventType'] == 4) {$lblsty='<span class="label label-important"><i class="icon-bolt">';} 
else if ( $rownote['IDEventType'] == 6) {$lblsty='<span class="label label-warning"><i class="icon-bell">';} 

$notilab .='<li>
<a href="pgCases.php?cccd='.$rownote['ID'].'&mark=1" >
	'. $lblsty .'</i></span>
	' .   substr( $rownote['DetailsEvent'] , 0, 38)   . ' . 
	<span class="time">' . $ddt  . '</span></a>
</li>';

}







$_SESSION['notilab'] ="" . $notilab;

 header('Location: index.php');
?>