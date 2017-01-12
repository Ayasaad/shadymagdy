<?php 
session_start(); 
require_once('dbop.php');
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
	if (!in_array("التقارير", $roles)) {
		header('Location: notpermeted.php');

	}
}      
//if (!in_array("مدير عام على النظام", $roles) or in_array("االتقارير", $roles))  {  header('Location: notpermeted.php'); } 


include('header.php'); 

?>

<?php 


//  if (!empty($_POST['optionsRadios2'])){ 
//   if ($_POST['optionsRadios2'] =='1')
//    {$theswitch = " and " ;} else { $theswitch = " or " ;} 
//  }







// $wer='';
// if (!empty($_POST['date_from']) && !empty($_POST['date_to'])){ 
// 	if ($wer =='') {$wer=" where e.TheDate between '" . $_POST['date_from'] . "' and '" . $_POST['date_to'] . "'";} 
// 	else { $wer .= $theswitch . "   e.TheDate between '" . $_POST['date_from'] . "' and '" . $_POST['date_to'] . "'" ;}
// };

// if (!empty($_POST['code'])){ 
// 	if ($wer =='') {$wer='  where casesmaster.Code in( ' . $_POST['code'] . ')';} else { $wer .= $theswitch . '    casesmaster.Code in ( ' . $_POST['code'] . ')' ;}
// };
// if (!empty($_POST['auto'])){
// 	if ($wer =='') {$wer='  where casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';} else { $wer .= $theswitch . '   casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';}
// };
// if (!empty($_POST['cust'])){
// 	if ($wer =='') {$wer='  where  persons.sName = "' . $_POST['cust'] . '"';} else { $wer .= $theswitch . '    persons.sName = "' . $_POST['cust'] . '"';}
// };
// if (!empty($_POST['enm'])){
// 	if ($wer =='') {$wer='  where  persons_1.sName = "' . $_POST['enm'] . '"';} else { $wer .= $theswitch . '    persons_1.sName = "' . $_POST['enm'] . '"';}
// };

// if (!empty($_POST['sub'])){
// 	if ($wer =='') {$wer='  where  casesmaster.subject like "%' . $_POST['sub'] . '%"';} else { $wer .= $theswitch . '   casesmaster.subject like "%' . $_POST['sub'] . '%"';}
// };

// if(!empty($_POST['check_cCourts'])) {
// 	$vch="";
// 	foreach($_POST['check_cCourts'] as $check) {
// 		if ($vch ==''){$vch = $check;}else {$vch .=',' . $check;} 
// 	};
// 	if ($wer =='') {$wer='  where  casesdetails.Court in (' . $vch . ')';} 
// 	else  {$wer .= $theswitch . '    casesdetails.Court in (' . $vch . ')';}
// };

// if(!empty($_POST['check_EventType'])) {
// 	$vch2="";
// 	foreach($_POST['check_EventType'] as $check2) {
// 		if ($vch2 ==''){$vch2 = $check2;}else {$vch2 .=',' . $check2;} 
// 	};
// 	if ($wer =='') {$wer='  where  e.IDEventType in (' . $vch2 . ')';} 
// 	else  {$wer .= $theswitch . '    e.IDEventType in (' . $vch2 . ')';}
// };

// if (!empty($_POST['ceventstats'])){
// 	if ($wer =='') {$wer='  where  e.EventState = ' . $_POST['ceventstats'];} 
// 			  else { $wer .= $theswitch . '    e.EventState = ' . $_POST['ceventstats'];}
// };

// if (!empty($_POST['ctypes'])){
// 	if ($wer =='') {$wer='  where  casesmaster.CaseType = ' . $_POST['ctypes'];} 
// 			  else { $wer .= $theswitch . '    casesmaster.CaseType = ' . $_POST['ctypes'];}
// };

// if (!empty($_POST['cstates'])){
// 	if ($wer =='') {$wer='  where  casesmaster.CaseState = ' . $_POST['cstates'];} 
// 			  else { $wer .= $theswitch . '    casesmaster.CaseState = ' . $_POST['cstates'];}
// };

// if (!empty($_POST['cpositions'])){
// 	if ($wer =='') {$wer='  where  casesdetails.Position = ' . $_POST['cpositions'];} 
// 			  else { $wer .= $theswitch . '    casesdetails.Position = ' . $_POST['cpositions'];}
// };


// 	if ($wer =='') {$wer='  where  casesdetails.nowin=1';} 
// 	else  {$wer .='    AND casesdetails.nowin=1';}

