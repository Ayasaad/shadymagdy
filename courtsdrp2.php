<?php
require_once('config.php');
 
function GetCourts($idd) {
	
	if ($idd==0){
		$query= mysql_query("select id,CourtName from Courts");

	}
	else{
		$query= mysql_query("select id,CourtName from Courts where ID =".$idd);
	}
	$Courts ='';
	$Courts ='<select class="span6 m-wrap" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
	while($row = mysql_fetch_array($query))
	{	
		$Courts .='<option value="'.$row["id"].'">'.$row["CourtName"].'</option>';
	}
	$Courts .='</select>';
	return $Courts;
}
?>