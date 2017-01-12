<?php
include('./config.php');

if ($_GET["typ"]== 1){
	$query= mysql_query("SELECT max(ID)+1 as MxCid FROM scan");
}else {
	$query= mysql_query("SELECT max(ID)+1 as MxCid FROM scanperson");
}
$row = mysql_fetch_assoc($query); 
$MxCid = $row['MxCid'];


$ds = DIRECTORY_SEPARATOR;  //1
 $storeFolder = 'uploads';   //2
 if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3 
    $path_parts = pathinfo($_FILES["file"]["name"]);
    $extension = $path_parts['extension'];          
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    if ($_GET["typ"]== 1) {
    	    $targetFile =  $targetPath.  "Arch_c_" . $MxCid . "." . $extension;  //5

    	}else{
   $targetFile =  $targetPath.  "Arch_p_" . $MxCid . "." . $extension;  //5
}
 //move_uploaded_file($tempFile,$targetPath. $PID); //6





if (move_uploaded_file($_FILES['file']['tmp_name'],$targetFile)){
	if ($_GET["typ"]== 1){
		$query= mysql_query("INSERT INTO scan (CaseID,FileName,ImgPath,FileTitle)  
			VALUES (". $_POST["archCNM"] .",". $_POST["archtypes"] .",'Arch_c_".  $MxCid . "." . $extension . "','sucsess')");
	}else{
$werttt = "INSERT INTO scanperson (PersonID,FileName,ImgPath,FileTitle)  
			VALUES (". $_POST["archCNM"] .",". $_POST["archtypes"] .",'Arch_p_".  $MxCid . "." . $extension . "','sucsess')";

		$query= mysql_query($werttt);
	}
	echo 
	'<div class="alert alert-success">
	<button class="close" data-dismiss="alert"></button>
	<strong>تم بنجاح!</strong>تمت اضافة المرفق بنجاح.
	<br />
	
</div>'
  ;
}


}
?>