// // if (!empty($_POST['ctypes'])){shstates
// //   	if ($wer ='') {$wer='  where CaseType = ' . $_POST['ctypes'];} else { $wer .='  and  CaseType = ' . $_POST['ctypes'];}
// // };
// // if (!empty($_POST['cstates'])){
// //  	if ($wer ='') {$wer='  where CaseState = ' . $_POST['cstates'];} else { $wer .='  and  CaseState = ' . $_POST['cstates'];}
// // };
// // if (!empty($_POST['cpositions'])){ 
// // 	 	if ($wer ='') {$wer='  where  ( casesdetails.Position = ' . $_POST['cpositions'] . '  AND nowin = 1 )';} else { $wer .='  and  casesdetails.Position = ' . $_POST['cpositions'] . '  AND nowin = 1 )';}
// // };
// // if (!empty($_POST['ceventstats']) && $_POST['ceventstats'] > -1){ 
// //  	if ($wer ='') {$wer='  where caseevents.EventState = ' . $_POST['ceventstats'];} else { $wer .='  and  caseevents.EventState = ' . $_POST['ceventstats'];}
// // };
// // if (!empty($_POST['cUsers']) && $_POST['cUsers'] > -1){
// //   	if ($wer ='') {$wer='  where Enemy = ' . $_POST['cUsers'];} else { $wer .='  and  Enemy = ' . $_POST['cUsers'];}
// // };


// // WHERE (casesdetails.Court =5 AND nowin = 1)


// if($_SERVER['REQUEST_METHOD'] == "POST")  {}
// $query= mysql_query(' ALTER view vwroolall as  SELECT  lawyerdb1.e.ID AS `id2`, casesmaster.id    , 
//    casesmaster.Code    , casesmaster.AutoNumber    , 
//    casesmaster.CustomerID    , 
//    customerposition.PositionName           AS PositionNames,
//    casesmaster.CaseType    ,
//    casetypedetails.CaseTypeDetailsName    , casesmaster.CaseState    ,
//    casestates.StateName    , persons.sName    , casesmaster.subject    , casesmaster.Enemy    , persons_1.sName AS sName2    ,
//    papertypes.PaperType    , 
//    casesmaster.PaperType AS PaperTypeID    , 
//    casesmaster.MonChar    , casesdetails.Court    , 
//    `lawyerdb1`.`casesdetails`.`Circle` AS `Circle`,  
//     `lawyerdb1`.`casesdetails`.`CaseNumber`             AS `CaseNumber`,   
//    	`lawyerdb1`.`casesdetails`.`Secretary`                  AS `Secretary`,
// 	`lawyerdb1`.`casesdetails`.`Gedge`                  AS `Gedges`,
// 	`lawyerdb1`.`casesdetails`.`Floor`                  AS `Floor`,
// 	`lawyerdb1`.`casesdetails`.`Hall`                  AS `Hall`, casesdetails.Position    , courts.CourtName    ,
// 	 positions.positionName    ,
// 	 e.DetailsEvent    , e.IDEventType    ,
// 	  eventtypes.TypeName    , e.TheDate    , e.Notes    , e.TheUser    , e.WithUser    , e.EventState    , eventstats.evStateName  
//  ,
//        (SELECT CONCAT(TheDate," - ",DetailsEvent ) AS DetailsEvent  FROM  `caseevents` e1 WHERE  e1.thedate < e.thedate 
//        AND e.caseid = e1.caseid  AND e.IDEventType = e1.IDEventType ORDER BY e1.thedate DESC LIMIT 1 OFFSET 0) AS prev_value



// 	FROM    casesmaster    
// 	LEFT JOIN casestates           ON (casesmaster.CaseState = casestates.ID)    
// 	LEFT JOIN casetypedetails      ON (casesmaster.CaseType = casetypedetails.ID)    
// 	LEFT JOIN persons              ON (casesmaster.CustomerID = persons.ID)    
// 	LEFT JOIN persons AS persons_1 ON (casesmaster.Enemy = persons_1.ID)    
// 	LEFT JOIN casesdetails         ON (casesdetails.CaseMasterID = casesmaster.ID)    
// 	LEFT JOIN papertypes           ON (casesmaster.PaperType = papertypes.ID)    
// 	LEFT JOIN courts               ON (casesdetails.Court = courts.ID)    
// 	LEFT JOIN positions            ON (casesdetails.Position = positions.ID)    
// 	LEFT JOIN caseevents  e        ON (e.CaseID = casesmaster.ID)    
// 	LEFT JOIN eventstats           ON (eventstats.ID = e.EventState)    
// 	LEFT JOIN eventtypes           ON (e.IDEventType = eventtypes.ID)  
// 	LEFT JOIN eventthreads         ON (eventthreads.EventID = e.ID)	
// 	LEFT JOIN  customerposition    ON (customerposition.ID =  casesdetails.CustPos)
//            '. $wer .'   and  ( e.id NOT IN (SELECT ID FROM caseevents WHERE parent IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL)) AND e.id NOT IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL))
//        ORDER BY  TheDate');



