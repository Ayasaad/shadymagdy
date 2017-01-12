<?php
$con_err="sorry connection error";
$link = mysql_connect("localhost","root","") or die($con_err);
mysql_set_charset('utf8',$link);
mysql_select_db("lawyerdb1");




?>