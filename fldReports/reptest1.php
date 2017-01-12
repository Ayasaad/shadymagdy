<?php
require('../fpdf181/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    //$this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}



// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}


// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}

}



// $pdf = new PDF();
// // Column headings
// $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// // Data loading
// $data = $pdf->LoadData('../fpdf181/tutorial/countries.txt');
// $pdf->SetFont('Arial','',14);
// $pdf->AddPage();
  
// $pdf->FancyTable($header,$data);
// $pdf->Output();







// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();

// Column headings
$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
// Data loading
$data = $pdf->LoadData('../fpdf181/tutorial/countries.txt');
$pdf->SetFont('Arial','',14);

$pdf->AddPage();
 
$pdf->FancyTable($header,$data);
 
$pdf->Output();
?>


<script>

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