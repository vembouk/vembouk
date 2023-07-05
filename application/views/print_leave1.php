<?Php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
 $this->Image('logo.jpeg',0,0);
}
// Page footer
function Footer()
{
 $this->SetY(-20);
 $this->Image('images/pdf-footer.jpg');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetMargins(10,60,10);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'This is line number '.$i,0,1);
$pdf->Output();
?>