// //  and  ( e.id NOT IN (SELECT ID FROM caseevents WHERE parent IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL)) AND e.id NOT IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL))
// // AND ( e.id NOT IN (SELECT ID FROM caseevents WHERE eventstate = 5))  

// if($_SERVER['REQUEST_METHOD'] == "POST")  {
// $query0=(' ALTER view vwNeedInfo as      SELECT     casesmaster.ID, casesmaster.subject, casesmaster.Code, persons.sName, casesmaster.Enemy, casesmaster.AutoNumber, casestates.StateName, courts.CourtName
// FROM         casesmaster INNER JOIN
// casestates ON casesmaster.CaseState = casestates.ID INNER JOIN
// casesdetails ON casesmaster.ID = casesdetails.CaseMasterID INNER JOIN
// courts ON casesdetails.Court = courts.ID INNER JOIN
// persons ON casesmaster.customerID = persons.ID INNER JOIN
// persons AS persons_1 ON casesmaster.Enemy = persons_1.ID AND casesmaster.Enemy = persons_1.ID
// WHERE     (casesmaster.ID IN
// (SELECT     CaseID
// FROM         caseevents
// WHERE     (IDEventType <> 1)
// GROUP BY CaseID
// HAVING      (MAX(TheDate) < CURDATE()))) AND (casesmaster.CaseState NOT IN (5, 11, 9, 12, 1010)) ');
// }


// //el mongaz

// if($_SERVER['REQUEST_METHOD'] == "POST")  {
// 	$sqwals="  SELECT
//   `e`.`ID`                                            AS `id2`,
//   `lawyerdb1`.`casesmaster`.`ID`                      AS `id`,
//   e.parent,
//   `lawyerdb1`.`casesmaster`.`Code`                    AS `Code`,
//   `lawyerdb1`.`casesmaster`.`AutoNumber`              AS `AutoNumber`,
//   `lawyerdb1`.`casesmaster`.`CustomerID`              AS `CustomerID`,
//   `lawyerdb1`.`customerposition`.`PositionName`       AS `PositionNames`,
//   `lawyerdb1`.`casesmaster`.`CaseType`                AS `CaseType`,
//   `lawyerdb1`.`casetypedetails`.`CaseTypeDetailsName` AS `CaseTypeDetailsName`,
//   `lawyerdb1`.`casesmaster`.`CaseState`               AS `CaseState`,
//   `lawyerdb1`.`casestates`.`StateName`                AS `StateName`,
//   `lawyerdb1`.`persons`.`sName`                       AS `sName`,
//   `lawyerdb1`.`casesmaster`.`subject`                 AS `subject`,
//   `lawyerdb1`.`casesmaster`.`Enemy`                   AS `Enemy`,
//   `persons_1`.`sName`                                 AS `sName2`,
//   `lawyerdb1`.`papertypes`.`PaperType`                AS `PaperType`,
//   `lawyerdb1`.`casesmaster`.`PaperType`               AS `PaperTypeID`,
//   `lawyerdb1`.`casesmaster`.`MonChar`                 AS `MonChar`,
//   `lawyerdb1`.`casesdetails`.`Court`                  AS `Court`,
//   `lawyerdb1`.`casesdetails`.`Circle`                 AS `Circle`,
//   `lawyerdb1`.`casesdetails`.`Secretary`              AS `Secretary`,
//   `lawyerdb1`.`casesdetails`.`Gedge`                  AS `Gedges`,
//   `lawyerdb1`.`casesdetails`.`Floor`                  AS `Floor`,
//   `lawyerdb1`.`casesdetails`.`Hall`                   AS `Hall`,
//   `lawyerdb1`.`casesdetails`.`Position`               AS `Position`,
//    `lawyerdb1`.`casesdetails`.`CaseNumber`             AS `CaseNumber`,   
//   `lawyerdb1`.`courts`.`CourtName`                    AS `CourtName`,
//   `lawyerdb1`.`positions`.`positionName`              AS `positionName`,
//   `e`.`DetailsEvent`                                  AS `DetailsEvent`,
//   `e`.`IDEventType`                                   AS `IDEventType`,
//   `lawyerdb1`.`eventtypes`.`TypeName`                 AS `TypeName`,
//   `e`.`TheDate`                                       AS `TheDate`,
//   `e`.`Notes`                                         AS `Notes`,
//   `e`.`TheUser`                                       AS `TheUser`,
//   `e`.`WithUser`                                      AS `WithUser`,
//   `e`.`EventState`                                    AS `EventState`,
//   `lawyerdb1`.`eventstats`.`evStateName`              AS `evStateName`,
//   (SELECT     CONCAT(`e1`.`TheDate`,' - ',`e1`.`DetailsEvent`)    AS `DetailsEvent`
//    FROM `lawyerdb1`.`caseevents` `e1`
//    WHERE ((`e1`.`TheDate` < `e`.`TheDate`)
//           AND (`e`.`CaseID` = `e1`.`CaseID`)
//           AND (`e`.`IDEventType` = `e1`.`IDEventType`))
//    ORDER BY `e1`.`TheDate` DESC
//    LIMIT 0,1) AS `prev_value`


