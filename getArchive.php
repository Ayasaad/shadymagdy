<?php
require_once('config.php');
$cid = $_POST['CaseID'];
$query= mysql_query("SELECT CustomerID,Enemy FROM casesmaster where id = ". $cid );
$row = mysql_fetch_assoc($query); 
$cuid = $row['CustomerID'];
$enid = $row['Enemy'];
$PID ="";



if (!empty($_POST['artyp']) && $_POST['artyp'] ==2) {
	$ssqdl = "select scanperson.ID, scanperson.PersonID as ids,scaninfo.pName,scanperson.ImgPath,scanperson.FileTitle FROM     lawyerdb1.scanperson    INNER JOIN  lawyerdb1.scaninfo  
	ON ( scanperson.FileName  =  scaninfo.ID ) where PersonID= " . $cuid;
}else if (!empty($_POST['artyp']) && $_POST['artyp'] ==3){
	$ssqdl = "select scanperson.ID,scanperson.PersonID as ids,scaninfo.pName,scanperson.ImgPath,scanperson.FileTitle FROM     lawyerdb1.scanperson    INNER JOIN  lawyerdb1.scaninfo  
	ON ( scanperson.FileName  =  scaninfo.ID ) where PersonID= " . $enid;
}
else{ 
	$ssqdl = "select scan.ID,scan.CaseID as ids,scaninfo.pName,scan.ImgPath,scan.FileTitle FROM     lawyerdb1.scan    INNER JOIN  lawyerdb1.scaninfo  
	ON ( scan.FileName  =  scaninfo.ID ) where CaseID= " . $cid;
}


$scans = "";

$query2= mysql_query($ssqdl);
while ( $row =mysql_fetch_array($query2)) {

	if ( substr($row['ImgPath'] , -4)==".pdf"){
		$iimg="<a href='uploads/" . $row['ImgPath'] . "'  target='_blank'><img src='pdf.png' alt='Smiley face' height='82' width='62'></a>";
	}
	else if ( substr($row['ImgPath'] , -4)=="docx"){
		$iimg="<a href='uploads/" . $row['ImgPath'] . "'  target='_blank'><img src='docx.png' alt='Smiley face' height='82' width='62'></a>";
	}
	else if ( substr($row['ImgPath'] , -4)==".swf"){
		$iimg="<a href='uploads/" . $row['ImgPath'] . "'  target='_blank'><img src='adobe-flash-player-6.jpg' alt='Smiley face' height='82' width='62'></a>";
	}
	else{

		$iimg="<a href='uploads/" . $row['ImgPath'] . "'  target='_blank'><img src='uploads/" . $row['ImgPath'] . "' alt='Smiley face' height='82' width='62'></a>";
	}

	$scans .= "
	<tr>
		<td>".$iimg."</td>
		<td>" . $row['pName'] . "</td>
		<td> 
			<a class='btn red archivedel' mark='".$_POST['artyp']."' title='" . $row['ID'] . "'  id='" . $row['ID'] . "'><i class='icon-trash icon-white'></i> حـذف</a>
		</td>
		<td> 
			<a class='btn green' href='uploads/" . $row['ImgPath'] . "'   target='_blank'  title='" . $row['ID'] . "'  id='" . $row['ID'] . "'><i class='icon-eye-open'></i>مشاهدة</a>
		</td>
		<td></td>
	</tr>";
}

echo $scans . "<br />" ;

?>
