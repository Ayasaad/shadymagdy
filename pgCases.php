<?php    
session_start();
include('config.php');
//include('init.php');




// if($_SERVER['REQUEST_METHOD'] == "POST")  
// 	{$_SESSION['seid']=1;
// }
// else{
//$_SESSION['seid']=0;
// }

 //if (empty($_SESSION['seid'])) {$_SESSION['seid']= 0;}





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
ON (`usersinroles`.`UserID` = `users`.`id`) WHERE `users`.`id`= ". $_SESSION['USID'];

$qury= mysql_query($ssql);
$roles = array();
while($roow = mysql_fetch_assoc($qury))
{
	$roles[] = $roow['RoleName'];
}
if (!in_array("مدير عام على النظام", $roles))   { 
	if (!in_array("شاشة عرض القضايا", $roles)) {
		header('Location: notpermeted.php');
	}
}   
//if (!in_array("مدير عام على النظام", $roles) or in_array("شاشة عرض القضايا", $roles))  {  header('Location: notpermeted.php'); } 
//echo "sameh" . $_SESSION['USID']; 
//session_destroy();

//if (!in_array("مدير عام على النظام", $roles) or in_array("شاشة عرض القضايا", $roles))  {  header('Location: notpermeted.php'); } 



include('header.php');
include('fldReports/courtsdrp.php');
include('search.php');
include('popCaseevents.php');
include('dbop.php');



?>



<!--  searchModal -->
<div id="searchModal" class="modal hide fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>البحث في القضايا</h3>
	</div>
	<form id="formsearh" action="getCasesSearchAjax.php" method="POST" id="sermod">
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




<!-- add New_person --> 
<div id="New_person" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form110"   method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> جديد</h3>
			<input type="hidden" id="perstype">
		</div>

		<div class="modal-body">
			<input type="" name="pname" placeholder="الاسم"><br/>
			<input type="" name="idnum" placeholder="الرقم المدني"><br />



			<div class="control-group">

				<div class="controls">
					<select class="span6 m-wrap" name="category"  id="persnat" >
						<?php  echo GetPersnation();?>  
					</select>
				</div>
			</div>



		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
			<button id="addnewepers"  type="submit"   class="btn red">اضافة</button>
		</div>
	</form>
</div>
<!-- END_add New person --> 



<!--editCase -->
<div id="static" class="modal hide fade" tabindex="-1" data-width="760" data-backdrop="static" data-keyboard="false">
	<form id="form116" action="editcase.php"   method="POST">
		<div class="modal-body">
			<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="span6">
						<h4>Some Input</h4>
						<p><input name="cid2" type="hidden" class="span12 m-wrap"></p>
						<p>كود<input name="Code" type="text" class="span12 m-wrap"></p>
						<p>الالي<input id="AutoNumber" name="AutoNumber" type="text" class="span12 m-wrap"></p>
						<p><input type="text" autocomplete="off"  name="sName" placeholder="العميل"  class="span12 m-wrap"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data; ?>" /></p>
						<p><input type="text" autocomplete="off"  name="sName2" placeholder="الخصم"  class="span12 m-wrap"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data2; ?>" /></p>

						<p>الموضوع<input name="subject" type="text" class="span12 m-wrap"></p>
						<p>التاريخ<input name="TheDate" type="text" class="span12 m-wrap"></p>
					</div>
					<div class="span6">
						<h4>Some More Input</h4>
						<p>الحالة<select class="span12 m-wrap required" name="ctstats" id="casestateid"  data-placeholder="Choose a Category" tabindex="1">
							<?php  echo Getcstates(0);?>
						</select></p>
						<p>النوع<select class="span12 m-wrap required" name="ctypes" id="casetypeeid"  data-placeholder="Choose a Category" tabindex="1">
							<?php  echo Getctypes(0);?>
						</select></p>
						<p>الخطاب<input name="LaterDate" type="text" class="span12 m-wrap"></p>
						<p>السند<input name="PaperType" type="text" class="span12 m-wrap"></p>
						<p>الشكوى<input name="mon" type="text" class="span12 m-wrap"></p>

					</div>
				</div>

			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">الغاء</button>
			<button type="submit"  class="btn green">حفظ التعديل</button>
		</div>
	</form>
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
							<a  class="btn yellow casdetAdd" data-toggle="modal"   data-target="#Add_det" ><i class="icon-plus"></i> اضافة</a>
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

<!-- END_caseEvents --> 


<!-- t3amol --> 
<div id="t3amol" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form101"   method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> تعامل</h3>
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






<!-- editpersinfo --> 
<div id="editpersinfo" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="formeditpersinfo"   method="POST" action="editpersinfo.php">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> تعديل بيانات شخص</h3>
			<input type="hidden" name="idthread">
		</div>
		<div class="modal-body">


			<div>
				<input  type="text" name="usernameid" ><br>
				<input type="text" name="username" ><br>
				<input type="text" name="firstname"><br>
				<select class="span12 m-wrap"  name="persnatselc"  id="persnatselc"  data-placeholder="اختر" tabindex="1">
					<?php echo GetPersnation(0);  ?> 
				</select>
			</div>



		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
			<button id="addnewevent2"  type="submit"   class="btn red">تعديل</button>
		</div>
	</form>
</div>
<!-- END_editpersinfo -->