// FROM (((((((((((((`lawyerdb1`.`casesmaster`
//                LEFT JOIN `lawyerdb1`.`casestates`
//                  ON ((`lawyerdb1`.`casesmaster`.`CaseState` = `lawyerdb1`.`casestates`.`ID`)))
//               LEFT JOIN `lawyerdb1`.`casetypedetails`
//                 ON ((`lawyerdb1`.`casesmaster`.`CaseType` = `lawyerdb1`.`casetypedetails`.`ID`)))
//              LEFT JOIN `lawyerdb1`.`persons`
//                ON ((`lawyerdb1`.`casesmaster`.`CustomerID` = `lawyerdb1`.`persons`.`ID`)))
//             LEFT JOIN `lawyerdb1`.`persons` `persons_1`
//               ON ((`lawyerdb1`.`casesmaster`.`Enemy` = `persons_1`.`ID`)))
//            LEFT JOIN `lawyerdb1`.`casesdetails`
//              ON ((`lawyerdb1`.`casesdetails`.`CaseMasterID` = `lawyerdb1`.`casesmaster`.`ID`)))
//           LEFT JOIN `lawyerdb1`.`papertypes`
//             ON ((`lawyerdb1`.`casesmaster`.`PaperType` = `lawyerdb1`.`papertypes`.`ID`)))
//          LEFT JOIN `lawyerdb1`.`courts`
//            ON ((`lawyerdb1`.`casesdetails`.`Court` = `lawyerdb1`.`courts`.`ID`)))
//         LEFT JOIN `lawyerdb1`.`positions`
//           ON ((`lawyerdb1`.`casesdetails`.`Position` = `lawyerdb1`.`positions`.`ID`)))
//        LEFT JOIN `lawyerdb1`.`caseevents` `e`
//          ON ((`e`.`CaseID` = `lawyerdb1`.`casesmaster`.`ID`)))
//       LEFT JOIN `lawyerdb1`.`eventstats`
//         ON ((`lawyerdb1`.`eventstats`.`ID` = `e`.`EventState`)))
//      LEFT JOIN `lawyerdb1`.`eventtypes`
//        ON ((`e`.`IDEventType` = `lawyerdb1`.`eventtypes`.`ID`)))
//     LEFT JOIN `lawyerdb1`.`eventthreads`
//       ON ((`lawyerdb1`.`eventthreads`.`EventID` = `e`.`ID`)))
//    LEFT JOIN `lawyerdb1`.`customerposition`
//      ON ((`lawyerdb1`.`customerposition`.`ID` = `lawyerdb1`.`casesdetails`.`CustPos`)))


//   ";

// $query0012= mysql_query ("ALTER view vwmongaz as    " . $sqwals . $wer ." and  e.id   IN  (  SELECT parent   FROM caseevents WHERE eventstate = 1    )

// ORDER BY `e`.`TheDate`");

// $query0013= mysql_query ("ALTER view vwnotmongaz as    " . $sqwals . $wer ." and  e.eventstate = 3  AND  e.id NOT IN (SELECT id   FROM caseevents WHERE eventstate = 1  )

