<?php session_start();
require_once('config.php');
//mysql_query("INSERT INTO courts (code) values ('555')");
$msg="";
if (empty($_POST['cust'])) {
	$msg.= " (اسم العميل ناقص)";
}elseif (empty($_POST['enm'])) {
	$msg.=" (اسم الخصم ناقص)";
}elseif (empty($_POST['autonumber'])) {
	$msg.=" (الرقم الالي ناقص)";
}elseif (empty($_POST['cstates'])) {
	$msg.=" (الحالة ناقص)";
}elseif (empty($_POST['cpositions'])) {
	$msg.=" (الدرجة ناقص) ";
}elseif (empty($_POST['Courts'])) {
	$msg.=" (الجهة ناقص) ";
}elseif (empty($_POST['subject'])) {
	$msg.=" (الموضوع ناقص) ";
}else
{


	$result = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['cust']."' limit 1");
	$row=mysql_fetch_array($result);
	$cust = $row[0];
	

	$result2 = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['enm']."' limit 1");
	$row2=mysql_fetch_array($result2);
	$enm = $row2[0];
	

	$autonumber = $_POST['autonumber'];
	
	$cstates = $_POST['cstates'];
	$cpositions = $_POST['cpositions'];
	$Courts = $_POST['Courts'];
	
	$subject = $_POST['subject'];
	

	$query3=mysql_query("select max(Code)+1 Code from casesmaster")  ;
	$row3 = mysql_fetch_assoc($query3);
	$ccode=$row3['Code'];

	$sql= " INSERT INTO casesmaster (
	code,
	AutoNumber,
	CustomerID ,
	Enemy,
	
	CaseState,
	subject,   ClintID  
	
	) 
	VALUES(
	'".$ccode."', 
	'". $autonumber ."',". $cust .",". $enm .",". $cstates .",
	'". $subject ."',". $_SESSION['clintid'] .")";
	mysql_query($sql);
	

//echo $sql;

	$sqmax = "select max(id) id from casesmaster";
	$query=mysql_query($sqmax)  ;
	$row = mysql_fetch_assoc($query);
	$masterid=$row['id'];

	$sql2= " INSERT INTO casesdetails (

	CaseMasterID,Court,Position
	
	,NowIN
	) 
	VALUES(" . $masterid .",". $Courts .",". $cpositions .",1)";
	mysql_query($sql2);
	$msg = "تم";
}
echo $msg;









// ". $cpositions .", 
//". $Courts .", 
//". $casenumber ."


//$user_id= mysql_insert_id();
//if(!empty($user_id) {


//$sql=INSERT INTO profiles (userid, bio, homepage) VALUES($user_id,'Hello world!', 'http://www.stackoverflow.com');
/* or 
$sql=INSERT INTO profiles (userid, bio, homepage) VALUES(LAST_INSERT_ID(),'Hello   world!', 'http://www.stackoverflow.com'); */
 //mysql_query($sql);
//};



?>

