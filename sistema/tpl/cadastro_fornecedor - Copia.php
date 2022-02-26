<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE FORNECEDOR*************************************
	*************************************************************************************/
	
	if(isset($_POST['button1'])){
	
		//$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
		$nome_fornecedor = htmlspecialchars(mysql_real_escape_string($_POST['nome_fornecedor']));
		$cnpj = htmlspecialchars(mysql_real_escape_string($_POST['cnpj']));
		$nome_contato = htmlspecialchars(mysql_real_escape_string($_POST['nome_contato']));
		$telefone1 = htmlspecialchars(mysql_real_escape_string($_POST['telefone1']));
		$telefone2 = htmlspecialchars(mysql_real_escape_string($_POST['telefone2']));
		$endereco = htmlspecialchars(mysql_real_escape_string($_POST['endereco']));
		$bairro = htmlspecialchars(mysql_real_escape_string($_POST['bairro']));
		$cep = htmlspecialchars(mysql_real_escape_string($_POST['cep']));
		$uf = htmlspecialchars(mysql_real_escape_string($_POST['uf']));
		$email = htmlspecialchars(mysql_real_escape_string($_POST['email']));
		$site = htmlspecialchars(mysql_real_escape_string($_POST['site']));
		$obs = htmlspecialchars(mysql_real_escape_string($_POST['observacao']));
	  
	   
		if(empty($nome_fornecedor) && empty($cnpj) && empty($nome_contato) && empty($telefone1) && empty($email) ){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($nome_fornecedor)){ 
			echo "<script>alert ('Informe o nome fornecedor');</script>";
		}else if(empty($cnpj)){
			echo "<script>alert ('Informe a cnpj');</script>";
		}else if(empty($nome_contato)){
			echo "<script>alert ('Informe a nome contato');</script>";
		}else if(empty($telefone1)){
			echo "<script>alert ('Informe a telefone1');</script>";
		}else if(empty ($email)){
			echo "<script>alert ('Informe o email');</script>";
		}else{
	  
			$cadquery = "INSERT INTO fornecedor
					(for_nome_fornecedor,
					for_cnpj,
					for_nome_contato,
					for_telefone1,
					for_telefone2,
					for_endereco,
					for_bairro,
					for_cep,
					for_uf,
					for_email,
					for_site,
					for_observacao) 
				VALUES 
					('$nome_fornecedor',
					'$cnpj',
					'$nome_contato',
					'$telefone1',
					'$telefone2',
					'$endereco',
					'$bairro',
					'$cep',
					'$uf',
					'$email',
					'$site',
					'$obs')";
			$cadastra = mysql_query($cadquery) or die (mysql_error());

			if($cadastra){
				echo "<script>alert ('Fornecedor Cadastrado com sucesso!');
				location.href = 'fornecedor.php';
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
$(document).ready(function(){
	$("input.data").mask("99/99/9999");
        $("input.cpf").mask("999.999.999-99");
		$("input.cnpj").mask("99.999.999-9999-99");
        $("input.cep").mask("99.999-999");
		$("input.tel").mask("(99)9999-9999");
});
</script>
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Fornecedor</div>
      <div class="card-body">
        <form method="post" action="">
        <div class="form-group">
            <label for="exampleInputEmail1">Nome Fornecedor</label>
            <input class="form-control" name="nome" id="nome" type="text"  placeholder="Digite o nome">
        </div>
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">CNPJ</label>
                <input class="form-control" name="cnpj" id="cnpj" type="text" maxlength="18" placeholder="Digite o cnpj">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Nome Contato</label>
                <input class="form-control" name="nome_contato" id="nome_contato" type="text"  placeholder="Digite o contato">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Telefone1</label>
                <input class="form-control" name="telefone" id="tel" type="text"  placeholder="Digite o telefone">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Telefone2</label>
                <input class="form-control" name="telefone2" id="tel" type="text"  placeholder="Digite o telefone2">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Endereço</label>
            <input class="form-control" name="endereco" id="endereco" type="text"  placeholder="Digite o endereco">
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Bairro: </label>
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
					<select name="uf" class="form-control">
						 <option value="AC">Acre</option>
                         <option value="AL">Alagoas</option>
                         <option value="AP">Amapá</option>
                         <option value="AM">Amazonas</option>
                         <option value="BA" selected>Bahia</option>
                         <option value="CE">Ceará</option>
                         <option value="DF">Distrito Federal</option>
                         <option value="GO">Goiás</option>
                         <option value="ES">Espírito Santo</option>
                         <option value="MA">Maranhão</option>
                         <option value="MT">Mato Grosso</option>
                         <option value="MS">Mato Grosso do Sul</option>
                         <option value="MG">Minas Gerais</option>
                         <option value="PA">Pará</option>
                         <option value="PB">Paraiba</option>
                         <option value="PR">Paraná</option>
                         <option value="PE">Pernambuco</option>
                         <option value="PI">Piauí­</option>
                         <option value="RJ">Rio de Janeiro</option>
                         <option value="RN">Rio Grande do Norte</option>
                         <option value="RS">Rio Grande do Sul</option>
                         <option value="RO">Rondônia</option>
                         <option value="RR">Roraima</option>
                         <option value="SP">São Paulo</option>
                         <option value="SC">Santa Catarina</option>
                         <option value="SE">Sergipe</option>
                         <option value="TO">Tocantins</option>
					</select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">E-mail:</label>
                <input class="form-control" name="email" id="email" type="email" >
              </div>
            </div>
          </div>
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Site: </label>
				<input class="form-control" name="site" id="site" type="text" >
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Observação:</label>
                <input class="form-control" name="observacao" id="observacao" type="text" >
              </div>
            </div>
          </div>
          
           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="fornecedor.php">Voltar</a>
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
