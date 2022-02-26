<?php
include "include/autSis.php";

if(isset($_POST['send'])){
    //$pedido = $_POST['num_venda'];
    //$data = $_POST['data_venda'];
	$vendedor = 
    $placa = $_POST['placa'];
    $km = $_POST['km'];
    $produtos = $_POST['produtos'];
    $servicos = $_POST['servicos'];


    include ('banco.php');


    mysql_query("INSERT INTO venda(id_venda, num_venda, data_venda, placa, km, produtos, servicos)
            values(
                NULL,
                '{$venda}',
                '{$data}',
                '{$placa}',
                '{$km}',
                '{$produtos}',
                '{$servicos}'

                            )
            ");

    mysql_query("INSERT INTO vendaproduto (id_venda, produtos) SELECT venda.id_venda, venda.produtos FROM venda  ORDER BY venda.id_venda DESC LIMIT 1")or die(mysql_error());

    mysql_query("INSERT INTO vendaservico (id_venda, servicos) SELECT venda.id_venda, venda.servicos FROM venda  ORDER BY venda.id_venda DESC LIMIT 1")or die(mysql_error());




}


	/************************************************************************************
	****************************CADASTRO DE PRODUTOS*************************************
	*************************************************************************************/
	if(isset($_POST['button1'])){
		$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo_produto']));
		$qtde = htmlspecialchars(mysql_real_escape_string($_POST['quantidade']));
		$valor_unitario = htmlspecialchars(mysql_real_escape_string($_POST['valor_unitario']));
		$cliente = htmlspecialchars(mysql_real_escape_string($_POST['cliente']));

		if(empty($qtde) && empty($valor_unitario)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		
		}else if(empty($qtde)){
			echo "<script>alert ('Informe a Quantidade');</script>";
		}else if(empty($valor_unitario)){
			echo "<script>alert ('Informe a valor unitario');</script>";
		}else{
	  
		 $cadquery = "INSERT INTO saida_produto (id_produto,qtde, valor_unitario, id_cliente ) VALUES ('$codigo', '$qtde','$valor_unitario', '$cliente')";
	  $cadastra = mysql_query($cadquery) or die (mysql_error());
	  
	  
	  if($cadastra){
		echo "<script>alert ('Saida de Produto Cadastrado com sucesso!');
			location.href = 'estoque.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  }
	  $id = $_GET['id'];

}
}
	$sql_code = "SELECT  * FROM produto p INNER JOIN saida_produto sp ON p.pro_id_produto=sp.id_produto";
$query3 = mysql_query($sql_code);
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pereira&Cia - Sistema de Estoque</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Pedidos</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
              
                <label for="exampleInputName">Vendedor</label>
                <select name="codigo_produto" class="form-control" disabled>
                        <?php
         	echo '<option value="'.strtoupper($infoUser['ve_id']).'">'.strtoupper($infoUser['ve_nome']).'</option>'; 
						  ?>
                          
                          </optgroup>
                        </select>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Cliente</label>
             <select name="cliente" class="form-control">
                <option value=""><------Selecione Cliente------></option>
                <?php 
					$query = mysql_query("SELECT * FROM cliente");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["cli_id_cliente"].'">'.$reg["cli_nome"].'</option>';}
				?>
                </select>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Status do Pedido</label>
               
               <select name="cliente" class="form-control">
               
                <?php 
					$query = mysql_query("SELECT * FROM status");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["st_id_status"].'">'.$reg["st_descricao"].'</option>';}
				?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Itens</label>
               <select name="cliente">
					<option value=""><-----SELECIONE Produtos-------></option>
                          <?php 
							$query = mysql_query("SELECT * FROM produto");
							while($reg=mysql_fetch_array($query)){
							echo '<option value="'.$reg["pro_id_produto"].'">'.$reg["pro_id_produto"]." - ".$reg["pro_descricao"] .'</option>';}	 
						  ?>
					</optgroup>
                </select>
              </div>
            </div>
          </div>
          
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Quantidade</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="quantidade" id="quantidade" type="number"  >
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">valor</label>
                <input class="form-control" name="valor" id="valor" type="text" disabled>
              </div>
            </div>
          </div>
          
           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="estoque.php">Voltar</a>
          <a class="d-block small" href="admin.php">Pagina Inicial</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/popper/popper.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