<!-- commercial --> 
<div id="commercial" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form1202"   method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> الاعلانات</h3>
			<input type="hidden" name="idthread">
		</div>

		<div class="modal-body">
			<!-- BEGIN SAMPLE TABLE PORTLET-->
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption"><i class="icon-comments"></i>جدول الاعلانات</div>
					<div class="tools">
						<a href="javascript:;" class="collapse"></a>
						<a href="#portlet-config" data-toggle="modal" class="config"></a>
						<a href="javascript:;" class="reload"></a>
						<a href="javascript:;" class="remove"></a>
					</div>
					<div class="actions">
						<a data-toggle="modal" href="#Addcommer" class="btn yellow"><i class="icon-plus"></i> اضافة</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>حالة الاعلان</th>

							</tr>
						</thead>
						<tbody id="commercialdata">


						</tbody>
					</table>
				</div>
			</div>
			<!-- END SAMPLE TABLE PORTLET-->
		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>

		</div>
	</form>
</div>
<!-- END_commercial -->




<!-- Addcommer -->
<div id="Addcommer" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form1150" action="AddnewCommer.php"  method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>اضافة اعلان</h3>
			<input id="HiddenCaseIDFcomm" name="HiddenCaseIDFcomm"  type="hidden" />
		</div>
		<div class="modal-body">

			<div class="control-group">
				<div class="controls">
					<select class="span12 m-wrap"   id="commerstate" name="commerstate" data-placeholder="Choose a Category" tabindex="1">
						<?php  echo Getcommerstate(0);?>  
					</select>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
			<button id="addnewevent2"  type="submit"   class="btn red">اضافة</button>
		</div>
	</form>
</div>
<!-- End Addcommer -->






<!-- redirect --> 
<div id="redirect" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form115" action="redirect.php"  method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>توجيه الاجراء</h3>
			<input type="hidden" id="rediid" name="rediid" >
		</div>
		<div class="modal-body">

			<div class="control-group">
				<div class="controls">
					<select class="span12 m-wrap"   id="userre" name="userre" data-placeholder="Choose a Category" tabindex="1">
						<?php  echo GetUsers(0);?>  
					</select>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
			<button id="addnewevent2"  type="submit"   class="btn red">توجيه</button>
		</div>
	</form>
</div>
<!-- END_redirect -->  





<!-- groups --> 
<div id="groups" class="modal hide fade container" tabindex="-1" data-focus-on="input:first">
	<form id="form101"   method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3>شاشة المجموعات</h3>
			<input type="hidden" name="idthread">
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="span12">

					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption"><i class="icon-picture"></i>جدول المجموعات</div>
							<div class="tools">
								<a href="javascript:;" class="collapse"></a>
								<a href="#portlet-config" data-toggle="modal" class="config"></a>
								<a href="javascript:;" class="reload"></a>

							</div>
							<div class="actions">
								<a  class="btn yellow casdetAdd" data-toggle="modal"   data-target="#addgroup" ><i class="icon-plus"></i> انشاء مجموعة</a>
							</div>

						</div>
						<div class="portlet-body">

							<p id="demod"> </p>

							<table class="table table-condensed table-hover">
								<thead>
									<tr>
										<th>#</th>
										<th>الكود</th>
										<th>اسم المجموعة</th>

										<th><i class="icon-plus"></i></th>
										<th><i class="icon-eye-open"></i></th>

									</tr>
								</thead>
								<tbody id="groupsdata">







								</tbody>
							</table>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>

			</div>
		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>

		</div>
	</form>
</div>
<!-- END_groups -->



<!-- addgroup --> 
<div id="addgroup" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="frmaddgroup"   method="POST" action="addgroup.php">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> انشاء مجموعة</h3>
			<input type="hidden" name="idthread">
		</div>
		<div class="modal-body">
			<div class="control-group">
				<div class="controls">

				</div>
			</div>
			<input type="text" name="txevnt1" placeholder="رمز المجموعة" class="m-wrap" data-tabindex="1">
			<input type="text" name="txevnt02" placeholder="اسم المجموعة الجديدة" class="m-wrap" data-tabindex="1">
			<input type="text" name="txevnt3" placeholder="وصف المجموعة" class="m-wrap" data-tabindex="1">
		</div>

		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
			<button id="addnewevent2"  type="submit"   class="btn red">انشاء</button>
		</div>
	</form>
