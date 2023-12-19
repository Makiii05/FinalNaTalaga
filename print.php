<?PHP
require('fpdf.php');
$conn=new mysqli("localhost", "root", "", "dbfinal");
$pdf = new FPDF('L','mm', 'Letter');
$pdf->SetAutoPageBreak(true, 5);
$pdf->AddPage();

$pdf->SetFont('Arial', '',8);
$result=$conn->query("SELECT * FROM tblledger WHERE fldaccnt='$_GET[txtaccount]'");
while($row=$result->fetch_assoc()){
$pdf->Cell(20,5,$row["flddate"],1,0,'C');
$pdf->Cell(50,5,$row["flddesc"],1,0, 'C');
$pdf->Cell(20,5,$row["flddebit"],1,0, 'R');
$pdf->Cell(20,5, $row["fldcredit"],1,0, 'R');
$pdf->Cell(20,5,$row["fldbalance"],1,1, 'R');
}

$pdf->Output();
?>