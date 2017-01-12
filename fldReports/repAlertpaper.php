 <!DOCTYPE html>

 <html xmlns="http://www.w3.org/1999/xhtml">
 <head runat="server">
  <title></title><meta charset="utf-8" />
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
 <?php session_start(); 

 require_once('../dbop.php');
 require_once('../fldReports/courtsdrp.php');



 $IDf=$_GET['thread'];

 $sqls="  SELECT
 `e`.`ID`                                AS `id2`,
 `casesmaster`.`ID`                      AS `id`,
 `casesmaster`.`Code`                    AS `Code`,
 `casesmaster`.`AutoNumber`              AS `AutoNumber`,
 `casesmaster`.`CustomerID`              AS `CustomerID`,
 `customerposition`.`PositionName`       AS `PositionNames`,
 `casesmaster`.`CaseType`                AS `CaseType`,
 `casetypedetails`.`CaseTypeDetailsName` AS `CaseTypeDetailsName`,
 `casesmaster`.`CaseState`               AS `CaseState`,
 `casestates`.`StateName`                AS `StateName`,
 `persons`.`sName`                       AS `sName`,
 `casesmaster`.`subject`                 AS `subject`,
 `casesmaster`.`Enemy`                   AS `Enemy`,
 `persons_1`.`sName`                     AS `sName2`,
 `papertypes`.`PaperType`                AS `PaperType`,
 `casesmaster`.`PaperType`               AS `PaperTypeID`,
 `casesmaster`.`MonChar`                 AS `MonChar`,
 `casesdetails`.`Court`                  AS `Court`,
 `casesdetails`.`Circle`                 AS `Circle`,
 `casesdetails`.`CaseNumber`             AS `CaseNumber`,
 `casesdetails`.`Secretary`              AS `Secretary`,
 `casesdetails`.`Gedge`                  AS `Gedges`,
 `casesdetails`.`Floor`                  AS `Floor`,
 `casesdetails`.`Hall`                   AS `Hall`,
 `casesdetails`.`Position`               AS `Position`,
 `courts`.`CourtName`                    AS `CourtName`,
 `positions`.`positionName`              AS `positionName`,
 `e`.`DetailsEvent`                      AS `DetailsEvent`,
 `e`.`IDEventType`                       AS `IDEventType`,
 `eventtypes`.`TypeName`                 AS `TypeName`,
 `e`.`TheDate`                           AS `TheDate`,
 `e`.`cdate`                             AS `cdate`,
 `e`.`Notes`                             AS `Notes`,
 `e`.`TheUser`                           AS `TheUser`,
 `e`.`WithUser`                          AS `WithUser`,
 `e`.`EventState`                        AS `EventState`,
 `eventstats`.`evStateName`              AS `evStateName`,
 (SELECT
 CONCAT(`e1`.`TheDate`,' - ',`e1`.`DetailsEvent`) AS `DetailsEvent`
 FROM `caseevents` `e1`
 WHERE ((`e1`.`TheDate` < `e`.`TheDate`)
 AND (`e`.`CaseID` = `e1`.`CaseID`)
 AND (`e`.`IDEventType` = `e1`.`IDEventType`))
 ORDER BY `e1`.`TheDate` DESC
 LIMIT 0,1) AS `prev_value`
 FROM (((((((((((((`casesmaster`
 LEFT JOIN `casestates`
 ON ((`casesmaster`.`CaseState` = `casestates`.`ID`)))
 LEFT JOIN `casetypedetails`
 ON ((`casesmaster`.`CaseType` = `casetypedetails`.`ID`)))
 LEFT JOIN `persons`
 ON ((`casesmaster`.`CustomerID` = `persons`.`ID`)))
 LEFT JOIN `persons` `persons_1`
 ON ((`casesmaster`.`Enemy` = `persons_1`.`ID`)))
 LEFT JOIN `casesdetails`
 ON ((`casesdetails`.`CaseMasterID` = `casesmaster`.`ID`)))
 LEFT JOIN `papertypes`
 ON ((`casesmaster`.`PaperType` = `papertypes`.`ID`)))
 LEFT JOIN `courts`
 ON ((`casesdetails`.`Court` = `courts`.`ID`)))
 LEFT JOIN `positions`
 ON ((`casesdetails`.`Position` = `positions`.`ID`)))
 LEFT JOIN `caseevents` `e`
 ON ((`e`.`CaseID` = `casesmaster`.`ID`)))
 LEFT JOIN `eventstats`
 ON ((`eventstats`.`ID` = `e`.`EventState`)))
 LEFT JOIN `eventtypes`
 ON ((`e`.`IDEventType` = `eventtypes`.`ID`)))
 LEFT JOIN `eventthreads`
 ON ((`eventthreads`.`EventID` = `e`.`ID`)))
 LEFT JOIN `customerposition`
 ON ((`customerposition`.`ID` = `casesdetails`.`CustPos`)))
 WHERE ((`casesdetails`.`NowIN` = 1)  AND   e.id   = ".$IDf ."   )
 ORDER BY `e`.`TheDate` ";



 $query= mysql_query($sqls);

 $row =mysql_fetch_assoc($query)
 ?>
 <form id="form1" runat="server">

  <div style="">



    <div id="Div1" style="">
      <div id="rep1" style="">
        <div dir="rtl" style="text-align: right; margin: 0 auto; padding: 5px; border: 1px solid orange; height: 26cm; width: 21cm; box-shadow: 5px 5px 15px #999;">
          <div class="print" style="float: right;">
            <img src="../assets/img/invoice/almarshed3.png" alt="" />
          </div>
          <div>
            <p style="padding: 5px 0; font-size: 24px; line-height: 28px; text-align: left;">اخطار قضية
              <?php echo  $row["Code"] ." - ". date("d-m-Y") ;?> <span style="display: block; font-size: 14px; color: #999;" class="muted">تقرير إخطار - <span style="color: red;"> </span> بيانات اجراء</span></p>
            </div>


            <div style="margin: 40px 0 20px 0; border-top: 1px solid gray"></div>


            <div style="font-size: 28px;"><br>
              <?php   
              $dfdt="<p><b>السادة</b> / " . $row["sName"] . " </p>
              <p style='margin:0 40% 0 0'><b>تحية طيبة وبعد،،،</b>  </p>
              <p>نفيدكم بأن القضية  رقم  // " . $row["CaseNumber"] . "-". $row["Circle"] ." </p>
              <p> والمرفوعة ضد // <b>" . $row["sName2"] . " </b> </p>
              <p>  وموضوعها // " . $row["subject"] . "</p>
              <p>والمنظورة امام محكمة // " . $row["CourtName"] . "</p>
              <p>وصفتكم فيها // " . $row["PositionNames"] . "</p>
              <p>انه بتاريخ  // <input type='text'   style='border-style: none; width:110px ;font-size:20px;' value='" . $row["cdate"] . "' />  قد تأجلت الى تاريخ  //  <input   type='text' style='border-style: none;  width:110px ; font-size:20px;' value='" . $row["TheDate"] . "' /></p>
              <p style='vertical-align:top;'>وذلك للاسباب // <textarea style='border-style: none; font-size:20px;' rows='1' cols='50'>" . $row["DetailsEvent"] . "' </textarea></p>
               <br /><br /><p style='margin:0 490px 0 0'> المستشار / فواز المرشد <br /> <span style='margin:0 50px 0 0 ; font-size:24px;'>". $_SESSION['USNM'] ."</span></p><a href='#' style='font-size:14px' title='ارسال بريد الكتروني'>ارسال</a>";
              echo  $dfdt ;


