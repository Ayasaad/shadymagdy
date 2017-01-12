<?php  session_start(); 
 
include('dbop.php');





$uname=$_POST['username'];
$password=$_POST['password'];
$clintid=$_POST["clintID"];

if(empty($_POST) === false){
//	echo $uname . '<br />' . $password;
	$sqc="select id,count(active) as active from users where username='".$uname."' and password ='".$password."'";
	$query=mysql_query($sqc)  ;
	$row = mysql_fetch_assoc($query);
	$isok=$row['active'];

if ($isok==1) {

	$_SESSION['USID']=$row['id'];
	$_SESSION['USNM']=$uname;
	
	$_SESSION['clintid']=$clintid;
	 
	 header('Location: index.php');
   
   $ssqll="update  users set thedate= '". date("Y\-m\-d\ h:i:s") ."' where id =" . $_SESSION['USID'];
   $query= mysql_query($ssqll);
  // unset($_SESSION['officename']);
  $_SESSION['officename']= selectonce("select SetValue from systemsetings where Setname = 'ArabicCompName'","SetValue");
  //header('Location: NotifecationLoad.php');
}else{
	header('Location: login.php');
}

}
else{
	header('Location: login.php');
}
 
  

?>
