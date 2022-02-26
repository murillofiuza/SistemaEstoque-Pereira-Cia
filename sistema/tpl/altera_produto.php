<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE PRODUTOS***********************************
	*************************************************************************************/
	if(isset($_POST['button1'])){
		$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo']));
		$descricao = htmlspecialchars(mysql_real_escape_string($_POST['descricao']));
		$categoria = htmlspecialchars(mysql_real_escape_string($_POST['categoria']));
		$fornecedor = htmlspecialchars(mysql_real_escape_string($_POST['fornecedor']));
		$marca = htmlspecialchars(mysql_real_escape_string($_POST['marca']));
		$preco_custo = htmlspecialchars(mysql_real_escape_string($_POST['preco_custo']));
		$preco_venda = htmlspecialchars(mysql_real_escape_string($_POST['preco_venda']));
		$porc_lucro = htmlspecialchars(mysql_real_escape_string($_POST['porc_lucro']));
		$unidade = htmlspecialchars(mysql_real_escape_string($_POST['unidade']));
		$status = htmlspecialchars(mysql_real_escape_string($_POST['status']));
		$imagem = @$_FILES['imagem']['name'];
		$estoque_minimo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_minimo']));
		$estoque_maximo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_maximo']));
	  

			// Pega extensão da imagem
				@preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem['name'], $ext);
 
        	// Gera um nome único para a imagem
        		$nome_imagem =  $imagem;
 
        	// Caminho de onde ficará a imagem
        		$caminho_imagem = "img/produtos/".$nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
				@move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem);
	
		if(empty($codigo) && empty($descricao) && empty($categoria) && empty($marca) && empty($preco_custo) && empty($preco_venda) && empty($porc_lucro)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($codigo)){ 
			echo "<script>alert ('Informe o codigo');</script>";
		}else if(empty($descricao)){
			echo "<script>alert ('Informe a descrição');</script>";
		}else if(empty($categoria)){
			echo "<script>alert ('Informe a categoria');</script>";
		}else if(empty ($marca)){
			echo "<script>alert ('Informe a marca');</script>";
		}else if(empty ($preco_custo)){
			echo "<script>alert ('Informe o preco de custo');</script>";
		}else if(empty ($preco_venda)){
			echo "<script>alert ('Informe o preco de venda');</script>";
		}else{
	  
		$id = @$_GET['id'];
	  //Consulta de alteração de registro
		$altquery = "UPDATE produto 
						SET  pro_id='$codigo',
						pro_descricao='$descricao', 
						pro_categoria='$categoria', 
						pro_id_fornecedor='$fornecedor', 
						pro_marca='$marca', 
						pro_preco_custo='$preco_custo', 
						pro_preco_venda='$preco_venda',
						pro_porc_lucro='$porc_lucro', 
						pro_unidade='$unidade',
						pro_status='$status',
						pro_imagem='$nome_imagem',
						pro_estoque_minimo='$estoque_minimo',
						pro_estoque_maximo='$estoque_maximo' 
						WHERE pro_id=$id";
		$alterar = mysql_query($altquery) or die (mysql_error());
		
		//$ultimo_id = mysql_insert_id($codigo);
		
		//$_UP['pasta'] = 'img/produtos/'.$ultimo_id.'/';
		//mkdir($_UP['pasta'], 0777);
		//if(@move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'].$imagem)){
			//echo "imagem com sucesso";
		//}
		  //Mensagem de confirmação de alteração do registro.
			if($alterar){
				echo "<script>alert ('Produto Alterado com sucesso!');
					location.href = 'produto.php';
					</script>";
			}else{
				echo "<script>alert ('Erro ao Cadastrar!');</script>";
			}			
		}
		
	}
		$id = @$_GET['id'];
					$sql_code = "SELECT * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id
														 WHERE p.pro_id=$id";
					$query2 = mysql_query($sql_code);
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
   
	<?php 
		while (@$resultado = mysql_fetch_array($query2)) {
			$codigoProduto = $resultado['pro_id'];
			$nomeProduto = $resultado['pro_descricao'];
			$status2 = $resultado['pro_status'];
			$precoVenda = $resultado['pro_preco_venda'];
			$precoCusto = $resultado['pro_preco_custo'];
			$porcLucro = $resultado['pro_porc_lucro'];
			$categoriaProduto = $resultado['pro_categoria'];
			$marca = $resultado['pro_marca'];
			$fornecedor = $resultado['for_nome'];
			$imagem1 = $resultado['pro_imagem'];
			$quantidade_min = $resultado['pro_estoque_minimo'];
			$quantidade_max = $resultado['pro_estoque_maximo'];
			$unidade1 = $resultado['pro_unidade'];
			?>
                    
      <div class="card-header">Alterar Produto</div>
      <div class="card-body">
        <form method="post" enctype="multipart/form-data">
           <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Codigo</label>
                <input class="form-control" name="codigo" id="codigo" type="text" value="<?php echo $codigoProduto?>" aria-describedby="nameHelp" placeholder="Codigo do produto">
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Nome do Produto</label>
            <font color="#FF0000">*</font>
            <input class="form-control" name="descricao" id="exampleInputEmail1" type="text" value="<?php echo $nomeProduto?>"  placeholder="Digite o nome do produto">
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Categoria</label>
                <font color="#FF0000">*</font>
                <select name="categoria" class="form-control">
                
                <?php 
				$query = mysql_query("SELECT * FROM categoria");
				for($i = 0; $i < mysql_num_rows($query); $i++){
					//while($reg=mysql_fetch_array($query)){
						$reg = mysql_fetch_array($query);
					//$marca1 = $reg['ma_id_marca'];
					
					if($categoriaProduto == $reg[1]){
					echo '<option value="'.$reg['cat_descricao'].'" selected>'.$reg["cat_descricao"].'</option>';
					
					}else{
					echo '<option value="'.$reg['cat_descricao'].'">'.$reg["cat_descricao"].'</option>';
					}
				}
				?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Fornecedor</label>
                <font color="#FF0000">*</font>
                <select name="fornecedor" class="form-control">
                
                <?php 
				$query = mysql_query("SELECT * FROM fornecedor");
				for($i = 0; $i < mysql_num_rows($query); $i++){
					//while($reg=mysql_fetch_array($query)){
						$reg = mysql_fetch_array($query);
					//$marca1 = $reg['ma_id_marca'];
					
					if($fornecedor == $reg[1]){
					echo '<option value="'.$reg['for_id'].'" selected>'.$reg["for_nome"].'</option>';
					
					}else{
					echo '<option value="'.$reg['for_id'].'">'.$reg["for_nome"].'</option>';
					}
				}
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
                
                <?php 
				$query = mysql_query("SELECT * FROM marca");
				for($i = 0; $i < mysql_num_rows($query); $i++){
					//while($reg=mysql_fetch_array($query)){
						$reg = mysql_fetch_array($query);
					//$marca1 = $reg['ma_id_marca'];
					
					if($marca == $reg[1]){
					echo '<option value="'.$reg['ma_descricao'].'" selected>'.$reg["ma_descricao"].'</option>';
					
					}else{
					echo '<option value="'.$reg['ma_descricao'].'">'.$reg["ma_descricao"].'</option>';
					}
				}
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
                R$<input class="form-control" name="preco_custo" id="preco_custo" type="text" value="<?php echo $precoCusto?>" placeholder="R$0.00" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Preço Venda</label>
                <font color="#FF0000">*</font>
                R$<input class="form-control" name="preco_venda" id="preco_venda" readonly type="text" value="<?php echo $precoVenda?>" placeholder="R$0.00" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Porcentagem de Lucro %</label>
                <input class="form-control" name="porc_lucro" id="porc_lucro" onBlur="soma()" type="text" value="<?php echo $porcLucro?>" placeholder="0%">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Unidade</label>
                <font color="#FF0000">*</font>
                <select name="unidade" class="form-control">
                
                <?php 
				$query = mysql_query("SELECT * FROM unidade");
				for($i = 0; $i < mysql_num_rows($query); $i++){
					//while($reg=mysql_fetch_array($query)){
						$reg = mysql_fetch_array($query);
					//$marca1 = $reg['ma_id_marca'];
					
					if($unidade1 == $reg[1]){
					echo '<option value="'.$reg['unid_descricao'].'" selected>'.$reg["unid_descricao"].'</option>';
					
					}else{
					echo '<option value="'.$reg['unid_descricao'].'">'.$reg["unid_descricao"].'</option>';
					}
				}
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
                <!--input type="checkbox"  name="up_imagem" id="up_imagem" value="Sim" onclick="document.getElementById('imagem').disabled = !this.checked;"-->
                <input class="form-control" type="file"  name="imagem" id="imagem" >
                 <!--input class="form-control" type="text"  name="imagem" id="imagem"  value="<?php //echo $imagem1 ?>"-->
                
              <br>
               <img src='img/produtos/<?php echo $imagem1 ?>' height='100' width='100' />
			   <br>
			   <?php //echo "<a href= upload_produto.php?id=$codigoProduto>Alterar</a>";  ?>
            </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Minimo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_minimo" id="estoque_minimo" type="text" value="<?php echo $quantidade_min ?>" placeholder="0">
            </div>
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Maximo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_maximo" id="estoque_maximo" type="text" value="<?php echo $quantidade_max ?>" placeholder="0">
            </div> 
            </div>
            <?php }?>
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
