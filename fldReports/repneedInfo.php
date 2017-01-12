 <!DOCTYPE html>

 <html xmlns="http://www.w3.org/1999/xhtml">
 <head runat="server">
  <title>القضايا الناقصة</title><meta charset="utf-8" />
  <style>
    body,td,th {
      font-family: Georgia, "Times New Roman", Times, serif;
      color: #333;
    }
    .contents{
      margin: 20px;
      padding: 20px;
      list-style: none;
      background: #F9F9F9;
      border: 1px solid #ddd;
      border-radius: 5px;
    }
    .contents li{
      margin-bottom: 10px;
    }
    .loading-div{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 300%;
      background: rgba(0, 0, 0, 0.56);
      z-index: 999;
      display:none;
    }
    .loading-div img {
      margin-top: 20%;
      margin-right: 37%;
    }

    /* Pagination style */
    .pagination{margin:0;padding:0;}
    .pagination li{
      display: inline;
      padding: 6px 10px 6px 10px;
      border: 1px solid #ddd;
      margin-right: -1px;
      font: 15px/20px Arial, Helvetica, sans-serif;
      background: #FFFFFF;
      box-shadow: inset 1px 1px 5px #F4F4F4;
    }
    .pagination li a{
      text-decoration:none;
      color: rgb(89, 141, 235);
    }
    .pagination li.first {
      border-radius: 5px 0px 0px 5px;
    }
    .pagination li.last {
      border-radius: 0px 5px 5px 0px;
    }
    .pagination li:hover{
      background: #CFF;
    }
    .pagination li.active{
      background: #F0F0F0;
      color: #333;
    }
  </style>
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
              <p style="padding: 5px 0; font-size: 24px; line-height: 28px; text-align: left;">القضايا الناقصة

                <?php echo   date("d-m-Y") ;?> <span style="display: block; font-size: 14px; color: #999;" class="muted">  تقرير القايا الناقصة او المنساة - <span style="color: red;">...</span> قضية</span></p>
              </div>
<div class="loading-div"><img src="../tumblr_mla8v0CgVj1qgwp67o1_400.gif" ></div>

              <div id="needinfotbl" style="margin: 40px 0 20px 0; border-top: 1px solid gray"></div>

            </div>

          </div>
        </div>
      </div>

    </form>

    <script src="../assets/plugins/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

    <script>



      $(document).ready(function(e){

$(".loading-div").show(); //show loading element

reload_data();




$('.cod').on("click",function(){

  $('.cod').css("background-color", "");
  $(this).css("background-color", "yellow");

});



            //executes code below when user click on pagination links
            $(".pageelm").live("click",   function (e){
              e.preventDefault();

$(".loading-div").show(); //show loading element
              var page = $(this).attr("data-page"); //get page number from link
             // alert(page);

             $.ajax({
              type: "POST",
              url:'needinfoajax.php',
              dataType: 'html', 
              data: {page:  page },
              success: function (data) {
                $('#needinfotbl').html('');

                $('#needinfotbl').append(data);


$(".loading-div").hide(); //once done, hide loading element

}
});
           });





          });





      function reload_data() {
        $.ajax({
          type: "POST",
          url:'needinfoajax.php',
          dataType: 'html', 

          success: function (data) {
            $('#needinfotbl').html('');

            $('#needinfotbl').append(data);

$(".loading-div").hide(); //once done, hide loading element

},
error: function (msg) {alert('sameh_ERROR');}
});
      };







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
