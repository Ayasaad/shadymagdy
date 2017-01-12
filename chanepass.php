<?php
require_once('dbop.php');

$_POST['usernameid'];
$_POST['password'];
$_POST['rpassword'];

 
	$paschk = selectonce('select password from users where id= ' .$_POST['usernameid'],"password");
	if ($_POST['password'] == $paschk) {

		updateData("update users set password = '". $_POST['rpassword'] ."' where id =" . $_POST['usernameid']);
		echo "تم التغيير كلمة المرور...";
	}else {
		echo "كلمة المرور الحالة غير صحيحة!";
	}
 
?>