<?php 
require_once('dbop.php');

 if (!empty($_POST['optionsRadios2'])){ 
  if ($_POST['optionsRadios2'] =='1')
   {$theswitch = " and " ;} else { $theswitch = " or " ;} 
 }







$wer='';
if (!empty($_POST['date_from']) && !empty($_POST['date_to'])){ 
	if ($wer =='') {$wer=" where e.TheDate between '" . $_POST['date_from'] . "' and '" . $_POST['date_to'] . "'";} 
	else { $wer .= $theswitch . "   e.TheDate between '" . $_POST['date_from'] . "' and '" . $_POST['date_to'] . "'" ;}
};

if (!empty($_POST['code'])){ 
	if ($wer =='') {$wer='  where casesmaster.Code in( ' . $_POST['code'] . ')';} else { $wer .= $theswitch . '    casesmaster.Code in ( ' . $_POST['code'] . ')' ;}
};
if (!empty($_POST['auto'])){
	if ($wer =='') {$wer='  where casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';} else { $wer .= $theswitch . '   casesmaster.AutoNumber in( ' . $_POST['auto'] . ')';}
};
if (!empty($_POST['cust'])){
	if ($wer =='') {$wer='  where  persons.sName = "' . $_POST['cust'] . '"';} else { $wer .= $theswitch . '    persons.sName = "' . $_POST['cust'] . '"';}
};
if (!empty($_POST['enm'])){
	if ($wer =='') {$wer='  where  persons_1.sName = "' . $_POST['enm'] . '"';} else { $wer .= $theswitch . '    persons_1.sName = "' . $_POST['enm'] . '"';}
};

if (!empty($_POST['sub'])){
	if ($wer =='') {$wer='  where  casesmaster.subject like "%' . $_POST['sub'] . '%"';} else { $wer .= $theswitch . '   casesmaster.subject like "%' . $_POST['sub'] . '%"';}
};

if(!empty($_POST['check_cCourts'])) {
	$vch="";
	foreach($_POST['check_cCourts'] as $check) {
		if ($vch ==''){$vch = $check;}else {$vch .=',' . $check;} 
	};
	if ($wer =='') {$wer='  where  casesdetails.Court in (' . $vch . ')';} 
	else  {$wer .= $theswitch . '    casesdetails.Court in (' . $vch . ')';}
};

if(!empty($_POST['check_EventType'])) {
	$vch2="";
	foreach($_POST['check_EventType'] as $check2) {
		if ($vch2 ==''){$vch2 = $check2;}else {$vch2 .=',' . $check2;} 
	};
	if ($wer =='') {$wer='  where  e.IDEventType in (' . $vch2 . ')';} 
	else  {$wer .= $theswitch . '    e.IDEventType in (' . $vch2 . ')';}
};

if (!empty($_POST['ceventstats'])){
	if ($wer =='') {$wer='  where  e.EventState = ' . $_POST['ceventstats'];} 
			  else { $wer .= $theswitch . '    e.EventState = ' . $_POST['ceventstats'];}
};

if (!empty($_POST['ctypes'])){
	if ($wer =='') {$wer='  where  casesmaster.CaseType = ' . $_POST['ctypes'];} 
			  else { $wer .= $theswitch . '    casesmaster.CaseType = ' . $_POST['ctypes'];}
};

if (!empty($_POST['cstates'])){
	if ($wer =='') {$wer='  where  casesmaster.CaseState = ' . $_POST['cstates'];} 
			  else { $wer .= $theswitch . '    casesmaster.CaseState = ' . $_POST['cstates'];}
};

if (!empty($_POST['cpositions'])){
	if ($wer =='') {$wer='  where  casesdetails.Position = ' . $_POST['cpositions'];} 
			  else { $wer .= $theswitch . '    casesdetails.Position = ' . $_POST['cpositions'];}
};

if (!empty($_POST['fromuser'])){
  if ($wer =='') {$wer='  where  e.TheUser = ' . $_POST['fromuser'];} 
        else { $wer .= $theswitch . '    e.TheUser = ' . $_POST['fromuser'];}
};

