<

<?php

//INCLUINDO ARQUIVO PARA GERAR O PDF
include "Fpdf/fpdf_paisagem.php";
include_once "include/autSis.php";

	
$id = $_GET ['id'];
$busca  =  @mysql_query("SELECT DISTINCT * FROM venda v INNER JOIN cliente c ON v.v_id_cliente=c.cli_id 
										INNER JOIN venda_item vi ON vi.vi_id_venda=v.v_id
										INNER JOIN produto p ON vi.vi_id_produto=p.pro_id
										WHERE v.v_id=$id ORDER BY p.pro_descricao ASC");

$busca2  =  @mysql_query("SELECT DISTINCT * FROM venda v INNER JOIN cliente c ON v.v_id_cliente=c.cli_id 
										INNER JOIN venda_item vi ON vi.vi_id_venda=v.v_id
										INNER JOIN produto p ON vi.vi_id_produto=p.pro_id
										WHERE v.v_id=$id ");
	
$pdf = new FPDF();
$pdf->Open();
$pagina = 1;


$pdf->AddPage();


   // $pdf->Cell (55,15,"",1,0,"C");
    $pdf->image ("img/x.gif",17,15,60);
    $pdf->SetFont ("Times", "B",18);
    $pdf->Cell (75,2,"Pedido realizado",0,0,"C");
while($row2 = mysql_fetch_array($busca2)){
		//$sub	 = number_format($row2['pro_preco_venda'] * $row2['v_quantidade'], 2, ',', '.'); 
		//@$total += $sub;
    $pdf->SetXY(85,10);
	$pdf->SetFont ("Times", "B",12);
    $pdf->Cell (100,18 ,"Numero Pedido:".$row2['v_id']);
	$pdf->SetX(138);
    $pdf->Cell (145,29,"Cliente:".$row2['cli_nome']);
	$pdf->SetX(138);
	$pdf->Cell (200,18,"Vendedor:".$row2['v_id_vendedor']);
	$pdf->SetX(220);
	$pdf->Cell (230,18,"Status do pedido:".$row2['v_status']);
	$pdf->SetX(85);
	$pdf->Cell (100,29,"Data:".$row2['v_data']);
	$pdf->SetX(220);
	$pdf->Cell (170,29,"Valor Total: R$".$row2['v_valor']);
    //$pdf->SetY(25);
}

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
    $pdf->Cell(40, 5, $row['vi_quantidade'],1,0);
    $pdf->SetX(180);
    $pdf->Cell(20, 5,"R$ ".$row['pro_preco_venda']*$row['vi_quantidade'],1,0);


	
	//$pdf->SetFont ("Times", "",9);
	//$pdf->Text (185, 285 ,"PAGINA: ".$pagina);

}
ob_start ();

$pdf->Output();

?>
