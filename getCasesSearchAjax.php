<?php  session_start(); 
 


include('pagenetion.php');
include('dbop.php');


if (!empty($_POST['searchstat']) ==0){
	$_SESSION['seid']=0;
	$wer='  where   casesdetails.nowin=1';

}else
{
	$_SESSION['seid']=1;
}







$ssql="SELECT
`users`.`username`
, `roles`.`RoleName`
, `roles`.`ID`
, `users`.`id`
FROM
`lawyerdb1`.`usersinroles`
INNER JOIN `lawyerdb1`.`roles` 
ON (`usersinroles`.`RoleID` = `roles`.`ID`)
INNER JOIN `lawyerdb1`.`users` 
ON (`usersinroles`.`UserID` = `users`.`id`);";

$qury= mysql_query($ssql);
$roles = array();
while($roow = mysql_fetch_assoc($qury))
{
	$roles[] = $roow['RoleName'];
}







$theswitch = " and ";


if (!empty($_POST['code'])) {$code= $_POST['code'];}
if (!empty($_POST['auto'])) {$auto= $_POST['auto'];}
if (!empty($_POST['cust'])) {$cust= $_POST['cust'];}
if (!empty($_POST['cstates'])) {$cstates= $_POST['cstates'];}
if (!empty($_POST['ctypes'])) {$ctypes= $_POST['ctypes'];}
// $auto = $_POST['auto'];
// $cust = $_POST['cust'];
// $enm = $_POST['enm'];
// $sub = $_POST['sub'];










//echo $_POST['CharCode'];


// $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
// $pieces = explode(" ", $pizza);
// echo $pieces[0]; // piece1
// echo $pieces[1]; // piece2



if (!empty($_POST['CharCode'])){
	$theswitch = " or " ;
	$CharCode  = $_POST['CharCode'];
//$CharsCode = explode(" ", $CharCode);

	//foreach ($CharsCode as $charelement) {
	if (is_numeric($CharCode)) {
		$code=$CharCode;
		$auto=$CharCode;
	} else {
		$cust=$CharCode;


		$qurydw= mysql_query('select ID from  casetypedetails  where CaseTypeDetailsName = "'. $CharCode .'"');
		$rowlsw = mysql_fetch_assoc($qurydw);
		$ctypes =  $rowlsw["ID"]; 

		$quryd= mysql_query('select ID from  casestates  where StateName ="'. $CharCode .'"');
		$rowls = mysql_fetch_assoc($quryd);
		$cstates =  $rowls["ID"];
	}
//}


//	$code =  $CharsCode[0] ;
} 






$wer='';

if (!empty($_GET['cccd'])){ 
	if ($wer =='') {$wer='  where (casesmaster.id in ( ' . $_GET['cccd'] . ')' ;} else { $wer .=  $theswitch . '   casesmaster.id  in ( ' . $_GET['cccd'] . ')'  ;}
};

if (!empty($code)){ 
	if ($wer =='') {$wer='  where (casesmaster.Code in( ' . $code . ')';} else { $wer .=  $theswitch . '     casesmaster.Code in ( ' . $code . ')' ;}
};
if (!empty($auto)){
	if ($wer =='') {$wer='  where (casesmaster.AutoNumber in( ' . $auto . ')';} else { $wer .=  $theswitch . '     casesmaster.AutoNumber in( ' . $auto . ')';}
};
if (!empty($cust)){
	if ($wer =='') {$wer='  where  (persons.sName   like "%' . $cust . '%"';} else { $wer .=  $theswitch . '     persons.sName   like "%' . $cust . '%"';}
};
if (!empty($_POST['enm'])){
	if ($wer =='') {$wer='  where   (persons_1.sName  = "' . $_POST['enm'] . '"';} else { $wer .=  $theswitch . '      persons_1.sName  = "' . $_POST['enm'] . '"';}
};

if (!empty($_POST['sub'])){
	if ($wer =='') {$wer='  where  (casesmaster.subject  like "%' . $_POST['sub'] . '%"';} else { $wer .=  $theswitch . '     casesmaster.subject  like "%' . $_POST['sub'] . '%"';}
};


if(!empty($_POST['check_cCourts'])) {
	$vch="";
	foreach($_POST['check_cCourts'] as $check) {
		if ($vch ==''){$vch = $check;}else {$vch .=',' . $check;} 
	};
	if ($wer =='') {$wer='  where  (casesdetails.Court  in (' . $vch . ')';} 
	else  {$wer .=  $theswitch . '     (casesdetails.Court  in (' . $vch . ')';}
};


if (!empty($ctypes)){
	if ($wer =='') {$wer='  where    (casesmaster.CaseType  = ' . $ctypes;} 
	else { $wer .=  $theswitch . '       casesmaster.CaseType  = ' . $ctypes;}
};

if (!empty($cstates)){
	if ($wer =='') {$wer='  where   (casesmaster.CaseState = ' . $cstates;} 
	else { $wer .=  $theswitch . '     casesmaster.CaseState = ' . $cstates;}
};

