 <?php
// $_POST["smsnumber"];
// $_POST["smsTitle"];
// $_POST["smsSubject"];
 


$strTerm =  $_POST["smsSubject"];// $_POST["smsSubject"];

//$title=strtoupper(bin2hex(iconv('UTF-8', 'UCS-2', $strTerm))); 
$msg=  strtoupper(bin2hex(iconv('UTF-8', 'UCS-2', $strTerm))); //'01587015750160501581'; //rawurlencode("سامح"); //mb_convert_encoding(bin2hex($strTerm), 'UTF-8', 'auto'); ;

//http://sms1.cardboardfish.com:9001/HTTPSMS?S=H&UN=egygulf2451&P=6XskdSql&DA=00201210643605&SA=Al-Marshad&DC=4&M="

//http://sms1.cardboardfish.com:9001/HTTPSMS?S=H&UN=smta7001&P=6LS79KkM&DA=00201210643605&SA=Al-Marshad&DC=4&M=
$res = file_get_contents(
'http://sms1.cardboardfish.com:9001/HTTPSMS?S=H&UN=smta7001&P=6LS79KkM&DA='.$_POST["smsnumber"].'&SA=Al-Marshad&DC=4&M='.$msg);
//echo $res;

if (strpos($res,'OK') !== false) {
	echo '<div class="alert alert-success">
	<button class="close" data-dismiss="alert"></button>
	<strong>ارسال ناجح!</strong> تم ارسال الرسالة بنجاح.
</div>';
}else
{
	echo  "خطأ". $res;
}
?>


