<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE CLIENTE*************************************
	*************************************************************************************/
	
	 if(isset($_POST['button1'])){
	
	  $cnpj = htmlspecialchars(mysql_real_escape_string($_POST['cnpj']));
	  $insc_estadual = htmlspecialchars(mysql_real_escape_string($_POST['insc_estadual']));
	  $nome = htmlspecialchars(mysql_real_escape_string($_POST['nome']));
	  $contato = htmlspecialchars(mysql_real_escape_string($_POST['contato']));
	  $telefone1 = htmlspecialchars(mysql_real_escape_string($_POST['telefone']));
	  $telefone2 = htmlspecialchars(mysql_real_escape_string($_POST['telefone2']));
	  $email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
	  $endereco = htmlspecialchars(mysql_real_escape_string($_POST['endereco']));
	  $cidade = htmlspecialchars(mysql_real_escape_string($_POST['cidade']));
	  $bairro = htmlspecialchars(mysql_real_escape_string($_POST['bairro']));
	  $cep = htmlspecialchars(mysql_real_escape_string($_POST['cep']));
	  $uf = htmlspecialchars(mysql_real_escape_string($_POST['uf']));
	  
	   
	  if(empty($nome) && empty($telefone1)){//verifica se o usuario preencheu todos os campos
		echo  "<script>alert ('Preencha todos os campos');</script>"; 
	  }else if(empty($nome)){
	     echo "<script>alert ('Informe a nome');</script>";
	  }else if(empty($telefone1)){
	    echo "<script>alert ('Informe a telefone');</script>";
	  }else{
	  
	  $cadquery = "INSERT INTO cliente 
						(cli_cnpj, 
						cli_insc_estadual, 
						cli_nome,
						cli_contato,
						cli_telefone1,
						cli_telefone2, 
						cli_email,
						cli_endereco, 
						cli_cidade, 
						cli_bairro, 
						cli_cep, 
						cli_uf) 
					VALUES 
						('$cnpj',
						'$insc_estadual',
						'$nome', 
						'$contato',
						'$telefone1', 
						'$telefone2',
						'$email',
						'$endereco',
						'$cidade',
						'$bairro',
						'$cep',
						'$uf')";
					
	  $cadastra = mysql_query($cadquery) or die (mysql_error());

	  if($cadastra){
		echo "<script>alert ('Cliente Cadastrado com sucesso!');
			location.href = 'cliente.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  }
	
	$id = $_GET['id'];
	$busca = mysql_query("SELECT * FROM cliente WHERE cli_id = $id"); 
	$row = mysql_fetch_arrow($busca);
}
}
	
  ?>
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pereira&Cia - Cadastro de fornecedor</title>
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
        $m("#cnpj").mask("99.999.999/9999-99");
        $m("#tel").mask("(99)9999-9999");
		$m("#tel2").mask("(99)9999-9999");
		$m("#cep").mask("99.999-999");
		$m("#ie").mask("999999-99");
    });
</script>
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Cliente</div>
      <div class="card-body">
        <form method="post" action="">
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">CNPJ</label>
                <input class="form-control" name="cnpj" id="cnpj" type="text" maxlength="18" placeholder="Digite o cnpj">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Insc. Estadual</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="insc_estadual" id="ie" type="text" maxlength="9"  placeholder="Digite escrição estadual">
              </div>
            </div>
           </div>
           
           <div class="form-group">
            <label for="exampleInputEmail1">Nome Cliente</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="nome" id="nome" type="text"  placeholder="Digite o nome">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Contato</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="contato" id="contato" type="text"  placeholder="Digite o contato">
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Telefone1</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="telefone" id="tel" type="text" placeholder="Digite o telefone">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Telefone2</label>
              <font color="#FF0000">*</font>
              <input class="form-control" name="telefone2" id="tel2" type="text" placeholder="Digite o telefone2">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="email" id="email" type="text"  placeholder="Digite o email">
        </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Endereço</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="endereco" id="endereco" type="text"  placeholder="Digite o endereco">
          </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Cidade</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="cidade" id="cidade" type="text"  placeholder="Digite o endereco">
          </div>
        
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Bairro: </label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="bairro" id="bairro" type="text" placeholder="Seu login">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">CEP:</label>
                <input class="form-control" name="cep" id="cep" type="text" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">UF: </label>
                <font color="#FF0000">*</font>
					<select name="uf" class="form-control">
                
                <?php 
				$query = mysql_query("SELECT * FROM estados");
				for($i = 0; $i < mysql_num_rows($query); $i++){
					//while($reg=mysql_fetch_array($query)){
						$reg = mysql_fetch_array($query);
					//$marca1 = $reg['ma_id_marca'];
					
					if($marca == $reg[1]){
					echo '<option value="'.$reg['est_sigla'].'" selected>'.$reg["est_descricao"].'</option>';
					
					}else{
					echo '<option value="'.$reg['est_sigla'].'">'.$reg["est_descricao"].'</option>';
					}
				}
				?>
                </select>
              </div>
            </div>
          </div>

           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="cliente.php">Voltar</a>
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
