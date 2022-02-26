<?php
include "include/autSis.php";
	/************************************************************************************
	****************************ALTERAÇÃO DE CLIENTE*************************************
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
	  
	  if(empty($nome)){//verifica se o usuario preencheu todos os campos
		echo  "<script>alert ('Preencha todos os campos');</script>"; 
	  }else if(empty($nome)){
		echo "<script>alert ('Informe a nome');</script>";
	  }else{
	  $id = @$_GET['id'];
	  $cadquery = "UPDATE cliente SET 							
	  					cli_cnpj='$cnpj',
						cli_insc_estadual='$insc_estadual',
						cli_nome='$nome',
						cli_contato='$contato',
						cli_telefone1='$telefone1',
						cli_telefone2='$telefone2', 
						cli_email='$email',
						cli_endereco='$endereco', 
						cli_cidade='$cidade', 
						cli_bairro='$bairro', 
						cli_cep='$cep', 
						cli_uf='$uf' 
						WHERE 
						cli_id=$id";
	  $cadastra = mysql_query($cadquery) or die (mysql_error());
	  
	  if($cadastra){
		echo "<script>alert ('Cliente Alterado com sucesso!');
			location.href = 'cliente.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  }
	}
  }

$id = @$_GET['id'];
$sql_code = "SELECT * FROM cliente WHERE cli_id=$id";
$query2 = mysql_query($sql_code);

  ?>

<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
      <div class="card-header">Alterar registro de Cliente</div>
      <?php 
	  	while (@$resultado = mysql_fetch_assoc($query2)) {
		$id = $resultado['cli_id'];
		$cnpj = $resultado['cli_cnpj']; 
		$insc_estadual = $resultado['cli_insc_estadual'];
		$nome = $resultado['cli_nome'];
		$contato = $resultado['cli_contato'];
		$tel1 = $resultado['cli_telefone1'];
		$tel2 = $resultado['cli_telefone2'];
		$email = $resultado['cli_email'];
		$endereco = $resultado['cli_endereco'];
		$bairro = $resultado['cli_bairro'];
		$cep = $resultado['cli_cep'];
		$cidade = $resultado['cli_cidade'];
		
		?>
      <div class="card-body">
        <form method="post" action="">
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">CNPJ</label>
                <input class="form-control" name="cnpj" id="cnpj" type="text" maxlength="18" value="<?php echo $cnpj ?>" placeholder="Digite o cnpj">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Insc. Estadual</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="insc_estadual" id="ie" type="text" value="<?php echo $insc_estadual ?>"   placeholder="Digite escrição estadual">
              </div>
            </div>
           </div>
           
           <div class="form-group">
            <label for="exampleInputEmail1">Nome Cliente</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="nome" id="nome" type="text" value="<?php echo $nome ?>"  placeholder="Digite o nome">
        </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Contato</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="contato" id="contato" type="text" value="<?php echo $contato ?>"  placeholder="Digite o contato">
        </div>
        
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Telefone1</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="telefone" id="tel" type="text" value="<?php echo $tel1 ?>" placeholder="Digite o telefone">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Telefone2</label>
              <font color="#FF0000">*</font>
              <input class="form-control" name="telefone2" id="tel2" type="text" value="<?php echo $tel2 ?>" placeholder="Digite o telefone2">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="email" id="email" type="text" value="<?php echo $email ?>" placeholder="Digite o email">
        </div>
        
          <div class="form-group">
            <label for="exampleInputEmail1">Endereço</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="endereco" id="endereco" type="text" value="<?php echo $endereco ?>"  placeholder="Digite o endereco">
          </div>
        
        <div class="form-group">
            <label for="exampleInputEmail1">Cidade</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="cidade" id="cidade" type="text" value="<?php echo $cidade ?>"  placeholder="Digite o endereco">
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
                <input class="form-control" name="cep" id="cep" value="<?php echo $cep ?>" type="text" >
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
            <?php }?>
          </div>

           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Alterar" /> 
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
