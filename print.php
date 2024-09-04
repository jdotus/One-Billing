<?php
require ('c:/xampp/htdocs/FPDF/fpdf.php');

include ('dbcon.php');

    
//A4 width: 219mm
//default margin :10mm each side
//writable horizontal : 219-(10*2)=189mm

// $pdf = new FPDF('p','mm','A4');

// $pdf -> AddPage();

$pdf = new FPDF('P', 'mm', array(209.55, 273.05)); // Custom paper size: 100mm x 150mm

$pdf->SetTopMargin(34.4);

$pdf->AddPage();

// sset font to arial, bold, 6pt

$pdf->SetFont('Arial','B',9);


$infoQuery = "SELECT * FROM info WHERE id = '{$_GET["id"]}'";
$infoResult = mysqli_query($con, $infoQuery);
$infoCounter = 0;

while($row = mysqli_fetch_array($infoResult)) {

    $pdf->Cell(30.988, 12.954, '            ' . $row["si_num"],0,0, 'C');  // SI Number


    $pdf->MultiCell(88.773, 6.477, $row['sold_to'] . "\n" . $row['tin'], 0,'C');

    $pdf->Cell(30.988, 12.954,$row["si_date"],0,0,'C');
    $pdf->MultiCell(88.773, 6.477, wordwrap($row["address"],80, "\n"), 0,'C');

    $pdf->Cell(30.988, 11.938,'', 0,0);

    $pdf->Cell(88.773, 5.969,'' , 0 , 2 , 'C'); 
    $pdf->Cell(88.773, 5.969,'' , 0 , 1 , 'C');

}

    // LABEL
    $pdf->Cell(18.288, 5.461,"QUANTITY: ",0,0,'C'); 
    $pdf->Cell(12.7, 5.461,'UNITS',0,0,'C');  
    $pdf->Cell(88.773, 5.461,"ITEM DESCRIPTION: ",0,0,'C'); 

    $pdf->Cell(30.496, 5.461,"UNIT PRICE ",0,0,'C');
    $pdf->Cell(33.671, 5.461,"TOTAL PRICE: ",0,1,'C');
    
    $pdf->Cell(18.288, 6.35,'' ,0,0,'C'); 
    $pdf->Cell(12.7, 6.35,'',0,0,'C');  
    $pdf->Cell(88.773, 6.35,'',0,0,'C');
    $pdf->Cell(30.496, 6.35,'',0,0,'C');
    $pdf->Cell(33.671, 6.35,'',0,1,'C');

    $pdf->Cell(18.288, 6.35,'' ,0,0,'C'); 
    $pdf->Cell(12.7, 6.35,'',0,0,'C');  
    $pdf->Cell(88.773, 6.35,'',0,0,'C');
    $pdf->Cell(30.496, 6.35,'',0,0,'C');
    $pdf->Cell(33.671, 6.35,'',0,1,'C');

    $pdf->Cell(18.288, 6.35,'' ,0,0,'C'); 
    $pdf->Cell(12.7, 6.35,'',0,0,'C');  
    $pdf->Cell(88.773, 6.35,'',0,0,'C');
    $pdf->Cell(30.496, 6.35,'',0,0,'C');
    $pdf->Cell(33.671, 6.35,'',0,1,'C');

$query = "SELECT * FROM sales_2 WHERE info_key = '{$_GET["id"]}'";
$result = mysqli_query($con, $query);
$counter = 0;

while($row = mysqli_fetch_array($result)) {
    $pdf->Cell(18.288, 6.35,'' ,0,0,'C'); 
    $pdf->Cell(12.7, 6.35,'',0,0,'C');  
    $pdf->Cell(88.773, 6.35,$row["item_description"],0,0,'C');
    $pdf->Cell(30.496, 6.35,'',0,0,'C');
    $pdf->Cell(33.671, 6.35,$row["total_price"],0,1,'C');
    $counter++;
}

for($i = 0; $i < 12 - $counter ; $i++) {

    $pdf->Cell(18.288, 6.35,' ',0,0);
    $pdf->Cell(12.7, 6.35,' ',0,0);  
    $pdf->Cell(88.773, 6.35,' ',0,0);
    $pdf->Cell(30.496, 6.35,' ',0,0);
    $pdf->Cell(33.671, 6.35,' ',0,1);

}

$infoQuery2 = "SELECT * FROM info WHERE id = '{$_GET["id"]}'";
$infoResult2 = mysqli_query($con, $infoQuery2);

while($row = mysqli_fetch_array($infoResult2)) {

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'',0,0);
$pdf->Cell(33.671, 6.35,$row["total_amount_payable"],0,1,'C');

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'',0,0);
$pdf->Cell(33.671, 6.35,'',0,1);

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'',0,0);
$pdf->Cell(33.671, 6.35,'',0,1);


$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'VATable Sale',0,0);
$pdf->Cell(33.671, 6.35,'',0,1);
// $pdf->Cell(33.671, 6.35,$row["vatable_sale"],1,1);

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'VAT Exempt Sale',0,0);
$pdf->Cell(33.671, 6.35,'',0,1);
// $pdf->Cell(33.671, 6.35,$row["vat_exempt_sale"],1,1);

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'Zero Rated Sale',0,0);
$pdf->Cell(33.671, 6.35,'',0,1);
// $pdf->Cell(33.671, 6.35,$row["zero_rated_sale"],1,1);

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'Total Sale',0,0);
$pdf->Cell(33.671, 6.35,$row["total_sale"],0,1,'C');

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'VAT',0,0);
$pdf->Cell(33.671, 6.35,$row["vat"],0,1,'C');

$pdf->Cell(18.288, 6.35,' ',0,0); 
$pdf->Cell(12.7, 6.35,' ',0,0);  
$pdf->Cell(88.773, 6.35,' ',0,0);
$pdf->Cell(30.496, 6.35,'Total Amount Payable',0,0);
$pdf->Cell(33.671, 6.35,$row["total_amount_payable"],0,1,'C');

    
}

$pdf->Output();

// }

?>