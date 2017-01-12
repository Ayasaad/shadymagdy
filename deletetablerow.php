<?php
require_once('dbop.php');
 

$ids = $_POST['ids'];
$tableid =$_POST['tableid'];

 

$deletestr = "delete from  ".$tableid ." where id = " . $ids;
deleteData($deletestr);
//echo $upstr;
?>