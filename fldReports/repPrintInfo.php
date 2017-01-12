 <!DOCTYPE html>

 <html xmlns="http://www.w3.org/1999/xhtml">
 <head runat="server">
    <title></title>
    <meta charset="utf-8" />
   <script src="../assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
    <link href="theme.default.css" rel="stylesheet">
  <script src="jquery.tablesorter.min.js"></script>
  <script src="jquery.tablesorter.widgets.min.js"></script>
  <script>
  $(function(){
    $('table').tablesorter({
      widgets        : ['zebra', 'columns'],
      usNumberFormat : false,
      sortReset      : true,
      sortRestart    : true
    });
  });
  </script>



    <style>
        /* THE FOLLOWING CSS IS REQUIRED AND SHOULD NOT BE MODIFIED. */

        table.fauxRow {
            border-spacing: 0;
        }

        table.fauxRow > tbody > tr > td {
            padding: 0;
            overflow: hidden;
        }

        table.fauxRow > tbody > tr > td > table.print {
            display: inline-table;
            vertical-align: top;
        }





        @media print {
            #header {
                display: table-header-group;
            }
        }





        @page {
            counter-increment: page;

            @top-center {
                content: "Headline, yo!";
            }

            @bottom-right {
                counter-increment: page;
                content: "Page " counter(page);
            }
        }

td {
border-bottom: 1px solid #ccc; /* or whatever specific values you prefer */
}
    </style>
</head>
<body>
 <?php 

 sleep(4);

                          require_once('../config.php');
                          $query= mysql_query("SELECT *,(select count(id) from vwcases) as cotevts  FROM vwcases ");
                          $tablerows='';
                          while ( $row =mysql_fetch_array($query)) {
                            $cotevts=$row["cotevts"] ;
                            $tablerows .=   '<tr>


                      <td>
                      <a  class="cod" style="font-family:Arial;font-size: 12px; color:#E91E63;" target="_blank" href="../pgCases.php?cccd='.$row["ID"] .'&mark=1">'.$row["Code"] .'</a><br /> 
                      <span style="font-family:Arial;font-size: 13px; color:#008275;">'. $row["AutoNumber"] .'</span><br />
                          <span style="font-family:Arial;font-size: 12px;color:#863B20;">   '.$row["CaseNumber"].'</span> 
                      </td>

                      <td>
                      <span style=" font-weight: bold;  font-family:Arial;font-size: 13px;">'.$row["sName"].'</span>
                       <br />
                      <span style=" font-family:Arial;font-size: 12px;">'.$row["sName2"].'</span>
                      <br /> - <span  style="font-family:Arial;font-size: 14px; color:#1E88E5;">'. $row["subject"] .'</span>
                      </td>


                      <td>
                       <span style="font-family:Arial;font-size: 14px;color:#1E88E5;">'.$row["CaseTypeName"].'</span> <br /> 
                       <span style="font-family:Arial;font-size: 14px;color:#1E88E5;">'.$row["StateName"].'</span> <br /> 
                       </td>
                     
                     

                      <td>
                       <span style="font-family:Arial;font-size: 14px;color:#1E88E5;">'.$row["Courtname"].'</span> <br /> 
                       </td>

                        </tr>';
                    };
                     ?>
    <form id="form1" runat="server">

        <div style="">



            <div id="Div1" style="">
                <div id="rep1" style="">
                    <div dir="rtl" style="text-align: right; margin: 0 auto; padding: 5px; border: 1px solid orange; height: auto; width: 21cm; box-shadow: 5px 5px 15px #999;">
                        <div class="print" style="float: right;">
                            <img src="../assets/img/invoice/almarshed3.png" alt="" />
                        </div>
                        <div>
                            <p style="padding: 5px 0; font-size: 24px; line-height: 28px; text-align: left;">'طباعة القضايا'
                              <?php echo   date("d-m-Y") ;?> <span style="display: block; font-size: 14px; color: #999;" class="muted">تقرير الرول - <span style="color: red;"><?php echo  $cotevts;?></span> اجراء</span></p>
                        </div>


                        <div style="margin: 40px 0 20px 0; border-top: 1px solid gray"></div>

                        <table  class="print tablesorter" cellspacing="0" width="100%">
                          <thead>
                             <tr style="font-size: 14px; background:#D4D3D3;">

                                <th  style="width: 70px">كود / آلي</th>
                                <th  style="width: 200px">الاشخاص-الموضوع</th>
                                
                             
                                   <th  style="width: 130px">النوع -الحالة</th>
                                <th  style="width: 75px;font-size: 12px;">الجهة - الدائرة</th>
                            </tr>
                        </thead>

                        <tbody>
                               <?php echo $tablerows;?>
                         




                </tbody>
            </table>
        </div>

    </div>
