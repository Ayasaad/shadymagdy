<?Php session_start();

require_once('config.php');
 
  
$CID = $_POST['CaseID'];
  $evnt = $_POST['evnt'];
  $evnttype = $_POST['evnttype'];
 $TheDate = $_POST['TheDate'];
 $uidd=$_SESSION['USID'];


  $query= mysql_query("insert into caseevents (CaseID,DetailsEvent,IDEventType,TheDate,cdate,TheUser) 
  			  values (".$CID .",'".$evnt."',".$evnttype." 	,'".$TheDate."','". date("Y/m/d") ."',".$uidd.")");
 
  // $query= mysql_query("insert into caseevents (CaseID,DetailsEvent, IDEventType,TheDate,cdate,TheUser,parent) 
  // 			  values (".$CID .",'جديد',".$evnttype." 	,'".date("Y/m/d")."','". date("Y/m/d") ."','".$_SESSION['USID']."',LAST_INSERT_IddsD())");
 
 echo $uidd;
?>