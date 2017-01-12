<?php 
include('config.php');




?>

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

									<table  class="table table-condensed">
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
												<th class="hidden-480"><i class='m-icon-swapleft icon-print'></i></th>

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

						<table id="contextEvents" class="table table-condensed table-hover">
							<thead>
								<tr>

									<th  style='width: 370px;' >الاجراء</th>
									<th>المستخدم</th>
									<th>التاريخ</th>
									<th class="hidden-480">نوعه</th>
									<th>تعامل</th>
									<th style="text-algin:left;">تحكم</th>
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