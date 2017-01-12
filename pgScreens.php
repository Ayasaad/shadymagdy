<?php
require_once('dbop.php');

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
					الشاشات الفرعية
					<small>شاشات الضبط الفرعية للنظام</small>
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











				<div class="span12">
					<!--BEGIN TABS-->
					<div class="tabbable tabbable-custom tabs-right">
						<!-- Only required for left/right tabs -->
						<ul class="nav nav-tabs tabs-right">
							<li><a href="#tab_4_1" data-toggle="tab">الاشخاص</a></li>
							<li class="active"><a href="#tab_4_2" data-toggle="tab">حالات القضايا</a></li>
							<li><a href="#tab_4_3" data-toggle="tab">انواع القضايا</a></li>
							<li><a href="#tab_4_4" data-toggle="tab">حالات الاجراءات</a></li>
							<li><a href="#tab_4_5" data-toggle="tab">انواع الاجراءات</a></li>

							<li><a href="#tab_4_7" data-toggle="tab">حالات الاعلانات</a></li>
							<li><a href="#tab_4_8" data-toggle="tab">مسميات الارشيف</a></li>
							<li><a href="#tab_4_9" data-toggle="tab">الجهات والمحاكم</a></li>
							<li><a href="#tab_4_10" data-toggle="tab">درجات التقاضي</a></li>
							<li><a href="#tab_4_11" data-toggle="tab">صفة الاشخاص</a></li>

							<li><a href="#tab_4_13" data-toggle="tab">انواع السندات</a></li>

						</ul>
						<div class="tab-content">
							<div class="tab-pane " id="tab_4_1">
								<p>الاشخاص.</p>

								<table  class="table table-condensed table-hover ">
									<thead>
										<tr>
											<th>#</th>
											<th>الاسم</th>
											<th class="hidden-480">الحالة</th>

										</tr>
									</thead>
									<tbody id="tbpersons">



									</tbody>
								</table>

							</div>
							<div class="tab-pane active" id="tab_4_2">

								<div class="span5">
									<!-- BEGIN FORM-->
									<form id="addNewCasestate" action="addNewCasestate.php" method="POST" class="horizontal-form">
										<h3 class="form-section">حالات القضايا.</h3>
										<div class="row-fluid">
											<div class="span6 ">
												<div class="control-group">
													<label class="control-label" for="firstName">مسمى الحالة</label>
													<div class="controls">
														<input type="text" name="stateName" class="m-wrap span12" placeholder="ادخل هنا مسمى الحالة الجديدة">
														<button id="addnewevent2"  type="submit"   class="btn red">اضافة</button>
														<span class="help-block">.</span>

													</div>
												</div>
											</div>

											

										</div>
									</form>
									<!-- END FORM--> 
								</div>
								<div class="span5">
									<table id="casestates" class="table table-condensed table-hover ">
										<thead>
											<tr>
												<th>#</th>
												<th>الترتيب</th>
												<th>الحالة</th>

											</tr>
										</thead>
										<tbody id="tbStates">
											<?php 
											$brk2=0;
											$drr=array();
											$drr = selectDataAsArr("casestates","ID,Code,StateName"); 
											$x2 = count($drr);

											for($i2=0; $i2<$x2; $i2++){
												echo 
												"<tr id='". $drr[$i2]['ID'] ."'>
												<td>". $drr[$i2]['ID']    ."</td>
												<td  name='code'>" . $drr[$i2]['Code']    ."</td>
												<td  name='StateName'>" . $drr[$i2]['StateName']    ."</td>
												
												<td>
													<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
													<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
												</td>

												<td style='display:none' >
													<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
													<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
												</td>

											</tr>";
										}
										?>


									</tbody>
								</table>
							</div>

						</div>
						<div class="tab-pane" id="tab_4_3">
							<div class="span5">
								<!-- BEGIN FORM-->
								<form id="addNewCasetype" action="addNewCasetype.php" method="POST" class="horizontal-form">
									<h3 class="form-section">انواع القضايا.</h3>
									<div class="row-fluid">
										<div class="span6 ">
											<div class="control-group">
												<label class="control-label" for="firstName">مسمى النوع</label>
												<div class="controls">
													<input type="text" name="typeName" class="m-wrap span12" placeholder="ادخل هنا مسمى النوع الجديدة">
													<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
													<span class="help-block">.</span>

												</div>
											</div>
										</div>

									</div>
								</form>
								<!-- END FORM--> 
							</div>
							<div class="span5">
								<table id="casetypedetails" class="table table-condensed table-hover ">
									<thead>
										<tr>
											<th>#</th>
											<th>الترتيب</th>
											<th>الحالة</th>

										</tr>
									</thead>
									<tbody id="tbStates">
										<?php 
										$brk2=0;
										$drr=array();
										$drr = selectDataAsArr("casetypedetails","ID,Code,CaseTypeDetailsName"); 
										$x2 = count($drr);

										for($i2=0; $i2<$x2; $i2++){
											echo 
											"<tr id='". $drr[$i2]['ID']    ."'>
											<td>". $drr[$i2]['ID']    ."</td>
											<td  name='Code'>". $drr[$i2]['Code']    ."</td>
											<td  name='CaseTypeDetailsName'>". $drr[$i2]['CaseTypeDetailsName']    ."</td>
											<td>
												<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
												<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
											</td>

											<td style='display:none' >
												<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
												<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
											</td>
										</tr>";
									}
									?>


								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane" id="tab_4_4">
						<div class="span5">
							<!-- BEGIN FORM-->
							<form id="addNewEventState" action="addNewEventState.php" method="POST" class="horizontal-form">
								<h3 class="form-section">حالات الاجراءات.</h3>
								<div class="row-fluid">
									<div class="span6 ">
										<div class="control-group">
											<label class="control-label" for="firstName">مسمى الحالة</label>
											<div class="controls">
												<input type="text" name="EventState" class="m-wrap span12" placeholder="ادخل هنا حالة الاجراء الجديدة">
												<button id="addnewese"  type="submit"   class="btn red">اضافة</button>
												<span class="help-block">مسمى حالات التعامل مع الاجراءات</span>
											</div>
										</div>
									</div>
								</div>
							</form>
							<!-- END FORM--> 
						</div>
						<div class="span5">
							<table id="eventstats" class="table table-condensed table-hover ">
								<thead>
									<tr>
										<th>#</th>
										<th>الترتيب</th>
										<th>الحالة</th>

									</tr>
								</thead>
								<tbody id="tbStates">
									<?php 
									$brk2=0;
									$drr=array();
									$drr = selectDataAsArr("eventstats","ID,Code,evStateName"); 
									$x2 = count($drr);

									for($i2=0; $i2<$x2; $i2++){
										echo 
										"<tr id='". $drr[$i2]['ID'] ."'>
										<td>". $drr[$i2]['ID']    ."</td>
										<td name='Code'>". $drr[$i2]['Code']    ."</td>
										<td name='evStateName'>". $drr[$i2]['evStateName']    ."</td>
										<td>
											<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
											<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
										</td>

										<td style='display:none' >
											<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
											<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
										</td>

									</tr>";
								}
								?>


							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="tab_4_5">
					<div class="span5">
						<!-- BEGIN FORM-->
						<form id="addNewEventtypes" action="addNewEventtypes.php" method="POST" class="horizontal-form">
							<h3 class="form-section">انواع الاجراءات.</h3>
							<div class="row-fluid">
								<div class="span6 ">
									<div class="control-group">
										<label class="control-label" for="firstName">مسمى النوع</label>
										<div class="controls">
											<input type="text" name="typeName" class="m-wrap span12" placeholder="ادخل هنا مسمى النوع الجديدة">
											<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
											<span class="help-block">.</span>

										</div>
									</div>
								</div>

							</div>
						</form>
						<!-- END FORM--> 
					</div>
					<div class="span5">
						<table id="eventtypes"  class="table table-condensed table-hover ">
							<thead>
								<tr>
									<th>#</th>
									<th>الترتيب</th>
									<th>الحالة</th>

								</tr>
							</thead>
							<tbody id="tbStates">
								<?php 
								$brk2=0;
								$drr=array();
								$drr = selectDataAsArr("eventtypes","ID,Code,TypeName"); 
								$x2 = count($drr);

								for($i2=0; $i2<$x2; $i2++){
									echo 
									"<tr id='". $drr[$i2]['ID'] ."'>
									<td>". $drr[$i2]['ID']    ."</td>
									<td  name='Code'>". $drr[$i2]['Code']    ."</td>
									<td  name='TypeName'>". $drr[$i2]['TypeName']    ."</td>
									<td>
										<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
										<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
									</td>

									<td style='display:none' >
										<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
										<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
									</td>
								</tr>";
							}
							?>


						</tbody>
					</table>
				</div>
			</div>

			<div class="tab-pane" id="tab_4_7">
				<div class="span5">
					<!-- BEGIN FORM-->
					<form id="addNewComrStat" action="addNewComrStat.php" method="POST" class="horizontal-form">
						<h3 class="form-section">حالات الاعلانات.</h3>
						<div class="row-fluid">
							<div class="span6 ">
								<div class="control-group">
									<label class="control-label" for="firstName">مسمى الحالة</label>
									<div class="controls">
										<input type="text" name="stateName" class="m-wrap span12" placeholder="ادخل هنا حالة الاعلان الجديدة">
										<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
										<span class="help-block">.</span>
									</div>
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM--> 
				</div>
				<div class="span5">
					<table id="commercialstates" class="table table-condensed table-hover ">
						<thead>
							<tr>
								<th>#</th>
								<th>الترتيب</th>
								<th>الحالة</th>

							</tr>
						</thead>
						<tbody id="tbStates">
							<?php 
							$brk2=0;
							$drr=array();
							$drr = selectDataAsArr("commercialstates","ID,state"); 
							$x2 = count($drr);

							for($i2=0; $i2<$x2; $i2++){
								echo 
								"<tr id='". $drr[$i2]['ID'] ."' >
								<td name='Code'>". $drr[$i2]['ID']    ."</td>
								<td name='state'>". $drr[$i2]['state']    ."</td>
								<td>
									<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
									<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
								</td>

								<td style='display:none' >
									<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
									<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
								</td>
							</tr>";
						}
						?>


					</tbody>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="tab_4_8">
			<div class="span5">
				<!-- BEGIN FORM-->
				<form id="addNewArchName" action="addNewArchName.php" method="POST" class="horizontal-form">
					<h3 class="form-section">مسميات الارشيف.</h3>
					<div class="row-fluid">
						<div class="span5 ">
							<div class="control-group">
								<label class="control-label" for="firstName">مسمى انواع الارشيف</label>
								<div class="controls">
									<input type="text" name="thename" class="m-wrap span12" placeholder="ادخل هنا مسمى النوع">

									<span class="help-block">.</span>
								</div>
							</div> <div class="control-group">

							<div class="controls">
								<label class="radio">
									<input type="radio" name="optionsRadios2" value="1" checked />
									قضية
								</label>
								<label class="radio">
									<input type="radio" name="optionsRadios2" value="2"  />
									موكل
								</label>
								<label class="radio">
									<input type="radio" name="optionsRadios2" value="3"  />
									خصم
								</label>  

							</div>	

							<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
						</div>
					</div>

				</div>
			</form>
			<!-- END FORM--> 
		</div> 
		<div class="span5">
			<table  class="table table-condensed table-hover ">
				<thead>
					<tr>
						<th>#</th>
						<th>الترتيب</th>
						<th>الحالة</th>

					</tr>
				</thead>
				<tbody id="tbStates">
					<?php 
					$brk2=0;
					$drr=array();
					$drr = selectDataAsArr("scaninfo","ID,Code,pName,Spisialist"); 
					$x2 = count($drr);

					for($i2=0; $i2<$x2; $i2++){
						echo 
						"<tr id='". $drr[$i2]['ID'] ."'>
						<td>". $drr[$i2]['ID']    ."</td>
						<td name='Code'>". $drr[$i2]['Code']    ."</td>
						<td name='pName'>". $drr[$i2]['pName']    ."</td>
						<td name='Spisialist'>". $drr[$i2]['Spisialist']    ."</td>
						<td>
							<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
							<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
						</td>

						<td style='display:none' >
							<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
							<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
						</td>
					</tr>";
				}
				?>


			</tbody>
		</table>
	</div>
