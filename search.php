<?php
    require_once('config.php');
    //========================================العملاء=============================================
    
   $query= mysql_query("SELECT sName FROM persons where PersType = 1 ORDER BY sName");
  
     
     $data='';
    while($row = mysql_fetch_array($query))
    {   
        if ($data==''){  $data = "&quot;" . $row["sName"] . "&quot;" ;} else { $data .= ",&quot;" . $row["sName"] . "&quot;" ; }
    }

    $data ="[" . $data ."]";

 
//=========================================الخصوم===============================================

     $query2= mysql_query("SELECT sName FROM persons  where PersType = 2  ORDER BY sName");
  
     
     $data2='';
    while($row2 = mysql_fetch_array($query2))
    {   
         if ($data2==''){  $data2 = "&quot;" . $row2["sName"] . "&quot;" ;} else { $data2 .= ",&quot;" . $row2["sName"] . "&quot;" ; }
    }

    $data2 ="[" . $data2 ."]";
      


?>