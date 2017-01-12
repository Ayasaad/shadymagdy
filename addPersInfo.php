<?php

require_once('config.php');

$persinfodet = $_POST['persinfodet'];
$persinfotyp = $_POST['persinfotyp'];
$persidd = $_POST['persidd'];

$sq="insert into prs_contacts (PersonID,InfoTypeID,Title) values (".$persidd .",".$persinfotyp.",'".$persinfodet."')";
 $query= mysql_query($sq);
 


?>