</div>
<div class="tab-pane" id="tab_4_9">
	<div class="span5">
		<!-- BEGIN FORM-->
		<form id="addNewCourt" action="addNewCourt.php" method="POST" class="horizontal-form">
			<h3 class="form-section">الجهات والمحاكم.</h3>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">مسمى الجهة</label>
						<div class="controls">
							<input type="text" name="CourtName" class="m-wrap span12" placeholder="ادخل هنا مسمى الجهة">
							<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
							<span class="help-block">.</span>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM--> 
	</div>
	<div class="span5">
		<table id="courts" class="table table-condensed table-hover ">
			<thead>
				<tr>
					<th>#</th>
					<th>الترتيب</th>
					<th>الحالة</th>

				</tr>
			</thead>
			<tbody id="tbStates">
				<?php 
				$brk2=0;
				$drr=array();
				$drr = selectDataAsArr("courts","ID,Code2,CourtName"); 
				$x2 = count($drr);

				for($i2=0; $i2<$x2; $i2++){
					echo 
					"<tr id='". $drr[$i2]['ID'] ."'>
					<td>". $drr[$i2]['ID']    ."</td>
					<td name='Code'>". $drr[$i2]['Code2']    ."</td>
					<td name='CourtName'>". $drr[$i2]['CourtName']    ."</td>
					<td>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
					</td>

					<td style='display:none' >
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
					</td>
				</tr>";
			}
			?>


		</tbody>
	</table>
