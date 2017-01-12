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










				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption"><i class="icon-briefcase"></i>جدول القضايا</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>

						<div class="actions">
							<a data-toggle="modal" href="#searchModal" class="btn icn-only blue">بحث<i class="m-icon-swapleft icon-search"></i></a>
							<a  href="addnewcase.php" class="btn yellow"><i class="icon-plus"></i> اضافة</a>

						</div>
					</div>
					<div class="portlet-body no-more-tables">

						<table id="systemsetings" class="table table-condensed table-hover ">
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
								$drr = selectDataAsArr("systemsetings","ID,Code,Setname,SetValue,SetProperty"); 
								$x2 = count($drr);

								for($i2=0; $i2<$x2; $i2++){
									echo 
									"<tr id='". $drr[$i2]['ID'] ."'>
									<td>". $drr[$i2]['ID']    ."</td>

									<td  name='code'>" . $drr[$i2]['Code']    ."</td>
									<td  name='Setname'>" . $drr[$i2]['Setname']    ."</td>
									<td  name='SetValue' style='max-width: 150px;overflow: hidden;'>" . $drr[$i2]['SetValue']    ."</td>
									<td  name='SetProperty'>" . $drr[$i2]['SetProperty']    ."</td>

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




});
</script>
