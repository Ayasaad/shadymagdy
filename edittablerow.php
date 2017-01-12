<?php
require_once('dbop.php');
 
$data = $_POST['data'];
$ids = $_POST['ids'];
$tableid =$_POST['tableid'];

   $uses="";
foreach ($data as $key => $value) {
       if ($uses=='') {$uses  = " {$key} = '{$value}' ";}else{$uses .= ", {$key} = '{$value}' ";}
}

$upstr = "update ".$tableid ." set " . $uses ." where id = " . $ids;
updateData($upstr);
 echo $upstr;
?>