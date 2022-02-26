<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE PRODUTOS*************************************
	*************************************************************************************/
	if(isset($_POST['button1'])){
		$codigo = htmlspecialchars(mysql_real_escape_string($_POST['codigo_produto']));
		$qtde = htmlspecialchars(mysql_real_escape_string($_POST['quantidade']));
		$valor_unitario = htmlspecialchars(mysql_real_escape_string($_POST['valor_unitario']));

		if(empty($codigo) && empty($qtde) && empty($valor_unitario)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('Preencha todos os campos');</script>";
		}else if(empty($codigo)){ 
			echo "<script>alert ('Informe o codigo');</script>";
		}else if(empty($qtde)){
			echo "<script>alert ('Informe a Quantidade');</script>";
		}else if(empty($valor_unitario)){
			echo "<script>alert ('Informe a valor unitario');</script>";
		}else{
	  
		$cadquery = "INSERT INTO entrada_produto 
					(ent_id_produto,
					ent_qtde,
					ent_valor_unitario)
					VALUES 
					('$codigo', 
					'$qtde', 
					'$valor_unitario')";
		$cadastra = mysql_query($cadquery) or die (mysql_error());
	  
	  
		if($cadastra){
			echo "<script>alert ('Entrada de Produto Cadastrado com sucesso!');
			location.href = 'estoque.php';
			</script>";
		}else{
			echo "<script>alert ('Erro ao Cadastrar!');</script>";
		}
		$id = $_GET['id'];
		}
	}
	$sql_code = "SELECT  * FROM produto p INNER JOIN entrada_produto ep ON p.pro_id=ep.ent_id_produto";
	$query3 = mysql_query($sql_code);
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

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
      <div class="card-header">Registrar Entrada de produto</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Produto</label>
                <select name="codigo_produto">
                         <option value=""><-----SELECIONE O PRODUTO-------></option>
                          <?php 
						  $query = mysql_query("SELECT * FROM produto where pro_id");
      						while($reg=mysql_fetch_array($query)){
         					 echo '<option value="'.$reg["pro_id"].'">'.$reg["pro_descricao"].'</option>';}	 
						  ?>
                          
                          </optgroup>
                        </select>
              </div>
              
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Quantidade</label>
            <input class="form-control" name="quantidade" id="quantidade" type="text"  placeholder="Digite quantidade">
          </div>
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Preço Unitario</label>
                R$
                <input class="form-control" name="valor_unitario" id="valor_unitario" type="text" placeholder="R$0.00" onKeyUp="maskIt(this,event,'###.###.###,##',true)" dir="rtl">
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