// ORDER BY `e`.`TheDate`");

// $query0014= mysql_query ("ALTER view vwforget as    " . $sqwals  ."  AND  e.thedate < CURDATE() AND e.parent IS NULL AND e.id NOT IN (SELECT parent FROM caseevents WHERE parent IS NOT NULL )        

// ORDER BY `e`.`TheDate`");

// $query0015= mysql_query ("ALTER view vwthenew as    " . $sqwals . $wer ."  AND  e.thedate > CURDATE() AND e.parent IS NULL AND e.id NOT IN (SELECT parent FROM caseevents WHERE parent IS NOT NULL )       

// ORDER BY `e`.`TheDate`");

// }



// // SELECT
// //   COUNT(`lawyerdb1`.`caseevents`.`ID`) AS `id`,
// //   (SELECT
// //      COUNT(`vwroolall`.`id`)
// //    FROM `lawyerdb1`.`vwroolall`) AS `ddal`,
// //   (SELECT
// //      COUNT(`vwroolall`.`id`)
// //    FROM `lawyerdb1`.`vwroolall`
// //    WHERE (`vwroolall`.`TheDate` = CURDATE())) AS `ddal2`,
// //   (SELECT
// //      COUNT(`vwroolall`.`id`)
// //    FROM `lawyerdb1`.`vwroolall`
// //    WHERE (`vwroolall`.`TheDate` = (CURDATE() + INTERVAL 1 DAY))) AS `ddal3`,
// //     (SELECT COUNT(id) FROM vwmongaz) AS mongaz , 
// //     (SELECT COUNT(id) FROM vwnotmongaz) AS  notmongaz,
// //     (SELECT COUNT(id) FROM vwforget) AS  forget,
// //     (SELECT COUNT(id) FROM vwthenew) AS  thenew, 
// //   (SELECT
// //      COUNT(`vwneedinfo`.`ID`)
// //    FROM `lawyerdb1`.`vwneedinfo`) AS `ddal4`
// // FROM `lawyerdb1`.`caseevents`
// // WHERE ((`lawyerdb1`.`caseevents`.`IDEventType` = 4)
// //        AND (`lawyerdb1`.`caseevents`.`TheDate` BETWEEN CURDATE()
// //             AND (CURDATE() + INTERVAL 7 DAY)))







// if($_SERVER['REQUEST_METHOD'] == "POST")  {
// $query2= mysql_query (" SELECT
//   COUNT(`lawyerdb1`.`caseevents`.`ID`) AS `id`,
//   (SELECT
//      COUNT(`vwroolall`.`id`)
//    FROM `lawyerdb1`.`vwroolall`) AS `ddal`,
//   (SELECT
//      COUNT(`vwroolall`.`id`)
//    FROM `lawyerdb1`.`vwroolall`
//    WHERE (`vwroolall`.`TheDate` = CURDATE())) AS `ddal2`,
//   (SELECT
//      COUNT(`vwroolall`.`id`)
//    FROM `lawyerdb1`.`vwroolall`
//    WHERE (`vwroolall`.`TheDate` = (CURDATE() + INTERVAL 1 DAY))) AS `ddal3`,
//     (SELECT COUNT(id) FROM vwmongaz) AS mongaz , 
//     (SELECT COUNT(id) FROM vwnotmongaz) AS  notmongaz,
//     (SELECT COUNT(id) FROM vwforget) AS  forget,
//     (SELECT COUNT(id) FROM vwthenew) AS  thenew, 
//     (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 4) as roolgalasat,
//     (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 5) as rooledary,
//     (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 6) as rooltanfiz 
// FROM `lawyerdb1`.`caseevents`
// WHERE ((`lawyerdb1`.`caseevents`.`IDEventType` = 4)
//        AND (`lawyerdb1`.`caseevents`.`TheDate` BETWEEN CURDATE()
//             AND (CURDATE() + INTERVAL 7 DAY))) ");

// }


// 	$row = mysql_fetch_assoc($query2);
// 	//$row2_2 = mysql_fetch_assoc($query2_2);
// 	//$row2_3 = mysql_fetch_assoc($query2_3);
// 	//$glasat=$row['id'];





