<?php session_start(); 

require_once('dbop.php');


$drr = selectDataAsArr("groupinfo where TheUser = " . $_SESSION['USID'] ,"id,Code,GName,Discr");
$x = count($drr);
$strtbl="";

for($i=0; $i<$x; $i++){
	$strtbl .= "<tr>
	<td>" . $drr[$i]['id']  . "</td>
	<td>" . $drr[$i]['Code']  . "</td>
	<td>" . $drr[$i]['GName']  . "</td>
	 
	<td><i class='icon-signin'></i><a href='#' class='adtogroup' id='" . $drr[$i]['id']  . "'> اضافة على تلك</a></td>
	<td><i class='icon-eye-open'></i><a href='#' class='viewgroup' id='" . $drr[$i]['id']  . "'> عرض</a></td>
</tr>";

}


echo $strtbl;


?>