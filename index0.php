<?php
include('header.php');
include('config.php');
//include('init.php');
include('fldReports/courtsdrp.php');
include('search.php');


if($_SERVER['REQUEST_METHOD'] == "POST")  
	{$_SESSION['seid']=1;
}
else{
	$_SESSION['seid']=0;
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

// foreach($roles as $value){
//      print $value."-";
//  }










$wer='';

if (!empty($_GET['cccd'])){ 
	if ($wer =='') {$wer='  where casesmaster.id = ' . $_GET['cccd']  ;} else { $wer .='  and  casesmaster.id  = ' . $_GET['cccd']   ;}
};

if (!empty($_POST['code'])){ 
	if ($wer =='') {$wer='  where casesmaster.Code in( ' . $_POST['code'] . ')';} else { $wer .='  and  casesmaster.Code in ( ' . $_POST['code'] . ')' ;}
};
// if (!empty($_POST['auto'])){
// 	if ($wer =='') {$wer='  where casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';} else { $wer .='  and  casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';}
// };
if (!empty($_POST['cust'])){
	if ($wer =='') {$wer='  where  persons.sName   = "' . $_POST['cust'] . '"';} else { $wer .='  and  persons.sName   = "' . $_POST['cust'] . '"';}
};
if (!empty($_POST['enm'])){
	if ($wer =='') {$wer='  where   persons_1.sName  = "' . $_POST['enm'] . '"';} else { $wer .='  and   persons_1.sName  = "' . $_POST['enm'] . '"';}
};

if (!empty($_POST['sub'])){
	if ($wer =='') {$wer='  where  casesmaster.subject  like "%' . $_POST['sub'] . '%"';} else { $wer .='  and  casesmaster.subject  like "%' . $_POST['sub'] . '%"';}
};


if(!empty($_POST['check_cCourts'])) {
	$vch="";
	foreach($_POST['check_cCourts'] as $check) {
		if ($vch ==''){$vch = $check;}else {$vch .=',' . $check;} 
	};
	if ($wer =='') {$wer='  where  casesdetails.Court  in (' . $vch . ')';} 
	else  {$wer .='  and  casesdetails.Court  in (' . $vch . ')';}
};


if (!empty($_POST['ctypes'])){
	if ($wer =='') {$wer='  where    casesmaster.CaseType  = ' . $_POST['ctypes'];} 
	else { $wer .=' and    casesmaster.CaseType  = ' . $_POST['ctypes'];}
};

if (!empty($_POST['cstates'])){
	if ($wer =='') {$wer='  where   casesmaster.CaseState = ' . $_POST['cstates'];} 
	else { $wer .=' and   casesmaster.CaseState = ' . $_POST['cstates'];}
};

if (!empty($_POST['cpositions'])){
	if ($wer =='') {$wer='  where    casesdetails.Position  = ' . $_POST['cpositions'];} 
	else { $wer .=' and    casesdetails.Position  = ' . $_POST['cpositions'];}
};







if ($wer =='') {$wer='  where   casesdetails.nowin=1';} 
else  {$wer .='    AND  casesdetails.nowin=1';}

$sqc='ALTER VIEW vwcases AS 
SELECT
casesmaster.Code                    AS `Code`,
casesmaster.ID                      AS `ID`,
casesmaster.AutoNumber              AS `AutoNumber`,
casesmaster.CustomerID              AS `CustomerID`,
casesmaster.CaseType                AS `CaseType`,
casesdetails.Court                  AS `Court`,
casesdetails.Position               AS `Position`,
casesdetails.NowIN                  AS `nowin`,
casetypedetails.CaseTypeDetailsName AS `CaseTypeName`,
casesmaster.CaseState               AS `CaseState`,
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
FROM ((((((casesmaster
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
ON ((casesmaster.PaperType = papertypes.ID))) '. $wer;

//$query2= mysql_query($sqc);


$query= mysql_query($sqc);


if ($wer =='  where   casesdetails.nowin=1'){$sq='SELECT * FROM vwcases   ORDER BY  ID DESC LIMIT 20';}
else{$sq='SELECT * FROM vwcases   ORDER BY  ID DESC';}


$query2= mysql_query($sq);
$tablerows='';

while ( $row =mysql_fetch_array($query2)) {

	if (in_array("عرض اجراءات القضايا", $roles)) {$btnOpration = '	<a id="'.$row["ID"].'" class="evnts" data-toggle="modal" data-target="#full-width" href="#"></i> الاجراءات</a>';}else{$btnOpration = '';}
	if (in_array("عرض تفاصيل القضايا", $roles)) {$btnDetails = '<a id="'.$row["ID"].'" class="detail"   data-toggle="modal" data-target="#casedetails" href="#"><i class="icon-reorder"></i> تفاصيل</a>';}else{$btnDetails = '';}
	if (in_array("عرض اجراءات القضايا", $roles)) {$btnEdit = '<a id="'.$row["ID"].'" class="editCase" data-toggle="modal" href="#static"  ><i class="icon-edit"></i>تعديل</a>';}else{$btnEdit = '';}
	if (in_array("عرض ارشيف القضايا", $roles)) {$btnArchive = '<a id="'.$row["ID"].'"  class="archive"  data-toggle="modal" href="" data-target="#caseArchive"  ><i class="icon-archive"></i>ارشيف</a>';}else{$btnArchive = '';}
	

	$tablerows .= '<tr>
	<td>
		<div class="btn-toolbar">
			<div class="btn-group ">
				<a class="btn green mini" title="'.$row["ID"].'"  href="#" data-toggle="dropdown">
					<i class="icon-cogs"></i> تحكم
					<i class="icon-angle-down"></i>
				</a>
				<ul class="dropdown-menu">

					<li>'.$btnOpration.'</li>
					<li>'.$btnDetails.'</li>
					<li><a href="#"><i class=""></i> مستجدات</a></li>
					<li><a href="#"><i class=""></i> الاعلانات</a></li>
					<li><a href="#"><i class="icon-user-md"></i>خبراء</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-print"></i>طباعة</a></li>
					<li class="divider"></li>
					<li>'.$btnEdit.'</li>
					<li><a href="#"><i class="icon-remove"></i>حذف</a></li>
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
	<td data-title="رقم الي"> '.$row["AutoNumber"].' </td>
	<td data-title="اشخاص" class="numeric">
		<a class="persons"  data-toggle="modal" href="" data-target="#person_details"  id="'.$row["CustomerID"].'" title="'.$row["CustomerID"].' "><b>'.$row["sName"].' </b></span> <br />  
			<a class="persons"  data-toggle="modal" href="" data-target="#person_details"   id="'.$row["Enemy"].' "  title="'.$row["Enemy"].' " style="color:#9C27B0;">'.$row["sName2"].' </span>
			</td>
			<td data-title="نوع" class="numeric"> '.$row["CaseTypeName"].' </td>
			<td data-title="حالة" class="numeric"> '.$row["StateName"].' </td>
			<td class="numeric"> '.$row["subject"].' </td>
			<td class="numeric">00/00/0000</td>
		</tr>';
	};


	?>



	<!--  searchModal -->
	<div id="searchModal" class="modal hide fade" tabindex="-1" data-width="760">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>البحث في القضايا</h3>
		</div>
		<form action="index.php" method="POST" id="sermod">
			<div class="modal-body">
				<div class="scroller" style="height:400px; " data-always-visible="1" data-rail-visible1="1">
					<div class="row-fluid">
						<div class="span6">
							<p><input type="text" placeholder="كود" name="code" class="span12 m-wrap"></p>
							<p><input type="text" placeholder="رقم الي" name="auto" class="span12 m-wrap"></p>
							<p> <input type="text"  autocomplete="off" name="cust" placeholder="العميل"  class="span12 m-wrap required"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data; ?>" /> 
							</p>
							<p> <input type="text" autocomplete="off"  name="enm" placeholder="الخصم"  class="span12 m-wrap required"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data2; ?>" /> 
							</p>
							<p><input type="text" placeholder="الموضوع" name="sub" class="span12 m-wrap"></p>

						</div>
						<div class="span6">
							<p> <?php  echo GetCourtsMulti(0);?> </p>
							<p><select class="span12 m-wrap required" name="ctypes"   data-placeholder="Choose a Category" tabindex="1">
								<?php  echo Getctypes(0);?>
							</select></p>
							<p><select class="span12 m-wrap required" name="cstates"   data-placeholder="Choose a Category" tabindex="1">
								<?php  echo Getcstates(0);?>
							</select></p>
							<p><select class="span12 m-wrap required" name="shposition"   data-placeholder="Choose a Category" tabindex="1">
								<?php  echo Getcpositions(0);?>
							</select></p>

						</div>
					</div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">الغاء</button>
				<input id="Submit1" type="submit" class="btn blue" value="بحث" />
			</div>
		</form>
	</div>
	<!-- End searchModal -->

	<!--editCase -->
	<div id="static" class="modal hide fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
		<div class="modal-body">
			<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="span6">
						<h4>Some Input</h4>
						<p><input name="cid2" type="hidden" class="span12 m-wrap"></p>
						<p>كود<input name="Code" type="text" class="span12 m-wrap"></p>
						<p>الالي<input name="AutoNumber" type="text" class="span12 m-wrap"></p>
						<p>العميل<input name="sName" type="text" class="span12 m-wrap"></p>
						<p>الخصم<input name="sName2" type="text" class="span12 m-wrap"></p>
						<p>الموضوع<input name="subject" type="text" class="span12 m-wrap"></p>
						<p>التاريخ<input name="TheDate" type="text" class="span12 m-wrap"></p>
					</div>
					<div class="span6">
						<h4>Some More Input</h4>
						<p>الحالة<input name="StateName" type="text" class="span12 m-wrap"></p>
						<p>النوع<input name="CaseTypeName" type="text" class="span12 m-wrap"></p>
						<p>الخطاب<input name="LaterDate" type="text" class="span12 m-wrap"></p>
						<p>السند<input name="PaperType" type="text" class="span12 m-wrap"></p>
						<p>الشكوى<input name="mon" type="text" class="span12 m-wrap"></p>
						<p>السند<input name="PaperType" type="text" class="span12 m-wrap"></p>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">الغاء</button>
			<button type="button" data-dismiss="modal" class="btn green">حفظ التعديل</button>
		</div>
	</div>
	<!-- End editCase -->

	<!-- AddcaseEvents -->
	<div id="stack1" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		<form id="form1"   method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>اضافة اجراء جديد</h3>
			</div>
			<div class="modal-body">

				<div class="control-group">
					<div class="controls">
						<select class="span12 m-wrap"   id="evnttypes" data-placeholder="Choose a Category" tabindex="1">
							<?php  echo GetEventTypeselec(0);?>  
						</select>
					</div>
				</div>


				<input type="text" name="txevnt" placeholder="الاجراء" class="m-wrap" data-tabindex="1">

				<div class="input-append" id="ui_date_picker_trigger">
					<input type="text" name="txTheDate" style="z-index: 10055;" class="pkr m-wrap medium" /><span class="add-on"><i class="icon-calendar"></i></span>
				</div>



			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
				<button id="addnewevent"  type="submit"   class="btn red">اضافة</button>
			</div>
		</form>
	</div>
	<!-- End AddcaseEvents -->



	<!-- Addcasedetails -->

	<!-- End Addcasedetails -->

	<!-- casedetails --> 
	<div id="casedetails" class="modal container hide fade" tabindex="-1" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>التفاصيل</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span12">

					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption"><i class="icon-picture"></i>جدول التفاصيل</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>

							</div>
							<div class="actions">
								<a data-toggle="modal" href="#stackd" class="btn yellow"><i class="icon-plus"></i> اضافة</a>
							</div>

						</div>
						<div class="portlet-body">

							<p id="demod"> </p>

							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>درجة</th>
										<th>رقم القضية</th>
										<th class="hidden-480">صفة العميل</th>
										<th>صفة الخصم</th>
										<th>دائرة</th>
										<th>طابق</th>
										<th>قاعة</th>
										<th>الجهة</th>
										<th>سكرتير</th>
										<th>غرفة سكرتير</th>
										<th>قاضي</th>
										<th>تحكم</th>
									</tr>
								</thead>
								<tbody id="evntsdetails">







								</tbody>
							</table>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>

			</div>
		</div>
	</div>
	<!--end  casedetails --> 


	<!-- caseEvents --> 
	<div id="full-width" class="modal container hide fade" tabindex="-1" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>الاجراءات</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span4">
					<!-- BEGIN CONDENSED TABLE PORTLET-->
					<div class="portlet box grey">
						<div class="portlet-title">
							<div class="caption"><i class="icon-picture"></i>القضايا</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>

							</div>
							<div class="actions">
								<a data-toggle="modal" href="#searchModal" class="btn icn-only blue">بحث<i class="m-icon-swapleft icon-search"></i></a>
								<a  href="addnewcase.php" class="btn yellow"><i class="icon-plus"></i>اضافة</a>

							</div>
						</div>
						<div class="portlet-body">

							<!--BEGIN TABS-->
							<div class="tabbable tabbable-custom">
								<ul class="nav nav-tabs">
									<li id="litabcas" class="active"><a href="#tab_1_1" data-toggle="tab">القضايا</a></li>
									<li id="litabevt"><a href="#tab_1_2" data-toggle="tab">تفاصيل الاجراء</a></li>

								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1_1">

										<table  class="table table-condensed table-hover ">
											<thead>
												<tr>
													<th>#</th>
													<th>الاشخاص</th>
													<th class="hidden-480">الحالة</th>

												</tr>
											</thead>
											<tbody id="getCasesSearch">


											</tbody>
										</table>


									</div>
									<div class="tab-pane" id="tab_1_2">

										<table class="table table-condensed table-hover">
											<thead>
												<tr>

													<th>الاجراء</th>
													<th>التاريخ</th>
													<th class="hidden-480">الحالة</th>

												</tr>
											</thead>
											<tbody id="evntthreads">








											</tbody>
										</table>

									</div>

								</div>
							</div>
							<!--END TABS-->

						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>


				<div class="span8">
					<!-- BEGIN CONDENSED TABLE PORTLET-->


					<div class="portlet box green">
						<div class="portlet-title">
							<div class="caption"><i class="icon-picture"></i>جدول الاجراءات</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>

							</div>
							<div class="actions">
								<a data-toggle="modal" href="#stack1" class="btn yellow"><i class="icon-plus"></i> اضافة</a>
								<a data-toggle="modal" href="#casedetails" class="detail btn red"><i class="icon-reorder"></i> تفاصيل</a>

								<div class="btn-group">
									<a class="btn blue" href="#" data-toggle="dropdown">
										<i class="icon-filter"></i> فلتر
										<i class="icon-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-left">
										<li><a href="#" class="hrrrf" value="4">  جلسات</a></li>
										<li><a href="#" class="hrrrf" value="2">  خبراء</a></li>
										<li><a href="#" class="hrrrf" value="5">  اداري</a></li>
										<li><a href="#" class="hrrrf" value="6">  تنفيز</a></li>
										<li class="divider"></li>
										<li><a href="#" class="hrrrf" value="0"><i class="i"></i> الكل  </a></li>
									</ul>
								</div>
							</div>

						</div>
						<div class="portlet-body">

							<p id="demo"></p>  

							<table class="table table-condensed table-hover">
								<thead>
									<tr>

										<th>الاجراء</th>
										<th>التاريخ</th>
										<th class="hidden-480">نوعه</th>
										<th>تعامل</th>
										<th>تحكم</th>
									</tr>
								</thead>
								<tbody id="evntscase">








								</tbody>
							</table>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>



			</div>
		</div>
	</div>
	<!-- END_caseEvents --> 


	<!-- t3amol --> 
	<div id="t3amol" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		<form id="form101"   method="POST">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3> جديد</h3>
				<input type="hidden" name="idthread">
			</div>
			<div class="modal-body">
				<div class="control-group">
					<div class="controls">
						<select class="span12 m-wrap"  onchange="myevnttypeschange()" id="evntstat"  data-placeholder="Choose a Category" tabindex="1">
							<?php  echo Getceventstat(0);?>  
						</select>
					</div>
				</div>

				<input type="text" name="txevnt2" placeholder="الاجراء" class="m-wrap" data-tabindex="1">
				<div class="input-append" id="ui_date_picker_trigger">
					<input type="text" name="txTheDate2" style="z-index: 10055;" class="pkr m-wrap medium" /><span class="add-on"><i class="icon-calendar"></i></span>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
				<button id="addnewevent2"  type="submit"   class="btn red">اضافة</button>
			</div>
		</form>
	</div>
	<!-- END_t3amol --> 


	<!-- Archive --> 
	<div id="caseArchive" class="modal container hide fade" tabindex="-1" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>الارشيف </h3> 
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span12">
					<div class="tabbable tabbable-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab2_1_1" data-toggle="tab">ارشف القضية</a></li>
							<li><a href="#tab2_1_2" data-toggle="tab">الموكل</a></li>
							<li><a href="#tab2_1_3" data-toggle="tab">الخصم</a></li>
							<a href="#" class="btn yellow mini ">ادارة الارشيف</a>
						</ul>
						<div class="tab-content">


							<div class="tab-pane active" id="tab2_1_1">
								<p>ارشيف القضية الخاص <strong id="coded">s</strong> </p> 
								<form id="upload" method="POST"  mark=""  enctype="multipart/form-data" action="upload.php?typ=1">
									<select class="span2 m-wrap"   name="archtypes" data-placeholder="Choose a Category" tabindex="1">
										<?php  echo GetArchInfo(1);?>  
									</select><br />
									<span class="btn green fileinput-button">
										<i class="icon-plus icon-white"></i>
										<span>اضف ملف</span>
										<input type="file" name="file" class="filex" >
									</span>
									<!-- <input type="file" name="file" id="filex"> -->
									<input type="hidden"  id="archCID" name="archCNM" >
									<!-- 	<input type="submit"> -->
								</form>
								<div  id="progthred" style="display:none;" class="progress green progress-striped active">
									<div id="prog" style="width: 0%;" class="bar"><div id="percent"></div></div>
								</div> 
								<div id="here"></div>
								<table class="table table-striped">
									<tbody id="archtbl1">
									</tbody>
								</table>
							</div>


							<div class="tab-pane" id="tab2_1_2">
								<p>ارشيف الموكل</p>
								<form id="upload2" method="POST" mark="2" enctype="multipart/form-data" action="upload.php?typ=2">
									<select class="span2 m-wrap"   name="archtypes" data-placeholder="Choose a Category" tabindex="1">
										<?php  echo GetArchInfo(2);?>  
									</select><br />
									<span class="btn green fileinput-button">
										<i class="icon-plus icon-white"></i>
										<span>اضف ملف</span>
										<input type="file" name="file" class="filex" >
									</span>
									<!-- <input type="file" name="file" id="filex"> -->
									<input type="hidden"  id="archPID" name="archCNM" >
									<!-- 	<input type="submit"> -->
								</form>
								<div  id="progthred2" style="display:none;" class="progress green progress-striped active">
									<div id="prog2" style="width: 0%;" class="bar"><div id="percent"></div></div>
								</div> 
								<div id="here2"></div>
								<table class="table table-striped">
									<tbody id="archtbl2">
									</tbody>
								</table>
							</div>

							<div class="tab-pane" id="tab2_1_3">
								<p>ارشيف الخصم</p>
								<form id="upload3" method="POST" mark="3" enctype="multipart/form-data" action="upload.php?typ=3">
									<select class="span2 m-wrap"   name="archtypes" data-placeholder="Choose a Category" tabindex="1">
										<?php  echo GetArchInfo(3);?>  
									</select><br />
									<span class="btn green fileinput-button">
										<i class="icon-plus icon-white"></i>
										<span>اضف ملف</span>
										<input type="file" name="file" class="filex" >
									</span>
									<!-- <input type="file" name="file" id="filex"> -->
									<input type="hidden"  id="archEID" name="archCNM" >
									<!-- 	<input type="submit"> -->
								</form>
								<div  id="progthred3" style="display:none;" class="progress green progress-striped active">
									<div id="prog3" style="width: 0%;" class="bar"><div id="percent"></div></div>
								</div> 
								<div id="here3"></div>
								<table class="table table-striped">
									<tbody id="archtbl3">
									</tbody>
								</table>

							</div>

							<div class="well">
								<h3>ملاحظات</h3>
								<ul>
									<li> المساحة القصوى للملف <strong>8 ميغا بايت </strong>.</li>
									<li> متاح رفع جميع انواع الملفات شرط الحد الاقصى للمساحة.</li>
									<li>يمكنك اختيار  <strong>ملف واحد</strong> فقط فى كل مرة تقوم فيها بالرفع.</li>
									<li>من فضلك راجعنا فى حال واجهت اي مشكلة على الرابط التالي <a href="https://github.com/blueimp/jQuery-File-Upload/wiki"> المرجع الرسمي للبرنامج</a>.</li>
								</ul>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div>
	<!--end  Archive person_details--> 


	<!-- person_details --> 
	<div id="person_details" class="modal container hide fade" tabindex="-1" >
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>بيانات الاشخاص<input type="text" id="personid"></h3> 
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span9">

					<div class="portlet box purple">
						<div class="portlet-title">
							<div class="caption"><i class="icon-cogs"></i>سامح</div>
							<div class="tools">

								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>

							</div>
								<div class="actions">
								 
								<a  href="addnewcase.php" class="btn green"><i class="icon-plus"></i>اضافة</a>

							</div>

						</div>
						<div class="portlet-body">
							<div class="row-fluid">
								<div style="padding-right: 20px;" class="form-actions">
									<table id="user" class="table table-bordered table-striped">
										<tbody>
											<tr>
												<td style="width:15%">الاسم</td>
												<td style="width:50%"><a href="#" id="username" data-type="text" data-pk="1" data-original-title="Enter username">superuser</a></td>
												<td style="width:35%"><span class="muted">الاسم بالكامل</span></td>
											</tr>
											<tr>
												<td>الرقم المدني</td>
												<td><a href="#" id="firstname" data-type="text" data-pk="1" data-placement="left" data-placeholder="Required" data-original-title="Enter your firstname"></a></td>
												<td><span class="muted">رقم البطاقة المدية</span></td>
											</tr>
											<tr>
												<td>الجنسية</td>
												<td><a href="#" id="sex" data-type="select" data-pk="1" data-value="" data-original-title="Select sex"></a></td>
												<td><span class="muted">بلد الجنسية</span></td>
											</tr>





										</tbody>
									</table>

								</div>



							</div>


							<div class="row-fluid">	

								<table class="table table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>المعلومة</th>
											<th>البيان</th>
											<th class="hidden-480">التحكم</th>

										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Mark</td>
											<td>Otto</td>
											<td class="hidden-480">
												<a class='btn red' title='' id=''><i class='icon-trash icon-white'></i> حـذف</a>
												<a href=""></a>

											</td>

										</tr>
										<tr>
											<td>2</td>
											<td>Jacob</td>
											<td>Nilson</td>
											<td class="hidden-480">jac123</td>

										</tr>
										<tr>
											<td>3</td>
											<td>Larry</td>
											<td>Cooper</td>
											<td class="hidden-480">lar</td>

										</tr>
										<tr>
											<td>3</td>
											<td>Sandy</td>
											<td>Lim</td>
											<td class="hidden-480">sanlim</td>

										</tr>
									</tbody>
								</table></div>
							</div>
						</div>
					</div>
					<div class="span3" style="border-right:1px solid gray;">


						<!-- BEGIN FORM-->
						<form action="#" class="form-horizontal">
							<div style="padding-right: 20px;">
								<h4><strong>رسالة خاصة</strong></h4>
								<div class="control-group">

									<input type="text" placeholder="الرقم" class="m-wrap medium" />

								</div>
								<div class="control-group">

									<input type="text" placeholder="عنوان الرسالة" class="m-wrap medium" />

								</div>
								<div class="control-group">

									<textarea class="medium m-wrap" placeholder="نص الرسالة"  rows="3"></textarea>

								</div>
							</div>
							<div style="padding-right: 20px;" class="form-actions">
								<button type="submit" class="btn blue"><i class="icon-ok"></i> ارسال</button>
								<button type="button" class="btn">الغاء</button>
							</div>
						</form>
						<!-- END FORM-->  
					</div>
				</div>
			</div>
		</div>
		<!--end   person_details--> 






		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER -->
						<div class="color-panel hidden-phone">
							<div class="color-mode-icons icon-color"></div>
							<div class="color-mode-icons icon-color-close"></div>
							<div class="color-mode">
								<p>THEME COLOR</p>
								<ul class="inline">
									<li class="color-black current color-default" data-style="default-rtl"></li>
									<li class="color-blue" data-style="blue-rtl"></li>
									<li class="color-brown" data-style="brown-rtl"></li>
									<li class="color-purple" data-style="purple-rtl"></li>
									<li class="color-grey" data-style="grey-rtl"></li>
									<li class="color-white color-light" data-style="light-rtl"></li>
								</ul>
								<label>
									<span>Layout</span>
									<select class="layout-option m-wrap small">
										<option value="fluid" selected>Fluid</option>
										<option value="boxed">Boxed</option>
									</select>
								</label>
								<label>
									<span>Header</span>
									<select class="header-option m-wrap small">
										<option value="fixed" selected>Fixed</option>
										<option value="default">Default</option>
									</select>
								</label>
								<label>
									<span>Sidebar</span>
									<select class="sidebar-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
								<label>
									<span>Footer</span>
									<select class="footer-option m-wrap small">
										<option value="fixed">Fixed</option>
										<option value="default" selected>Default</option>
									</select>
								</label>
							</div>
						</div>
						<!-- END BEGIN STYLE CUSTOMIZER --> 
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							شاشة القضايا
							<small>الشاشة الرئيسية</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a> 
								<i class="icon-angle-left"></i>
							</li>
							<li>
								<a href="#">Layouts</a>
								<i class="icon-angle-left"></i>
							</li>
							<li><a href="#">Blank Page</a></li>
						</ul>  
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="row-fluid search-forms search-default">
							<form class="form-search" action="#">
								<div class="chat-form">
									<div class="input-cont">   
										<input type="text" placeholder="بحث..." class="m-wrap" />
									</div>
									<button data-toggle="modal" href="#searchModal" class="btn green">بحث متقدم <i class="m-icon-swapleft icon-search"></i></button>
									<!-- <button type="button" class="btn green">ابحث &nbsp; <i class="m-icon-swapleft m-icon-white"></i></button> -->
								</div>
							</form>
						</div>

						<div class="portlet-body no-more-tables">
							<!-- table table-striped table-hover  -->
							<table id="context" class="table table-striped table-hover  table-advance table-condensed cf">
								<thead class="cf">
									<tr>
										<th style=""><i class="icon-cogs"></i></th>
										<th>كود</th>
										<th>الرقم الآلي</th>
										<th class="numeric">الاشخاص</th>
										<th class="numeric">النوع</th>
										<th class="numeric">الحالة</th>
										<th class="numeric">الموضوع</th>
										<th class="numeric">التاريخ</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									echo $tablerows; ?>


								</tbody></table>



							</div>


			<!-- 	<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption"><i class="icon-briefcase"></i>جدول القضايا</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>

						<div class="actions">
							
							<a  href="addnewcase.php" class="btn yellow"><i class="icon-plus"></i> اضافة</a>

						</div>
					</div>
					
				</div> -->



			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
	<!-- END PAGE CONTAINER--> 
</div>






<?php include('footer.php');?>




<script type="text/javascript">
	function myevnttypeschange() {
		var x = document.getElementById("evnttypes2").value;
		document.getElementById("addnewevent2").innerHTML = "You selected: " + x;
	}


		// $("#tabs").tabs();

		// $("tbody").sortable({
		// 	items: "> tr",
		// 	appendTo: "parent",
		// 	helper: "clone"
		// }).disableSelection();

		// $("#tabs ul li a").droppable({
		// 	hoverClass: "drophover",
		// 	tolerance: "pointer",
		// 	drop: function(e, ui) {
		// 		var tabdiv = $(this).attr("href");
		// 		$(tabdiv + " table tr:last").after("<tr>" + ui.draggable.html() + "</tr>");
		// 		ui.draggable.remove();
		// 	}
		// });
	</script>





	<script>
		$(document).ready(function(e){


			$.urlParam = function(name){
				var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
				if (results==null){
					return null;
				}
				else{
					return results[1] || 0;
				}
			}

			if ($.urlParam('mark')==1){
				reload_caceevents($.urlParam('cccd'),0);
				$('#full-width').modal('show'); 
			};


			$('.editCase').click(function(){
				Edit_case($(this).attr("id"));
			});

			$('.evnts').live("click",function(){
				reload_caceevents($(this).attr("id"),0);
				reload_CasesSearch();
			});


			$('.evnts2').live("click",function(){
				reload_caceevents($(this).attr("id"),0);
				$("#getCasesSearch tr").removeAttr("style")
				$(this).closest( "tr" ).css("background-color","#D5D5D2");
			});


			$('.detail').live("click",function(){
				reload_cacedetails($(this).attr("id"));
			});

			$('.hrrrf').click(function(){
				reload_caceevents($("#hddnCID").val(),$(this).attr("value"));
			});

			$('.DetailsEv').live("click",function(){
				reload_eventsthreads($(this).attr("value"));
			});


			$('.archivedel').live("click",function(){
				var mark = $(this).attr("mark");
				 //alert($(this).attr("id") +"OO"+mark);
				 delete_Arcive($(this).attr("id"),$(this).attr("mark"));
				});

			$('.archive').live("click",function(){
				$("#archCID").val($(this).attr("id"));
				$("#coded").text($(this).closest('tr').find('td:eq(1)').text());
				reload_Arcive($(this).attr("id"),1);
				reload_Arcive($(this).attr("id"),2);
				reload_Arcive($(this).attr("id"),3);
				$("#archPID").val($(this).closest('tr').find('#spCustID').attr("title"));
				$("#archEID").val($(this).closest('tr').find('#spEnID').attr("title"));
			});


			$(".filex").live('change',function(e)
			{

				
				var sel =  $(this).closest('form').find('select').val();
				if (sel=='')
					{alert("اختر اسم المرفق اولا ...!");$(this).val("");}

				else{

					e.preventDefault();   
					var mark = $(this).closest('form').attr("mark");
				   //
				   $("#"+$(this).closest('form').attr("id")).ajaxSubmit(
				   {
				   	beforeSend:function()
				   	{
				   		$("#progthred"+mark).fadeIn(200);
				   		$("#prog"+mark).css( "width", "0" );
				   	},
				   	uploadProgress:function(event,position,total,percentCompelete)
				   	{
				   		$("#prog"+mark).css('width',percentCompelete+'%'); 
				   		$("#percent"+mark).html(percentCompelete+'%');
				   	},
				   	success:function(data)
				   	{

				   		$("#here"+mark).html(data);
				   		$("#here"+mark).fadeIn(1);
				   		reload_Arcive($("#archCID").val(),1);
				   		reload_Arcive($("#archCID").val(),2);
				   		reload_Arcive($("#archCID").val(),3);
				 		//$("#prog"+mark).css( "width", "0" );
				 		$("#progthred"+mark).delay( 2000 ).fadeOut(1000);
				 		$("#here"+mark).delay( 4000 ).fadeOut(1000);



				 	}
				 });

				}
			});


			$('.persons').live("click",function(){
				$("#personid").val($(this).attr("id"));
			});





		});
//------------------delete arcive case--------------------archivedel
function delete_Arcive(idf,artyp){
	//alert(idf+"OOO"+artyp);
	$.ajax({
		type: "POST",
		url:'delArchive.php',
		dataType: 'html', 
		data: {CaseID: idf ,artyp:artyp},
		success: function (data) {
//alert(data);
reload_Arcive($("#archCID").val(),artyp);
},
error: function (msg) {alert('sameh_ERROR');}
});
}

//------------------get Archive data---------------------
function reload_Arcive(idf,artyp){
	$.ajax({
		type: "POST",
		url:'getArchive.php',
		dataType: 'html', 
		data: {CaseID:"'" + idf + "'",artyp:artyp},
		success: function (data) {

			$('#archtbl'+artyp).html('');
			$('#archtbl'+artyp).append(data);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
}

//--------------  get Cases Search --------------------
function reload_CasesSearch() {

	$.ajax({
		type: "POST",
		url:'getCasesSearch.php',
		dataType: 'html', 
		data: {seID:<?php echo $_SESSION['seid']; ?>},
		success: function (data) {

			$('#getCasesSearch').html('');
			$('#getCasesSearch').append(data);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};



//--------------  delete event --------------------

$('.evdel').live("click",function(){
	if (confirm('سيتم حذف ' + $(this).attr("value"))) {
		$.ajax({
			type: 'POST',
			url:'deleteevnt.php',
			data: {CaseID:$(this).attr("value")},
				//dataType: 'json',16089
				success: function (data) {
					reload_caceevents($("input[name='HiddenCaseID']").val(),0);
				},
				error: function (data) {alert('sameh_ERROR');}
			});
		alert('تم الحذف');
	} else {

		alert('تمم التراجع عن الحذف');
	}

});


//--------------  get events --------------------
function reload_caceevents(idf,evtyp) {

	var CaseID = idf; 

	var str;
	$.ajax({
		type: "POST",
		url:'getCaseevents.php',
		dataType: 'html',

		data: {CaseID:"'" + CaseID + "'",fnc:'getevnt',evtyp:  evtyp  }, 
		success: function (data) {

			$('#evntscase').html('<input id="hddnCID" name="HiddenCaseID" value="'+ CaseID +'" type="hidden" />');

			$('#evntscase').append(data);

	alert($("#hddnCID").val());

	//$('tr[class^=child-]').hide().children('td');

},
error: function (msg) {alert('sameh_ERROR');}
});
};


//--------------  get case detals --------------------
function reload_cacedetails(idf) {
	debugger
	var CaseID = idf; 
	if (idf === undefined){CaseID=$("#hddnCID").val();}

	var str;
	$.ajax({
		type: "POST",
		url:'getCaseDetails.php',
		dataType: 'html',

		data: {CaseID:"'" + CaseID + "'",fnc:'getdetl'  }, 
		success: function (data) {

			$('#evntsdetails').html('<input id="hddnCIDdet" name="HiddenCaseIDdet" value="'+ CaseID +'" type="hidden" />');

			$('#evntsdetails').append(data);



		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};


//--------------  get case for edit--------------------
function Edit_case(idf) {

			var CaseID = idf; //$(this).attr("id");
			var str;
			$.ajax({
				type: "POST",
				url:'geteditcase.php',
				dataType: 'json',
				data: {CaseID:"'" + CaseID + "'",fnc:'getevnt'}, 
				success: function (data) {

					$('#evntscase').html('<input name="HiddenCaseeditID" value="'+ CaseID +'" type="hidden" />');

					

					$("input[name='cid2']").val(data[0][0]); 
					$("input[name='Code']").val(data[0][8]); 
					$("input[name='AutoNumber']").val(data[0][7]); 
					$("input[name='sName']").val(data[0][2]); 
					$("input[name='sName2']").val(data[0][3]); 
					$("input[name='subject']").val(data[0][1]); 
					$("input[name='TheDate']").val(data[0][11]); 
					$("input[name='StateName']").val(data[0][6]); 
					$("input[name='CaseTypeName']").val(data[0][5]); 
					$("input[name='LaterDate']").val(data[0][10]); 
					$("input[name='PaperType']").val(data[0][4]); 
					$("input[name='mon']").val(data[0][9]); 






				},
				error: function (msg) {alert('sameh_ERROR');}
			});
		};
//--------------add new Evnt--------------------
$('#form1').submit(function(e) {
	e.preventDefault();

	var CaseIDv = $("input[name='HiddenCaseID']").val();
	var evntnm = $("input[name='txevnt']").val();
	var evnttype = $("#evnttypes option:selected").val();
	var datevalue = $("input[name='txTheDate']").val();




	$.ajax({
		type: 'POST',
		url:'addevnt.php',

		data: {CaseID:CaseIDv,evnt:evntnm,evnttype:evnttype,TheDate:datevalue},
				//dataType: 'json',
				success: function (data) {

					reload_caceevents(CaseIDv);
					$('#stack1').modal('hide'); 

				},
				error: function (data) {alert('sameh_ERROR');}
			});
});


//--------------   event evthread id--------------------
$('.evthread').live("click",function(){
	$("input[name='idthread']").val($(this).attr("value"));
});


//--------------add new Event threads--------------------
$('#form101').submit(function(e) {
	e.preventDefault();

	var CaseIDv = $("input[name='HiddenCaseID']").val();
	var evntnm = $("input[name='txevnt2']").val();
	var evntstat = $("#evntstat option:selected").val();
	var datevalue = $("input[name='txTheDate2']").val();
	var idthread = $("input[name='idthread']").val();



	$.ajax({
		type: 'POST',
		url :'addeventthreads.php',

		data: {CaseID:CaseIDv,evnt:evntnm,evntstat:evntstat,TheDate:datevalue,idthread:idthread},
				//dataType: 'json',
				success: function (data) {

					reload_caceevents(CaseIDv);
					$('#t3amol').modal('hide'); 
					reload_eventsthreads(idthread);

					$('#tab_1_2').addClass("active");
					$('#tab_1_1').removeClass("active"); 
					$('#litabevt').addClass("active");
					$('#litabcas').removeClass("active");
				},
				error: function (data) {alert('sameh_ERROR');}
			});
});


//--------------get Event threads--------------------

function reload_eventsthreads(idf){

	var CaseID = idf; 

	var str;
	$.ajax({
		type: "POST",
		url:'getEventThreads.php',
		dataType: 'html',

		data: {CaseID:"'" + CaseID + "'"}, 
		success: function (data) {

			//$('#evntscase').html('<input id="hddnCID" name="HiddenCaseID" value="'+ CaseID +'" type="hidden" />');
			$('#evntthreads').html('');
			$('#evntthreads').append(data);

			$('#tab_1_2').addClass("active");
			$('#tab_1_1').removeClass("active"); 
			$('#litabevt').addClass("active");
			$('#litabcas').removeClass("active");


	//$('tr[class^=child-]').hide().children('td');

},
error: function (msg) {alert('sameh_ERROR');}
});

};





</script> 

<script type="text/javascript">
	$(function() {
		$('tr.parent')
		.css("cursor","pointer")
		.attr("title","Click to expand/collapse")
		.live("click",function(){
			$(this).siblings('.child-'+this.id).toggle();
		});
	});

</script>


