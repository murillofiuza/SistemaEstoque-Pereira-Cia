<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE PRODUTOS*************************************
	*************************************************************************************/
	if(isset($_POST['button1'])){
		$codigo		 = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
		$descricao   = htmlspecialchars(mysql_real_escape_string($_POST['descricao']));
		$categoria   = htmlspecialchars(mysql_real_escape_string($_POST['categoria']));
		$fornecedor  = htmlspecialchars(mysql_real_escape_string($_POST['fornecedor']));
		$marca 		 = htmlspecialchars(mysql_real_escape_string($_POST['marca']));
		$preco_custo = htmlspecialchars(mysql_real_escape_string($_POST['preco_custo']));
		$preco_venda = htmlspecialchars(mysql_real_escape_string($_POST['preco_venda']));
		$porc_lucro  = htmlspecialchars(mysql_real_escape_string($_POST['porc_lucro']));
		$unidade 	 = htmlspecialchars(mysql_real_escape_string($_POST['unidade']));
		$status 	 = htmlspecialchars(mysql_real_escape_string($_POST['status']));
		$imagem 	 = @$_FILES['imagem']['name'];
		//$imagem = @$_POST["imagem"];
		$estoque_minimo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_minimo']));
		$estoque_maximo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_maximo']));
		
	
   /********************************************************
	************************ IMAGEM ************************
	********************************************************/

		// Pega extensão da imagem
			@preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem["name"], $ext);

        // Gera um nome único para a imagem
			$nome_imagem = $imagem .".". $ext[1];

        // Caminho de onde ficará a imagem
			$caminho_imagem = "img/produtos/".$nome_imagem;

		// Faz o upload da imagem para seu respectivo caminho
			@move_uploaded_file($imagem["tmp_name"], $caminho_imagem);

   /********************************************************
	************************IMAGEM *************************
	********************************************************/
	
		if(empty($descricao) && empty($categoria) && empty($fornecedor) && empty($marca) && empty($preco_custo) && empty($preco_venda) && empty($porc_lucro)){//verifica se o usuario preencheu todos os campos
	   
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($descricao)){
			echo "<script>alert ('Informe a descrição');</script>";
		}else if(empty($categoria)){
			echo "<script>alert ('Informe a categoria');</script>";
		}else if(empty ($fornecedor)){
			echo "<script>alert ('Informe o fornecedor');</script>";
		}else if(empty ($marca)){
			echo "<script>alert ('Informe a marca');</script>";
		}else if(empty ($preco_custo)){
			echo "<script>alert ('Informe o preco de custo');</script>";
		}else if(empty ($preco_venda)){
			echo "<script>alert ('Informe o preco de venda');</script>";
			
		}else{
	  
		$cadquery = "INSERT INTO produto 
						(pro_id, 
						pro_descricao, 
						pro_categoria,
						pro_id_fornecedor, 
						pro_marca, 
						pro_preco_custo, 
						pro_preco_venda,
						pro_porc_lucro,
						pro_unidade, 
						pro_status,
						pro_imagem,
						pro_estoque_minimo,
						pro_estoque_maximo) 
					VALUES 
						('$codigo', 
						'$descricao', 
						'$categoria',
						'$fornecedor',
						'$marca',
						'$preco_custo',
						'$preco_venda',
						'$porc_lucro', 
						'$unidade',
						'$status',
						'$nome_imagem',
						'$estoque_minimo',
						'$estoque_maximo')";
							
		$cadastra = mysql_query($cadquery) or die (mysql_error());
	  //$ultimo_id = mysql_insert_id();
	  
		
		if($cadastra){
			echo "<script>alert ('Produto Cadastrado com sucesso!');
			location.href = 'produto.php';
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
  <title>Pereira&amp;Cia - Sistema de Estoque</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<script type="text/javascript">
function id(valor_campo)
{
return document.getElementById(valor_campo);
}

function getValor(valor_campo)
{
var  valor = document.getElementById(valor_campo).value.replace(',', '.');
//document.write("Valor:" + valor);
return parseFloat(valor);
}

function soma()
{
var preco = getValor('preco_custo');
var porcentagem = getValor('porc_lucro');

var total = preco * (porcentagem/100);
//var t = (100/total);
id('preco_venda').value = total+preco;
}
</script>

<script type="text/javascript">
function maskIt(w,e,m,r,a){
// Cancela se o evento for Backspace
if (!e) var e = window.event
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;
// Variáveis da função
var txt  = (!r) ? w.value.replace(/[^\d]+/gi,'') : w.value.replace(/[^\d]+/gi,'').reverse();
var mask = (!r) ? m : m.reverse();
var pre  = (a ) ? a.pre : "";
var pos  = (a ) ? a.pos : "";
var ret  = "";
if(code == 9 || code == 8 || txt.length == mask.replace(/[^#]+/g,'').length) return false;
// Loop na máscara para aplicar os caracteres
for(var x=0,y=0, z=mask.length;x<z && y<txt.length;){
if(mask.charAt(x)!='#'){
ret += mask.charAt(x); x++; } 
else {
ret += txt.charAt(y); y++; x++; } }
// Retorno da função
ret = (!r) ? ret : ret.reverse()	
w.value = pre+ret+pos; }
// Novo método para o objeto 'String'
String.prototype.reverse = function(){
return this.split('').reverse().join(''); };
</script>
<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Produto</div>
      <div class="card-body">
     
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Codigo</label>
                <input class="form-control" name="codigo" id="codigo" type="text" aria-describedby="nameHelp" placeholder="Codigo do produto">
                 
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nome do Produto</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="descricao" id="exampleInputEmail1" type="text"  placeholder="Digite o nome do produto">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Categoria</label>
                <font color="#FF0000">*</font>
                <select name="categoria" class="form-control">
                <option value=""><------Selecione------></option>
                <?php 
					$query = mysql_query("SELECT * FROM categoria ORDER BY cat_descricao ASC");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["cat_descricao"].'">'.$reg["cat_descricao"].'</option>';}
				?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Fornecedor</label>
                <font color="#FF0000">*</font>
                <select name="fornecedor" class="form-control">
                <option value=""><------Selecione------></option>
                <?php 
					$query = mysql_query("SELECT * FROM fornecedor ORDER BY for_nome ASC");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["for_id"].'">'.$reg["for_nome"].'</option>';}
				?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Marca</label>
                <font color="#FF0000">*</font>
                <select name="marca" class="form-control">
                <option value=""><------Selecione------></option>
                <?php 
					$query = mysql_query("SELECT * FROM marca ORDER BY ma_descricao ASC");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["ma_descricao"].'">'.$reg["ma_descricao"].'</option>';}
				?>
                </select>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Preço Custo</label>
                <font color="#FF0000">*</font>
                R$<input class="form-control" name="preco_custo" id="preco_custo" type="text" placeholder="R$0.00" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl">
              </div>
             
              <div class="col-md-6">
                <label for="exampleInputName">Preço Venda</label>
                <font color="#FF0000">*</font>
                R$<input class="form-control" name="preco_venda" readonly id="preco_venda" type="text" value="" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Porcentagem de Lucro %</label>
              <input class="form-control" name="porc_lucro" id="porc_lucro" onBlur="soma()" type="text" placeholder="0%">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Unidade</label>
                <font color="#FF0000">*</font>
                <select name="unidade" class="form-control">
                <option value=""><------Selecione------></option>
                <?php 
					$query = mysql_query("SELECT * FROM unidade ORDER BY unid_descricao ASC");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["unid_descricao"].'">'.$reg["unid_descricao"].'</option>';}
				?>
                </select>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Status</label>
                <font color="#FF0000">*</font>
                <select name="status" class="form-control">
                <option value="A"><font color="#00CC00">Ativo</font></option>
                <option value="I">Inativo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="exampleInputName">Imagem Produto</label>
                <input type="file" name="imagem" id="imagem"/>
            </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Minimo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_minimo" id="estoque_minimo" type="text" value="0" placeholder="0">
            </div>
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Maximo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_maximo" id="estoque_maximo" type="text" value="9999" placeholder="0">
            </div> 
            </div>
          </div>
          
           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="produto.php">Voltar</a>
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