</div>
<!-- END_addGroup -->





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
						<a href="pgArchive1.php" class="btn yellow mini ">ادارة الارشيف</a>
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
		<h3>بيانات الاشخاص<input type="hidden" id="personid"></h3> 
	</div>
	<div class="modal-body">
		<div class="row-fluid">
			<div class="span9">

				<div id="perstableinfo" class="portlet box purple">
					<div class="portlet-title">
						<div class="caption"><i class="icon-cogs"></i>جدول بيانات الشخص</div>
						<div class="tools">

							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>

						</div>
						<div class="actions">

							<a   data-toggle="modal" href="" data-target="#AddPersonInfo"  class="btn green"><i class="icon-plus"></i>اضافة</a>

						</div>

					</div>
					<div class="portlet-body">
						<div class="row-fluid">
							<div style="padding-right: 20px;" class="form-actions">
								<table id="user" class="table table-bordered table-striped">
									<tbody id="persinftbl" >




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
								<tbody id="perstbl">

								</tbody>
							</table></div>
						</div>
					</div>
				</div>
				<div class="span3" style="border-right:1px solid gray;">


					<!-- BEGIN FORM-->
					<form id="form108" action="#" class="form-horizontal">
						<div style="padding-right: 20px;">
							<div id="smsstate"></div>
							<h4><strong>رسالة خاصة</strong></h4>

							<div class="control-group">

								<input type="text" placeholder="الرقم" style="text-align: left;" id="smsNumber" class="span8" />
								<input type="text" name="" class="span3" id="smsKeyNumber" value="00965">

							</div>
							<div class="control-group">

								<input type="hidden" placeholder="عنوان الرسالة" id="smsTitle" class="m-wrap medium" />
								<textarea class="medium m-wrap" placeholder="نص الرسالة" id="smsSubject"  rows="3"></textarea>
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


	<!-- AddPersonInfo --> 
	<div id="AddPersonInfo" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		<form id="form107"   method="POST" action="addPersInfo.php">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>اضافة معلومة جديدة</h3>
				<input type="hidden" name="persidd" id="persidd">
			</div>
			<div class="modal-body">
				<div class="control-group">
					<div class="controls">
						<select class="span12 m-wrap"  onchange="myevnttypeschange()" name="persinfotyp"  data-placeholder="Choose a Category" tabindex="1">
							<?php  echo GetPersInfotype();?>  
						</select><input type="text"  name="persinfodet" placeholder="البيان" class="m-wrap" data-tabindex="1">
					</div>
				</div>



			</div>

			<div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
				<button id="addnewevent2"  type="submit"   class="btn red">اضافة</button>
			</div>
		</form>
	</div>
	<!-- END_AddPersonInfo --> 



	<!-- edit Event --> 
	<div id="edit_Event" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
		<form id="form112"   method="POST" action="GetEventByID.php">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h3>تعديل الاجراء</h3>
				<input type="hidden" name="evidd" id="evidd">
			</div>
			<div class="modal-body">

				<div class="control-group">
					<div class="controls" id="evnteditdata">
						<input type="text" name="evt"  id="evt" placeholder="الاجراء"  class="m-wrap" data-tabindex="1">
						<div class="input-append"  id="ui_date_picker_trigger">
							<input type="text" id="evtdt" name="evtdt" style="z-index: 10055;" class="pkr m-wrap medium" /><span class="add-on"><i class="icon-calendar"></i></span>
						</div>
						<select class="span12 m-wrap"  name="EventType"  id="EventType"  data-placeholder="Choose a Category" tabindex="1">
							<?php echo GetEventTypeselec(0);  ?> </select></div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
						<button id="editevntid"  type="submit"   class="btn red">حفظ</button>
					</div>
				</form>
			</div>
			<!-- END_edit Event --> 






			<!--  edit_det --> 
			<div id="edit_det" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
				<form id="form113"   method="POST" action="edtdetByID.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h3>تعديل التفاصيل</h3>
						<input type="hidden" name="ccidd" id="ccidd">
					</div>
					<div class="modal-body">

						<div class="control-group">
							<div class="controls"  >
								<select class="span12 m-wrap"  name="detposf"  id="detposf"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getcpositions(0);  ?> 
								</select>
								<input type="text" name="detcnumber"  id="detcnumber" placeholder="رقم القضية"  class="m-wrap" data-tabindex="1">
								<select class="span12 m-wrap"  name="detperspos"  id="detperspos"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getpersonpos(0);  ?> 
								</select>
								<select class="span12 m-wrap"  name="detperspos2"  id="detperspos2"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getpersonpos(0);  ?> 
								</select>
								<input type="text" name="detcercil" id="detcercil" placeholder="دائرة"  class="m-wrap" data-tabindex="1">
								<input type="text" name="detflor"   id="detflor" placeholder="طابق"  class="m-wrap" data-tabindex="1">
								<input type="text" name="dethall"   id="dethall" placeholder="قاعة"  class="m-wrap" data-tabindex="1">
								<select class="span12 m-wrap"  name="detcourt"  id="detcourt"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo GetCourts(0);  ?> 
								</select>
								<input type="text" name="detsecrt"  id="detsecrt" placeholder="سكرتير"  class="m-wrap" data-tabindex="1">
								<input type="text" name="detgu"  id="detgu" placeholder="قاضي"  class="m-wrap" data-tabindex="1">
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
						<button id="editcctid"  type="submit"   class="btn red">حفظ</button>
					</div>
				</form>
			</div>
			<!-- END_edit_det --> 


			<!--  AddNew_det --> 
			<div id="Add_det" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
				<form id="form114"   method="POST" action="AddNewDet.php">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h3>اضافة التفاصيل</h3>
						<input type="hidden" name="ccidd2" id="ccidd2">

					</div>
					<div class="modal-body">

						<div class="control-group">
							<div class="controls" >
								<select class="span12 m-wrap"  name="detposf2"  id="detposf2"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getcpositions(0);  ?> 
								</select>
								<input type="text" name="detcnumber2"  id="detcnumber2" placeholder="رقم القضية"  class="m-wrap" data-tabindex="1">
								<select class="span12 m-wrap"  name="detperspos2"  id="detperspos2"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getpersonpos(0);  ?> 
								</select>
								<select class="span12 m-wrap"  name="detperspos22"  id="detperspos22"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo Getpersonpos(0);  ?> 
								</select>
								<input type="text" name="detcercil2" id="detcercil2" placeholder="دائرة"  class="m-wrap" data-tabindex="1">
								<input type="text" name="detflor2"   id="detflor2" placeholder="طابق"  class="m-wrap" data-tabindex="1">
								<input type="text" name="dethall2"   id="dethall2" placeholder="قاعة"  class="m-wrap" data-tabindex="1">
								<select class="span12 m-wrap"  name="detcourt2"  id="detcourt2"  data-placeholder="Choose a Category" tabindex="1">
									<?php echo GetCourts(0);  ?> 
								</select>
								<input type="text" name="detsecrt2"  id="detsecrt2" placeholder="سكرتير"  class="m-wrap" data-tabindex="1">
								<input type="text" name="detgu2"  id="detgu2" placeholder="قاضي"  class="m-wrap" data-tabindex="1">
							</div>
						</div>

					</div>

					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn">اغلاق</button>
						<button id="addcctid"  type="submit"   class="btn red">اضافة</button>
					</div>
				</form>
			</div>
			<!-- END_AddNew_det --> 

			

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
							<ul class="breadcrumb" style="    margin: 0 0 1px;">
								<li>
									<i class="icon-home"></i>
									<a href="index.php">الرئيسية</a> 
									<i class="icon-angle-left"></i>
								</li>
								<li>
									<a href="#">القضايا</a>
									<i class="icon-angle-left"></i>
								</li>
								<li><a href="pgCases.php">عرض القضايا</a></li>
							</ul>  
							<!-- END PAGE TITLE & BREADCRUMB-->
						</div>
					</div>
					<!-- END PAGE HEADER-->
					<div class="btn-toolbar" style="float: right;margin-top: 0;margin-bottom: 0">
						<div class="btn-group">
							<a class="btn red mini" title="'.$row["ID"].'"  href="#" data-toggle="dropdown">
								<i class="icon-print"></i> طباعة
								<i class="icon-angle-down"></i>
							</a>
							<ul class="dropdown-menu" >
								<li><a href="#" class="printCases" id="printCases" title="طباعة القضايا المحددة"><i class="icon-file"></i>طباعة بيانات القضايا</a></li>
								

							</ul>
						</div>
					</div>


					<a href="#" class="btn yellow mini evnts" id="rungroups" value="<?php $_SESSION['USID'];?>" data-toggle="modal" data-target="#groups"  style="float: right;">المجموعات</a>
					<!-- BEGIN PAGE CONTENT-->
					<div class="row-fluid">
						<div class="span12">
							<div class="row-fluid search-forms search-default">
								<form class="form-search" action="#">

									<div class="chat-form">
										<div class="input-cont">   
											<input id="txtSearsh" type="text" placeholder="بحث... 'ابحث بسرعة عن عميل او كود او نوع او حالة او رقم الي'" class="m-wrap" />
											
										</div>


										<button data-toggle="modal" href="#searchModal" class="btn green">بحث متقدم <i class="m-icon-swapleft icon-search"></i></button>
										<!-- <button type="button" class="btn green">ابحث &nbsp; <i class="m-icon-swapleft m-icon-white"></i></button> -->
									</div>
								</form>
							</div>
							<a   id="addfastcase"  class="btn blue btn-block"><i class="m-icon-swapleft icon-time"></i> اضافة سريعة</a>
							
							<!--  AddNew_Case_Fast --> 
							<div id="adnewcasediv" style=" display:none">


								<!-- BEGIN VALIDATION STATES-->
								<div class="portlet box purple">
									<div class="portlet-title">
										<div class="caption"><i class="icon-reorder"></i>اضافة قضية سريعة</div>
										<div class="tools">
											<a href="javascript:;" class="collapse"></a>
											<a href="#portlet-config" data-toggle="modal" class="config"></a>
											<a href="javascript:;" class="reload"></a>

										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form method="POST" action="savecaseFast.php" id="form_sample_o1" class="form_sample_1 form-horizontal">
											<div class="alert alert-error hide">
												<button class="close" data-dismiss="alert"></button>
												لديك معلومات غير مكتملة.
											</div>
											<div class="alert alert-success hide">
												<button class="close" data-dismiss="alert"></button>
												تمت الاضافة بنجاح!
											</div>
											<div class="control-group">
												<label class="control-label">الرقم الالي</label>
												<div class="controls">
													<input type="text" name="autonumber" data-required="1" class="span6 m-wrap"/>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">اسم العميل<span class="required">*</span></label>
												<div class="controls">

													<input type="text" name="cust" placeholder="العميل"  class="span6 m-wrap required"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data; ?>" /> 

													<span class="help-inline">قدم اسم العميل</span>
													<a  data-toggle="modal" cat="1" href="" class="addprs" data-target="#New_person" >(جديد)</a>

												</div>
											</div>
											<div class="control-group">
												<label class="control-label">اسم الخصم<span class="required">*</span></label>
												<div class="controls">
													<input type="text" name="enm" placeholder="الخصم"  class="span6 m-wrap required"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data2; ?>" /> 
													<span class="help-inline">قدم اسم الخصم</span>
													<a  data-toggle="modal" href="" cat="2" class="addprs"  data-target="#New_person" >(جديد)</a>
												</div>
											</div>	

											<div class="control-group">
												<label class="control-label">الدرجة<span class="required">*</span></label>
												<div class="controls">
													<select class="span6 m-wrap required" name="cpositions"   data-placeholder="Choose a Category" tabindex="1">
														<?php  echo Getcpositions(0);?>
													</select>
													<span class="help-inline">قدم الدرجة </span>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">حالة<span class="required">*</span></label>
												<div class="controls">
													<select class="span6 m-wrap required" name="cstates"   data-placeholder="Choose a Category" tabindex="1">
														<?php  echo Getcstates(0);?>
													</select>
													<span class="help-inline">قدم الحالة</span>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">الجهة<span class="required">*</span></label>
												<div class="controls">
													<select class="span6 m-wrap required" name="Courts"  data-placeholder="Choose a Category" tabindex="1">
														<?php  echo GetCourts(0);?>
													</select>
													<span class="help-inline">قدم الجهة </span>
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">الموضوع  <span class="required">*</span></label>
												<div class="controls">
													<input type="text" name="subject"  class="span6 m-wrap required" />
													<span class="help-inline">قدم الموضوع </span>
												</div>
											</div>



											<div class="form-actions">
												<button type="submit" class="btn purple">اضافة</button>
												<button type="button" class="btn">الغاء</button>

											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
								<!-- END VALIDATION STATES-->
							</div>
							
							<!-- END_Case_Fast --> 


							<div id="casesmaster" class="portlet-body no-more-tables">
								<!-- table table-striped table-hover  -->





							</div>






						</div>
					</div>
					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER--> 
			</div>



			<style>
				@media screen and (max-width:300px){

				}
			</style>


			<?php include('footer.php');?>




			<script type="text/javascript">
				function myevnttypeschange() {
					var x = document.getElementById("evnttypes2").value;
					document.getElementById("addnewevent2").innerHTML = "You selected: " + x;
				}

			</script>





			<script>
				$(document).ready(function(e){



					//alert(valrut[0].sName);


					if ($.urlParam('mark')==1){
						loadCases2($.urlParam('cccd'));
						reload_caceevents($.urlParam('cccd'),0);
						
						$('#full-width').modal('show'); 
					}else{
						loadCases1();
						

					};









						//executes code below when user click on pagination links prtevthread
						$(".pageelm").live("click",   function (e){
							e.preventDefault();
							$(".loading-div").show(); //show loading element
							var page = $(this).attr("data-page"); //get page number from link
							loadCases1(page); 


						});



						$(".addprs").on("click",function () {
							$("#perstype").val($(this).attr("cat"));
						})



						$(".edpersinf").live("click",function () {


							$("#editpersinfo").find("input[name='usernameid']").val($(this).attr('value'));
							$("#editpersinfo").find("input[name='username']").val($(this).closest('table').find('#username').text());
							$("#editpersinfo").find("input[name='firstname']").val($(this).closest('table').find('#firstname').text());
							vvlselpers = $(this).closest('table').find('#sex').attr('value')
							$('#persnatselc option[value='+ vvlselpers +']').attr('selected','selected');

							//$("#editpersinfo").find("input[name='sex']").val( $(this).closest('table').find('#sex').text());
							

						})






						$('.editCase').live("click",function(){
							var evid =  $(this).attr("id");
							Edit_case(evid);

							$('#casestateid option[value='+ $("#csStatid" + evid  ).attr("value") +']').attr('selected','selected');
							$('#casetypeeid option[value='+ $("#cstypeid" + evid  ).attr("value") +']').attr('selected','selected');
						});


						$('.casetr').live("click",function(){
							
							vvl = $(this).attr("value"); 
							if ($(this).find('#chck_'+ vvl).attr("checked")) {
								$(this).find('#chck_'+ vvl).prop('checked', false);
								$(this).find('#light_'+ vvl).removeClass( "success" );
							}else{
								$(this).find('#chck_'+ vvl).prop('checked', true);
								$(this).find('#light_'+ vvl).addClass( "success" );
							}

						});



						$('.printCases').live("click",function(){
							
							
							ids='';
							$('.chkkinp').each(function(){
								if ($(this).attr("checked")) {
									if (ids=='') {ids =  $(this).val();}
									else{ids = ids + ',' + $(this).val();}
								}
							});


							loadCases2(ids);window.open("fldReports/repPrintInfo.php");
							
						});


						$(".prtevthread").live("click",function () {
							idr = $(this).closest('tr').attr('id');
							window.open('fldReports/repAlertpaper.php?thread='+idr , 'window name', 'window settings');
						})


						$('.evnts').live("click",function(){
							vvl = $(this).attr("id") ;



							$(this).closest('table').find('.chkkinp').prop('checked', false);
							$(this).closest('table').find('.success').removeClass("success");
							$(this).closest('tr').find('#light_'+ vvl).addClass("success");



							reload_caceevents($(this).attr("id"),0);
							reload_CasesSearch();



						});
						//$('#adnewcasediv').animate({display: 'none'});

						$('#addfastcase').live("click",function(){
							
							$("#adnewcasediv").toggle("slow");  

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


						$('.commer').live("click",function(){

							reload_commerdata($(this).attr("id"));
						});



						// 


						$('.viewgroup').live("click",function(){
							$.ajax({
								type: "POST",
								url:'displaygroup.php',
								dataType: 'html', 
								data: {gids:$(this).attr("id")},
								success: function (data) {
									// $('#persinftbl').html('');
									// $('#persinftbl').append(data);
									loadCases2(data);
								},
								error: function (msg) {alert('sameh_ERROR');}
							});
							
						});





						$('.adtogroup').live("click",function(){
							ids='';
							$('.chkkinp').each(function(){
								if ($(this).attr("checked")) {
									if (ids=='') {ids =  $(this).val();}
									else{ids = ids + ',' + $(this).val();}
								}
							});
							//alert(ids);
							$.ajax({
								type: "POST",
								url:'adcastogroup.php',
								dataType: 'html', 
								data: {cids: ids,gids:$(this).attr("id")},
								success: function (data) {
									// $('#persinftbl').html('');
									// $('#persinftbl').append(data);
									alert(data);
								},
								error: function (msg) {alert('sameh_ERROR');}
							});
						});




						$('#rungroups').live("click",function(){
							
							reload_groupsdata();

						});


						$('.archivedel').live("click",function(){
							var mark = $(this).attr("mark");
							delete_Arcive($(this).attr("id"),$(this).attr("mark"));
						});

						$('.archive').live("click",function(){
							$("#archCID").val($(this).attr("id"));
							$("#coded").text($(this).closest('tr').find('td:eq(1)').text());
							reload_Arcive($(this).attr("id"),1);
							reload_Arcive($(this).attr("id"),2);
							reload_Arcive($(this).attr("id"),3);

							$("#archPID").val($(this).closest('tr').find('#perscust').attr("title"));
							$("#archEID").val($(this).closest('tr').find('#persenm').attr("title"));
						});


						$(".filex").live('change',function(e){


							var sel =  $(this).closest('form').find('select').val();
							if (sel=='')
								{alert("اختر اسم المرفق اولا ...!");$(this).val("");}

							else{

								e.preventDefault();   
								var mark = $(this).closest('form').attr("mark");

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
							$("#personid").val($(this).attr("title"));
							$("#persidd").val($(this).attr("title"));
							reload_person($(this).attr("title"),0);
						});





						





//


$('.autosh').live("click",function(){
	var autonumv = $(this).text();
	var cid = $(this).attr("value");

// alert(autonumv);
// alert($(this).attr("value"));
$.ajax({
	type: 'GET',
	url:'http://197.50.203.14/lawyerphp/AutoSearchCommer.php',
	data: {autonum:autonumv,caseid:cid},
	beforeSend: function() { 	
		var el = $("#context");
		App.blockUI(el);
	},
	complete  : function() { 
		var el = $("#context"); 
		App.unblockUI(el);
	},

	success: function (data) {

			 //alert(data);

			//$('#txtSearsh').val(data);
		} 
	});
});



$('.detdel').live("click",function(){
	var detid = $(this).attr("value");

	$.ajax({
		type: 'POST',
		url:'deletedetrow.php',
		data: {detID:detid},
		
		success: function (data) {
			reload_cacedetails($("#hddnCIDdet").val());
			alert("نم الحذف");
		} 
	});
});






$('.detlid').live("click",function(){
	var detid = $(this).attr("value");
	var  CaseID=$("#hddnCID").val();
	$.ajax({
		type: 'POST',
		url:'nowinpage.php',
		data: {detID:detid,CaseID:CaseID},
		success: function (data) {
			alert(data);

		} 
	});
});



$('.evedit').live("click",function(){
	var evid =  $(this).attr("value");
	$("#evidd").val(evid);

	$("#evt").val($("#evtnmt"+evid).text());
	$("#evtdt").val($("#evtdtt"+evid).text());

	$('#EventType option[value='+ $("#evttnmt" + evid  ).attr("value") +']').attr('selected','selected');
});







$('.casdetedit').live("click",function(){
	var evid =  $(this).attr("value");
	$("#ccidd").val(evid);


	$('#detposf option[value='+ $("#detposetion"+ evid ).attr("value") +']').attr('selected','selected');
	$("#detcnumber").val($("#detCaseNumber"+evid).html());

	$('#detperspos option[value='+ $("#detPositionName"+ evid ).attr("value") +']').attr('selected','selected');
	$('#detperspos2 option[value='+ $("#detPositionName2"+ evid ).attr("value") +']').attr('selected','selected');

	$("#detcercil").val($("#detCircle"+evid).html());
	$("#detflor").val($("#detFloor"+evid).html());
	$("#dethall").val($("#detHall"+evid).html());

	$('#detcourt option[value='+ $("#detCourtName"+ evid ).attr("value") +']').attr('selected','selected');


	$("#detsecrt").val($("#detSecretary"+evid).html());
	$("#detgu").val($("#detGedge"+evid).html());
});




$('.casdetAdd').live("click",function(){
	var evid =  $(this).attr("value");
	$("#ccidd2").val($("#hddnCIDdet").val());
});



$('.redirect').live("click",function(){

	$("#rediid").val($(this).attr("value"));
});



$("#txtSearsh").live('keyup', function (e) {

	var charcdd = $(this).val();
	$.ajax({
		type: 'POST',
		url:'getCasesSearchAjax.php',
		data: {CharCode:charcdd},
		beforeSend:function()
		{
			e.preventDefault();
			var el = $("#context");
			App.blockUI(el);
			window.setTimeout(function () {
				App.unblockUI(el);
			}, 1000);
		}, 	 
		success: function (data) {
			$('#casesmaster').html('');
			$('#casesmaster').append(data);	
			//$('#tblrowcounts').html( '#' +( $('#casesmaster tr').length) + '#');
		},
		error: function (data) {alert('sameh_ERROR');}
	});
});



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


		$('#addnewepers').live("click",function(e) {

			e.preventDefault();

			var pname = $("input[name='pname']").val();
			var idnum = $("input[name='idnum']").val();
			var ptype = $("#perstype").val();
			var nat = $("#persnat option:selected").val();


			$.ajax({
				type: 'POST',
				url :'addpers.php',

				data: {pname:pname,idnum:idnum,nat:nat,ptype:ptype},
				//dataType: 'json',
				success: function (data) {
					$('#New_person').modal('hide'); 
					if(ptype==1){
						$("input[name='cust']").val(pname);
					}else{
						$("input[name='enm']").val(pname);
					}


					alert("تم الاضافة بنجاح");
				},
				error: function (data) {alert('sameh_ERROR');}
			});


		});
		

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
					//$('#txtSearsh') .val(data);
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

		//alert("dddddd");
	//	loadCases1();


		//end of $(document).load(finction);
	});

$.urlParam = function(name){
	var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
	if (results==null){
		return null;
	}
	else{
		return results[1] || 0;
	}
};



function loadCases2(idf){
	//alert("data22");
	$.ajax({
		type: 'GET',
		url:'getCasesSearchAjax.php',
		data: {cccd:idf},
		beforeSend: function() { 
			$('#searchModal').modal('hide'); 	
			var el = $("#context");

			App.blockUI(el);
			$(".blockUI").append("<br /><br /><span class='label label-inverse big'>جاري البحث ... !</span>");

		},
		complete  : function() { 
			var el = $("#context"); 
			App.unblockUI(el);
		},
		success: function (data) {
			//	alert(data);
			$('#casesmaster').html('');
			$('#casesmaster').append(data);	
		},
		error: function (msg) {alert('sameh_ERROR');}});

}


function loadCases1(pose){
	//alert("data22");
	$.ajax({
		type: 'POST',
		url:'getCasesSearchAjax.php',
		dataType: 'html',
		data: {searchstat:'0',serchpose:pose},
		beforeSend: function() { 
			$('#searchModal').modal('hide'); 	
			var el = $("#context");

			App.blockUI(el);
			$(".blockUI").append("<br /><br /><span class='label label-inverse big'>جاري البحث ... !</span>");

		},
		complete  : function() { 
			var el = $("#context"); 
			App.unblockUI(el);
		},
		success: function (data) {
			 	//alert(data);
			 	$('#casesmaster').html('');
			 	$('#casesmaster').append(data);	
			 	
			 	//$('#tblrowcounts').html( '#' +( $('#casesmaster tr').length) + '#');
			 },
			 error: function (msg) {alert('sameh_ERROR');}});

}

$('#formsearh').submit(function(e) {
	e.preventDefault();
	$("#formsearh").ajaxSubmit(
	{

		success:function(data)
		{$('#searchModal').modal('hide'); 
			//alert($("#hddnCID").val());
			$('#casesmaster').html('');
			$('#casesmaster').append(data);	
			
			$('#tblrowcounts').html( '#' +( $('#casesmaster tr').length) + '#');


		}
	});
});





$('#form107').submit(function(e) {
	e.preventDefault();
	$("#form107").ajaxSubmit(
	{
		success:function(data)
		{

			$('#AddPersonInfo').modal('hide'); 
			reload_person($("#persidd").val(),0);


		}
	});
});




$('#form108').submit(function(e) {
	e.preventDefault();
	var smsnumber=$("#smsKeyNumber").val()+$("#smsNumber").val();
	var smsTitle=$("#smsTitle").val();
	var smsSubject=$("#smsSubject").val();

	$.ajax({
		type: "POST",
		url:'smsSend.php',
		dataType: 'html', 
		data: {smsnumber:smsnumber,smsTitle:smsTitle,smsSubject:smsSubject},
		success: function (data) {
			$("#smsstate").append(data);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
});

$('#form112').submit(function(e) {
	e.preventDefault();
	$("#form112").ajaxSubmit(
	{
		success:function(data)
		{
			reload_caceevents($("input[name='HiddenCaseID']").val(),0);


			$('#edit_Event').modal('hide'); 
		}
	});
});


$('#frmaddgroup').submit(function(e) {
	e.preventDefault();
	$("#frmaddgroup").ajaxSubmit(
	{
		success:function(data)
		{
			 //alert(data);
			 $('#addgroup').modal('hide');
			 reload_groupsdata();
			 
			}});
});




$('#form113').submit(function(e) {
	e.preventDefault();
	$("#form113").ajaxSubmit(
	{
		success:function(data)
		{
			//alert(data)
			reload_cacedetails($("#hddnCIDdet").val());
     //$("#ccidd").val(data);
     $('#edit_det').modal('hide'); 
 }});
});



$('#form114').submit(function(e) {
	e.preventDefault();
	$("#form114").ajaxSubmit(
	{
		success:function(data)
		{
			//alert(data)
			reload_cacedetails($("#hddnCIDdet").val());

			$('#Add_det').modal('hide'); 



		}
	});
});

$('#form115').submit(function(e) {
	e.preventDefault();
	$("#form115").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data)
			//reload_cacedetails($("#hddnCIDdet").val());

			$('#redirect').modal('hide'); 



		}
	});
});

$('#form116').submit(function(e) {
	e.preventDefault();
	$("#form116").ajaxSubmit(
	{
		success:function(data)
		{loadCases1();
			alert("تم التعديل بنجاح");
			$('#static').modal('hide');
		}
	});
});



//formeditpersinfo


$('#formeditpersinfo').submit(function(e) {
	e.preventDefault();
	$("#formeditpersinfo").ajaxSubmit(
	{
		success:function(data)
		{ 
			
			reload_person(data,0);
			$('#editpersinfo').modal('hide');
		}
	});
});






$('#form1150').submit(function(e) {
	e.preventDefault();
	$("#form1150").ajaxSubmit(
	{
		success:function(data)
		{
			//alert(data);

			reload_commerdata($('#HiddenCaseIDFcomm').val());
			$('#Addcommer').modal('hide'); 
		}
	});
});

$('#form_sample_o1').submit(function(e) {
	e.preventDefault();

	$("#form_sample_o1").ajaxSubmit(
	{
		success:function(data)

		{

			dtx=data; 

			
			if (dtx=="تم") {
				$("input[name='cust']").val(''); 
				$("input[name='enm']").val(''); 
				$("input[name='autonumber']").val(''); 
				$("input[name='cstates']").val(''); 
				$("input[name='cpositions']").val(''); 
				$("input[name='Courts']").val(''); 
				$("input[name='subject']").val(''); 
				
				$("#adnewcasediv").toggle("slow");
			}
			alert(dtx);
			
			loadCases1();


			

		}
	});
});









//AjaxRequestMainFun
//------------------get AjaxRequestMainFun--------------------- 



function AjaxRequestMainFun(OprationName,typev,urlv,datatypev,datav) {
	if (OprationName=='select1') {

		$.ajax({
			type: typev,
			async: false,
			url: urlv,
			datatype: datatypev,
			data: datav,
			success: function(data) {
				var obj = JSON.parse(data);
				it_works = obj; // obj[1].CourtName;
			}
		});
	}
	return	it_works;
}


//reload_gritter
//------------------get reload_gritter--------------------- 

function reload_gritter(tit,sub,v1,v2) {
	setTimeout(function () {
		$.extend($.gritter.options, {
			position: 'top-left'
		});

		var unique_id = $.gritter.add({
                    // (string | mandatory) the heading of the notification
                    title: tit,
                    // (string | mandatory) the text inside the notification
                    text: sub  ,
                    // (string | optional) the image to display on the left
                    image: './assets/img/Signal_attention.png',
                    // (bool | optional) if you want it to fade out on its own or just sit there
                    sticky: true,
                    // (int | optional) the time you want it to be alive for before fading out
                    time: '',
                    // (string | optional) the class name you want to apply to that specific message
                    class_name: 'my-sticky-class'
                });

                // You can have it return a unique id, this can be used to manually remove it later using
                setTimeout(function () {
                	$.gritter.remove(unique_id, {
                		fade: true,
                		speed: 'slow'
                	});
                }, v1*1000);
            }, v2*1000);
}




//reload_commerdata
//------------------get Person data--------------------- 

function reload_commerdata(idf) {
	$.ajax({
		type: "POST",
		url:'getcommerdata.php',
		dataType: 'html', 
		data: {CaseID:  idf },
		success: function (data) {
			
			$('#HiddenCaseIDFcomm').val(idf);//('<input id="HiddenCaseIDFcomm" name="HiddenCaseIDFcomm" value="'+ idf +'" type="hidden" />');
			$('#commercialdata').html('');
			$('#commercialdata').append(data);

			

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};

//------------------get Person data--------------------- 

function reload_groupsdata() {
	$.ajax({
		type: "POST",
		url:'getgroups.php',
		dataType: 'html', 

		success: function (data) {
			//alert(data);
			$('#groupsdata').html('');
			$('#groupsdata').append(data);

			//reload_personifo(idf,artyp);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};



//------------------get Person data---------------------

function reload_person(idf,artyp) {
	$.ajax({
		type: "POST",
		url:'getPerson.php',
		dataType: 'html', 
		data: {PersonID: idf ,artyp:artyp},
		beforeSend: function() { 
			var el = $("#perstableinfo");
			App.blockUI(el);
		},
		complete  : function() { 
			var el = $("#perstableinfo"); 
			App.unblockUI(el);
		},
		success: function (data) {

			$('#perstbl').html('');
			$('#perstbl').append(data);

			reload_personifo(idf,artyp);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};




//------------------get Personinfo data---------------------
function reload_personifo(idf,artyp) {

	
	$.ajax({
		type: "POST",
		url:'getPerson.php',
		dataType: 'html', 
		data: {PersonID: idf ,artyp:2},
		beforeSend: function() { 
			var el = $("#perstableinfo");
			App.blockUI(el);
		},
		complete  : function() { 
			var el = $("#perstableinfo"); 
			App.unblockUI(el);
		},
		success: function (data) {
			
			$('#persinftbl').html('');
			$('#persinftbl').append(data);
		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};



//------------------delete arcive case--------------------archivedel
function delete_Arcive(idf,artyp){
	//alert(idf+"OOO"+artyp);
	$.ajax({
		type: "POST",
		url:'delArchive.php',
		dataType: 'html', 
		data: {CaseID: idf ,artyp:artyp},
		success: function (data) {

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
		data: {seID:'1'},
		success: function (data) {
			;
			$('#getCasesSearch').html('');
			$('#getCasesSearch').append(data);

//alert($('#getCasesSearch tr').length );


$("#getCasesSearch tr").css('background-color','');
$("#ffr" + $("#hddnCID").val() ).css('background-color','#cddc39');


},
error: function (msg) {alert('sameh_ERROR');}
});
};


//--------------  get events --------------------
function reload_caceevents(idf,evtyp) {
	var CaseID = idf; 
	var str;



	$.ajax({
		type: "POST",
		url:'getCaseevents.php',
		dataType: 'html',
		data: {CaseID:"'" + CaseID + "'",fnc:'getevnt',evtyp:  evtyp  }, 
		beforeSend: function() { 
			var el = $("#contextEvents");
			App.blockUI(el);
		},
		complete  : function() { 
			var el = $("#contextEvents"); 
			App.unblockUI(el);
		},
		success: function (data) {
			$('#evntscase').html('<input id="hddnCID" name="HiddenCaseID" value="'+ CaseID +'" type="hidden" />');
			$('#evntscase').append(data);








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

		data: {CaseID:"'" + CaseID + "'",fnc:'getdetl'}, 
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
						$('#evntthreads').html('');
						$('#evntthreads').append(data);

						$('#tab_1_2').addClass("active");
						$('#tab_1_1').removeClass("active"); 
						$('#litabevt').addClass("active");
						$('#litabcas').removeClass("active");


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




			if (!$.urlParam('mark')==1){

							valrut =  AjaxRequestMainFun('select1','POST','dbop.php','html',{OprationName:'select1',sqltbl:'vwNeedInfo LIMIT 5',sqlcolms:'id,sName,subject,StateName,Code'});

							for (i = 0; i <= valrut.length; i++) {
								tit= (i+1) + ' - ' + valrut[i].sName; 
								sub = valrut[i].subject + ','+ valrut[i].StateName + '<br/><a href="pgCases.php?cccd='+valrut[i].id+'&mark=1" > كود '+   valrut[i].Code +' </a>' ;
								v1 = 10;
								v2 = 2 ;

								reload_gritter(tit,sub,v1,((v2+3)*i)) ;
							}	
						} 

		</script>


