<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE VENDEDORES*************************************
	*************************************************************************************/
	
	if(isset($_POST['button1'])){
		$cpf = htmlspecialchars(mysql_real_escape_string($_POST['cpf']));
		$nome = htmlspecialchars(mysql_real_escape_string($_POST['nome']));
		$telefone = htmlspecialchars(mysql_real_escape_string($_POST['telefone']));
		$email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
		$login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
		$senha = htmlspecialchars(mysql_real_escape_string($_POST['senha']));
		$nivel = htmlspecialchars(mysql_real_escape_string($_POST['nivel']));
	  
	   
		if (empty($nome) && empty($telefone) && empty($email) && empty($login) && empty($senha)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($nome)){
			echo "<script>alert ('Informe a nome');</script>";
		}else if(empty($telefone)){
			echo "<script>alert ('Informe a telefone');</script>";
		}else if(empty($email)){
			echo "<script>alert ('Informe a email');</script>";
		}else if(empty ($login)){
			echo "<script>alert ('Informe o login');</script>";
		}else{
		$cadquery = "INSERT INTO vendedor 
	  			(ve_cpf,
				ve_nome,
				ve_telefone, 
				ve_email,
				ve_login,
				ve_senha,
				ve_nivel) 
				VALUES 
				('$cpf', 
				'$nome', 
				'$telefone', 
				'$email',
				'$login',
				'$senha',
				'$nivel')";
	  $cadastra = mysql_query($cadquery) or die (mysql_error());
	  
	  if($cadastra){
		echo "<script>alert ('Vendedor Cadastrado com sucesso!');
			location.href = 'vendedor.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  }
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
  <title>Pereira&Cia - Sistema</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
	<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
</head>

<script type="text/javascript">
var $m = jQuery.noConflict()
        $m(document).ready(function(){
       
        $m("#cpf").mask("999.999.999-99");
        $m("#tel").mask("(99) 9999-9999");
    });
</script>
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar vendedor</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">CPF:</label>
                <input class="form-control" name="cpf" id="cpf" type="text" placeholder="000.000.000-00" maxlength="14"/>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nome Completo</label>
            <input class="form-control" name="nome" id="nome" type="text"  placeholder="Digite o nome">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="tel">Telefone</label>
                <input class="form-control" name="telefone" id="tel"  type="text"  placeholder="Digite o telefone">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Email</label>
                <input class="form-control" name="email" id="email" type="email"  placeholder="Digite o email">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Login: </label>
                <input class="form-control" name="login" id="login" type="text" placeholder="Seu login">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Senha:</label>
                <input class="form-control" name="senha" id="senha" type="password" >
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Nivel de Acesso:</label>
               <select name="nivel" class="form-control">
                <option value="10">Administrador</option>
                <option value="5">Vendedor</option>
                </select>
              </div>
            </div>
          </div>
          
           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="vendedor.php">Voltar</a>
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