</div>

</div>
<div class="tab-pane" id="tab_4_10">
	<div class="span5">
		<!-- BEGIN FORM-->
		<form id="addNewposition" action="addNewposition.php" method="POST" class="horizontal-form">
			<h3 class="form-section">درجات التقاضي.</h3>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">مسمى درجات التقاضي</label>
						<div class="controls">
							<input type="text" name="positionName" class="m-wrap span12" placeholder="ادخل هنا مسمى الدرجة">
							<button id="addneweve"  type="submit"   class="btn red">اضافة</button>
							<span class="help-block">.</span>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM--> 
	</div>
	<div class="span5">
		<table id="positions" class="table table-condensed table-hover ">
			<thead>
				<tr>
					<th>#</th>
					<th>الترتيب</th>
					<th>الحالة</th>

				</tr>
			</thead>
			<tbody id="tbStates">
				<?php 
				$brk2=0;
				$drr=array();
				$drr = selectDataAsArr("positions","ID,Code,positionName"); 
				$x2 = count($drr);

				for($i2=0; $i2<$x2; $i2++){
					echo 
					"<tr id='". $drr[$i2]['ID'] ."'>
					<td>". $drr[$i2]['ID']    ."</td>
					<td name='Code'>". $drr[$i2]['Code']    ."</td>
					<td name='positionName'>". $drr[$i2]['positionName']    ."</td>
					<td>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
					</td>

					<td style='display:none' >
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
					</td>
				</tr>";
			}
			?>


		</tbody>
	</table>