if (!empty($_POST['touser'])){
  if ($wer =='') {$wer='  where  e.WithUser = ' . $_POST['touser'];} 
        else { $wer .= $theswitch . '    e.WithUser = ' . $_POST['touser'];}
};

	if ($wer =='') {$wer='  where  casesdetails.nowin=1';} 
	else  {$wer .='    AND casesdetails.nowin=1';}

// if (!empty($_POST['ctypes'])){shstates
//   	if ($wer ='') {$wer='  where CaseType = ' . $_POST['ctypes'];} else { $wer .='  and  CaseType = ' . $_POST['ctypes'];}
// };
// if (!empty($_POST['cstates'])){
//  	if ($wer ='') {$wer='  where CaseState = ' . $_POST['cstates'];} else { $wer .='  and  CaseState = ' . $_POST['cstates'];}
// };
// if (!empty($_POST['cpositions'])){ 
// 	 	if ($wer ='') {$wer='  where  ( casesdetails.Position = ' . $_POST['cpositions'] . '  AND nowin = 1 )';} else { $wer .='  and  casesdetails.Position = ' . $_POST['cpositions'] . '  AND nowin = 1 )';}
// };
// if (!empty($_POST['ceventstats']) && $_POST['ceventstats'] > -1){ 
//  	if ($wer ='') {$wer='  where caseevents.EventState = ' . $_POST['ceventstats'];} else { $wer .='  and  caseevents.EventState = ' . $_POST['ceventstats'];}
// };
// if (!empty($_POST['cUsers']) && $_POST['cUsers'] > -1){
//   	if ($wer ='') {$wer='  where Enemy = ' . $_POST['cUsers'];} else { $wer .='  and  Enemy = ' . $_POST['cUsers'];}
// };


// WHERE (casesdetails.Court =5 AND nowin = 1)




$query= mysql_query(' ALTER view vwroolall as  SELECT  lawyerdb1.e.ID AS `id2`, casesmaster.id    , 
   casesmaster.Code    , casesmaster.AutoNumber    , 
   casesmaster.CustomerID    , 
   customerposition.PositionName           AS PositionNames,
   casesmaster.CaseType    ,
   casetypedetails.CaseTypeDetailsName    , casesmaster.CaseState    ,
   casestates.StateName    , persons.sName    , casesmaster.subject    , casesmaster.Enemy    , persons_1.sName AS sName2    ,
   papertypes.PaperType    , 
   casesmaster.PaperType AS PaperTypeID    , 
   casesmaster.MonChar    , casesdetails.Court    , 
   `lawyerdb1`.`casesdetails`.`Circle` AS `Circle`,  
    `lawyerdb1`.`casesdetails`.`CaseNumber`             AS `CaseNumber`,   
   	`lawyerdb1`.`casesdetails`.`Secretary`                  AS `Secretary`,
	`lawyerdb1`.`casesdetails`.`Gedge`                  AS `Gedges`,
	`lawyerdb1`.`casesdetails`.`Floor`                  AS `Floor`,
	`lawyerdb1`.`casesdetails`.`Hall`                  AS `Hall`, casesdetails.Position    , courts.CourtName    ,
	 positions.positionName    ,
	 e.DetailsEvent    , e.IDEventType    ,
	  eventtypes.TypeName    , e.TheDate    , e.Notes    , e.TheUser    , e.WithUser    , e.EventState    , eventstats.evStateName  
 ,
       (SELECT CONCAT(TheDate," - ",DetailsEvent ) AS DetailsEvent  FROM  `caseevents` e1 WHERE  e1.thedate < e.thedate 
       AND e.caseid = e1.caseid  AND e.IDEventType = e1.IDEventType ORDER BY e1.thedate DESC LIMIT 1 OFFSET 0) AS prev_value
       
   

	FROM    casesmaster    
	LEFT JOIN casestates           ON (casesmaster.CaseState = casestates.ID)    
	LEFT JOIN casetypedetails      ON (casesmaster.CaseType = casetypedetails.ID)    
	LEFT JOIN persons              ON (casesmaster.CustomerID = persons.ID)    
	LEFT JOIN persons AS persons_1 ON (casesmaster.Enemy = persons_1.ID)    
	LEFT JOIN casesdetails         ON (casesdetails.CaseMasterID = casesmaster.ID)    
	LEFT JOIN papertypes           ON (casesmaster.PaperType = papertypes.ID)    
	LEFT JOIN courts               ON (casesdetails.Court = courts.ID)    
	LEFT JOIN positions            ON (casesdetails.Position = positions.ID)    
	LEFT JOIN caseevents  e        ON (e.CaseID = casesmaster.ID)    
	LEFT JOIN eventstats           ON (eventstats.ID = e.EventState)    
	LEFT JOIN eventtypes           ON (e.IDEventType = eventtypes.ID)  
	LEFT JOIN eventthreads         ON (eventthreads.EventID = e.ID)	
	LEFT JOIN  customerposition    ON (customerposition.ID =  casesdetails.CustPos)
           '. $wer .'   and  ( e.id NOT IN (SELECT ID FROM caseevents WHERE parent IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL)) AND e.id NOT IN (SELECT parent FROM caseevents WHERE eventstate=1 AND parent IS NOT NULL))
       ORDER BY  TheDate');





