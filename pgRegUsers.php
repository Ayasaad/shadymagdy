<?php
require_once('config.php');

include('header.php');







//Check if the form is submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username'])){
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

 $query= mysql_query("insert into users (username,password,email,first_name) values ('". $username ."','".$password."','".$email."','".$fullname."')");
echo "samehtaha";

    }






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
					 المستخدمين  
					<small>الشاشة اضافة مستخدم جديد</small>
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
						<div class="caption"><i class="icon-briefcase"></i>اضافة مستخدم</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
							<a href="#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="reload"></a>
							<a href="javascript:;" class="remove"></a>
						</div>

					 
					</div>
					<div class="portlet-body no-more-tables">

						 


 <form class="form-vertical register-form" action="pgRegUsers.php" method="post">
			<h3 >تسجيل مستخدم</h3>
			<p>البيانات الشخصية:</p>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">رالاسم</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-font"></i>
						<input class="m-wrap placeholder-no-fix required" type="text" placeholder="الاسم" name="fullname"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
				<label class="control-label visible-ie8 visible-ie9">البريد الاكتروني</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-envelope"></i>
						<input class="m-wrap placeholder-no-fix" type="text" placeholder="البريد الاكتروني" name="email"/>
					</div>
				</div>
			</div>
			

			<p>بيانات تسجيل الدخول:</p>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">اسم المستخدم</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-user"></i>
						<input class="m-wrap placeholder-no-fix" type="text" autocomplete="off" placeholder="اسم المستخدم" name="username"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-lock"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="كلمة المرور" name="password"/>
					</div>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label visible-ie8 visible-ie9">اعد كتابة كلمة المرور</label>
				<div class="controls">
					<div class="input-icon left">
						<i class="icon-ok"></i>
						<input class="m-wrap placeholder-no-fix" type="password" autocomplete="off" placeholder="اعد كتابة كلمة المرور" name="rpassword"/>
					</div>
				</div>
			</div>
			 
			<div class="form-actions">
			 
				<button type="submit" id="register-submit-btn" class="btn green pull-left">
					  تسجيل المستخدم <i class="m-icon-swapleft m-icon-white"></i>
				</button>            
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


<?php
include('footer.php');

?>

 