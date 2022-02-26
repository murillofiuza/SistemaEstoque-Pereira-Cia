
<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE FORNECEDOR*************************************
	*************************************************************************************/
	
	if(isset($_POST['button1'])){
	
		//$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
		$nome = htmlspecialchars(mysql_real_escape_string($_POST['nome_fornecedor']));
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
	  
	   
		if(empty($nome) && empty($nome_contato) && empty($telefone1)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($nome)){ 
			echo "<script>alert ('Informe o nome fornecedor');</script>";
		}else if(empty($nome_contato)){
			echo "<script>alert ('Informe a nome contato');</script>";
		}else if(empty($telefone1)){
			echo "<script>alert ('Informe a telefone1');</script>";
		}else{
	  		$id = @$_GET['id'];
			$cadquery = "UPDATE fornecedor
					SET for_nome='$nome',
					for_cnpj='$cnpj',
					for_contato='$nome_contato',
					for_telefone1='$telefone1',
					for_telefone2='$telefone2',
					for_endereco='$endereco',
					for_bairro='$bairro',
					for_cep='$cep',
					for_uf='$uf',
					for_email='$email',
					for_site='$site',
					for_observacao='$obs'
					WHERE for_id=$id";
			$cadastra = mysql_query($cadquery) or die (mysql_error());

			if($cadastra){
				echo "<script>alert ('Fornecedor Alterado com sucesso!');
				location.href = 'fornecedor.php';
				</script>";
			}else{
				echo "<script>alert ('Erro ao Cadastrar!');</script>";
			}

		}
	}
	$id = @$_GET['id'];
$sql_code = "SELECT * FROM fornecedor WHERE for_id=$id";
$query2 = mysql_query($sql_code);
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
  
  <script type="text/javascript" language="javascript" src="js/jquery-1.4.2.js"></script>
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
    });
</script>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Fornecedor</div>
      <div class="card-body">
       <?php while (@$resultado = mysql_fetch_assoc($query2)) {
		$codigo = $resultado['for_id'];
		$nome_fornecedor = $resultado['for_nome'];
		$cnpj = $resultado['for_cnpj'];
		$nome_contato = $resultado['for_contato'];
		$telefone1 = $resultado['for_telefone1'];
		$telefone2 = $resultado['for_telefone2'];
		$email = $resultado['for_email'];
		$endereco = $resultado['for_endereco'];
		$obs = $resultado['for_observacao'];
		$uf = $resultado['for_uf'];
		$site = $resultado['for_site'];
		$bairro = $resultado['for_bairro'];
		$cep = $resultado['for_cep'];
		
		?>
        <form method="post" action="">
        <div class="form-group">
            <label for="exampleInputEmail1">Nome Fornecedor</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="nome_fornecedor" id="nome_fornecedor" type="text" value="<?php echo $nome_fornecedor ?>" placeholder="Digite o nome">
        </div>
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">CNPJ</label>
                <input class="form-control" name="cnpj" id="cnpj" type="text" maxlength="18" value="<?php echo $cnpj ?>" placeholder="Digite o cnpj">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Nome Contato</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="nome_contato" id="nome_contato" type="text" value="<?php echo $nome_contato ?>"  placeholder="Digite o contato">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Telefone1</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="telefone1" id="tel" type="text" value="<?php echo $telefone1 ?>"  placeholder="Digite o telefone">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Telefone2</label>
                <input class="form-control" name="telefone2" id="tel2" type="text" value="<?php echo $telefone2 ?>"  placeholder="Digite o telefone2">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Endereço</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo $endereco ?>"  placeholder="Digite o endereco">
        </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Bairro: </label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="bairro" id="bairro" type="text" value="<?php echo $bairro ?>" placeholder="Seu login">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">CEP:</label>
                <input class="form-control" name="cep" id="cep" type="text" value="<?php echo $cep ?>" >
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
					
					if($categoriaProduto == $reg[1]){
					echo '<option value="'.$reg['est_sigla'].'" selected>'.$reg["est_descricao"].'</option>';
					
					}else{
					echo '<option value="'.$reg['est_sigla'].'">'.$reg["est_descricao"].'</option>';
					}
				}
				?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">E-mail:</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="email" id="email" type="email" value="<?php echo $email ?>" >
              </div>
            </div>
          </div>
         <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Site: </label>
				<input class="form-control" name="site" id="site" type="text" value="<?php echo $site ?>">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Observação:</label>
                <input class="form-control" name="observacao" id="observacao" type="text" value="<?php echo $obs ?>" >
              </div>
            </div>
          </div>
          <?php }?>
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