</div>
</div>
<div class="tab-pane" id="tab_4_11">
	<div class="span5">
		<!-- BEGIN FORM-->
		<form id="addNewPersposition" action="addNewPersposition.php" method="POST" class="horizontal-form">
			<h3 class="form-section">صفة الاشخاص.</h3>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">مسمى الصفة</label>
						<div class="controls">
							<input type="text" name="PositionName" class="m-wrap span12" placeholder="ادخل هنا الصفة">
							<button id="addnewevdfe"  type="submit"   class="btn red">اضافة</button>
							<span class="help-block">.</span>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM--> 
	</div>
	<div class="span5">
		<table  id="customerposition" class="table table-condensed table-hover ">
			<thead>
				<tr>
					<th>#</th>
					<th>الترتيب</th>
					<th>الحالة</th>

				</tr>
			</thead>
			<tbody id="tbStates">
				<?php 
				$brk2=0;
				$drr=array();
				$drr = selectDataAsArr("customerposition","ID,Code,PositionName"); 
				$x2 = count($drr);

				for($i2=0; $i2<$x2; $i2++){
					echo 
					"<tr id='". $drr[$i2]['ID'] ."'>
					<td>". $drr[$i2]['ID']    ."</td>
					<td name='Code'>". $drr[$i2]['Code']    ."</td>
					<td name='PositionName'>". $drr[$i2]['PositionName']    ."</td>
					<td>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
					</td>

					<td style='display:none' >
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
					</td>
				</tr>";
			}
			?>


		</tbody>
	</table>
