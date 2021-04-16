<?php 
$mpathdn = _XMYAPP_PATH_;
define('FPDF_FONTPATH',$mpathdn . '/fpdf17/');
require($mpathdn . '/fpdf17/fpdf.php');
$pdf = new FPDF('P','mm','letter');  

$pdf->SetAutoPageBreak(true, 1);
$pdf->SetMargins(0.3, 0, 0, 0);
$pdf->cMargin = 0;
$pdf->Open();
$pdf->AddPage();	

$width = $pdf->w;
$height = $pdf->h;
$pdf->Line($width / 2, 0,$width / 2,$height);
$pdf->Line(0, $height / 2,$width,$height/2);


$x = 10;
$y = 15;
$pg = 0;
foreach($result as $row){
    
    $pdf->SetFont('Times','',11);
    $pdf->Text($x + 30,$y,"reference no.");
    $pdf->Text($x + 52,$y,$row['refno']);

    $pdf->SetFont('Times','B',13);
    $pdf->Text($x + 25,$y + 5,"FG VAN RENTAL");

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+15,"MONTH:");
    $date = date_create($row['pperiod']);
    $pdf->Text($x + 28,$y + 15,date_format($date,"F d Y"));

    $pdf->Text($x,$y + 20,"PERIOD OF:");
    $pdf->Text($x + 28,$y + 20,$row['refno']);

    $pdf->Text($x,$y + 25,"OPERATOR:");
    $pdf->Text($x + 28,$y+25,$row['operator_name']);
    $pdf->Text($x + 37,$y+30,$row['plate_number']);

    $pdf->Text($x,$y+40,"TOTAL TRIPS");
    $pdf->Text($x + 68,$y+40,$row['totaltrips']);

    $pdf->Text($x,$y+45,"TOTAL AMOUNT");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 68,$y+45,$this->mylib->num_decimal($row['totalamount'])); // TOTAL AMOUNT
    $pdf->Text($x + 68,$y+82,$this->mylib->num_decimal($row['totalexpenses'])); // TOTAL EXPENSES

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+55,"EXPENSES:");

    $pdf->Text($x + 2,$y+60,"10% TAX");
    $pdf->Text($x + 68,$y+60,$this->mylib->num_decimal($row['tax_10'],2,9));

    $pdf->Text($x + 2,$y+65,"3% ANNUAL TAX");
    $pdf->Text($x + 68,$y+65,$this->mylib->num_decimal($row['tax_3']));

    $pdf->Text($x + 2,$y+70,"ADMIN FEE");
    $pdf->Text($x + 36,$y+70,"83.00");
    $pdf->Text($x + 52,$y+70,$row['days']);
    $pdf->Text($x + 68,$y+70,$this->mylib->num_decimal($row['admin_fee']));

    $pdf->Text($x + 2,$y+75,"OTHER FEE(s)");
    $pdf->Text($x + 68,$y+75,$this->mylib->num_decimal($row['otherdeduc']));

    $pdf->Text($x + 62,$y+76,'____________');
    $pdf->Text($x + 2,$y+82,"TOTAL EXPENSES");

    $pdf->SetFont('Times','B',12);
    $pdf->Text($x,$y+92,"NET PAY OUT");
    $pdf->Text($x + 68,$y+92,$this->mylib->num_decimal($row['net']));

    $x = 118;

    $pdf->SetFont('Times','',11);
    $pdf->Text($x + 30,$y,"reference no.");
    $pdf->Text($x + 52,$y,$row['refno']);

    $pdf->SetFont('Times','B',13);
    $pdf->Text($x + 25,$y + 5,"FG VAN RENTAL");

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+15,"MONTH:");
    $date = date_create($row['pperiod']);
    $pdf->Text($x + 28,$y + 15,date_format($date,"F d Y"));

    $pdf->Text($x,$y + 20,"PERIOD OF:");
    $pdf->Text($x + 28,$y + 20,$row['refno']);

    $pdf->Text($x,$y + 25,"OPERATOR:");
    $pdf->Text($x + 28,$y+25,$row['operator_name']);
    $pdf->Text($x + 37,$y+30,$row['plate_number']);

    $pdf->Text($x,$y+40,"TOTAL TRIPS");
    $pdf->Text($x + 68,$y+40,$row['totaltrips']);

    $pdf->Text($x,$y+45,"TOTAL AMOUNT");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 68,$y+45,$this->mylib->num_decimal($row['totalamount'])); // TOTAL AMOUNT
    $pdf->Text($x + 68,$y+82,$this->mylib->num_decimal($row['totalexpenses'])); // TOTAL EXPENSES

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+55,"EXPENSES:");

    $pdf->Text($x + 2,$y+60,"10% TAX");
    $pdf->Text($x + 68,$y+60,$this->mylib->num_decimal($row['tax_10']));

    $pdf->Text($x + 2,$y+65,"3% ANNUAL TAX");
    $pdf->Text($x + 68,$y+65,$this->mylib->num_decimal($row['tax_3']));

    $pdf->Text($x + 2,$y+70,"ADMIN FEE");
    $pdf->Text($x + 36,$y+70,"83.00");
    $pdf->Text($x + 52,$y+70,$row['days']);
    $pdf->Text($x + 68,$y+70,$this->mylib->num_decimal($row['admin_fee']));

    $pdf->Text($x + 2,$y+75,"OTHER FEE(s)");
    $pdf->Text($x + 68,$y+75,$this->mylib->num_decimal($row['otherdeduc']));

    $pdf->Text($x + 62,$y+76,'____________');
    $pdf->Text($x + 2,$y+82,"TOTAL EXPENSES");

    $pdf->SetFont('Times','B',12);
    $pdf->Text($x,$y+92,"NET PAY OUT");
    $pdf->Text($x + 68,$y+92,$this->mylib->num_decimal($row['net']));

    $x = 10;
    $y = $y + 140;
    $pg = $pg + 1;
    if($pg == 2){
        $pdf->AddPage();
        $x = 10;
        $y = 15;
        $pg = 0;
        $pdf->Line($width / 2, 0,$width / 2,$height);
        $pdf->Line(0, $height / 2,$width,$height/2);
    }
}

$file = "./downloads/pdf/" . basename("./downloads/pdf/" . 'lp' . date("Yhis"));
$file .= '.pdf';

//Save PDF to file
$pdf->Output();
// $file = "." . $file;
// Everything for owner, read and execute for others
// if(!empty($file)){
//     chmod($file, 0755);
//     echo "<HTML><SCRIPT>document.location='{$file}';  </SCRIPT></HTML>";
// }


$pdf->close();
?>