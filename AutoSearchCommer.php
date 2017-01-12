
<?php
require_once('dbop.php');

$autonum=$_GET["autonum"];
$caseid =$_GET["caseid"];

$coci1= selectonce("select SetValue from systemsetings where Setname='BNES_JSESSIONID'","SetValue");
$coci2=  selectonce("select SetValue from systemsetings where Setname='JSESSIONID'","SetValue");
$capchta =   selectonce("select SetValue from systemsetings where Setname='captcha'","SetValue");


$cookies = array("Cookie: BNES_JSESSIONID=".$coci1."; JSESSIONID=".$coci2."; path=/; domain=www.kuwaitcourts.gov.kw;");

$opts = array('http' => array('header' => $cookies));
$context = stream_context_create($opts);
$fLink="http://www.kuwaitcourts.gov.kw/viewResults/validateCase.jsp?searchType=0&txtCaseNo=";
$html = file_get_contents($fLink.trim($autonum)."&txtCaptcha=".$capchta, false, $context);


//echo iconv('WINDOWS-1256', 'UTF-8', $html);//https://www.kuwaitcourts.gov.kw/viewResults/announceView.jsp


$html2 = iconv('WINDOWS-1256', 'UTF-8', file_get_contents("https://www.kuwaitcourts.gov.kw/viewResults/announceView.jsp", false, $context));


$strs  = strpos($html2, 'تفاصيل');
$stre  = strpos($html2, '</table>');

$ddt=  substr($html2, $strs, $stre);

$ddt = strip_tags($ddt);

//$ddt = str_replace(" ","",$ddt);
$ddt = explode("\n",  $ddt);

$cot =  count($ddt);



 

  for ($x0 = 0; $x0 < $cot; $x0++){

  if(trim($ddt[$x0])=='عدد زائري اليوم') {$cot = $x0;} else {$cot =  count($ddt);} ;

  }





$tim1 = 5;
//if(trim($ddt[44])=='عددزائرياليوم') {echo "kkk";} else {echo "nnnnnn";} ;



for ($x = 0; $x < $cot; $x++){

	 

	  //echo   $x ."=>".  trim($ddt[$x]) . "<br />";
	$ro[0] = trim($ddt[$tim1]);
	  $tim1 +=1;
	$ro[1] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[2] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[3] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[4] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[5] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[6] = trim($ddt[$tim1]);
	$tim1 +=1;
	$ro[7] = trim($ddt[$tim1]);
	$tim1 +=5;

 

$qur="insert into commercial (CaseID,cmrState,cdate,comerNum,comerType,comerCaseNum,comerDirect,comerDetail)  values ('". trim($caseid) ."','".$ro[6]."','".$ro[5]."','".$ro[1]."','".$ro[2]."','".$ro[3]."','".$ro[4]."','".$ro[7]."')";
  $query= mysql_query($qur);

echo $qur;
	if (trim($ddt[$tim1]) == '') {
        break;    /* You could also write 'break 1;' here. */
    }
	  
}

 


?>