<?php
require_once('config.php');
 $UID = $_POST['userID'];

$sq ="SELECT
 	`usercourt`.`ID`,
    `courts`.`CourtName`
    , `users`.`username`
FROM
    `lawyerdb1`.`usercourt`
    LEFT JOIN `lawyerdb1`.`courts` 
        ON (`usercourt`.`CourtID` = `courts`.`ID`)
    LEFT JOIN `lawyerdb1`.`users` 
        ON (`usercourt`.`UserID` = `users`.`id`)";


$query= mysql_query($sq ." where userid = " .  $UID);



$dtable="";

  while($row = mysql_fetch_array($query))
	 { 
	 $dtable.="<tr>
	 	<td>" . $row['ID'] . "</td>
		   	   	<td><a href='#' class='DetailsEv' value='" . $row['ID']   . "'>" . $row['CourtName'] . "</a></td>
		 	   </tr>";

		}
			  echo $dtable;
?>