<?php  
require_once('config.php');

include('header.php');

$uuid=$_SESSION['USID'];

$sq="SELECT
 	  `casesmaster`.`ID`
  	, `caseevents`.`DetailsEvent`
    , `caseevents`.`TheDate`
    , `caseevents`.`CDate`
    , `caseevents`.`eventstate`
    , `casesmaster`.`Code`
    , `persons`.`sName`
    , `casesmaster`.`subject`
    ,`users`.`username`
FROM
    `lawyerdb1`.`usercourt`
    INNER JOIN `lawyerdb1`.`courts` 
        ON (`usercourt`.`CourtID` = `courts`.`ID`)
    INNER JOIN `lawyerdb1`.`users` 
        ON (`usercourt`.`UserID` = `users`.`id`)
    INNER JOIN `lawyerdb1`.`casesdetails` 
        ON (`casesdetails`.`Court` = `courts`.`ID`)
    INNER JOIN `lawyerdb1`.`casesmaster` 
        ON (`casesdetails`.`CaseMasterID` = `casesmaster`.`ID`)
    INNER JOIN `lawyerdb1`.`persons` 
        ON (`casesmaster`.`CustomerID` = `persons`.`ID`)
    INNER JOIN `lawyerdb1`.`caseevents` 
        ON (`caseevents`.`CaseID` = `casesmaster`.`ID`)
        
WHERE caseevents.id IN (

SELECT parent FROM caseevents WHERE  id IN (

SELECT ID FROM caseevents WHERE  eventstate = 2  AND parent NOT IN (
 SELECT parent FROM caseevents WHERE  parent IS NOT NULL AND eventstate =1 
)))  AND  `users`.`ID` = " . $uuid . "   OR `caseevents`.`WithUser` = "  . $uuid;

$query= mysql_query($sq);
$dtable="";
 

	  while($row = mysql_fetch_array($query))
	 {
$dtable.='<tr>
				<td><a href="#">' . $row['DetailsEvent']  . '</td>
        		<td class="hidden-phone">' . $row['TheDate']  . '</td>
        		<td>' . $row['sName']  . '</td>
        		<td>  ' . $row['subject']  . '</span></td>
        		<td> <span class="label label-success label-mini">' . $row['username']  . '</span></td>
        		<td> <span class="label label-success label-mini">' . $row['eventstate']  . '</span></td>
        		<td><a class="btn mini green-stripe" href="pgCases.php?cccd=' . $row['ID']  . '&mark=1">' . $row['Code']  . '</a></td>
        	</tr>';
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
					   شاشة الاشعارات
					<small>الشاشة اشعارات الاجراءات</small>
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





<div id="tab_1_4" class="tab-pane">
								<div class="row-fluid search-forms search-default">
									<form class="form-search" action="#">
										<div class="chat-form">
											<div class="input-cont">   
												<input type="text" placeholder="بحث..." class="m-wrap" />
											</div>
											<button type="button" class="btn green">ابحث &nbsp; <i class="m-icon-swapleft m-icon-white"></i></button>
										</div>
									</form>
								</div>
								<div class="portlet-body" style="display: block;">
									<table class="table table-striped table-bordered table-advance table-hover">
										<thead>
											<tr>
												<th><i class="icon-briefcase"></i> الاجراء</th>
												<th class="hidden-phone"><i class="icon-calendar"></i> التاريخ</th>
												<th><i class="icon-user"></i> العميل</th>
												<th><i class="icon-bullhorn"></i> الموضوع</th>
												<th><i class="icon-bullhorn"></i> المستخدم</th>
												<th><i class="icon-bullhorn"></i> الحالة</th>
												<th><i class="icon-bookmark"></i> الكورد </th>
											</tr>
										</thead>
										<tbody>
											 <?php echo $dtable;?>
										</tbody>
									</table>
								</div>
								<div class="space5"></div>
								 
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
