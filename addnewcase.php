<?php 
 session_start(); 

require_once('config.php');
include('fldReports/courtsdrp.php');
include('search.php');



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
 	if (!in_array("اضافة قضايا", $roles)) {
 		header('Location: notpermeted.php');
 	}
 }   




//if (!in_array("مدير عام على النظام", $roles) or in_array("اضافة قضايا", $roles))  {  header('Location: notpermeted.php'); } 
//echo "sameh" . $_SESSION['USID']; 
//session_destroy();
include('header.php');
?>



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
					<small>اضافة قضية جديدة</small>
				</h3>
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Home</a> 
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
	<!-- <form action="AddNP"  method="POST">
							{!! csrf_field() !!}

							<input type="text" name="section_Name"/>
							<button type="submit" class="btn blue" >حفظ</button>
						</form> -->


						<div class="portlet box blue" id="form_wizard_1">
							<div class="portlet-title">
								<div class="caption">
									<i class="icon-reorder"></i> خطوات الاضافة - <span class="step-title">الخطوة 1 من 4</span>
								</div>
								<div class="tools hidden-phone">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
							</div>
							<div class="portlet-body form">
								<form action="savecase.php"  method="POST" class="form-horizontal" id="submit_form">
									<div class="form-wizard">
										<div class="navbar steps">
											<div class="navbar-inner">
												<ul class="row-fluid">
													<li class="span3">
														<a href="#tab1" data-toggle="tab" class="step active">
															<span class="number">1</span>
															<span class="desc"><i class="icon-ok"></i> اطراف القضية</span>   
														</a>
													</li>
													<li class="span3">
														<a href="#tab2" data-toggle="tab" class="step">
															<span class="number">2</span>
															<span class="desc"><i class="icon-ok"></i> بيانات القضية</span>   
														</a>
													</li>
													<li class="span3">
														<a href="#tab3" data-toggle="tab" class="step">
															<span class="number">3</span>
															<span class="desc"><i class="icon-ok"></i> البيانات الحسابية</span>   
														</a>
													</li>
													<li class="span3">
														<a href="#tab4" data-toggle="tab" class="step">
															<span class="number">4</span>
															<span class="desc"><i class="icon-ok"></i> الحفظ</span>   
														</a> 
													</li>
												</ul>
											</div>
										</div>
										<div id="bar" class="progress progress-success progress-striped">
											<div class="bar"></div>
										</div>

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



										<div class="tab-content">
											<div class="alert alert-error hide">
												<button class="close" data-dismiss="alert"></button>
												لديك بعض الأخطاء بالنموذج. يرجى مراجعة أدناه.
											</div>
											<div class="alert alert-success hide">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>

											<div class="tab-pane active" id="tab1">
												<h3 class="block">قدم بيانات الطراف القضية</h3>

												<div class="control-group">
													<label class="control-label">اسم العميل<span class="required">*</span></label>
													<div class="controls">
														
														<input type="text" name="cust" placeholder="العميل"  class="span6 m-wrap required"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data; ?>" /> 

														<span class="help-inline">قدم اسم العميل</span>
														<a  data-toggle="modal" cat="1" href="" class="addprs" data-target="#New_person" >(جديد)</a>

													</div>
												</div>	

												<div class="control-group">
													<label class="control-label">صفته  <span class="required">*</span></label>
													<div class="controls">
														<select class="span6 m-wrap required" name="perspos"   data-placeholder="Choose a Category" tabindex="1">
															<?php  echo Getpersonpos(0);?>
														</select>

														
														<span class="help-inline">قدم صفة العميل</span>
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
													<label class="control-label">صفته  <span class="required">*</span></label>
													<div class="controls">
														<select class="span6 m-wrap required" name="enmpos2"   data-placeholder="Choose a Category" tabindex="1">
															<?php  echo Getpersonpos(0);?>
														</select>
														<span class="help-inline">قدم صفة الخصم</span>
													</div>
												</div>	
											</div>

											<div class="tab-pane" id="tab2">
												<h3 class="block">قدم بيانات القضية</h3>
												<div class="control-group">
													<label class="control-label">الرقم الآلي<span class="required">	</span></label>
													<div class="controls">
														<input type="text" name="autonumber" digits="true" minlength="9" MaxLength="9" class="span6 m-wrap" />
														<span class="help-inline">قدم الرقم الآلي</span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">نوع<span class="required">*</span></label>
													<div class="controls">
														<select class="span6 m-wrap required" name="ctypes" data-placeholder="Choose a Category" tabindex="1">
															<?php  echo Getctypes(0);?>
														</select>
														<span class="help-inline">قدم النوع </span>
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
													<label class="control-label">الدرجة<span class="required">*</span></label>
													<div class="controls">
														<select class="span6 m-wrap required" name="cpositions"   data-placeholder="Choose a Category" tabindex="1">
															<?php  echo Getcpositions(0);?>
														</select>
														<span class="help-inline">قدم الدرجة </span>
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
													<label class="control-label">رقم القضية</label>
													<div class="controls">
														<input type="text" name="casenumber"  class="span6 m-wrap " />
														<span class="help-inline">قدم رقم القضية </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الموضوع  <span class="required">*</span></label>
													<div class="controls">
														<input type="text" name="subject"  class="span6 m-wrap required" />
														<span class="help-inline">قدم الموضوع </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">التاريخ</label>
													<div class="controls">

														<input name="thedate" class="required m-wrap m-ctrl-medium pkr" readonly size="16" type="text" value="" /><span class="add-on"><i class="icon-calendar"></i></span>

													</div>
												</div>

												<div class="control-group">
													<label class="control-label">اختصاص القضية<span class="required">*</span></label>
													<div class="controls">
														<label class="radio">
															<input type="radio" name="gender"  value="M" data-title="Male" />
															محاماة
														</label>
														<div class="clearfix"></div>
														<label class="radio">
															<input type="radio" name="gender" value="T" data-title="Female"/>
															تحصيل
														</label>  
														<div id="form_gender_error"></div>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">مبلغ الشكوى</label>
													<div class="controls">
														<input type="text" name="monycomplain" value="0.0" class="span6 m-wrap " />
														<span class="help-inline">قدم  </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">نوع السند</label>
													<div class="controls">
														<select class="span6 m-wrap" name="cpapertype"   data-placeholder="Choose a Category" tabindex="1">
															<?php  echo Getcpapertype(0);?>
														</select>
														<span class="help-inline">قدم  </span>
													</div>
												</div>

											</div>
											<div class="tab-pane" id="tab3">
												<h3 class="block">البيانات المحاسبية</h3>
												<div class="control-group">
													<label class="control-label">المطالبة  </label>
													<div class="controls">
														<input type="text"  digits="true" value="0"   class="span6 m-wrap " />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">المقدم </label>
													<div class="controls">
														<input type="text"   value="0"   digits="true" class="span6 m-wrap " />
														<span class="help-inline"> </span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الموخر  </label>
													<div class="controls">
														<input type="text"   value="0"  digits="true"  class="span6 m-wrap " />
														<span class="help-inline"></span>
													</div>
												</div>



											</div>
											<div class="tab-pane" id="tab4">
												<h3 class="block">مراجعة  القضية</h3>
												<h4 class="form-section">اطراف القضية</h4>
												<div class="control-group">
													<label class="control-label">العميل:</label>
													<div class="controls">
														<span class="text display-value" data-display="cust"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الخصم:</label>
													<div class="controls">
														<span class="text display-value" data-display="enm"></span>
													</div>
												</div>
												<h4 class="form-section">بيانات القضية</h4>
												<div class="control-group">
													<label class="control-label">النوع:</label>
													<div class="controls">
														<span class="text display-value" data-display="ctypes"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الحالة:</label>
													<div class="controls">
														<span class="text display-value" data-display="cstates"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الجهة:</label>
													<div class="controls">
														<span class="text display-value" data-display="Courts"></span>
													</div>
												</div>
												<div class="control-group">
													<label class="control-label">الموضوع:</label>
													<div class="controls">
														<span class="text display-value" data-display="subject"></span>
													</div>
												</div>

												<!-- <h4 class="form-section">Billing</h4>
												<div class="control-group">
													<label class="control-label">Card Holder Name:</label>
													<div class="controls">
														<span class="text display-value" data-display="card_name"></span>
													</div>
												</div> -->



											</div>
										</div>
										<div class="form-actions clearfix">
											<a href="javascript:;" class="btn button-previous">
												<i class="m-icon-swapright"></i> السابق 
											</a>
											<a href="javascript:;" class="btn blue button-next">
												التالي <i class="m-icon-swapleft m-icon-white"></i>
											</a>
											<button type="submit" class="btn blue button-submit" >حفظ</button>

										</div>
									</div>
								</form>
							</div>
						</div>

					</div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER--> 
		</div>	


		<?php include('footer.php');?>

		<script>
			
			$(document).ready(function(e){
				$(".addprs").on("click",function () {
					$("#perstype").val($(this).attr("cat"));
				})




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
			
		</script>