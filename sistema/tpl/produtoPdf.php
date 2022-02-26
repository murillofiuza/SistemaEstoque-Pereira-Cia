<?php

//INCLUINDO ARQUIVO PARA GERAR O PDF
include "Fpdf/fpdf.php";
include_once "include/autSis.php";

	

$busca = @mysql_query("SELECT * FROM produto");
	
$pdf = new FPDF();
$pdf->Open();
$pagina = 1;

$pdf->AddPage();


    $pdf->Cell (55,15,"",1,0,"C");
    $pdf->image ("img/x.gif",14,10,15);
    $pdf->SetFont ("Times", "B",14);
    $pdf->Cell (110,7,"Relatorio Por Produtos",0,0,"C");
    $pdf->SetXY(65,10);
   
    $pdf->SetY(25);
    $pdf->SetFont ("Times", "B",12);

//$this->Image('img/logo.png',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(20, 5, 'Cod.',1,0);
$pdf->SetX(30);
$pdf->Cell(110, 5, 'Produto',1,0);
$pdf->SetX(140);
$pdf->Cell(40, 5, 'Quantidade',1,0);
$pdf->SetX(180);
$pdf->Cell(20, 5, 'Valor',1,0);
while ($resultado = mysql_fetch_array($busca)) {
$pdf->SetFont('Arial', 'B', 9);
    $pdf->ln();
    $pdf->Cell(20, 5, $resultado['pro_id'],1,0);
    $pdf->SetX(30);
    $pdf->Cell(110, 5, $resultado['pro_descricao'],1,0);
    $pdf->SetX(140);
    $pdf->Cell(40, 5, $resultado['pro_marca'],1,0);
    $pdf->SetX(180);
    $pdf->Cell(20, 5, $resultado['pro_preco_venda'],1,0);
	$pdf->SetFont ("Times", "",9);
$pdf->Text (185, 285 ,"PAGINA: ".$pagina);
}



ob_start ();
$pdf->Output();

?>