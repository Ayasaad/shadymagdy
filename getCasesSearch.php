<?php  session_start(); 
require_once('config.php');

	
 $chk= $_POST['seID'];
 
 if ($chk=='1'){
 
	 
$query3= mysql_query("SELECT * FROM vwcases ORDER BY  ID DESC limit 50");


$dtable2="";
 

	  while($row1 = mysql_fetch_array($query3))
	 {
//$stest .= $row['ID'] ."<br />";ع
	 
		$dtable2.="<tr id='ffr" . $row1['ID'] . "'>
						<td><a id='" . $row1['ID'] . "' class='evnts2' href='#'><span class='label label-success'>" . $row1['Code'] . "</span></a></td>
						<td>" . $row1['sName'] . " <br /> " . $row1['sName2'] . "<br />" . $row1['subject'] . "</td>
						<td class='hidden-480'>" . $row1['StateName'] . "<br/>
						<a style='display: none;' id='" . $row1['ID'] . " ' href='#' data-toggle='modal' data-target='#casedetails' class='detail'> <span class='label label-info'>تفاصيل</span></a></td>
					 </tr>
					 " ;
	// 	//$output[] = array ($row['ID'],$row['DetailsEvent'],$row['TheDate'],$row['CDate'],$row['IDEventType'],$row['TypeName']);
	// }
	// if (!empty($output)){
	// 	echo json_encode($output);

	  }

	  echo $dtable2;
 	}else
 	{echo "لم يتم البحث بعد";}
//---------------------------------


?>