</div>
</div>

</form>
<script src="../assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
<script src="../assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<script>



  $(document).ready(function(e){

    $('.cod').on("click",function(){

      $('.cod').css("background-color", "");
      $(this).css("background-color", "yellow");
      
    });
  });


    function popitup(url, h, w) {
        newwindow = window.open(url, 'name4', 'height=' + h + ' ,width=' + w + '');
        if (window.focus) { newwindow.focus() }
            return false;
    }


        // (function () { // THIS FUNCTION IS REQUIRED.
        //     if (/Firefox|MSIE/i.test(navigator.userAgent))
        //         var formatForPrint;
        //     else
        //         var formatForPrint = function (table) {
        //             var tableParent = table.parentNode
        //             , cell = table.querySelector("tbody > tr > td");
        //             if (cell) {
        //                 var topFauxRow = document.createElement("table")
        //                 , fauxRowTable = topFauxRow.insertRow(0).insertCell(0).appendChild(table.cloneNode())
        //                 , colgroup = fauxRowTable.appendChild(document.createElement("colgroup"))
        //                 , headerHider = document.createElement("div")
        //                 , metricsRow = document.createElement("tr")
        //                 , cells = cell.parentNode.cells
        //                 , cellNum = cells.length
        //                 , colCount = 0
        //                 , tbods = table.tBodies
        //                 , tbodCount = tbods.length
        //                 , tbodNum = 0
        //                 , tbod = tbods[0];
        //                 for (; cellNum--; colCount += cells[cellNum].colSpan);
        //                     for (cellNum = colCount; cellNum--; metricsRow.appendChild(document.createElement("td")).style.padding = 0);
        //                         cells = metricsRow.cells;
        //                     tbod.insertBefore(metricsRow, tbod.firstChild);
        //                     for (; ++cellNum < colCount; colgroup.appendChild(document.createElement("col")).style.width = cells[cellNum].offsetWidth + "px");
        //                         var borderWidth = metricsRow.offsetHeight;
        //                     metricsRow.className = "metricsRow";
        //                     borderWidth -= metricsRow.offsetHeight;
        //                     tbod.removeChild(metricsRow);
        //                     tableParent.insertBefore(topFauxRow, table).className = "fauxRow";
        //                     if (table.tHead)
        //                         fauxRowTable.appendChild(table.tHead);
        //                     var fauxRow = topFauxRow.cloneNode(true)
        //                     , fauxRowCell = fauxRow.rows[0].cells[0];
        //                     fauxRowCell.insertBefore(headerHider, fauxRowCell.firstChild).style.marginBottom = -fauxRowTable.offsetHeight - borderWidth + "px";
        //                     if (table.caption)
        //                         fauxRowTable.insertBefore(table.caption, fauxRowTable.firstChild);
        //                     if (tbod.rows[0])
        //                         fauxRowTable.appendChild(tbod.cloneNode()).appendChild(tbod.rows[0]);
        //                     for (; tbodNum < tbodCount; tbodNum++) {
        //                         tbod = tbods[tbodNum];
        //                         rows = tbod.rows;
        //                         for (; rows[0]; tableParent.insertBefore(fauxRow.cloneNode(true), table).rows[0].cells[0].children[1].appendChild(tbod.cloneNode()).appendChild(rows[0]));
        //                     }
        //                 tableParent.removeChild(table);
        //             }
        //             else
        //                 tableParent.insertBefore(document.createElement("div"), table).appendChild(table).parentNode.className = "fauxRow";
        //         };
        //         var tables = document.body.querySelectorAll("table.print")
        //         , tableNum = tables.length;
        //         for (; tableNum--; formatForPrint(tables[tableNum]));
        //     })();
    </script>
</body>
</html>
