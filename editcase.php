<?php 

require_once('config.php');


 
$result = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['sName']."' limit 1");
$row=mysql_fetch_array($result);
$cust = $row[0];
 

$result2 = mysql_query("SELECT id FROM persons WHERE sName='".$_POST['sName2']."' limit 1");
$row2=mysql_fetch_array($result2);
$enm = $row2[0];
 




$ssqll="update  casesmaster set code= '". $_POST['Code'] ."' , AutoNumber='". $_POST['AutoNumber'] ."' , subject='". $_POST['subject'] ."' ,CaseState=". $_POST['ctstats'] ." , CaseType=". $_POST['ctypes'] ."  , CustomerID=". $cust ."  , Enemy=". $enm . "            where ID  =  " .$_POST['cid2'];

$query= mysql_query($ssqll);


 //$_POST['cid2'] ; 
echo $ssqll;
 ?>