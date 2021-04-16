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
// $pdf->Line($width / 4, 0,$width / 4,$height);
$pdf->Line(0, $height / 2,$width,$height/2);


$x = 7;
$y = 12;
$pg = 0;

foreach($result as $row){
    $pdf->SetFont('Times','B',13);
    $pdf->Text($x + 27,$y,"FG VAN RENTAL");
    $pdf->SetFont('Times','',11);
    $pdf->Text($x + 10,$y+5,"Contact No. 0926 058 1888 / 0927 307 9766");
    $pdf->Text($x + 32,$y+10,"PAY OUT SLIP");
    $pdf->Line(0, $y+14,$width,$y+14);

    $pdf->SetFont('Times','B',11);
    $pdf->Text($x,$y+22,"OPERATOR:");
    $pdf->Text($x + 45,$y+22,$row['operator_name']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+27,"STATEMENT DATE:");
    $date = date_create($row['pperiod']);
    $pdf->Text($x + 45,$y+27,date_format($date,"F d Y"));

    $pdf->Text($x,$y+32,"PERIOD:");
    $pdf->Text($x + 45,$y+32,date_format($date,"F d Y"));

    $pdf->Text($x,$y+37,"COMPANY:");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 45,$y+37,$row['abbr']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+42,"VEHICLE ACTIVITIES:");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 45,$y+42,$row['plate_number']);
    $pdf->Text($x + 45,$y+47,$row['unit']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+52,"DRIVER:");
    $pdf->Text($x + 45,$y+52,$row['driver_name']);

    $pdf->Text($x,$y+62,"GROSS RATE PER DAY");
    $pdf->Text($x + 45,$y+62,$this->mylib->num_decimal($row['chargeperday']) . " x ". $row['days']);
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 75,$y+62,$this->mylib->num_decimal($row['gross']));

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+67,"EXPENSES:");

    $pdf->Text($x+2,$y+72,"10% MONTHLY TAX");
    $pdf->Text($x + 45,$y+72,$this->mylib->num_decimal($row['10percent']) . " x ". $row['days']);
    $pdf->Text($x + 75,$y+72,$this->mylib->num_decimal($row['tax_10']));

    $pdf->Text($x+2,$y+77,"3% ANNUAL TAX");
    $pdf->Text($x + 45,$y+77,$this->mylib->num_decimal($row['3percent']) . " x ". $row['days']);
    $pdf->Text($x + 75,$y+77,$this->mylib->num_decimal($row['tax_3']));

    $pdf->Text($x+2,$y+82,"ADMIN FEE");
    $pdf->Text($x + 45,$y+82,"83.00 x ". $row['days']);
    $pdf->Text($x + 75,$y+82,$this->mylib->num_decimal($row['sop']));

    $pdf->Text($x+2,$y+87,"OTHER FEE(s)");
    $pdf->Text($x + 75,$y+87,$row['otherdeduc']);

    $pdf->Text($x + 70,$y+88,'____________');
    $pdf->Text($x+2,$y+96,"TOTAL EXPENSES");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 75,$y+96,$this->mylib->num_decimal($row['totalexpenses']));

    $pdf->SetFont('Times','',11);
    $pdf->Text($x+2,$y+104,"GROSS RATE PER DAY LESS TOTAL EXPENSES");
    $pdf->Text($x+10,$y+109,$this->mylib->num_decimal($row['gross']));
    $pdf->Text($x+40,$y+109,"LESS");
    $pdf->Text($x+65,$y+109,$this->mylib->num_decimal($row['totalexpenses']));

    $pdf->Line(0, $y+112,$width,$y+112);
    $pdf->SetFont('Times','B',12);
    $pdf->Text($x+5,$y+121,"NET PAY OUT:");
    $pdf->Text($x+50,$y+121,"Php       " . $this->mylib->num_decimal($row['net']));

    $x = 116;

    $pdf->SetFont('Times','B',13);
    $pdf->Text($x + 27,$y,"FG VAN RENTAL");
    $pdf->SetFont('Times','',11);
    $pdf->Text($x + 10,$y+5,"Contact No. 0926 058 1888 / 0927 307 9766");
    $pdf->Text($x + 32,$y+10,"PAY OUT SLIP");
    $pdf->Line(0, $y+14,$width,$y+14);

    $pdf->SetFont('Times','B',11);
    $pdf->Text($x,$y+22,"OPERATOR:");
    $pdf->Text($x + 45,$y+22,$row['operator_name']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+27,"STATEMENT DATE:");
    $date = date_create($row['pperiod']);
    $pdf->Text($x + 45,$y+27,date_format($date,"F d Y"));

    $pdf->Text($x,$y+32,"PERIOD:");
    $pdf->Text($x + 45,$y+32,date_format($date,"F d Y"));

    $pdf->Text($x,$y+37,"COMPANY:");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 45,$y+37,$row['abbr']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+42,"VEHICLE ACTIVITIES:");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 45,$y+42,$row['plate_number']);
    $pdf->Text($x + 45,$y+47,$row['unit']);

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+52,"DRIVER:");
    $pdf->Text($x + 45,$y+52,$row['driver_name']);

    $pdf->Text($x,$y+62,"GROSS RATE PER DAY");
    $pdf->Text($x + 45,$y+62,$this->mylib->num_decimal($row['chargeperday']) . " x ". $row['days']);
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 75,$y+62,$this->mylib->num_decimal($row['gross']));

    $pdf->SetFont('Times','',11);
    $pdf->Text($x,$y+67,"EXPENSES:");

    $pdf->Text($x+2,$y+72,"10% MONTHLY TAX");
    $pdf->Text($x + 45,$y+72,$this->mylib->num_decimal($row['10percent']) . " x ". $row['days']);
    $pdf->Text($x + 75,$y+72,$this->mylib->num_decimal($row['tax_10']));

    $pdf->Text($x+2,$y+77,"3% ANNUAL TAX");
    $pdf->Text($x + 45,$y+77,$this->mylib->num_decimal($row['3percent']) . " x ". $row['days']);
    $pdf->Text($x + 75,$y+77,$this->mylib->num_decimal($row['tax_3']));

    $pdf->Text($x+2,$y+82,"ADMIN FEE");
    $pdf->Text($x + 45,$y+82,"83.00 x ". $row['days']);
    $pdf->Text($x + 75,$y+82,$this->mylib->num_decimal($row['sop']));

    $pdf->Text($x+2,$y+87,"OTHER FEE(s)");
    $pdf->Text($x + 75,$y+87,$row['otherdeduc']);

    $pdf->Text($x + 70,$y+88,'____________');
    $pdf->Text($x+2,$y+96,"TOTAL EXPENSES");
    $pdf->SetFont('Times','B',11);
    $pdf->Text($x + 75,$y+96,$this->mylib->num_decimal($row['totalexpenses']));

    $pdf->SetFont('Times','',11);
    $pdf->Text($x+2,$y+104,"GROSS RATE PER DAY LESS TOTAL EXPENSES");
    $pdf->Text($x+10,$y+109,$this->mylib->num_decimal($row['gross']));
    $pdf->Text($x+40,$y+109,"LESS");
    $pdf->Text($x+65,$y+109,$this->mylib->num_decimal($row['totalexpenses']));

    $pdf->Line(0, $y+112,$width,$y+112);
    $pdf->SetFont('Times','B',12);
    $pdf->Text($x+5,$y+121,"NET PAY OUT:");
    $pdf->Text($x+50,$y+121,"Php       " . $this->mylib->num_decimal($row['net']));


    $x = 7;
    $y = $y + 138;
    $pg = $pg + 1;

    if($pg == 2){
        $pdf->AddPage();
        $x = 7;
        $y = 12;
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