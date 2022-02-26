<?php
include "include/autSis.php";
	/*************************************************************************************
	****************************ALTERAÇÃO DE PRODUTOS*************************************
	*************************************************************************************/
	if(isset($_POST['button1'])){
		//$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
		$nome_categoria = htmlspecialchars(mysql_real_escape_string($_POST['nome_categoria']));
		if(empty($nome_categoria)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha o campo categoria');</script>";
		}else{
			$id = @$_GET['id'];
			//Consulta de alteração de registro
			$altquery = "UPDATE categoria SET  cat_descricao='$nome_categoria' WHERE cat_id='$id'";
		 	//executa a consulta
			$alterar = mysql_query($altquery) or die (mysql_error());
		  
			//Mensagem de confirmação de alteração do registro.
			if($alterar){
				echo "<script>alert ('Categoria Alterado com sucesso!');
					location.href = 'categoria.php';
					</script>";
			}else{
				echo "<script>alert ('Erro ao alterar!');</script>";
			}
		}
	}

	$id = @$_GET['id'];
	$sql_code = "SELECT * FROM categoria WHERE cat_id=$id";
	$query2 = mysql_query($sql_code);
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pereira&amp;Cia - Sistema de Estoque</title>
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
      <div class="card-header">Registrar Produto</div>
      <div class="card-body">
        <form method="post" action="">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nome a categoria</label>
                <?php 
				while($resultado= mysql_fetch_assoc($query2)){
					$nome_categoria = $resultado['cat_descricao'];
				} ?>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row"></div>
          </div>
          
          <span class="col-md-6">
          <input class="form-control" name="nome_categoria" id="nome_categoria" type="text" aria-describedby="nameHelp" placeholder="Categoria do produto" value="<?php echo $nome_categoria ?>">
          </span>
          <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="categoria.php">Voltar</a>
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
