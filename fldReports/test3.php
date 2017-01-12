<?php
require_once('config.php');
 
 
$query= mysql_query(" CREATE   VIEW `vwcases`  AS  select * from courts");
$query= mysql_query(" CREATE   VIEW `vwroolall`  AS  select * from courts");
$query= mysql_query(" CREATE   VIEW `vwNeedInfo`  AS   SELECT  * from courts");
$query= mysql_query(" CREATE   VIEW `vwmongaz`  AS   SELECT  * from courts");

$query= mysql_query(" CREATE   VIEW `vwnotmongaz`  AS   SELECT  * from courts");

$query= mysql_query(" ALTER VIEW `clculat` AS SELECT
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
   WHERE (`vwroolall`.`TheDate` = (CURDATE() + INTERVAL 1 DAY))) AS `ddal3`, (SELECT COUNT(id) FROM vwmongaz) AS mongaz , (SELECT COUNT(id) FROM vwnotmongaz) AS  notmongaz,
  (SELECT
     COUNT(`vwneedinfo`.`ID`)
   FROM `lawyerdb1`.`vwneedinfo`) AS `ddal4`
FROM `lawyerdb1`.`caseevents`
WHERE ((`lawyerdb1`.`caseevents`.`IDEventType` = 4)
       AND (`lawyerdb1`.`caseevents`.`TheDate` BETWEEN CURDATE()
            AND (CURDATE() + INTERVAL 7 DAY)))");




 
?>