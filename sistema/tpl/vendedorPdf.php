
<?php

//INCLUINDO ARQUIVO PARA GERAR O PDF
include "Fpdf/fpdf_paisagem.php";
include_once "include/autSis.php";

	

$busca = @mysql_query("SELECT * FROM vendedor");

$busca2 = @mysql_query("SELECT * FROM venda");
	
$pdf = new FPDF();
$pdf->Open();
$pagina = 1;

$pdf->AddPage();


    $pdf->Cell (55,15,"","C");
    $pdf->image ("img/x.gif",14,10,60);
    $pdf->SetFont ("Times", "B",14);
    $pdf->Cell (110,7,"Relatorio de vendedores",0,0,"C");
    $pdf->SetXY(65,10);
   
    $pdf->SetY(25);
    $pdf->SetFont ("Times", "B",12);

//$this->Image('img/logo.png',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(25, 5, 'CPF.',1,0);
$pdf->SetX(35);
$pdf->Cell(105, 5, 'Nome',1,0);
$pdf->SetX(140);
$pdf->Cell(40, 5, 'Telefone',1,0);
$pdf->SetX(180);
$pdf->Cell(70, 5, 'E-mail',1,0);
$pdf->SetX(250);
$pdf->Cell(20, 5, 'Vendas',1,0);
while ($resultado = mysql_fetch_array($busca)) {
$pdf->SetFont('Arial', 'B', 9);
    $pdf->ln();
    $pdf->Cell(25, 5, $resultado['ve_cpf'],1,0);
    $pdf->SetX(35);
    $pdf->Cell(105, 5, $resultado['ve_nome'],1,0);
    $pdf->SetX(140);
    $pdf->Cell(40, 5, $resultado['ve_telefone'],1,0);
    $pdf->SetX(180);
    $pdf->Cell(70, 5, $resultado['ve_email'],1,0);
	$pdf->SetX(250);
	$pdf->Cell(20, 5, 'quant.venda' ,1,0);
	
}

	$pdf->SetFont ("Times", "",9);
$pdf->Text (185, 285 ,"PAGINA: ".$pagina);


ob_start ();
$pdf->Output();

?>