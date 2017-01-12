<?php    session_start();
include('config.php');
include('fldReports/courtsdrp.php');








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

//if (!(in_array("مدير عام على النظام", $roles) or in_array("ادارة المستخدمين", $roles)))  {  header('Location: notpermeted.php'); } 

 if (!in_array("مدير عام على النظام", $roles))   { 
 	if (!in_array("ادارة المستخدمين", $roles)) {
 		header('Location: notpermeted.php');
 	}
 }   

 

include('header.php');








$sq='SELECT * FROM users   ORDER BY  username'; 


$query= mysql_query($sq);
$tablerows='';

while ($row =mysql_fetch_array($query)) {
	$tablerows .= '
	<tr>
		<td><img src="assets/img/avatar.png" alt="" /></td>
		<td class="hidden-phone"><a href="pgUserprofile.php?uname='.$row["id"].'" id="'.$row["id"].'"  >'.$row["first_name"].'</a></td>
		<td><b>'.$row["username"].' </b></td>
		<td class="hidden-phone">'.$row["thedate"]  .' </td>
		<td class="hidden-phone" title="'.$row["password"].'">***</td>
		<td><span class="label label-danger">Blocked</span></td>
		<td><a class="btn mini red-stripe Permissions" id="'.$row["id"].'" href="#">الصلاحيات</a></td>
	    <td><a href="#" id="'.$row["id"].'" class="showcourt" ><span class="icon-home"> المحاكم</span></a></td>
	</tr>


	';
};





$qu= mysql_query( 'SELECT  distinct(category) as category FROM roles   ORDER BY  category');
$categorys='';

while ($row =mysql_fetch_array($qu)) {
	$categorys .= '<li><a href="#" class="hrrrf" name='.$row["category"].' >  '.$row["category"].'</a></li>';
}


$qu2= mysql_query('SELECT * FROM roles    order by category');
$perm='';

while ($row =mysql_fetch_array($qu2)) {
	$perm .= '<option value="'.$row["ID"].'">'.$row["category"]."-".$row["RoleName"].'</option>';
}
 


?>






<!-- Get Courts User --> 
<div id="Get_court_user" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
	<form id="form102"   method="POST">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
			<h3> محاكم المستخدم (<span id="uidd"></span>)</h3>
			<input type="hidden" name="idthread">
		</div>
		<div class="modal-body">
			<table id="context" class="table-bordered table-striped table-condensed cf">
				<thead class="cf">
					<tr>
						<th>#</th>
						<th>المحكمة</th>
									<!-- <th class="numeric">الايميل</th>
									<th class="numeric">اسم الدخول</th>
									<th class="numeric">كلمة المرور</th> -->

								</tr>
							</thead>
							<tbody id="tblcourtdetail">




							</tbody>
						</table>

						<div class="control-group">
							<div class="controls">
								<select class="span12 m-wrap"  onchange="myevnttypeschange()" id="courtss"  data-placeholder="Choose a Category" tabindex="1">
									<?php  echo GetCourts(0);?>  
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
			<!-- Get Courts User -->





			<!-- Get Permission User --> 
			<div id="Get_Permission_user" class="modal hide fade" tabindex="-1" data-focus-on="input:first">
				<form id="form103"   method="POST">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h3> صلاحيات المستخدم (<span id="uidd"></span>)</h3>
						<input type="hidden" name="idthread">
					</div>
					<div class="modal-body">


						<!-- BEGIN CONDENSED TABLE PORTLET-->
						<div class="portlet box green">
							<div class="portlet-title">
								<div class="caption"><i class="icon-picture"></i>الصلاحيات</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									<a href="#portlet-config" data-toggle="modal" class="config"></a>
									<a href="javascript:;" class="reload"></a>
									<a href="javascript:;" class="remove"></a>
								</div>
								<div class="actions">

									<div class="btn-group">
										<a class="btn blue" href="#" data-toggle="dropdown">
											<i class="icon-filter"></i> القسم
											<i class="icon-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-left">
											<?php echo $categorys; ?>

											<li class="divider"></li>
											<li><a href="#" class="hrrrf" ><i class="i"></i> الكل  </a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="portlet-body">
								<table class="table table-condensed table-hover">
									<thead>
										<tr>
											<th class="hidden-480">#</th>
											<th>الصلاحية</th>
											<th class="hidden-480">القسم</th>
											<th class="hidden-480">تحكم</th>
										</tr>
									</thead>
									<tbody id="tblGetPermission">
										

									</tbody>
								</table>
							</div>
						</div>
						<!-- END CONDENSED TABLE PORTLET-->
						<div class="control-group">
							<div class="controls">
								<select class="span12 m-wrap"  onchange="myevnttypeschange()" id="perms"  data-placeholder="Choose a Category" tabindex="1">
									<?php  echo $perm;?>   
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
			<!-- Get Courts User -->











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
								المستخدمين  
								<small>الشاشة ادارة المستخدم</small>
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


					<div id="tab_1_5" class="tab-pane">
