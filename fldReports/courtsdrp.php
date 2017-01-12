<?php
//require_once('dbop.php');

function GetCourts($idd) {
	
	if ($idd==0){
		$query= mysql_query("select id,CourtName from courts  ORDER BY  code2   IS NULL, code2 ");

	}
	else{
		$query= mysql_query("select id,CourtName from Courts where ID =".$idd ." ORDER BY  code2   IS NULL, code2 ");
	}
	$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="cCourts" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
	$Courts .='<option value>الجهة</option>';
	while($row = mysql_fetch_array($query))
	{	
		$Courts .='<option value="'.$row["id"].'">'.$row["CourtName"].'</option>';
	}
	//$Courts .='</select>';
	return $Courts;
}



function GetCourtsMulti($idd) {
	
	if ($idd==0){
		$query= mysql_query("select id,CourtName from courts  ORDER BY  code2   IS NULL, code2 ");

	}
	else{
		$query= mysql_query("select id,CourtName from Courts where ID =". $idd  ." ORDER BY  code2   IS NULL, code2 ");
	}
	$Courts ='';
	$Courts ='<div class="btn-group "> 
	<a class="btn  " style="width: 322px;" href="#" data-toggle="dropdown"> الجهة<i class=" icon-angle-down"></i>
	</a> 
	<div class="dropdown-menu hold-on-click dropdown-checkboxes">';

		while($row = mysql_fetch_array($query))
		{	

			$Courts .='<input value="'.$row["id"].'" type="checkbox" name="check_cCourts[]">'.$row["CourtName"].'</label><br />';
		}
		$Courts .='</div></div>';
		return $Courts;
	}






	function Getctypes($idd) {

		if ($idd==0){
			$query= mysql_query("select id,CaseTypeDetailsName from casetypedetails   order by code  IS NULL, code");// ORDER BY  code2   IS NULL, code2 

		}
		else{
			$query= mysql_query("select id,CaseTypeDetailsName from casetypedetails where ID =".$idd ."   order by code  IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="ctypes" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>النوع</option>';

		while($row = mysql_fetch_array($query))
		{	
			$Courts .='<option value="'.$row["id"].'">'.$row["CaseTypeDetailsName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}


	function Getcstates($idd) {

		if ($idd==0){
			$query= mysql_query("select id,StateName from casestates order by code IS NULL, code");

		}
		else{
			$query= mysql_query("select id,StateName from casestates where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="cstates" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>الحالة</option>';
		while($row = mysql_fetch_array($query))
		{	
			$Courts .='<option value="'.$row["id"].'">'.$row["StateName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}




	function GetUsers($idd) {

		if ($idd==0){
			$query= mysql_query("SELECT  id,UserName FROM  users order by code IS NULL, code");

		}
		else{
			$query= mysql_query("SELECT  id,UserName FROM  users where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
		//$Courts ='<select class="span12 m-wrap" name="cUsers" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>المستخدم</option>';
		while($row = mysql_fetch_array($query))
		{	
			$Courts .='<option value="'.$row["id"].'">'.$row["UserName"].'</option>';
		}
		//$Courts .='</select>';
		return $Courts;
	}



	function GetEventTypeselec($idd) {

		if ($idd==0){
			$query= mysql_query("select id,TypeName from eventtypes order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,TypeName from eventtypes where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="cpositions" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>نوع الاجراء...</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["TypeName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}


function Getcommerstate($idd) {

		if ($idd==0){
			$query= mysql_query("select id,state from commercialstates order by id IS NULL, id");
		}
		else{
			$query= mysql_query("select id,state from commercialstates where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="cpositions" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>حالة الاعلان...</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["state"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}






	function GetEventType($idd) {

		if ($idd==0){
			$query= mysql_query("select id,TypeName from eventtypes order by code IS NULL, code");

		}
		else{
			$query= mysql_query("select id,TypeName from eventtypes where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
		$Courts ='<div class="btn-group"> <a class="btn "  style="width: 322px;" href="#" data-toggle="dropdown"> نوع الاجراء <i class="icon-angle-down"></i> </a> <div class="dropdown-menu hold-on-click dropdown-checkboxes">';

		while($row = mysql_fetch_array($query))
		{	
			$Courts .='<input value="'.$row["id"].'" type="checkbox"  name="check_EventType[]" >'.$row["TypeName"].'</label><br />';
		}
		$Courts .='</div></div>';
		return $Courts;
	}



	function Getcpositions($idd) {

		if ($idd==0){
			$query= mysql_query("select id,positionName from positions order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,positionName from positions where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="cpositions" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>الدرجة</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["positionName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}





	function Getceventstats($idd) {

		if ($idd==0){
			$query= mysql_query("select id,evStateName from eventstats order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,evStateName from eventstats where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span12 m-wrap" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value>حالة الاجراء</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["evStateName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}





	function Getpersonpos($idd) {

		if ($idd==0){
			$query= mysql_query("select id,PositionName from customerposition order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,PositionName from customerposition where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">الصفة</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["PositionName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}


//eventstats

	function Getcpapertype($idd) {

		if ($idd==0){
			$query= mysql_query("select id,PaperType from papertypes order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,PaperType from papertypes where ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">السند</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["PaperType"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}


	function Getceventstat($idd) {

		if ($idd==0){
			$query= mysql_query("select id,evStateName from eventstats where id <>5 order by code IS NULL, code");
		}
		else{
			$query= mysql_query("select id,evStateName from eventstats where  id <>5 and ID =".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">الحالة</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["id"].'">'.$row["evStateName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}




	function GetArchInfo($idd) {

		if ($idd==0){
			$query= mysql_query("SELECT * FROM `scaninfo` order by code IS NULL, code");
		}
		else{
			$query= mysql_query("SELECT * FROM `scaninfo` WHERE `Spisialist` = ".$idd ." order by code IS NULL, code");
		}
		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">اسم المرفق</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["ID"].'">'.$row["pName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}




	function GetPersInfotype() {


		$query= mysql_query("SELECT * FROM `prs_infotypes` order by code IS NULL, code");

		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">نوع المعلومة</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["ID"].'">'.$row["InfoTypeName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}



	function GetPersnation() {


		$query= mysql_query("SELECT * FROM nationalities order by code IS NULL, code");

		$Courts ='';
	//$Courts ='<select class="span6 m-wrap required" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1">';
		$Courts .='<option value="">الجنسية</option>';
		while($row = mysql_fetch_array($query))
		{
			$Courts .='<option value="'.$row["ID"].'">'.$row["NatuName"].'</option>';
		}
	//$Courts .='</select>';
		return $Courts;
	}
	?>