</div>

</div>

<div class="tab-pane" id="tab_4_13">
	<div class="span5">
		<!-- BEGIN FORM-->
		<form id="addNewpapertype" action="addNewpapertype.php" method="POST" class="horizontal-form">
			<h3 class="form-section">انواع السندات.</h3>
			<div class="row-fluid">
				<div class="span6 ">
					<div class="control-group">
						<label class="control-label" for="firstName">مسمى السند</label>
						<div class="controls">
							<input type="text" name="PaperType" class="m-wrap span12" placeholder="ادخل هنا مسمى السند">
							<button id="addnewevdfe"  type="submit"   class="btn red">اضافة</button>
							<span class="help-block">.</span>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- END FORM--> 
	</div>
	<div class="span5">
		<table id="papertypes"  class="table table-condensed table-hover ">
			<thead>
				<tr>
					<th>#</th>
					<th>الترتيب</th>
					<th>الحالة</th>

				</tr>
			</thead>
			<tbody id="tbStates">
				<?php 
				$brk2=0;
				$drr=array();
				$drr = selectDataAsArr("papertypes","ID,Code,PaperType"); 
				$x2 = count($drr);

				for($i2=0; $i2<$x2; $i2++){
					echo 
					"<tr id='". $drr[$i2]['ID'] ."'>
					<td>". $drr[$i2]['ID']    ."</td>
					<td name='Code'>". $drr[$i2]['Code']    ."</td>
					<td name='PaperType'>". $drr[$i2]['PaperType']    ."</td>
					<td>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn blue mini editrow'>تعديل</a>
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn red mini deleterow'>حذف</a>
					</td>

					<td style='display:none' >
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn green mini saverow'>حفظ</a> 
						<a href='#' id='". $drr[$i2]['ID'] ."' class='btn yellow mini cancelEd'>الغاء</a>
					</td>
				</tr>";
			}
			?>


		</tbody>
	</table>
</div>



</div>

</div>
</div>
<!--END TABS-->
</div>













</div>
</div>
<!-- END PAGE CONTENT-->
</div>
<!-- END PAGE CONTAINER--> 
</div>


<?php
include('footer.php');

?>

