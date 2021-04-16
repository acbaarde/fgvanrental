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

$from = intval(substr($pperiod['cfrom'],8,2));
$to = intval(substr($pperiod['cto'],8,2));

$x = 6;
$y = 7;
$pg = 0;

foreach($result as $row){
    $pdf->SetY($y);
    $pdf->SetX($x);
    
    $pdf->SetFont('Times','',11);
    $pdf->SetTextColor(0,0,0);
    
    //HEADER
    $pdf->Cell(30,6," NAME:",'LRTB',0,'L',false);
    $pdf->SetFont('Times','B',11);
    $pdf->Cell(66,6,' '.$row['driver_name'],'RTB',0,'L',false);
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->SetFont('Times','',11);
    $date = date_create($row['pperiod']);
    $pdf->Cell(30,6," PERIOD:",'LR',0,'L',false);
    $pdf->Cell(66,6,' '.date_format($date,"F d Y"),'R',0,'L',false);
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->Cell(30,6," PLATE #.:",'LRT',0,'L',false);
    $pdf->Cell(66,6,' '.$row['plate_number'],'RT',0,'L',false);
    
    //SUB HEADER
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->Cell(15,6,"Date",'LRTB',0,'C',false);
    $pdf->Cell(15,6,"Trips",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Rate",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Bonus",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Salary",'RTB',0,'C',false);
    
    //BODY
    $a = 1;
    for($i = $from; $i <= $to; $i++){

        $day = 'day_'.$a;
        $a++;

        $pdf->Ln();
        $pdf->SetX($x);
        $pdf->Cell(15,6,$i,'LRB',0,'C',false);
        $pdf->Cell(15,6,$row[$day],'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal($row['rate']),'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal($row['bonus']),'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal(intval($row['rate']) * intval($row[$day])),'RB',0,'C',false);
    }
    
    //FOOTER
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->SetFont('Times','B',12);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(30,6,$row['total_trip'] . ' ','LRB',0,'R',false);
    $pdf->Cell(66,6,$this->mylib->num_decimal($row['salary']). ' ','RB',0,'R',false);

    $x = 114;

    $pdf->SetY($y);
    $pdf->SetX($x);
    
    $pdf->SetFont('Times','',11);
    $pdf->SetTextColor(0,0,0);
    
    //HEADER
    $pdf->Cell(30,6," NAME:",'LRTB',0,'L',false);
    $pdf->SetFont('Times','B',11);
    $pdf->Cell(66,6,' '.$row['driver_name'],'RTB',0,'L',false);
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->SetFont('Times','',11);
    $date = date_create($row['pperiod']);
    $pdf->Cell(30,6," PERIOD:",'LR',0,'L',false);
    $pdf->Cell(66,6,' '.date_format($date,"F d Y"),'R',0,'L',false);
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->Cell(30,6," PLATE #.:",'LRT',0,'L',false);
    $pdf->Cell(66,6,' '.$row['plate_number'],'RT',0,'L',false);
    
    //SUB HEADER
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->Cell(15,6,"Date",'LRTB',0,'C',false);
    $pdf->Cell(15,6,"Trips",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Rate",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Bonus",'RTB',0,'C',false);
    $pdf->Cell(22,6,"Salary",'RTB',0,'C',false);
    
    //BODY
    $a = 1;
    for($i = $from; $i <= $to; $i++){

        $day = 'day_'.$a;
        $a++;

        $pdf->Ln();
        $pdf->SetX($x);
        $pdf->Cell(15,6,$i,'LRB',0,'C',false);
        $pdf->Cell(15,6,$row[$day],'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal($row['rate']),'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal($row['bonus']),'RB',0,'C',false);
        $pdf->Cell(22,6,$this->mylib->num_decimal(intval($row['rate']) * intval($row[$day])),'RB',0,'C',false);
    }
    
    //FOOTER
    $pdf->Ln();
    $pdf->SetX($x);
    $pdf->SetFont('Times','B',12);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(30,6,$row['total_trip'] . ' ','LRB',0,'R',false);
    $pdf->Cell(66,6,$this->mylib->num_decimal($row['salary']). ' ','RB',0,'R',false);

    $y = $y + 140;
    $x = 6;
    $pg = $pg + 1;

    if($pg == 2){
        $pdf->AddPage();
        $x = 6;
        $y = 10;
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