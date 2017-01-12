<?php
 require_once('config.php');

 
$result = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['cust']."' limit 1");
$row=mysql_fetch_array($result);
$cust = $row[0];
$perspos = $_POST['perspos'];

$result2 = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['enm']."' limit 1");
$row2=mysql_fetch_array($result2);
$enm = $row2[0];
$enmpos2 = $_POST['enmpos2'];

$autonumber = $_POST['autonumber'];
$ctypes = $_POST['ctypes'];
$cstates = $_POST['cstates'];
$cpositions = $_POST['cpositions'];
$Courts = $_POST['Courts'];
$casenumber = $_POST['casenumber'];
$subject = $_POST['subject'];
$monycomplain = $_POST['monycomplain'];
$cpapertype = $_POST['cpapertype'];

 $query3=mysql_query("select max(Code)+1 Code from casesmaster")  ;
	$row3 = mysql_fetch_assoc($query3);
	$ccode=$row3['Code'];

$sql= " INSERT INTO casesmaster (
							code,
 						AutoNumber,
 						CustomerID ,
 						 Enemy,
 						 CaseType,
  							 CaseState,
 							 subject,
 							 mon
							 ) 
						  VALUES(
						 '".$ccode."', 
						 '". $autonumber ."',". $cust .",". $enm .",". $ctypes .",". $cstates .",
						 '". $subject ."',". $monycomplain .")";
mysql_query($sql);
 

echo $sql;

$sqmax = "select max(id) id from casesmaster";
$query=mysql_query($sqmax)  ;
	$row = mysql_fetch_assoc($query);
	$masterid=$row['id'];

$sql2= " INSERT INTO casesdetails (

						CaseMasterID
					 
						,NowIN
							 ) 
						  VALUES(" . $masterid .",1)";
mysql_query($sql2);

header('Location: index.php');  








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

