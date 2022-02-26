<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE PRODUTOS*************************************
	*************************************************************************************/
	
	 if(isset($_POST['button1'])){
	
	  //$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
	  //$nome_fornecedor = htmlspecialchars(mysql_real_escape_string($_POST['nome_fornecedor']));
	  $nome_marca = htmlspecialchars(mysql_real_escape_string(@$_POST['nome_marca']));
	  
	  
	   
	  if(empty($nome_marca)){//verifica se o usuario preencheu todos os campos
	  	echo  "<script>alert ('Preencha o campo marca');</script>";
	  }else{
	  
	  $cadquery = "INSERT INTO marca (ma_descricao) VALUES ('$nome_marca')";
	  $cadastra = mysql_query($cadquery) or die (mysql_error());
	  
	  
	  if($cadastra){
		echo "<script>alert ('Marca Cadastrado com sucesso!');
			location.href = 'marca.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  }
	  $id = $_GET['id'];
	}
}

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
      <div class="card-header">Registrar Marca</div>
      <div class="card-body">
        <form method="post" action="">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Nome da marca</label>
                <input class="form-control" name="nome_marca" id="nome_marca" type="text" aria-describedby="nameHelp" placeholder="Codigo do marca">
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
          
          <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="marca.php">Voltar</a>
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
