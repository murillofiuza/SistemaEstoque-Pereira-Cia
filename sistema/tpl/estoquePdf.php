<

<?php

//INCLUINDO ARQUIVO PARA GERAR O PDF
include "Fpdf/fpdf.php";
include_once "include/autSis.php";

	
//$id = $_GET ['id'];
$busca  =  @mysql_query("SELECT DISTINCT * FROM estoque e INNER JOIN produto p ON e.esto_id_produto=p.pro_id");


	
$pdf = new FPDF();
$pdf->Open();
$pagina = 1;


$pdf->AddPage();


   // $pdf->Cell (55,15,"",1,0,"C");
    $pdf->image ("img/x.gif",17,15,60);
    $pdf->SetFont ("Times", "B",18);
    $pdf->Cell (210,40,"Relatorio de produtos no estoque",0,0,"C");
	//$pdf->SetY(35);

//$this->Image('img/logo.png',11,11,40); // INSERE UMA LOGOMARCA NO PONTO X = 11, Y = 11, E DE TAMANHO 40.

	$pdf->SetFont('Arial', 'B', 11);
	$pdf->ln();
	$pdf->Cell(20,10, 'Cod.',1,0);
	$pdf->SetX(30,120);
	$pdf->Cell(110,10, 'Produto',1,0);
	$pdf->SetX(140,120);
	$pdf->Cell(40,10, 'Quantidade',1,0);
	$pdf->SetX(180,120);
	$pdf->Cell(20,10, 'Valor',1,0);

	while($row = @mysql_fetch_assoc($busca)){
	$pdf->SetFont('Arial', 'B', 9);
    $pdf->ln();
    $pdf->Cell(20, 5, $row['pro_id'],1,0);
    $pdf->SetX(30);
    $pdf->Cell(110, 5, $row['pro_descricao'],1,0);
    $pdf->SetX(140);
    $pdf->Cell(40, 5, $row['esto_qtde'],1,0);
    $pdf->SetX(180);
    $pdf->Cell(20, 5, $row['pro_preco_venda'],1,0);

	//$pdf->SetFont ("Times", "",9);
	//$pdf->Text (185, 285 ,"PAGINA: ".$pagina);

}
ob_start ();

$pdf->Output();

?>