<script type="text/javascript">

	$(document).ready(function(e){



//--------------------------------------

$('.editrow').live("click",function(e){
	e.preventDefault();
	idd=$(this).attr("id");

	$(this).closest('tr').find('td').each(function(){
		if($(this).attr("name")){
			$(this).html("<input type='text' name='"+ $(this).attr("name") +"' style='width:60px;' value='"+ $(this).text() +"'>")
			//alert($(this).text());
		}
		
	});

	$(this).closest('td').css("display","none");
	$(this).closest('td').next('td').css( "display","block");

});


//--------------------------------------save

$('.saverow').live("click",function(e){
	e.preventDefault();
	idds=$(this).closest('tr').attr("id");
	tableid=$(this).closest('table').attr("id");
	var jsonObject = [],tempObj = {};

	$(this).closest('tr').find('input').each(function(){
		if($(this).attr("type")=="text"){ 

			tempObj[$(this).attr("name")] = $(this).val();
			jsonObject.push(tempObj);

			$(this).closest('td').html( $(this).val() );
			

		}
	});

	$.ajax({
		type: "POST",
		url:'edittablerow.php',

		data: {data:jsonObject[0],ids:idds,tableid:tableid},
		success: function (data) {
			//alert(data);
		}
	});



	$(this).closest('td').css("display","none" );
	$(this).closest('td').prev('td').css("display","block");

});
//--------------------------------------cancelEd


$('.cancelEd').live("click",function(e){
	e.preventDefault();
	$(this).closest('tr').find('input').each(function(){
		if($(this).attr("type")=="text"){ 
			$(this).closest('td').html( $(this).val() );
		}
	});
	$(this).closest('td').css("display","none" );
	$(this).closest('td').prev('td').css("display","block");
});
//--------------------------------------deleterow



$('.deleterow').live("click",function(e){
	e.preventDefault();
	idds=$(this).closest('tr').attr("id");
	tableid=$(this).closest('table').attr("id");
	

	$.ajax({
		type: "POST",
		url:'deletetablerow.php',

		data: {ids:idds,tableid:tableid},
		success: function (data) {
			//alert(data);
		}
	});



	$(this).closest('td').css("display","none" );
	$(this).closest('td').prev('td').css("display","block");

});


//--------------------------------------deleterow
function reload_CasesState(idf,artyp) {

	
	$.ajax({
		type: "POST",
		url:'getPerson.php',
		dataType: 'html', 
		data: {PersonID:"'" + idf + "'",artyp:2},
		success: function (data) {
			
			$('#persinftbl').html('');
			$('#persinftbl').append(data);
		},
		error: function (msg) {alert('sameh_ERROR');}
	});
};





//--------------------------------------

$('#addNewCasestate').submit(function(e) {
	e.preventDefault();
	$("#addNewCasestate").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------




$('#addNewCasetype').submit(function(e) {
	e.preventDefault();
	$("#addNewCasetype").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------





$('#addNewEventState').submit(function(e) {
	e.preventDefault();
	$("#addNewEventState").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------






$('#addNewEventtypes').submit(function(e) {
	e.preventDefault();
	$("#addNewEventtypes").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------


//addNewCourt



$('#addNewHandelState').submit(function(e) {
	e.preventDefault();
	$("#addNewHandelState").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------



$('#addNewComrStat').submit(function(e) {
	e.preventDefault();
	$("#addNewComrStat").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------


$('#addNewArchName').submit(function(e) {
	e.preventDefault();
	$("#addNewArchName").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);


		}
	});
});
//--------------------------------------
//addNewposition



$('#addNewCourt').submit(function(e) {
	e.preventDefault();
	$("#addNewCourt").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);
		}
	});
});
//--------------------------------------




$('#addNewposition').submit(function(e) {
	e.preventDefault();
	$("#addNewposition").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);
		}
	});
});
//--------------------------------------



$('#addNewPersposition').submit(function(e) {
	e.preventDefault();
	$("#addNewPersposition").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);
		}
	});
});
//--------------------------------------



$('#addNewpapertype').submit(function(e) {
	e.preventDefault();
	$("#addNewpapertype").ajaxSubmit(
	{
		success:function(data)
		{
			alert(data);
		}
	});
});
//--------------------------------------





});

</script>
