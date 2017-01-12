<?php 

include('config.php');
//echo $_POST['gids'] . "sucsess"; 
$ids = explode(",",$_POST['cids'] );


foreach ($ids as &$value) {
    //$value = $value * 2;
    $query= mysql_query("insert into groups (GroupID,CaseID) 
  			  values (". $_POST['gids'] .",". $value  .")");
}
echo "تمت اضافة القضايا على المجموعة";


?>