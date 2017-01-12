<?php 
include('config.php');


 


$ssqll = "UPDATE caseevents set WithUser = " . $_POST['userre'] . " where id= " . $_POST['rediid'];
$query= mysql_query($ssqll);

 echo "تم التوجيه";
?>