<?php
require_once('config.php');
include('dbop.php');

//$key=$_POST["keys"];










$theswitch = " and ";


if (!empty($_POST['code'])) {$code= $_POST['code'];}
if (!empty($_POST['auto'])) {$auto= $_POST['auto'];}
if (!empty($_POST['cust'])) {$cust= $_POST['cust'];}
if (!empty($_POST['cstates'])) {$cstates= $_POST['cstates'];}
if (!empty($_POST['ctypes'])) {$ctypes= $_POST['ctypes'];}





$wer='';

if (!empty($_GET['cccd'])){ 
	if ($wer =='') {$wer='  where (casesmaster.id = ' . $_GET['cccd']  ;} else { $wer .=  $theswitch . '   casesmaster.id  = ' . $_GET['cccd']   ;}
};

if (!empty($code)){ 
	if ($wer =='') {$wer='  where (casesmaster.Code in( ' . $code . ')';} else { $wer .=  $theswitch . '     casesmaster.Code in ( ' . $code . ')' ;}
};
if (!empty($auto)){
	if ($wer =='') {$wer='  where (casesmaster.AutoNumber in( ' . $auto . ')';} else { $wer .=  $theswitch . '     casesmaster.AutoNumber in( ' . $auto . ')';}
};
if (!empty($cust)){
	if ($wer =='') {$wer='  where  (persons.sName   like "%' . $cust . '%"';} else { $wer .=  $theswitch . '     persons.sName   like "%' . $cust . '%"';}
};
if (!empty($_POST['enm'])){
	if ($wer =='') {$wer='  where   (persons_1.sName  = "' . $_POST['enm'] . '"';} else { $wer .=  $theswitch . '      persons_1.sName  = "' . $_POST['enm'] . '"';}
};

if (!empty($_POST['sub'])){
	if ($wer =='') {$wer='  where  (casesmaster.subject  like "%' . $_POST['sub'] . '%"';} else { $wer .=  $theswitch . '     casesmaster.subject  like "%' . $_POST['sub'] . '%"';}
};


if(!empty($_POST['check_cCourts'])) {
	$vch="";
	foreach($_POST['check_cCourts'] as $check) {
		if ($vch ==''){$vch = $check;}else {$vch .=',' . $check;} 
	};
	if ($wer =='') {$wer='  where  (casesdetails.Court  in (' . $vch . ')';} 
	else  {$wer .=  $theswitch . '     (casesdetails.Court  in (' . $vch . ')';}
};


if (!empty($ctypes)){
	if ($wer =='') {$wer='  where    (casesmaster.CaseType  = ' . $ctypes;} 
	else { $wer .=  $theswitch . '       casesmaster.CaseType  = ' . $ctypes;}
};

if (!empty($cstates)){
	if ($wer =='') {$wer='  where   (casesmaster.CaseState = ' . $cstates;} 
	else { $wer .=  $theswitch . '     casesmaster.CaseState = ' . $cstates;}
};

if (!empty($_POST['shposition'])){
	if ($wer =='') {$wer='  where    (casesdetails.Position  = ' . $_POST['shposition'];} 
	else { $wer .=  $theswitch . '       casesdetails.Position  = ' . $_POST['shposition'];}
};







if ($wer =='') {$wer='  where   casesdetails.nowin=1';} 
else  {$wer .='  )  AND  casesdetails.nowin=1';}






