<?php
require_once('dbop.php');


$usernameid=$_POST['usernameid'];
$uname= $_POST['username'];
$firstname=$_POST['firstname'];
$sex=$_POST['persnatselc'];


updateData("update persons set sName='".$uname."' , CardID='".$firstname."' ,Natunality='".$sex."' where id = " . $usernameid);
echo $usernameid;

?>