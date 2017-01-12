<?php
require_once('config.php');


$PersonID = $_POST['PersonID'];
$query= mysql_query("
	SELECT
	`prs_contacts`.`PersonID`
	, `prs_infotypes`.`InfoTypeName`
	, `prs_contacts`.`Title`
	, `persons`.`sName`
	, `persons`.`ID`
	, `persons`.`CardID`
	, `persons`.`Natunality`
	, `persons`.`PersType`
	, `prs_contacts`.`ID`
	, `nationalities`.`NatuName`
	, `nationalities`.`ID` as 'nationalitiesID'
	FROM
	`lawyerdb1`.`prs_contacts`
	RIGHT JOIN `lawyerdb1`.`persons` 
	ON (`prs_contacts`.`PersonID` = `persons`.`ID`)
	LEFT JOIN `lawyerdb1`.`nationalities` 
	ON (`persons`.`Natunality` = `nationalities`.`ID`)
	LEFT JOIN `lawyerdb1`.`prs_infotypes` 
	ON (`prs_contacts`.`InfoTypeID` = `prs_infotypes`.`ID`)   WHERE `persons`.`ID` = " . $PersonID);

$dtable=""; 
if ($_POST['artyp']==0){
	while($row = mysql_fetch_array($query))
	{ 
		$dtable.= "<tr title='" .$row['ID'] . "'  id='" .$row['ID'] . "'>
		<td>" . $row['ID'] . "</td>
		<td>" . $row['InfoTypeName'] . "</td>
		<td>" . $row['Title']      . "</td>
		<td><a class='btn red archivedel'   title='" . $row['ID'] . "'  id='" . $row['ID'] . "'><i class='icon-trash icon-white'></i> حـذف</a></td>


	</tr>";


}
}else{
	$row = mysql_fetch_assoc($query); 
	$dtable ='<tr>
	<td style="width:15%">الاسم</td>
	<td style="width:50%"><a href="#" id="username" data-type="text" data-pk="1" data-original-title="Enter username">' . $row['sName'] . '</a></td>
	<td style="width:35%"><span class="muted">الاسم بالكامل</span></td>
</tr>
<tr>
	<td>الرقم المدني</td>
	<td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="left" data-placeholder="Required" data-original-title="Enter your firstname">'. $row['CardID'] . '</a></td>
	<td><span class="muted">رقم البطاقة المدية</span></td>
</tr>
<tr>
	<td>الجنسية</td>
	<td><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-original-title="Select sex" value="'. $row['nationalitiesID'].'">' . $row['NatuName'] . '</a></td>
	<td><span class="muted">بلد الجنسية</span></td>
</tr>
<tr>
	<td><a href="#" class="btn yellow mini edpersinf"  data-toggle="modal" href="" data-target="#editpersinfo" 					value="'. $PersonID .'">تعديل</a></td>

	
</tr>
<tr></tr>

'; 


};


echo $dtable;





?>