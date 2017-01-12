<?php
require_once('config.php');

$UID = $_POST['USID'];
$permID = $_POST['permID'];
$sq="insert into usersinroles (RoleID,UserID) values (".$permID.",".$UID.")";
 $query= mysql_query($sq);
echo $sq;





?>