$sqc='ALTER VIEW vwcases AS 
SELECT
casesmaster.Code                    AS `Code`,
casesmaster.ID                      AS `ID`,
casesmaster.AutoNumber              AS `AutoNumber`,
casesmaster.CustomerID              AS `CustomerID`,
casesmaster.CaseType                AS `CaseType`,
casesdetails.Court                  AS `Court`,
courts.CourtName		            AS `Courtname`,
casesdetails.Position               AS `Position`,
casesdetails.NowIN                  AS `nowin`,
casetypedetails.CaseTypeDetailsName AS `CaseTypeName`,
casetypedetails.ID  				AS `CaseTypeID`,
casesmaster.CaseState               AS `CaseState`,
casestates.ID              			AS `Statid`,
casestates.StateName                AS `StateName`,
persons.sName                       AS `sName`,
casesmaster.subject                 AS `subject`,
casesmaster.Enemy                   AS `Enemy`,
persons_1.sName                     AS `sName2`,
casesmaster.TheDate                 AS `TheDate`,
papertypes.PaperType                AS `PaperType`,
casesmaster.PaperType               AS `PaperTypeID`,
casesmaster.mon                     AS `mon`,
casesmaster.MonChar                 AS `monchar`,
casesmaster.LaterDate               AS `LaterDate`
FROM (((((((casesmaster
LEFT JOIN casestates
ON ((casesmaster.CaseState = casestates.ID)))
LEFT JOIN casetypedetails
ON ((casesmaster.CaseType = casetypedetails.ID)))
LEFT JOIN persons
ON ((casesmaster.CustomerID = persons.ID)))
LEFT JOIN persons `persons_1`
ON ((casesmaster.Enemy = persons_1.ID)))
LEFT JOIN casesdetails
ON ((casesdetails.CaseMasterID = casesmaster.ID)))
LEFT JOIN papertypes
ON ((casesmaster.PaperType = papertypes.ID)))
LEFT JOIN courts
ON ((casesdetails.Court  = courts.ID))) '. $wer;






$query2= mysql_query($sqc);
$sq='SELECT ID   FROM vwcases ';



$querys= mysql_query($sq);


$tablerows='';

while ( $row =mysql_fetch_array($querys)) {

	$tablerows .= '<tr><td>'.$row["ID"].'</td></tr>';
}













// // $ssql="SELECT     `scan`.*    , `scaninfo`.`pName` 
// FROM     `lawyerdb1`.`scan`    INNER JOIN `lawyerdb1`.`scaninfo`      ON (`scan`.`FileName` = `scaninfo`.`ID`)";


// $ssql="SELECT     `scanperson`.*    , `scaninfo`.`pName` FROM     `lawyerdb1`.`scanperson`    INNER JOIN `lawyerdb1`.`scaninfo`      ON (`scanperson`.`FileName` = `scaninfo`.`ID`) WHERE scanperson.`personid`= ".$key;


// $qury= mysql_query($ssql);

// $tbl='';


// //<img src="../tumblr_mla8v0CgVj1qgwp67o1_400.gif" >

// while($row = mysql_fetch_assoc($qury))
// {
//   $tbl .='<tr> <td> <img  width="80px" src="uploads/'.$row ['ImgPath']    .'"></td> </tr>';
// }


// echo  count(selectDataAsTR("vwcases","(ID)"));






// SELECT     `scan`.*    , `scaninfo`.`pName` 
// FROM     `lawyerdb1`.`scan`    INNER JOIN `lawyerdb1`.`scaninfo`      ON (`scan`.`FileName` = `scaninfo`.`ID`)



$drr=array();
$drr = selectDataAsArr("lawyerdb1.scan  INNER JOIN lawyerdb1.scaninfo      ON (scan.FileName = scaninfo.ID)					 where Caseid IN(". getColDataAsArray("vwcases","ID") .")",
	"scan.* , scaninfo.pName");

$x = count($drr);
$brk=0;
echo  " <h4>ارشيف القضية</h4> <br>" ;
for($i=0; $i<$x; $i++){



	$brks='<div class="row-fluid">';
	$brke='</div>';


	$conten = ' <div class="span3">
	<div class="item">
		<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="uploads/'. $drr[$i]['ImgPath']    .'">
			<div class="zoom">
				<img   src="uploads/'. $drr[$i]['ImgPath']    .'" alt="Photo" />                    
				<div class="zoom-icon"></div>
			</div>
		</a>
		<div class="details">
			<a href="#" class="icon"><i class="icon-paper-clip"></i></a>
			<a href="#" class="icon"><i class="icon-link"></i></a>
			<a href="#" class="icon"><i class="icon-pencil"></i></a>
			<a href="#" class="icon"><i class="icon-remove"></i></a>    
		</div>
	</div>
</div>';


if ($brk==0){$brk+=1;
	echo $brks .$conten;
}elseif ($brk<3) {$brk+=1;
	echo $conten ;
}elseif ($brk==3) {
	echo $conten . $brke ;
	$brk=0;
}

if ($i==$x-1) {
	echo  $brke ;
}
}






