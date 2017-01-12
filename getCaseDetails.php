<?php
require_once('config.php');
$evt = $_POST['fnc'];

if($evt='getevnt'){
	$CID = $_POST['CaseID'];
	
 
 
	 
	$query= mysql_query("SELECT
      casesdetails.ID
    , casesdetails.Position
    , positions.positionName
     , positions.id as positionsid
    , casesdetails.CaseNumber
    , casesdetails.Circle
    , casesdetails.CustPos
     , customerposition_1.id as 'Positionid'
    , customerposition_1.PositionName
    , casesdetails.EnemytPos
    , customerposition.id as 'Positionid2'
    , customerposition.PositionName as 'PositionName2'
    , casesdetails.Floor
    , casesdetails.Hall
    , casesdetails.Secretary
    , casesdetails.Court
    , courts.CourtName
    , casesdetails.Gedge
    , casesdetails.NowIN
FROM
    lawyerdb1.casesdetails
    LEFT JOIN  lawyerdb1.courts 
        ON (casesdetails.Court = courts.ID)
    LEFT JOIN  lawyerdb1.customerposition 
        ON (casesdetails.EnemytPos = customerposition.ID)
    LEFT JOIN  lawyerdb1.positions 
        ON (casesdetails.Position = positions.ID)
    LEFT JOIN  lawyerdb1.customerposition AS customerposition_1
        ON (casesdetails.CustPos = customerposition_1.ID) where  CaseMasterID =".$CID  );


$dtable="";
 

	  while($row = mysql_fetch_array($query))
	 {
//$stest .= $row['ID'] ."<br />";
		
		$dtable.="<tr> 
							<td style='font-size: 7px;'><a href='#'  value='" . $row['ID']   . "' class='detlid' id='detlid" . $row['ID'] . "'  >" . $row['ID'] . "</a></td>
							<td id='detposetion" . $row['ID'] . "'  value='" . $row['positionsid'] . "' >" . $row['positionName'] . "</td>
							<td id='detCaseNumber" . $row['ID'] . "'  >" . $row['CaseNumber']. "</td>
							<td id='detPositionName" . $row['ID'] . "'   value='" . $row['Positionid'] . "'>" . $row['PositionName']. "</td>
							<td id='detPositionName2" . $row['ID'] . "'  value='" . $row['Positionid2'] . "'>" . $row['PositionName2']. "</td>
							<td id='detCircle" . $row['ID'] . "' >" . $row['Circle']. "</td>
							<td id='detFloor" . $row['ID'] . "' >" . $row['Floor']. "</td>
							<td id='detHall" . $row['ID'] . "' >" . $row['Hall']. "</td>
							<td id='detCourtName" . $row['ID'] . "'  value='" . $row['Court'] . "' >" . $row['CourtName']. "</td>
							<td id='detSecretary" . $row['ID'] . "' >" . $row['Secretary']. "</td>
							<td id='detGedge" . $row['ID'] . "' >" . $row['Gedge']. "</td>
							 <td    class='hidden-480'>" . $row['Gedge']  . "</td> 
							 <span class='label label-success'>
							 	<td>
								<div class='btn-toolbar'>
								<div class='btn-group'>
									<a class='btn green mini' href='#' data-toggle='dropdown'> 
										<i class='icon-cogs'></i> تحكم
										<i class='icon-angle-down'></i>
										</a>
										<ul class='dropdown-menu'>
										<li><a href='#'  value='" . $row['ID']   . "' data-toggle='modal'  data-target='#edit_det' class='casdetedit'><i class='icon-edit'></i>تعديل</a></li>
										<li><a href='#'  value='" . $row['ID']   . "' class='detdel' ><i class='icon-remove'></i>حذف</a></li>
									
										</ul>
							</div>
							</div>
							</td>
							</span>
							 
				</tr>";
	// 	//$output[] = array ($row['ID'],$row['DetailsEvent'],$row['TheDate'],$row['CDate'],$row['IDEventType'],$row['TypeName']);
	// }
	// if (!empty($output)){
	// 	echo json_encode($output);

	  }
	  echo $dtable;
}
//---------------------------------


?>

