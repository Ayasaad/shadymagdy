<?php
require_once('config.php');
 
 
$query= mysql_query(" CREATE   VIEW `vwcases`  AS  select * from courts  ");
$query= mysql_query(" CREATE   VIEW `vwroolall`  AS  select * from courts   ");
$query= mysql_query(" CREATE   VIEW `vwNeedInfo`  AS  select * from courts  ");



?>