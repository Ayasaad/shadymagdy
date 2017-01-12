<?php
require_once('config.php');

$OprationName="";
if(!empty($_POST['OprationName'])){$OprationName=$_POST['OprationName'];}

if ($OprationName=='select1') {
	echo json_encode(selectDataAsArr($_POST['sqltbl'],$_POST['sqlcolms']));
}
 else if ($OprationName=='insert') {
	echo  (insData($_POST['sqltbl'],$_POST['sqlcolms']));
}
 else if ($OprationName=='update') {
	echo  (updateData($_POST['sqltbl'],$_POST['sqlcolms']));
}
else if ($OprationName=='delete') {
	echo  (updateData($_POST['sqltbl'],$_POST['sqlcolms']));
}





















//-------------------The functions-------------------------------------------
function selectonce($squr,$neededval){
	$query=mysql_query($squr)  ;
	$row = mysql_fetch_assoc($query);
	$returned=$row[$neededval];
	return $returned;
//echo $squr;

}


function getColDataAsArray($TableName,$ColName){
	$sqString = "select ".$ColName." from ". $TableName ;
	$query=mysql_query($sqString)  ;
	$returnedCol="";
	while ( $row =mysql_fetch_array($query)) {
		if ($returnedCol==""){
			$returnedCol .= $row[$ColName];
		}else { 
			$returnedCol .= ','. $row[$ColName];
		}

		
	}
	return $returnedCol;
	//result = 1303,1305,1307,1308
}


function selectDataAsArr($TableName,$ColsName){
	$sqString = "select ".$ColsName." from ". $TableName ;
	$query=mysql_query($sqString)  ;
	$returnedCols=array();


	while ( $row =mysql_fetch_assoc($query)) {
		$returnedCols[] = $row;
	}
	return $returnedCols;
	//result = $array_variable[$i]['ImgPath'] 
}





function insData($TableName,$ColsName,$vals){
	$sqString = "insert into  ".$TableName." ( ".$ColsName ." )  values (" . $vals . ")" ;
	$query=mysql_query($sqString)  ;
	return $sqString;
}




function updateData($strval){
	$sqString = $strval ;
	$query=mysql_query($sqString)  ;
	$returnedCols=array();
}


function deleteData($strval){
	$sqString = $strval ;
	$query=mysql_query($sqString)  ;
	$returnedCols=array();
}

?>