<?php
require_once('config.php');

include('header.php');
include('FunctionSelectSystem.php');

$username = selectonce("SELECT id,username FROM users where  id =  ". $_GET["uname"],"username");

$enduser = selectonce("SELECT COUNT(id) as enduser FROM caseevents WHERE   eventstate = 1  AND enduser = ". $_GET["uname"],"enduser");
$aswilluser = selectonce("SELECT COUNT(id) as enduser FROM caseevents WHERE   eventstate = 3  AND enduser = ". $_GET["uname"],"enduser");
$neww = selectonce("SELECT COUNT(id) as enduser FROM caseevents WHERE `TheDate` > CURDATE() AND ISNULL( `parent`)AND NOT( `ID` IN(SELECT  `caseevents`.`parent`  FROM `caseevents`  WHERE (`caseevents`.`parent` IS NOT NULL))) AND theuser =". $_GET["uname"],"enduser");


$query= mysql_query("SELECT casesmaster.`id`,casesmaster.`Code`,caseevents.`DetailsEvent`,caseevents.`EventState`,caseevents.`parent`,caseevents.`TheDate`
FROM
    `lawyerdb1`.`caseevents`
    INNER JOIN `lawyerdb1`.`casesmaster` 
        ON (`caseevents`.`CaseID` = `casesmaster`.`ID`)
                WHERE caseevents.`EventState`=3 AND caseevents.`enduser`=". $_GET["uname"]);

$dtable="";
	while($row1 = mysql_fetch_array($query))
	{
		$dtable.="<tr>
		<td><a id='" . $row1['id'] . "' class='evnts2' href='#'><span class='label label-success'>" . $row1['DetailsEvent'] . "</span></a></td>
		<td>" . $row1['Code'] . "  </td>
		 </tr>
		" ;
	}
	 
	// $sqc="SELECT COUNT(id) as enduser FROM caseevents WHERE   eventstate = 1  AND enduser = ". $_GET["uname"] ;
	// $query=mysql_query($sqc)  ;
	// $row = mysql_fetch_assoc($query);
	// $enduser=$row['enduser'];
 

 
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
					شاشة تقارير المستخدم
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









<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid profile">
					<div class="span12">
						<!--BEGIN TABS-->
						<div class="tab-pane row-fluid active" id="tab_1_1">
									<ul class="unstyled profile-nav span3">
										<li><img src="facebook-logo.jpeg" alt="" /> <a href="#" class="profile-edit">تعديل</a></li>
										<li><a href="#">Projects</a></li>
										<li><a href="#">Messages <span>3</span></a></li>
										<li><a href="#">Friends</a></li>
										<li><a href="#">Settings</a></li>
									</ul>
									<div class="span9">
										<div class="row-fluid">
											<div class="span8 profile-info">
												<h1><?php echo $username;  ?></h1>
												<p> تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف .</p>
												<p> تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف .</p>
												<p> تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف  تعريف .</p>
												<p><a href="#">www.mywebsite.com</a></p>
												<ul class="unstyled inline">
													<li><i class="icon-map-marker"></i> Spain</li>
													<li><i class="icon-calendar"></i> 18 Jan 1982</li>
													<li><i class="icon-briefcase"></i> Design</li>
													<li><i class="icon-star"></i> Top Seller</li>
													<li><i class="icon-heart"></i> BASE Jumping</li>
												</ul>
											</div>
											<!--end span8-->
											<div class="span4">
												<div class="portlet sale-summary">
													<div class="portlet-title">
														<div class="caption">ملخص الاعمال
														</div>
														<div class="tools">
														<i class="icon-calendar"></i>
															<a class="reload" href="javascript:;"></a>
														</div>
													</div>
													<div class="portlet-body">
														<ul class="unstyled">
															<li>
																<span class="label label-success label-mini" >المنتهي  </span> 
																<span class="sale-num"><?php echo $enduser;  ?></span>
															</li>
															<li>
																<span class="label label-info label-mini" >الموجل  </span> 
																<span class="sale-num"><?php echo $aswilluser;  ?></span>
															</li>
															<li>
																<span  class="label label-warning label-mini" > الجديــد   </span> 
																<span  class="sale-num"><?php echo $neww;  ?></span>
															</li>
															 
														</ul>
													</div>
												</div>
											</div>
											<!--end span4-->
										</div>
										<!--end row-fluid-->
										<div class="tabbable tabbable-custom tabbable-custom-profile">
											<ul class="nav nav-tabs">
												<li class="active"><a href="#tab_1_11" data-toggle="tab">اخر التعاملات</a></li>
												<li ><a href="#tab_1_22" data-toggle="tab">تأجيلات</a></li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="tab_1_11">
													<div class="portlet-body" style="display: block;">
														<table class="table table-striped table-bordered table-advance table-hover">
															<thead>
																<tr>
																	<th><i class="icon-briefcase"></i> الاجراء وتاريخه</th>
																	<th class="hidden-phone"><i class="icon-question-sign"></i> التعليق وتاريخه</th>
																	<th><i class="icon-bookmark"></i> كود القضية</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
																<?php echo $dtable;?>
															</tbody>
														</table>
													</div>
												</div>
												<!--tab-pane-->
												<div class="tab-pane" id="tab_1_22">
													<div class="tab-pane active" id="tab_1_1_1">
														<div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
															<ul class="feeds">
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-success">                        
																					<i class="icon-bell"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					You have 4 pending tasks.
																					<span class="label label-important label-mini">
																					Take action 
																					<i class="icon-share-alt"></i>
																					</span>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			Just now
																		</div>
																	</div>
																</li>
																<li>
																	<a href="#">
																		<div class="col1">
																			<div class="cont">
																				<div class="cont-col1">
																					<div class="label label-success">                        
																						<i class="icon-bell"></i>
																					</div>
																				</div>
																				<div class="cont-col2">
																					<div class="desc">
																						New version v1.4 just lunched!   
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col2">
																			<div class="date">
																				20 mins
																			</div>
																		</div>
																	</a>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-important">                      
																					<i class="icon-bolt"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					Database server #12 overloaded. Please fix the issue.                      
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			24 mins
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			30 mins
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-success">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			40 mins
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-warning">                        
																					<i class="icon-plus"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New user registered.                
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			1.5 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-success">                        
																					<i class="icon-bell-alt"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					Web server hardware needs to be upgraded. 
																					<span class="label label-inverse label-mini">Overdue</span>             
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			2 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label">                       
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			3 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-warning">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			5 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			18 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label">                       
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			21 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			22 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label">                       
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			21 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			22 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label">                       
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			21 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			22 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label">                       
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			21 hours
																		</div>
																	</div>
																</li>
																<li>
																	<div class="col1">
																		<div class="cont">
																			<div class="cont-col1">
																				<div class="label label-info">                        
																					<i class="icon-bullhorn"></i>
																				</div>
																			</div>
																			<div class="cont-col2">
																				<div class="desc">
																					New order received. Please take care of it.                 
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col2">
																		<div class="date">
																			22 hours
																		</div>
																	</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
												<!--tab-pane-->
											</div>
										</div>
									</div>
									<!--end span9-->
								</div>
						<!--END TABS-->
					</div>
				</div>
				<!-- END PAGE CONTENT-->
















				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
		<!-- END PAGE CONTAINER--> 
	</div>


<?php
include('footer.php');

?>
