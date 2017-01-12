<?php
require_once('config.php');
$evt = $_POST['fnc'];

if($evt='getevnt'){
	$CID = $_POST['CaseID'];
	
	$wer="";

	if (!empty($_POST['evtyp'])){$evtyp= $_POST['evtyp'];}else{$evtyp = 0;}


	if ($evtyp == 0){
		$wer="";
	}
	else{
		$wer=" and IDEventType = " . $evtyp;
	}

	$query= mysql_query("SELECT    caseevents.ID    , caseevents.CaseID  ,  users.first_name    , caseevents.DetailsEvent    , caseevents.TheDate    , caseevents.CDate    , caseevents.IDEventType, caseevents.parent    , eventtypes.TypeName FROM      caseevents    
		LEFT JOIN  eventtypes         ON (caseevents.IDEventType = eventtypes.ID) 
		LEFT JOIN  users         ON (caseevents.TheUser = users.ID) 
		where caseevents.parent is null and CaseID =".$CID . $wer . " order by thedate desc");


	$dtable="";

	$trvl="";
	while($row = mysql_fetch_array($query))
	{
//$stest .= $row['ID'] ."<br />";
		
		if(is_null($row['parent'])){$trvl = "<tr class='parent' id='" .$row['ID'] . "'>";}
		else{$trvl = "<tr  class='child-" .$row['parent'] . "'>";}

// else{$trvl = "<tr  class='child-" .$row['parent'] . "'>";}    SELECT eventstate  FROM `caseevents` WHERE id IN (SELECT MAX(id)	 FROM caseevents WHERE (id = 70905 OR parent = 70905))

		$queryvv=mysql_query("SELECT eventstate  FROM `caseevents` WHERE id = (SELECT MAX(id)	 FROM caseevents WHERE (id = " .$row['ID'] . " OR parent = " .$row['ID'] . "))")  ;
		$rowvv = mysql_fetch_assoc($queryvv);
		$isok=$rowvv['eventstate'];
		if ($isok==1) {
			$isok ="";
			$isok = "<a href='#'  class=' btn mini green-stripe' data-toggle='modal'>منهي</a>";
		}
		else if ($isok==2)
		{

			$isok = "<a href='#' value='" . $row['ID']   . "' class='evthread btn mini red-stripe' data-toggle='modal'  data-target='#t3amol' >تعامل</a>";
		}else if ($isok==3)
		{

			$isok = "<a href='#' value='" . $row['ID']   . "' class='evthread btn mini blue-stripe' data-toggle='modal'  data-target='#t3amol' >تعامل</a>";
		}else 
		{

			$isok = "<a href='#' value='" . $row['ID']   . "' class='evthread btn mini yellow-stripe' data-toggle='modal'  data-target='#t3amol' >تعامل</a>";
		}



		$dtable.="<tr class='parent' id='" .$row['ID'] . "'>

		<td><a href='#' title='" . $row['ID']   . "' id='evtnmt" . $row['ID']   . "' class='DetailsEv' value='" . $row['ID']   . "'>" . $row['DetailsEvent'] . "</a>  </td>
		</td> <td style='font-size:9px;color:brown;'>  " . $row['first_name'] . "</td>
		<td  id='evtdtt" . $row['ID']   . "' >" . $row['TheDate']. "</td> 
		<td class='hidden-480'  id='evttnmt" . $row['ID']   . "' value='". $row['IDEventType']  ."' >" . $row['TypeName']  . "
			
			<td>".$isok."</td> 


			 
				<td>
					<div class='btn-toolbar' style='    margin-top: 0px;'>
						<div class='btn-group'>
							<a class='btn green mini' href='#' data-toggle='dropdown'> 
								<i class='icon-cogs'></i> تحكم
								<i class='icon-angle-down'></i>
							</a>
							<ul class='dropdown-menu' >


								<li><a href='#' value='" . $row['ID']   . "'  class='evedit' data-toggle='modal'  data-target='#edit_Event' ><i class='icon-edit  '></i>تعديل</a></li> 
								<li><a href='#' value='" . $row['ID']   . "' class='evdel'><i class='icon-remove  '></i>حذف</a></li> 
								<li><a href='#' value='" . $row['ID']   . "'  class='redirect' data-toggle='modal'  data-target='#redirect'><i class='icon-share-alt  '></i>توجيه</a></li>
								<li><a href='#' value='" . $row['ID']   . "'  class='prtevthread' ><i class='icon-print'></i>الاخطار</a></li>


							</ul>
						</div>
					</div>
				</td>
			 




			<td>
				<span class='label label-success'></td>

				</span></td>
			</tr>" ;


		}
		echo $dtable;
	}
//---------------------------------


	?>