$query0=(' ALTER view vwNeedInfo as      SELECT     casesmaster.ID, casesmaster.subject, casesmaster.Code, persons.sName, casesmaster.Enemy, casesmaster.AutoNumber, casestates.StateName, courts.CourtName
FROM         casesmaster INNER JOIN
casestates ON casesmaster.CaseState = casestates.ID INNER JOIN
casesdetails ON casesmaster.ID = casesdetails.CaseMasterID INNER JOIN
courts ON casesdetails.Court = courts.ID INNER JOIN
persons ON casesmaster.customerID = persons.ID INNER JOIN
persons AS persons_1 ON casesmaster.Enemy = persons_1.ID AND casesmaster.Enemy = persons_1.ID
WHERE     (casesmaster.ID IN
(SELECT     CaseID
FROM         caseevents
WHERE     (IDEventType <> 1)
GROUP BY CaseID
HAVING      (MAX(TheDate) < CURDATE()))) AND (casesmaster.CaseState NOT IN (5, 11, 9, 12, 1010)) ');









$sqwals="  SELECT
  `e`.`ID`                                            AS `id2`,
  `lawyerdb1`.`casesmaster`.`ID`                      AS `id`,
  e.parent,
  `lawyerdb1`.`casesmaster`.`Code`                    AS `Code`,
  `lawyerdb1`.`casesmaster`.`AutoNumber`              AS `AutoNumber`,
  `lawyerdb1`.`casesmaster`.`CustomerID`              AS `CustomerID`,
  `lawyerdb1`.`customerposition`.`PositionName`       AS `PositionNames`,
  `lawyerdb1`.`casesmaster`.`CaseType`                AS `CaseType`,
  `lawyerdb1`.`casetypedetails`.`CaseTypeDetailsName` AS `CaseTypeDetailsName`,
  `lawyerdb1`.`casesmaster`.`CaseState`               AS `CaseState`,
  `lawyerdb1`.`casestates`.`StateName`                AS `StateName`,
  `lawyerdb1`.`persons`.`sName`                       AS `sName`,
  `lawyerdb1`.`casesmaster`.`subject`                 AS `subject`,
  `lawyerdb1`.`casesmaster`.`Enemy`                   AS `Enemy`,
  `persons_1`.`sName`                                 AS `sName2`,
  `lawyerdb1`.`papertypes`.`PaperType`                AS `PaperType`,
  `lawyerdb1`.`casesmaster`.`PaperType`               AS `PaperTypeID`,
  `lawyerdb1`.`casesmaster`.`MonChar`                 AS `MonChar`,
  `lawyerdb1`.`casesdetails`.`Court`                  AS `Court`,
  `lawyerdb1`.`casesdetails`.`Circle`                 AS `Circle`,
  `lawyerdb1`.`casesdetails`.`Secretary`              AS `Secretary`,
  `lawyerdb1`.`casesdetails`.`Gedge`                  AS `Gedges`,
  `lawyerdb1`.`casesdetails`.`Floor`                  AS `Floor`,
  `lawyerdb1`.`casesdetails`.`Hall`                   AS `Hall`,
  `lawyerdb1`.`casesdetails`.`Position`               AS `Position`,
   `lawyerdb1`.`casesdetails`.`CaseNumber`             AS `CaseNumber`,   
  `lawyerdb1`.`courts`.`CourtName`                    AS `CourtName`,
  `lawyerdb1`.`positions`.`positionName`              AS `positionName`,
  `e`.`DetailsEvent`                                  AS `DetailsEvent`,
  `e`.`IDEventType`                                   AS `IDEventType`,
  `lawyerdb1`.`eventtypes`.`TypeName`                 AS `TypeName`,
  `e`.`TheDate`                                       AS `TheDate`,
  `e`.`Notes`                                         AS `Notes`,
  `e`.`TheUser`                                       AS `TheUser`,
  `e`.`WithUser`                                      AS `WithUser`,
  `e`.`EventState`                                    AS `EventState`,
  `lawyerdb1`.`eventstats`.`evStateName`              AS `evStateName`,
  (SELECT     CONCAT(`e1`.`TheDate`,' - ',`e1`.`DetailsEvent`)    AS `DetailsEvent`
   FROM `lawyerdb1`.`caseevents` `e1`
   WHERE ((`e1`.`TheDate` < `e`.`TheDate`)
          AND (`e`.`CaseID` = `e1`.`CaseID`)
          AND (`e`.`IDEventType` = `e1`.`IDEventType`))
   ORDER BY `e1`.`TheDate` DESC
   LIMIT 0,1) AS `prev_value`
 
   
FROM (((((((((((((`lawyerdb1`.`casesmaster`
               LEFT JOIN `lawyerdb1`.`casestates`
                 ON ((`lawyerdb1`.`casesmaster`.`CaseState` = `lawyerdb1`.`casestates`.`ID`)))
              LEFT JOIN `lawyerdb1`.`casetypedetails`
                ON ((`lawyerdb1`.`casesmaster`.`CaseType` = `lawyerdb1`.`casetypedetails`.`ID`)))
             LEFT JOIN `lawyerdb1`.`persons`
               ON ((`lawyerdb1`.`casesmaster`.`CustomerID` = `lawyerdb1`.`persons`.`ID`)))
            LEFT JOIN `lawyerdb1`.`persons` `persons_1`
              ON ((`lawyerdb1`.`casesmaster`.`Enemy` = `persons_1`.`ID`)))
           LEFT JOIN `lawyerdb1`.`casesdetails`
             ON ((`lawyerdb1`.`casesdetails`.`CaseMasterID` = `lawyerdb1`.`casesmaster`.`ID`)))
          LEFT JOIN `lawyerdb1`.`papertypes`
            ON ((`lawyerdb1`.`casesmaster`.`PaperType` = `lawyerdb1`.`papertypes`.`ID`)))
         LEFT JOIN `lawyerdb1`.`courts`
           ON ((`lawyerdb1`.`casesdetails`.`Court` = `lawyerdb1`.`courts`.`ID`)))
        LEFT JOIN `lawyerdb1`.`positions`
          ON ((`lawyerdb1`.`casesdetails`.`Position` = `lawyerdb1`.`positions`.`ID`)))
       LEFT JOIN `lawyerdb1`.`caseevents` `e`
         ON ((`e`.`CaseID` = `lawyerdb1`.`casesmaster`.`ID`)))
      LEFT JOIN `lawyerdb1`.`eventstats`
        ON ((`lawyerdb1`.`eventstats`.`ID` = `e`.`EventState`)))
     LEFT JOIN `lawyerdb1`.`eventtypes`
       ON ((`e`.`IDEventType` = `lawyerdb1`.`eventtypes`.`ID`)))
    LEFT JOIN `lawyerdb1`.`eventthreads`
      ON ((`lawyerdb1`.`eventthreads`.`EventID` = `e`.`ID`)))
   LEFT JOIN `lawyerdb1`.`customerposition`
     ON ((`lawyerdb1`.`customerposition`.`ID` = `lawyerdb1`.`casesdetails`.`CustPos`)))
     
      
  ";

$query0012= mysql_query ("ALTER view vwmongaz as    " . $sqwals . $wer ." and  e.id   IN  (  SELECT parent   FROM caseevents WHERE eventstate = 1    )

ORDER BY `e`.`TheDate`");
 
$query0013= mysql_query ("ALTER view vwnotmongaz as    " . $sqwals . $wer ." and  e.eventstate = 3  AND  e.id NOT IN (SELECT id   FROM caseevents WHERE eventstate = 1  )

ORDER BY `e`.`TheDate`");

$query0014= mysql_query ("ALTER view vwforget as    " . $sqwals  ."  AND  e.thedate < CURDATE() AND e.parent IS NULL AND e.id NOT IN (SELECT parent FROM caseevents WHERE parent IS NOT NULL )        

ORDER BY `e`.`TheDate`");

$query0015= mysql_query ("ALTER view vwthenew as    " . $sqwals . $wer ."  AND  e.thedate > CURDATE() AND e.parent IS NULL AND e.id NOT IN (SELECT parent FROM caseevents WHERE parent IS NOT NULL )       

ORDER BY `e`.`TheDate`");











$query2= mysql_query (" SELECT
  COUNT(`lawyerdb1`.`caseevents`.`ID`) AS `id`,
  (SELECT
     COUNT(`vwroolall`.`id`)
   FROM `lawyerdb1`.`vwroolall`) AS `ddal`,
  (SELECT
     COUNT(`vwroolall`.`id`)
   FROM `lawyerdb1`.`vwroolall`
   WHERE (`vwroolall`.`TheDate` = CURDATE())) AS `ddal2`,
  (SELECT
     COUNT(`vwroolall`.`id`)
   FROM `lawyerdb1`.`vwroolall`
   WHERE (`vwroolall`.`TheDate` = (CURDATE() + INTERVAL 1 DAY))) AS `ddal3`,
    (SELECT COUNT(id) FROM vwmongaz) AS mongaz , 
    (SELECT COUNT(id) FROM vwnotmongaz) AS  notmongaz,
    (SELECT COUNT(id) FROM vwforget) AS  forget,
    (SELECT COUNT(id) FROM vwthenew) AS  thenew, 
    (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 4) as roolgalasat,
    (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 5) as rooledary,
    (SELECT  COUNT(IDEventType) AS `id` FROM  `vwroolall`  WHERE IDEventType = 6) as rooltanfiz 
FROM `lawyerdb1`.`caseevents`
WHERE ((`lawyerdb1`.`caseevents`.`IDEventType` = 4)
       AND (`lawyerdb1`.`caseevents`.`TheDate` BETWEEN CURDATE()
            AND (CURDATE() + INTERVAL 7 DAY))) ");







 while ($record = mysql_fetch_assoc($query2)) {
        $event_array[] = array(
           'ddal' => $record['ddal'],
            'ddal2' => $record['ddal2'],
            'ddal3' => $record['ddal3'],
            'mongaz' => $record['mongaz'],
            'notmongaz' => $record['notmongaz'],
            'forget' => $record['forget'] ,
            'thenew' =>  $record['thenew'],
            'roolgalasat' =>   $record['roolgalasat'] ,
            'rooledary' =>   $record['rooledary'] ,
            'rooltanfiz' =>   $record['rooltanfiz']  
             
        );
    }

echo json_encode($event_array);




	 //$row = mysql_fetch_assoc($query2);


?>