if (!empty($_POST['shposition'])){
	if ($wer =='') {$wer='  where    (casesdetails.Position  = ' . $_POST['shposition'];} 
	else { $wer .=  $theswitch . '       casesdetails.Position  = ' . $_POST['shposition'];}
};







if ($wer =='') {$wer='  where   casesdetails.nowin=1  and casesmaster.ClintID = ' . $_SESSION['clintid'];} 
else  {$wer .='  )  AND  casesdetails.nowin=1 and casesmaster.ClintID = ' . $_SESSION['clintid'];}



$sqc='ALTER VIEW vwcases AS 
SELECT
casesmaster.Code                    AS `Code`,
casesmaster.ID                      AS `ID`,
casesmaster.AutoNumber              AS `AutoNumber`,
casesmaster.CustomerID              AS `CustomerID`,
casesmaster.CaseType                AS `CaseType`,
casesdetails.Court                  AS `Court`,
courts.CourtName		            AS `Courtname`,
casesdetails.Position               AS `Position`,
casesdetails.NowIN                  AS `nowin`,
casesdetails.CaseNumber                  AS `CaseNumber`,
casetypedetails.CaseTypeDetailsName AS `CaseTypeName`,
casetypedetails.ID  				AS `CaseTypeID`,
casesmaster.CaseState               AS `CaseState`,
casestates.ID              			AS `Statid`,
casestates.StateName                AS `StateName`,
persons.sName                       AS `sName`,
casesmaster.subject                 AS `subject`,
casesmaster.Enemy                   AS `Enemy`,
persons_1.sName                     AS `sName2`,
casesmaster.TheDate                 AS `TheDate`,
papertypes.PaperType                AS `PaperType`,
casesmaster.PaperType               AS `PaperTypeID`,
casesmaster.mon                     AS `mon`,
casesmaster.MonChar                 AS `monchar`,
casesmaster.LaterDate               AS `LaterDate`
FROM (((((((casesmaster
LEFT JOIN casestates
ON ((casesmaster.CaseState = casestates.ID)))
LEFT JOIN casetypedetails
ON ((casesmaster.CaseType = casetypedetails.ID)))
LEFT JOIN persons
ON ((casesmaster.CustomerID = persons.ID)))
LEFT JOIN persons `persons_1`
ON ((casesmaster.Enemy = persons_1.ID)))
LEFT JOIN casesdetails
ON ((casesdetails.CaseMasterID = casesmaster.ID)))
LEFT JOIN papertypes
ON ((casesmaster.PaperType = papertypes.ID)))
LEFT JOIN courts
ON ((casesdetails.Court  = courts.ID))) '. $wer;






if (!empty($_POST['serchpose']) ==0){$query2= mysql_query($sqc);}



//$query= mysql_query($sqc);