?>
<!--  searchModal -->
<div id="searchModal" class="modal hide fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3>البحث في التقارير</h3>
	</div>
	<form id="frmrptser" action="getsearchReportsajax.php" method="POST" >
		<div class="modal-body">

			<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">
				<div class="row-fluid">
					<div class="span6">

						<p>	<div class="control-group">

							<div class="controls">
								<label class="radio">
									<input type="radio" name="optionsRadios1" value="1"  />
									اليوم
								</label>
								<label class="radio">
									<input type="radio" name="optionsRadios1" value="2"  />
									الغد
								</label>  
								<label class="radio">
									<input type="radio" name="optionsRadios1" value="3" />
									الاسبوع
								</label>  
								<label class="radio">
									<input type="radio" name="optionsRadios1" value="4" />
									الشهر
								</label>  
							</div>
						</div>
						<input class="pkr m-wrap small" size="16" type="text" value=""  name="date_from" />
						<span class="text-inline">&nbsp;الى&nbsp;</span>
						<input class="pkr m-wrap small" size="16" type="text" value=""  name="date_to"  />
                <!-- <select class="span2 m-wrap required" ><option value>اليوم</option><option value>الاسبوع</option><option value>الشهر</option> </select>
            -->
            <p> <div class="control-group">

            	<div class="controls">
            		<label class="radio">
            			<input type="radio" name="optionsRadios2" value="1" checked />
            			و
            		</label>
            		<label class="radio">
            			<input type="radio" name="optionsRadios2" value="2"  />
            			أو
            		</label>  

            	</div>
            </div></p>
            <p><input type="text" name="code" placeholder="كود" class="span12 m-wrap"></p>
            <p><input type="text" name="auto" placeholder="رقم الي" class="span12 m-wrap"></p>
            <p><input type="text" autocomplete="off"  name="cust" placeholder="العميل"  class="span12 m-wrap"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data; ?>" /></p>
            <p><input type="text" autocomplete="off"  name="enm" placeholder="الخصم"  class="span12 m-wrap"  data-provide="typeahead" data-items="4"  data-source= "<?php echo $data2; ?>" /></p>
            <p><input type="text" name="sub" placeholder="الموضوع" class="span12 m-wrap"></p>
        </div>



        <div class="span6">

        	<p><?php  echo GetEventType(0);?></p>

        	<p><select class="span12 m-wrap" name="ceventstats" id="evnttype" data-placeholder="Choose a Category" tabindex="1"><?php  echo Getceventstats(0);?></select></p>

        	<p><?php  echo GetCourtsMulti(0);?></p>

        	<p><select class="span12 m-wrap required" name="ctypes"   data-placeholder="Choose a Category" tabindex="1"><?php  echo Getctypes(0);?></select></p>
        	<p><select class="span12 m-wrap required" name="cstates"   data-placeholder="Choose a Category" tabindex="1"><?php  echo Getcstates(0);?></select></p>
        	<p><select class="span12 m-wrap required" name="cpositions"   data-placeholder="Choose a Category" tabindex="1"><?php  echo Getcpositions(0);?></select></p>
        	
        	<p><span class="span2">موجة من</span><select class="span10 m-wrap required" name="fromuser"   data-placeholder="Choose a Category" tabindex="1"><?php  echo GetUsers(0);?></select></p>
        	<p><span class="span2">موجة الى</span><select class="span10 m-wrap required" name="touser"   data-placeholder="Choose a Category" tabindex="1"><?php  echo GetUsers(0);?></select></p>


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
					شاشة التقارير
					<small>الشاشة التارير الرئيسية</small>
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
		<!-- tab-pane-->


		<div class="tab-pane" id="context">
			<div class="row-fluid add-portfolio">
				<div class="pull-left">
					<span>جلساتك لهذا الاسبوع <?php echo $row['id'] ; ?></span>
				</div>
				<div class="pull-left">
					<a data-toggle="modal" href="#searchModal"  class="btn icn-only blue">بحث<i class="m-icon-swapleft icon-search"></i></a>                          
				</div>
				<div  id="progthred" style="display:none;" class="progress green progress-striped active">
					<div id="prog" style="width: 0%;" class="bar"><div id="percent"></div></div>
				</div> 
			</div>
			<!--end add-portfolio-->
			<div class="row-fluid portfolio-block">
				<div class="span5 portfolio-text">
					<img src="assets/img/profile/portfolio/5.jpg" alt="" />
					<div class="portfolio-text-info">
						<h4>رول القضايا</h4>
						<p>يطبع فى شكل رول القضايا.</p>
					</div>
				</div>
				<div class="span5" style="overflow:hidden;">
					<div class="portfolio-info">
						نتائج البحث
						<span id="ddal" style="font-size: 20px" ></span>
					</div>
					<div class="portfolio-info">
						اجراءات اليوم
						<span id="ddal2" style="font-size: 20px" ></span>
					</div>
					<div class="portfolio-info">
						اجراءات الغد
						<span  id="ddal3" style="font-size: 20px" ></span>
					</div>
					<div class="portfolio-info">
						الجلسات
						<a href="fldReports/roolgalasat.php" target="_blank"  ><span id="roolgalasat" style="font-size: 20px"></span></a> 
					</div>
					<div class="portfolio-info">
						الاداري
						<a href="fldReports/rooledary.php" target="_blank"  ><span id="rooledary" style="font-size: 20px"></span></a> 
					</div>
					<div class="portfolio-info">
						التنفيذ
						<a href="fldReports/rooltanfiz.php" target="_blank"  ><span id="rooltanfiz" style="font-size: 20px"></span></a> 
					</div>
				</div>
				<div class="span2 portfolio-btn">
					<a href="fldReports/reprool1.php" class="btn bigicn-only" target="_blank"><span>طباعة</span></a>                      
				</div>
			</div>
			<!--end row-fluid-->
			<div class="row-fluid portfolio-block">
				<div class="span5 portfolio-text">
					<img src="assets/img/profile/portfolio/7.jpg" alt="" />
					<div class="portfolio-text-info">
						<h4>تقرير نواقص القضايا</h4>
						<p>يطبع فى شكل تقرير يوضح القضايا مجهولة التوجيه او الارشيف الناقص .</p>
					</div>
				</div>
				<div class="span5" style="overflow:hidden;">
					<div class="portfolio-info">
						قضية ناقصة
						<a href="fldReports/repneedInfo.php" target="_blank"  ><span style="color:red;"><?php  echo  "[...]";?></span></a>
					</div>

				</div>
				<div class="span2 portfolio-btn">
					<a  href="fldReports/repneedInfo.php" target="_blank"   class="btn bigicn-only"><span>طباعة</span></a>                      
				</div>
			</div>
			<!--end row-fluid-->
			<div class="row-fluid portfolio-block">
				<div class="span5 portfolio-text">
					<img src="assets/img/profile/portfolio/8.jpg" alt="" />
					<div class="portfolio-text-info">
						<h4>تقرير الاجراءات </h4>
						<p>يطبع فى شكل تقرير يوضح الاجراءات المنجزة والغير منجزة ومستخدميها .</p>
					</div>
				</div>
				<div class="span5">
					<div class="portfolio-info">
						الاجراءات المنتهية
						<a href="fldReports/repmongaz1.php" target="_blank"  ><span id="mongaz" style="color:green;"></span></a>
					</div>
						<!-- 	<div class="portfolio-info">
								الغير منجزة
								<a href="fldReports/repnotmongaz.php" target="_blank"  ><span><?php  echo $row ['notmongaz'];?></span></a>
							</div> -->
							<div class="portfolio-info">
								الجديدة
								<a href="fldReports/repThenew.php" target="_blank"  ><span id="thenew" style="color:#f89406;"></span></a>
							</div>
							<div class="portfolio-info">
								المؤجلة
								<a href="fldReports/repnotmongaz.php" target="_blank"  ><span id="notmongaz"></span></a>
							</div>
							<!-- <div class="portfolio-info">
								المهملة
								<a href="fldReports/repforget.php" target="_blank"  ><span style="color:red;"><?php  echo  $row ['forget'];?></span></a>
							</div> -->
						</div>
						<div class="span2 portfolio-btn">
							<a href="fldReports/repmongaz1.php" class="btn bigicn-only"><span>طباعة</span></a>                      
						</div>
					</div>
					<br />
					<a href="fldReports/repPrintInfo.php" class="btn bigicn-only"><span> تقرير الاعلانات</span></a>
					<!--end row-fluid-->
				<!-- 	<div class="row-fluid portfolio-block">
						<div class="span5 portfolio-text">
							<img src="assets/img/profile/portfolio/13.jpg" alt="" />
							<div class="portfolio-text-info">
								<h4>تقرير تفاصيل الاجراءات</h4>
								<p>يطبع فى شكل يوضح كل اجراء وتفاصيل مجرياته  .</p>
							</div>
						</div>
						<div class="span5" style="overflow:hidden;">
							<div class="portfolio-info">
								Today Sold
								<span>24</span>
							</div>
							
						</div>
						<div class="span2 portfolio-btn">
							<a href="#" onclick="popitup('abc.php'); " class="btn bigicn-only"><span>طباعة</span></a> 

						</div>
					</div> -->
					<!--end row-fluid-->
				</div>
			</div>
		</div>

		<!--end tab-pane-->

		<!-- END PAGE CONTENT-->

		


		<script type="text/javascript">


			function popitup(url) {
                //var x = screen.width / 2 - 700 / 2;
                //var y = screen.height / 2 - 450 / 2;

                var w = 90;
                var h = 600;
                w = window.screen.availWidth * w / 100;

                var left = Number((screen.width / 2) - (w / 2));
                var tops = 20;


                //newwindow = window.open(url, 'name', 'height=500,width=1000,left=' + x + ',top=' + y);
                var newwindow = window.open(url, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=0, copyhistory=no, width=' + w + ', height=' + h + ', top=' + tops + ', left=' + left);

                // if (window.focus) { newwindow.focus() }
                newwindow.focus();
                return false;
            }





        </script>




        <?php include('footer.php');?>

 <script src="systems/jquerySys.js" type="text/javascript"></script> 

		<script type="text/javascript">
			$(document).ready(function(e){
			
				testv = AjaxRequestMainFun('selectJSON','POST','dbop.php','json',{sqltbl:'courts',sqlcolms:'Code'});
				 alert(testv[0].CourtName);
				//reload_gritter('tit','sub',10000,2000) ;
			});

		</script>


        <script type="text/javascript">


        	$('#frmrptser').submit(function(e) {
        		e.preventDefault();
        		$("#frmrptser").ajaxSubmit(
        		{     
        			beforeSend: function() { 
        				$('#searchModal').modal('hide'); 	
        				var el = $("#context");

        				App.blockUI(el);
        				$(".blockUI").append("<br /><br /><span class='label label-inverse big'>جاري البحث ... !</span>");

        			},
        			complete  : function() { 
        				var el = $("#context"); 
        				App.unblockUI(el);
        			},
        			success:function(data)
        			{

        				var obj = JSON.parse(data);

        				$('#ddal').html('');
        				$('#ddal').append(obj[0].ddal);

        				$('#ddal2').html('');
        				$('#ddal2').append(obj[0].ddal2);


        				$('#ddal3').html('');
        				$('#ddal3').append(obj[0].ddal3);



        				$('#roolgalasat').html('');
        				$('#roolgalasat').append(obj[0].roolgalasat);

        				$('#rooltanfiz').html('');
        				$('#rooltanfiz').append(obj[0].rooltanfiz);

        				$('#rooledary').html('');
        				$('#rooledary').append(obj[0].rooledary);


        				$('#mongaz').html('');
        				$('#mongaz').append(obj[0].mongaz);

        				$('#thenew').html('');
        				$('#thenew').append(obj[0].thenew);


        				$('#notmongaz').html('');
        				$('#notmongaz').append(obj[0].notmongaz);



        			}
        		});
        	});














        	$("input[name='optionsRadios1']").live("click",function(){
        		vl = $(this).attr("value");
        		var myDate = new Date();
        		var myDate2 = new Date();
        		var myDate3 = new Date();
        		myDate.setDate(myDate.getDate() + 1);
        		myDate2.setDate(myDate.getDate() + 7);
        		myDate3.setDate(myDate.getDate() + 30);
        		if (vl==1) {$("input[name='date_from']").val($.datepicker.formatDate('yy-mm-dd',  new Date()));$("input[name='date_to']").val($.datepicker.formatDate('yy-mm-dd', new Date()));}
        		else if (vl==2) {$("input[name='date_from']").val($.datepicker.formatDate('yy-mm-dd', new Date()));$("input[name='date_to']").val($.datepicker.formatDate('yy-mm-dd', myDate));}
        		else if (vl==3) {$("input[name='date_from']").val($.datepicker.formatDate('yy-mm-dd', new Date()));$("input[name='date_to']").val($.datepicker.formatDate('yy-mm-dd', myDate2));}
        		else if (vl==4) {$("input[name='date_from']").val($.datepicker.formatDate('yy-mm-dd', new Date()));$("input[name='date_to']").val($.datepicker.formatDate('yy-mm-dd', myDate3));}
        		;
//date_from
});
</script>
