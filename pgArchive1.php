	<?php
	include('./header.php');
	include('./config.php');
include('fldReports/courtsdrp.php');

	
	
	?>

<!--  searchModal -->
<div id="searchModal" class="modal hide fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>البحث في الارشيف</h3>
	</div>
	<form id="formsearh" action="getarchse.php" method="POST" id="sermod">
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



	<!-- BEGIN PAGE -->
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

						قسم الارشيف  <small>شاشة عرض الارشيف.</small>
					</h3>
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="index.html">Home</a> 
							<i class="icon-angle-left"></i>
						</li>
						<li>
							<a href="#">Form Stuff</a>
							<i class="icon-angle-left"></i>
						</li>
						<li><a href="#">Dropzone File Upload</a></li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row-fluid">
				<div class="span12">


					<div id="tab_2_5" class="tab-pane">
						<div class="row-fluid search-forms search-default">
							<form class="form-search" action="#">
								<div class="chat-form">
									<div class="input-cont">   
										<input id="mainsearch" disabled="1" type="text" placeholder="اكتب شيئاً..." class="m-wrap" />
									</div>
									<button data-toggle="modal" href="#searchModal" class="btn green">بحث متقدم <i class="m-icon-swapleft icon-search"></i></button>
								</div>
							</form>
						</div>
						<div id="displayarch" class="row-fluid search-images">


						</div>

					</div>







				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
		<!-- END PAGE CONTAINER-->
	</div>
	<!-- END PAGE --> 

	<?php include('footer.php'); ?>

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




			$("input:radio[name=optionsRadios1]").click(function() {
				var valu = $(this).val();
				$("input:hidden[name=OpratType]").val(valu);
				reload_arch($.urlParam('cid'),valu);
				//
			});

//mainsearch


$("#mainsearch").live('keyup', function (e) {

var key = $(this).val();

	$.ajax({
		type: "POST",
		url:'getarchse.php',
		dataType: 'html', 
		data: {keys: key },

		
		success: function (data) {
			$('#displayarch').html('');
			$('#displayarch').append(data);
		},
		error: function (msg) {alert('sameh_ERROR');}
	});


});



$('.del').live("click",function(){
	var valu = $("input:radio[name=optionsRadios1]:checked").val();
	del_arch($(this).attr("id"),valu);
});





});






$('#formsearh').submit(function(e) {
	e.preventDefault();
	$("#formsearh").ajaxSubmit(
	{

		success:function(data)
		{$('#searchModal').modal('hide'); 
			$('#displayarch').html('');
			$('#displayarch').append(data);
			// $('#tblrowcounts').html( '#' +( $('#casesmaster tr').length) + '#');


		}
	});
});







//--------------  get arch --------------------
function reload_arch(idf,artyp){

	var CaseID = idf; 

	var str;
	$.ajax({
		type: "POST",
		url:'getarch.php',
		dataType: 'html',

		data: {CaseID: CaseID ,artyp: artyp}, 
		success: function (data) {
//alert(idf+"-"+artyp);
			//$('#evntscase').html('<input id="hddnCID" name="HiddenCaseID" value="'+ CaseID +'" type="hidden" />');
			$('#scans').html('');
			$('#scans').append(data);

		},
		error: function (msg) {alert('sameh_ERROR');}
	});
  	//evntthreads
  };


//--------------  delete arch --------------------

function del_arch(idf,ttp){
	$.ajax({
		type: "POST",
		url:'delarch.php',
		dataType: 'html',

		data: {tID: idf ,artyp: ttp}, 
		success: function (data) {
			alert(idf + ttp);
		},
		error: function (msg) {alert('sameh_ERROR');}
	});
}
 //--------------  delete arch --------------------
 
</script>