<span style="color:red">توقيت الدخول حسب توقيت جرنتش لتوقيت الكويت يضاف ثلاث ساعات على التوقيت المعروض</span>
						<div class="portlet-body">

							<table class="table table-striped table-hover table-advance">
								<thead>
									<tr>
										<th><i class="icon-picture"></i> </th>
										<th class="hidden-phone">الاسم بالكامل</th>
										<th>اسم المستخدم</th>
										<th class="hidden-phone">اخر دخول</th>
										<th class="hidden-phone">كلمة المرور</th>
										<th>الحالة</th>
										<th></th><th></th>
									</tr>
								</thead>
								<tbody>
									<?php echo $tablerows; ?>

								</tbody>
							</table>
						</div>
						<div class="space5"></div>

					</div>






					<!-- END PAGE CONTENT-->
				</div>
				<!-- END PAGE CONTAINER--> 
			</div>





			<?php include('footer.php');?>




			<script>
	//
	$(document).ready(function(e){


		$('.showcourt').click(function(){
			reload_courtuser($(this).attr("id"));
			$("#uidd").text($(this).text());
		});

		$('.Permissions').click(function(){
			reload_Permissions($(this).attr("id"));
			$("#uidd").text('');
			$('#Get_Permission_user').modal('show');
		});

		 
		$('.hrrrf').live("click",function(){
			reload_Permissions($("#hddnuID").val(),$(this).attr("name"));
		});


		$('.detperm').live("click",function(){
	//	 alert($(this).attr("id"));
		 delperm($(this).attr("id"));
		});


	});



//--------------  get courtuser --------------------
function delperm(idf) {

	$.ajax({
		type: "POST",
		url:'delperm.php',
		dataType: 'html',
		data: {permID:idf  }, 
		success: function (data) {
reload_Permissions(  $("#hddnuID").val());
		  
},
error: function (msg) {alert('sameh_ERROR');}
});
}




//--------------  get courtuser --------------------
function reload_courtuser(idf) {

	var USID = idf; 

	var str;
	$.ajax({
		type: "POST",
		url:'getCourtdetails.php',
		dataType: 'html',

		data: {userID:"'" + USID + "'" }, 
		success: function (data) {

			$('#tblcourtdetail').html('<input id="hddnCID" name="HiddenuserID" value="'+ USID +'" type="hidden" />');

			$('#tblcourtdetail').append(data);
			$('#Get_court_user').modal('show'); 


	//$('tr[class^=child-]').hide().children('td');

},
error: function (msg) {alert('sameh_ERROR');}
});
};


//--------------add courtuser--------------------

$('#form102').submit(function(e) {
	e.preventDefault();

	var USID = $("input[name='HiddenuserID']").val();
	var courtID = $("#courtss").val();
	

	$.ajax({
		type: 'POST',
		url:'addCourtUser.php',

		data: {USID:USID ,courtID:courtID },
				//dataType: 'json',
				success: function (data) {
 //alert(data);
 reload_courtuser(USID);
					// $('#Get_court_user').modal('hide'); 

				},
				error: function (data) {alert('sameh_ERROR');}
			});
});

//--------------  get Permissions --------------------
function reload_Permissions(idf,evtyp) {

	var USID = idf; 
  //alert(idf +"ff+"+evtyp);
	var str;
	$.ajax({
		type: "POST",
		url:'getPermissions.php',
		dataType: 'html',
		data: {userID:USID,evtyp: evtyp }, 
		success: function (data) {
 
			$('#tblGetPermission').html('<input id="hddnuID" name="HiddenuserID2" value="'+ USID +'" type="Hidden" />');
			$('#tblGetPermission').append(data);
			 

  
 
	//$('tr[class^=child-]').hide().children('td');

},
error: function (msg) {alert('sameh_ERROR');}
});
};

//--------------add  Permissions--------------------
$('#form103').submit(function(e) {
	e.preventDefault();

	var USID = $("input[name='HiddenuserID2']").val();
	var permID = $("#perms").val();
	

	$.ajax({
		type: 'POST',
		url:'addPermissions.php',

		data: {USID:USID ,permID:permID },
				//dataType: 'json',
				success: function (data) {
 //alert(data);
 reload_Permissions(USID);
					// $('#Get_court_user').modal('hide'); 

				},
				error: function (data) {alert('sameh_ERROR');}
			});
});

</script>
