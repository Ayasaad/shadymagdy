<?php 
if(session_id() == '') {
	session_start(); 
}
require_once('config.php');

if (!$_SESSION['USID']){

	header('Location: login.php');

}


?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>المرشد للبرمجيات والتكنولوجيا | المحامي الآلي</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="./assets/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/bootstrap/css/bootstrap-responsive-rtl.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/css/style-metro-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/css/style-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/css/style-responsive-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/css/themes/default-rtl.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="./assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES -->
	<link rel="stylesheet" type="text/css" href="./assets/plugins/chosen-bootstrap/chosen/chosen-rtl.css" />
	<link rel="stylesheet" type="text/css" href="./assets/plugins/select2/select2_metro_rtl.css" />
	<link href="./assets/css/pages/profile-rtl.css" rel="stylesheet" type="text/css" />
	<link href="./assets/plugins/dropzone/css/dropzone-rtl.css" rel="stylesheet"/>
	<link href="assets/plugins/glyphicons/css/glyphicons.css" rel="stylesheet" />
	<link href="assets/plugins/glyphicons_halflings/css/halflings.css" rel="stylesheet" />
	<link href="assets/css/pages/search-rtl.css" rel="stylesheet" type="text/css"/>
	<link href="./assets/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet" />

	<!--module CSS-->
	<link rel="stylesheet" type="text/css" href="./assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.css"/>
	<link href="./assets/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css"/>
	<link href="assets/plugins/jquery-ui/jquery.ui.slider-rtl.css" rel="stylesheet"/>
	<link rel="stylesheet" href="./assets/plugins/data-tables/DT_bootstrap_rtl.css" />
	<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
	<link href="assets/plugins/bootstrap-switch/static/stylesheets/bootstrap-switch-metro-rtl.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="assets/plugins/jquery-tags-input/jquery.tagsinput-rtl.css" />
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="./assets/favicon.ico" />
	<link href="assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
	<link href="assets/plugins/chosen-bootstrap/chosen/chosen-rtl.css" rel="stylesheet" type="text/css"/>







	<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css"/>
	





	<style>
		@font-face {
			font-family: myFirstFont;
			src: url(DTHULUTH2.ttf);

		}

	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" style="width: 150px;" href="index.php">
					<!-- <img src="./assets/img/logo.png" alt="logo" /> -->
					<span style="margin-right: 30px; color: red; font-family: Segoe UI"><span style="color: white;">المحامي </span>الآلي</span>
				</a>
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
					<img src="./assets/img/menu-toggler.png" alt="" />
				</a>          
				<!-- END RESPONSIVE MENU TOGGLER -->            
				<!-- BEGIN TOP NAVIGATION MENU -->  
				<span class="brand"  id="officename" style="color:#ffffff;font-size:12px; font-family: myFirstFont; width: 170px;margin:1px 400px 0 0;"><?php echo  $_SESSION['officename'];?></span>            
				<ul class="nav pull-left">
					<!-- BEGIN NOTIFICATION DROPDOWN -->  

					<li class="dropdown pulsate-crazy" id="header_notification_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-warning-sign"></i>
							<span class="badge">20</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>لديك 20 اشعار جديد</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height:250px">
									
									<?php  echo $_SESSION['notilab'];	 	?>
								</ul>
							</li>
							<li class="external">
								<a href="pgNotifications.php">مشاهدة كل الاشعارات <i class="m-icon-swapleft"></i></a>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown" id="header_inbox_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-envelope"></i>
							<span class="badge">5</span>
						</a>
						<ul class="dropdown-menu extended inbox">
							<li>
								<p>You have 12 new messages</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height:250px">
									<li>
										<a href="inbox.html?a=view">
											<span class="photo"><img src="./assets/img/avatar2.jpg" alt="" /></span>
											<span class="subject">
												<span class="from">Lisa Wong</span>
												<span class="time">Just Now</span>
											</span>
											<span class="message">
												Vivamus sed auctor nibh congue nibh. auctor nibh
												auctor nibh...
											</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
											<span class="photo"><img src="./assets/img/avatar3.jpg" alt="" /></span>
											<span class="subject">
												<span class="from">Richard Doe</span>
												<span class="time">16 mins</span>
											</span>
											<span class="message">
												Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
												auctor nibh...
											</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
											<span class="photo"><img src="./assets/img/avatar1.jpg" alt="" /></span>
											<span class="subject">
												<span class="from">Bob Nilson</span>
												<span class="time">2 hrs</span>
											</span>
											<span class="message">
												Vivamus sed nibh auctor nibh congue nibh. auctor nibh
												auctor nibh...
											</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
											<span class="photo"><img src="./assets/img/avatar2.jpg" alt="" /></span>
											<span class="subject">
												<span class="from">Lisa Wong</span>
												<span class="time">40 mins</span>
											</span>
											<span class="message">
												Vivamus sed auctor 40% nibh congue nibh...
											</span>  
										</a>
									</li>
									<li>
										<a href="inbox.html?a=view">
											<span class="photo"><img src="./assets/img/avatar3.jpg" alt="" /></span>
											<span class="subject">
												<span class="from">Richard Doe</span>
												<span class="time">46 mins</span>
											</span>
											<span class="message">
												Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh
												auctor nibh...
											</span>  
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown" id="header_task_bar">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-tasks"></i>
							<span class="badge">5</span>
						</a>
						<ul class="dropdown-menu extended tasks">
							<li>
								<p>You have 12 pending tasks</p>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height:250px">
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">New release v1.2</span>
												<span class="percent">30%</span>
											</span>
											<span class="progress progress-success ">
												<span style="width: 30%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">Application deployment</span>
												<span class="percent">65%</span>
											</span>
											<span class="progress progress-danger progress-striped active">
												<span style="width: 65%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">Mobile app release</span>
												<span class="percent">98%</span>
											</span>
											<span class="progress progress-success">
												<span style="width: 98%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">Database migration</span>
												<span class="percent">10%</span>
											</span>
											<span class="progress progress-warning progress-striped">
												<span style="width: 10%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">Web server upgrade</span>
												<span class="percent">58%</span>
											</span>
											<span class="progress progress-info">
												<span style="width: 58%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">Mobile development</span>
												<span class="percent">85%</span>
											</span>
											<span class="progress progress-success">
												<span style="width: 85%;" class="bar"></span>
											</span>
										</a>
									</li>
									<li>
										<a href="#">
											<span class="task">
												<span class="desc">New UI release</span>
												<span class="percent">18%</span>
											</span>
											<span class="progress progress-important">
												<span style="width: 18%;" class="bar"></span>
											</span>
										</a>
									</li>
								</ul>
							</li>
							<li class="external">
								<a href="#">See all tasks <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
					<!-- END TODO DROPDOWN -->               
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<img alt="" src="./assets/img/avatar1_small.jpg" />
							<span class="username"><?php echo  $_SESSION['USNM']; ?></span>
							<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="icon-user"></i>حسابي</a></li>
							<li><a href="#"><i class="icon-calendar"></i> My Calendar</a></li>
							<li><a href="#"><i class="icon-envelope"></i> My Inbox <span class="badge badge-important">3</span></a></li>
							<li><a href="#"><i class="icon-tasks"></i> My Tasks <span class="badge badge-success">8</span></a></li>
							<li class="divider"></li>
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
							<li><a href="#"><i class="icon-lock"></i> Lock Screen</a></li>
							<li><a href="login.php"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN CONTAINER -->   

	<div class="page-container row-fluid">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->        
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li>
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search">
						<div class="input-box">
							<a href="javascript:;" class="remove"></a>
							<input type="text" placeholder="Search..." />
							<input type="button" class="submit" value=" " />
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				
				<li class="active ">
					<a href="javascript:;">
						<i class="icon-cogs"></i> 
						<span class="title">القضايا</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						
						<li class="active">
							<a href="pgCases.php">
								عرض القضايا</a>
							</li>
							<li class="active">
								<a href="addnewcase.php">
									اضافة قضية جديدة</a>
								</li>

								<li class="active">
									<a href="pgArchive1.php">
										ادارة الارشيف </a>
									</li>
								</ul>
							</li>
							<li>
								<a href="javascript:;">
									<i class="icon-cogs"></i> 
									<span class="title">التقارير</span>
									<span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">

									<li>
										<a href="pgReports.php">
											شاشة التقارير</a>
										</li>

									</ul>
								</li>
								<li>
									<a href="javascript:;">
										<i class="icon-cogs"></i> 
										<span class="title">المستخدمين</span>
										<span class="selected"></span>
										<span class="arrow open"></span>
									</a>
									<ul class="sub-menu">

										<li>
											<a href="pgRegUsers.php">
												اضافة مستخدم جديد</a>
											</li>
											<li>
												<a href="pgManageUsers.php">
													ادارة المستخدمين</a>
												</li>
												<li>
													<a href="pgChangePass.php">
														تغيير كلمة المرور</a>
													</li>

												</ul>
											</li>
											<li>
												<a href="javascript:;">
													<i class="icon-cogs"></i> 
													<span class="title">السكرتارية</span>
													<span class="selected"></span>
													<span class="arrow open"></span>
												</a>
												<ul class="sub-menu">

													<li>
														<a href="pgCalender.php">
															الرزنامة</a>
														</li>


													</ul>
												</li>
												<li>
													<a href="javascript:;">
														<i class="icon-cogs"></i> 
														<span class="title">الحسابات</span>
														<span class="selected"></span>
														<span class="arrow open"></span>
													</a>
													<ul class="sub-menu">

														<li>
															<a href="pgReports.php">
																قيد اليومية</a>
															</li>
															<li>
																<a href="pgReports.php">
																	دفتر اليويمة</a>
																</li>
																<li>
																	<a href="pgReports.php">
																		حساب الاستاذ العام</a>
																	</li>
																	<li>
																		<a href="pgReports.php">
																			ميزان المراجعة</a>
																		</li>
																		<li>
																			<a href="pgReports.php">
																				الميزانية</a>
																			</li>

																		</ul>
																	</li>
																	<li>
																		<a href="javascript:;">
																			<i class="icon-cogs"></i> 
																			<span class="title">المزيد</span>
																			<span class="selected"></span>
																			<span class="arrow open"></span>
																		</a>
																		<ul class="sub-menu">

																			<li>
																				<a href="pgReports.php">
																					المكتبة القانونية</a>
																				</li>


																			</ul>
																		</li>
																		<li>
																			<a href="javascript:;">
																				<i class="icon-cogs"></i> 
																				<span class="title">الضبط</span>
																				<span class="selected"></span>
																				<span class="arrow open"></span>
																			</a>
																			<ul class="sub-menu">

																				<li>
																					<a href="pgReports.php">
																						نسخ احتياطي</a>
																					</li>
																					<li>
																						<a href="pgScreens.php">
																							الشاشات</a>
																						</li>
																						<li>
																							<a href="pgReports.php">
																								البحث الآلي</a>
																							</li>
																							<li>
																								<a href="pgAutosearchset.php">
																									ضبط البحث الآلي</a>
																								</li>

																							</ul>
																						</li>
																						<li>
																							<a href="javascript:;" onclick="return popitup('https://www.kuwaitcourts.gov.kw/searchPages/searchCases.jsp')">
																								<i class="icon-foursquare"></i> 
																								<span class="title">البوابة</span>

																							</a>

																						</li>
																					</ul>
																					<div style="border:0px solid red; width:98%">
																						<span style="color:#ffffff">المتواجدون:-</span>
																						<?php
																						$query= mysql_query("SELECT username FROM users WHERE DATE(thedate) ='". date("Y/m/d") ."'");
																						$founded ="";
																						while($row = mysql_fetch_array($query))
																						{
																							$founded .='<p  style="color:#ffffff">'.$row["username"].'</p>';
																						}
																						echo $founded;
																						?>
																					</div>
																					<!-- END SIDEBAR MENU -->
																				</div>