//========================================================================================================
//$ssql="SELECT     `scanperson`.*    , `scaninfo`.`pName` FROM     `lawyerdb1`.`scanperson`    INNER JOIN `lawyerdb1`.`scaninfo`      ON (`scanperson`.`FileName` = `scaninfo`.`ID`) WHERE scanperson.`personid`= ".$key;

$drr2=array();
$drr2 = selectDataAsArr("lawyerdb1.scanperson    INNER JOIN lawyerdb1.scaninfo      ON (scanperson.FileName = scaninfo.ID) where Personid IN(". getColDataAsArray("vwcases","CustomerID") .")",
	"scanperson.*    , scaninfo.pName");

$x2 = count($drr2);
$brk2=0;
echo  "  <h4>ارشيف الموكل</h4> <br>";
for($i2=0; $i2<$x2; $i2++){



	$brks2='<div class="row-fluid">';
	$brke2='</div>';


	$conten2 = ' <div class="span3">
	<div class="item">
		<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="uploads/'. $drr2[$i2]['ImgPath']    .'">
			<div class="zoom">
				<img   src="uploads/'. $drr2[$i2]['ImgPath']    .'" alt="Photo" />                    
				<div class="zoom-icon"></div>
			</div>
		</a>
		<div class="details">
			<a href="#" class="icon"><i class="icon-paper-clip"></i></a>
			<a href="#" class="icon"><i class="icon-link"></i></a>
			<a href="#" class="icon"><i class="icon-pencil"></i></a>
			<a href="#" class="icon"><i class="icon-remove"></i></a>    
		</div>
	</div>
</div>';


if ($brk2==0){$brk2+=1;
	echo $brks2 .$conten2;
}elseif ($brk2<3) {$brk2+=1;
	echo $conten2 ;
}elseif ($brk2==3) {
	echo $conten2 . $brke2 ;
	$brk2=0;
}

if ($i2==$x2-1) {
	echo  $brke2 ;
}
}






//=====================================================================================================

$drr2=array();
$drr2 = selectDataAsArr("lawyerdb1.scanperson    INNER JOIN lawyerdb1.scaninfo      ON (scanperson.FileName = scaninfo.ID) where Personid IN(". getColDataAsArray("vwcases","Enemy") .")",
	"scanperson.*    , scaninfo.pName");

$x2 = count($drr2);
$brk2=0;
echo  " <h4>ارشيف الخصم</h4>   <br>";
for($i2=0; $i2<$x2; $i2++){



	$brks2='<div class="row-fluid">';
	$brke2='</div>';


	$conten2 = ' <div class="span3">
	<div class="item">
		<a class="fancybox-button" data-rel="fancybox-button" title="Photo" href="uploads/'. $drr2[$i2]['ImgPath']    .'">
			<div class="zoom">
				<img   src="uploads/'. $drr2[$i2]['ImgPath']    .'" alt="Photo" />                    
				<div class="zoom-icon"></div>
			</div>
		</a>
		<div class="details">
			<a href="#" class="icon"><i class="icon-paper-clip"></i></a>
			<a href="#" class="icon"><i class="icon-link"></i></a>
			<a href="#" class="icon"><i class="icon-pencil"></i></a>
			<a href="#" class="icon"><i class="icon-remove"></i></a>    
		</div>
	</div>
</div>';


if ($brk2==0){$brk2+=1;
	echo $brks2 .$conten2;
}elseif ($brk2<3) {$brk2+=1;
	echo $conten2 ;
}elseif ($brk2==3) {
	echo $conten2 . $brke2 ;
	$brk2=0;
}

if ($i2==$x2-1) {
	echo  $brke2 ;
}
}



// echo  " <h4>ارشيف المزكرات</h4> <br>" ;


// echo  selectDataAsTR("vwcases","(ID)")[1]['ID'];


?>	