//Circle
              ?>

            </div>


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


        (function () { // THIS FUNCTION IS REQUIRED.
          if (/Firefox|MSIE/i.test(navigator.userAgent))
            var formatForPrint;
          else
            var formatForPrint = function (table) {
              var tableParent = table.parentNode
              , cell = table.querySelector("tbody > tr > td");
              if (cell) {
                var topFauxRow = document.createElement("table")
                , fauxRowTable = topFauxRow.insertRow(0).insertCell(0).appendChild(table.cloneNode())
                , colgroup = fauxRowTable.appendChild(document.createElement("colgroup"))
                , headerHider = document.createElement("div")
                , metricsRow = document.createElement("tr")
                , cells = cell.parentNode.cells
                , cellNum = cells.length
                , colCount = 0
                , tbods = table.tBodies
                , tbodCount = tbods.length
                , tbodNum = 0
                , tbod = tbods[0];
                for (; cellNum--; colCount += cells[cellNum].colSpan);
                  for (cellNum = colCount; cellNum--; metricsRow.appendChild(document.createElement("td")).style.padding = 0);
                    cells = metricsRow.cells;
                  tbod.insertBefore(metricsRow, tbod.firstChild);
                  for (; ++cellNum < colCount; colgroup.appendChild(document.createElement("col")).style.width = cells[cellNum].offsetWidth + "px");
                    var borderWidth = metricsRow.offsetHeight;
                  metricsRow.className = "metricsRow";
                  borderWidth -= metricsRow.offsetHeight;
                  tbod.removeChild(metricsRow);
                  tableParent.insertBefore(topFauxRow, table).className = "fauxRow";
                  if (table.tHead)
                    fauxRowTable.appendChild(table.tHead);
                  var fauxRow = topFauxRow.cloneNode(true)
                  , fauxRowCell = fauxRow.rows[0].cells[0];
                  fauxRowCell.insertBefore(headerHider, fauxRowCell.firstChild).style.marginBottom = -fauxRowTable.offsetHeight - borderWidth + "px";
                  if (table.caption)
                    fauxRowTable.insertBefore(table.caption, fauxRowTable.firstChild);
                  if (tbod.rows[0])
                    fauxRowTable.appendChild(tbod.cloneNode()).appendChild(tbod.rows[0]);
                  for (; tbodNum < tbodCount; tbodNum++) {
                    tbod = tbods[tbodNum];
                    rows = tbod.rows;
                    for (; rows[0]; tableParent.insertBefore(fauxRow.cloneNode(true), table).rows[0].cells[0].children[1].appendChild(tbod.cloneNode()).appendChild(rows[0]));
                  }
                tableParent.removeChild(table);
              }
              else
                tableParent.insertBefore(document.createElement("div"), table).appendChild(table).parentNode.className = "fauxRow";
            };
            var tables = document.body.querySelectorAll("table.print")
            , tableNum = tables.length;
            for (; tableNum--; formatForPrint(tables[tableNum]));
          })();
      </script>
    </body>
    </html>
