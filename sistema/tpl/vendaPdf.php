
<?php
//REFERENCIAR O ARQUIVO COM A CLASSE DE GERAÇÃO DE PDF
include "pdf/mpdf.php";
include "include/autSis.php";

	$conn = @mysql_connect(HOST,USER,PASS) or die('Erro ao conectar' .mysql_error());
	$dbsa = @mysql_select_db(DBSA) or die('Erro ao selecionar banco de dados' .mysql_error());
	
	//$id = $_GET['id'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	
	if($categoria){
		$sql = "SELECT DISTINCT * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id_fornecedor
									    INNER JOIN marca m ON p.pro_id_marca=m.ma_id_marca
									    INNER JOIN categoria c  ON p.pro_id_categoria=c.cat_id_categoria
									    WHERE p.pro_id_categoria=$categoria";	
										$query = mysql_query($sql);
	}else if($marca){
		$sql = "SELECT DISTINCT * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id_fornecedor
									    INNER JOIN marca m ON p.pro_id_marca=m.ma_id_marca
									    INNER JOIN categoria c  ON p.pro_id_categoria=c.cat_id_categoria
									    WHERE p.pro_id_marca=$marca";	
										$query = mysql_query($sql);								
	}else if($categoria && $marca){
		$sql = "SELECT DISTINCT * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id_fornecedor
									    INNER JOIN marca m ON p.pro_id_marca=m.ma_id_marca
									    INNER JOIN categoria c  ON p.pro_id_categoria=c.cat_id_categoria
									    WHERE p.pro_id_categoria=$categoria AND p.pro_id_marca=$marca";	
										$query = mysql_query($sql);	
	}else{
		$sql = "SELECT * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id_fornecedor
									    INNER JOIN marca m ON p.pro_id_marca=m.ma_id_marca
									    INNER JOIN categoria c  ON p.pro_id_categoria=c.cat_id_categoria
									    ";
										$query = mysql_query($sql);
	}
		// Executa a consulta
		
		//$query2 = mysql_query($sql);
		//$res = mysql_fetch_array($query2);
		//$marca1 = $res['ma_descricao'];
		//$categoria1 = $res['cat_descricao'];
		
	$tabela = "<center><img src='img/logo.png' width='200' height='70'/></center>
				<h2>RELATÓRIO DE PRODUTOS: </h2>";

//crie uma variável para receber o código da tabela
    $tabela .= '<table border="1" bordercolor="#0066FF">';//abre table
    $tabela .='<thead>';//abre cabeçalho
    $tabela .= '<tr bgcolor="#CCCCCC" >';//abre uma linha
    $tabela .= '<th>ID</th>'; // colunas do cabeçalho
    $tabela .= '<th>Descrição</th>';
    $tabela .= '<th>Fornecedor</th>';
    $tabela .= '<th>Marca</th>';
    $tabela .= '<th>Categoria</th>';
    $tabela .= '<th>Preço Venda</th>';
    $tabela .= '<th>Preço Custo</th>';
	$tabela .= '<th>Status</th>';
    $tabela .= '</tr>';//fecha linha
    $tabela .='</thead>'; //fecha cabeçalho
    $tabela .='<tbody>';//abre corpo da tabela
    /*Se você tiver um loop para exibir os dados ele deve ficar aqui*/
	while($resultado = mysql_fetch_array($query)) {
		$codigoProduto = $resultado['pro_id_produto'];
		$nomeProduto = $resultado['pro_descricao'];
		$status = $resultado['pro_status'];
		$precoVenda = $resultado['pro_preco_venda'];
		$precoCusto = $resultado['pro_preco_custo'];
		$categoriaProduto = $resultado['cat_descricao'];
		$marca1 = $resultado['ma_descricao'];
		$fornecedor = $resultado['for_nome_fornecedor'];
		
    $tabela .= '<tr>'; // abre uma linha
    $tabela .= '<td>'.$codigoProduto.'</td>'; // coluna ID
    $tabela .= '<td>'.$nomeProduto.'</td>'; //coluna nomeproduto
    $tabela .= '<td>'.$fornecedor.'</td>'; // coluna fornecedor
    $tabela .= '<td>'.$marca1.'</td>'; //coluna marca
    $tabela .= '<td>'.$categoriaProduto.'</td>';//coluna categoriaProduto
    $tabela .= '<td>'.$precoVenda.'</td>'; // coluna precoVenda
    $tabela .= '<td>'.$precoCusto.'</td>';// coluna precoCusto
	$tabela .= '<td>'.$status.'</td>';// coluna status
    $tabela .= '</tr>'; // fecha linha
	}
    /*loop deve terminar aqui*/
    $tabela .='</tbody>'; //fecha corpo
    $tabela .= '</table>';//fecha tabela

    echo $tabela; // imprime
		
		
		
$arquivo = "ORÇAMENTO-SERVIÇOS-CLIENTE.pdf";

$mpdf = new mPDF();
$mpdf->WriteHTML($tabela);
/*
 * F - salva o arquivo NO SERVIDOR
 * I - abre no navegador E NÃO SALVA
 * D - chama o prompt E SALVA NO CLIENTE
 */

$mpdf->Output($arquivo, 'I');

echo "PDF GERADO COM SUCESSO";


?>
