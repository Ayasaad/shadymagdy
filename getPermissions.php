<?php
require_once('config.php');
 $UID = $_POST['userID'];
 
 
if (!empty($_POST['evtyp'])){$wer=" and roles.category = '" . trim($_POST['evtyp']) . "'"; }else{$wer = "";}




$sq = "SELECT
      `users`.`username`
    , `roles`.`RoleName`
    , `usersinroles`.`ID`
    , `roles`.`category`
FROM
    `lawyerdb1`.`usersinroles`
    INNER JOIN `lawyerdb1`.`roles` 
        ON (`usersinroles`.`RoleID` = `roles`.`ID`)
    INNER JOIN `lawyerdb1`.`users` 
        ON (`usersinroles`.`UserID` = `users`.`id`)";




$query= mysql_query($sq ." where users.id = " . $UID . $wer);



$dtable="";

  while($row = mysql_fetch_array($query))
	 {
	 $dtable.="<tr>
	 	<td>" . $row['ID'] . "</td>
		   	   	<td><a href='#' class='DetailsEv' value='" . $row['ID']   . "'>" . $row['RoleName'] . "</a></td>
	   	   	 	<td> " . $row['category'] . " </td>
	   	   	 	<td><a href='#' id='" . $row['ID']   . "' class='btn red detperm'  >حذف</a></td>
	    </tr>";
	}

			  echo $dtable;
			
?>


<script type="text/javascript">
		$(document).ready(function(e){

 
 
	});
</script>