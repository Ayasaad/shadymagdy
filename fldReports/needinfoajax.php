<?php

  require_once('../config.php');

  include('../pagenetion.php');
  include('../FunctionSelectSystem.php');




  $item_per_page =15;
  $total_records =  selectonce("select Count(id) as id from vwNeedInfo","id") ;
  $total_pages = ceil($total_records/$item_per_page);
  if(isset($_POST["page"])){
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
  }else{
    $page_number = 1; //if there's no page number, set it to 1
  }



  $navs = paginate_function($item_per_page, $page_number,$total_records, $total_pages);

  $page_position = (($page_number-1) * $item_per_page);

  $query= mysql_query("SELECT *  FROM vwNeedInfo  LIMIT " .  $page_position . "," . $item_per_page);
  $tablerows='';
  while ( $row =mysql_fetch_array($query)) {

    $tablerows .= 
    '<tr>


    <td>
      <a class="cod"  style="font-family:Arial;font-size: 12px; color:#E91E63;" target="_blank" href="../pgCases.php?cccd='.$row["id"] .'&mark=1">'.$row["Code"] .'</a><br /> 
      <span style="font-family:Arial;font-size: 13px; color:#008275;">'. $row["AutoNumber"] .'</span><br />

    </td>

    <td>
      <span style=" font-weight: bold;  font-family:Arial;font-size: 13px;">'.$row["sName"].'</span>
      <br /> - <span  style="font-family:Arial;font-size: 14px; color:#1E88E5;">'. $row["subject"] .'</span>
    </td>

    <td>

    </td>

    <td>
    </td>

    <td>
     <span style="font-family:Arial;font-size: 14px;color:#1E88E5;">'.$row["CourtName"].'</span> <br /> 


   </td>

 </tr>';
};


 echo '<table  class="print" cellspacing="0">
              <thead>
               <tr style="font-size: 14px; background:#D4D3D3;">

                <th  style="width: 70px">كود / آلي</th>
                <th  style="width: 200px">الاشخاص</th>

                <th  style="width: 200px">الاجراء - نوعه</th>

                <th  style="width: 130px">الطابق -القاعة</th>
                <th  style="width: 75px">الجهة</th>
              </tr>
            </thead>

            <tbody id="tblrep">

            '. $tablerows.'




            </tbody>
          </table>' .  $navs ;
 

?>