$item_per_page =8;
$total_records =  selectonce("select Count(id) as id from vwcases","id") ;
$total_pages = ceil($total_records/$item_per_page);
if(isset($_POST["serchpose"])){
		$page_number = filter_var($_POST["serchpose"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
		if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
	}else{
		$page_number = 1; //if there's no page number, set it to 1
	}



	$navs = paginate_function($item_per_page, $page_number,$total_records, $total_pages);
//get starting position to fetch the records
	$page_position = (($page_number-1) * $item_per_page);


	if (!empty($_POST['serchpose']) ==0)
		{$sq='SELECT *,(SELECT count(id) FROM vwcases) as cotcas FROM vwcases   ORDER BY  ID DESC LIMIT ' . $item_per_page;}
	else{
		$sq='SELECT *,(SELECT count(id) FROM vwcases) as cotcas  FROM vwcases   ORDER BY  ID DESC limit ' .  $page_position . ',' . $item_per_page ;

	}




	$query2= mysql_query($sq);
	$tablerows='';

	while ( $row =mysql_fetch_array($query2)) {

		if (in_array("عرض اجراءات القضايا", $roles) or in_array("مدير عام على النظام", $roles) ) {$btnOpration = '	<a id="'.$row["ID"].'" class="evnts" data-toggle="modal" data-target="#full-width" href="#"></i> الاجراءات</a>';}else{$btnOpration = '';}
		if (in_array("عرض تفاصيل القضايا", $roles) or in_array("مدير عام على النظام", $roles) ) {$btnDetails = '<a id="'.$row["ID"].'" class="detail"   data-toggle="modal" data-target="#casedetails" href="#"><i class="icon-reorder"></i> تفاصيل</a>';}else{$btnDetails = '';}
		if (in_array("عرض اجراءات القضايا", $roles) or in_array("مدير عام على النظام", $roles) ) {$btnEdit = '<a id="'.$row["ID"].'" class="editCase" data-toggle="modal" href="#static"  ><i class="icon-edit"></i>تعديل</a>';}else{$btnEdit = '';}
		if (in_array("عرض ارشيف القضايا", $roles) or in_array("مدير عام على النظام", $roles) ) {$btnArchive = '<a id="'.$row["ID"].'"  class="archive"  data-toggle="modal" href="" data-target="#caseArchive"  ><i class="icon-archive"></i>ارشيف</a>';}else{$btnArchive = '';}
		if (in_array("حذف القضايا", $roles) or in_array("مدير عام على النظام", $roles) ) {$btndelt = '<a id="'.$row["ID"].'"  href="#"   ><i class="icon-remove"></i>حذف</a>';}else{$btndelt = '';}


		$isok=$row['Statid'];
		if ($isok==1) {
			$isok ="warning";
		}
		else if ($isok==2)
		{
			$isok ="info";
		}else if ($isok==5)
		{
			$isok ="success";
		}else  if ($isok==9)
		{
			$isok ="inverse";
		}else  if ($isok==4)
		{
			$isok ="important";
		}
		$councass=$row["cotcas"];


		$queryvv=mysql_query("SELECT cmrState  FROM `commercial` WHERE id = ( SELECT MAX(id)	 FROM commercial WHERE caseid = " .$row['ID'] . " )")  ;
		$rowvv = mysql_fetch_assoc($queryvv);
		$iscommer=$rowvv['cmrState'];

		if ($iscommer==2) {
			$iscommer ="green";
		}
		else if ($iscommer==1)
		{
			$iscommer ="red";
		}
		else
		{
			$iscommer ="yellow";
		}

		$tablerows .= '<tr value="'.$row["ID"].'" class="casetr">
		<td class="highlight">
			<div   id="light_'.$row["ID"].'" class="" style="margin: 5px;"></div>
			<input type="checkbox" class="chkkinp" value="'.$row["ID"].'"  id="chck_'.$row["ID"].'" style="display:none"/>
			<div class="btn-toolbar ">
				<div class="btn-group ">
					<a class="btn '.$iscommer.' mini" title="'.$row["ID"].'"  href="#" data-toggle="dropdown">
						<i class="icon-cogs"></i> تحكم
						<i class="icon-angle-down"></i>
					</a>
					<ul class="dropdown-menu">
						<li>'.$btnOpration.'</li>
						<li>'.$btnDetails.'</li>
						<li><a href="#"><i class=""></i> مستجدات</a></li>
						<li> <a id="'.$row["ID"].'" href="#" class="commer"  data-toggle="modal" href="" data-target="#commercial"><i class=""></i>  الاعلانات</a></li>
						<li><a href="#"><i class="icon-user-md"></i>خبراء</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-print"></i>طباعة</a></li>
						<li class="divider"></li>
						<li>'.$btnEdit.'</li>
						<li>'.$btndelt.'</li>
						<li class="divider"></li>
						<li>'.$btnArchive.'</li>
						<li><a href="#"><i class="icon-file-text"></i>مذكرات القضية</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="icon-file"></i>تكليف بالوفاء</a></li>
						<li><a href="#"><i class="icon-file"></i>أمر اداء</a></li>
						<li><a href="#"><i class="icon-envelope"></i>الظرف</a></li>
					</ul>
				</div>
			</div>
		</td>
		<td data-title="كود">'.$row["Code"].'</td>
		<td data-title="رقم الي"><a href="#" value="  '.$row["ID"].'" class="autosh" title="تحديث">   '.$row["AutoNumber"].' </a></td> 
		<td data-title="اشخاص" class="numeric">
			<a class="persons"  data-toggle="modal" href="" data-target="#person_details"  id="perscust" title="'.$row["CustomerID"].' "><b>'.$row["sName"].' </b></span> <br />  
				<a class="persons"  data-toggle="modal" href="" data-target="#person_details"   id="persenm"  title="'.$row["Enemy"].' " style="color:#9C27B0;">'.$row["sName2"].' </span>
				</td>
				<td data-title="نوع" class="numeric"> '.$row["CaseTypeName"].' <span id="cstypeid'.$row["ID"].'" value="'.$row["CaseTypeID"].'" ></span>  </td>
				<td data-title="حالة" class="numeric "> <span class="label label-'. $isok .'">'.$row["StateName"].'</span> <span id="csStatid'.$row["ID"].'" value="'.$row["Statid"].'" ></span> </td>
				<td class="numeric"> '.$row["subject"].' </td>
				<td class="numeric"><span style="font-weight:bold;"> '.$row["Courtname"].'</span> </td>

			</tr>';
		};





		echo '	<table id="context" class="table table-striped table-hover  table-advance table-condensed cf">
		<thead class="cf">
			<tr>
				<th style=""> <span id="tblrowcounts" style="font-size:14px; color:red; font-weight: bold"> </span></th>
				<th>كود</th>
				<th>الرقم الآلي</th>
				<th class="numeric">الاشخاص</th>
				<th class="numeric">النوع</th>
				<th class="numeric">الحالة</th>
				<th class="numeric">الموضوع</th>
				<th class="numeric">الجهة</th>

			</tr>
		</thead>
		<tbody >



			'. $tablerows . '</tbody></table>' . $navs ;



			?>