<?php
include "include/autSis.php";
	/************************************************************************************
	****************************CADASTRO DE PRODUTOS*************************************
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
		$imagem = @$_FILES["imagem"];
		$estoque_minimo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_minimo']));
		$estoque_maximo = htmlspecialchars(mysql_real_escape_string($_POST['estoque_maximo']));
		
	/******************************************************
	************************IMAGEM *********************
	******************************************************/
			// Pega extensão da imagem
			@preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem['name'], $ext);
 
        	// Gera um nome único para a imagem
        	@$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "img/produtos/".$nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			@move_uploaded_file($imagem['tmp_name'], $caminho_imagem);
			  	
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
						(pro_id_produto, 
						pro_descricao, 
						pro_id_categoria,
						pro_id_fornecedor, 
						pro_id_marca, 
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
						'$imagem',
						'$estoque_minimo',
						'$estoque_maximo')";
		$cadastra = mysql_query($cadquery) or die (mysql_error());
	  
		if($cadastra){
			echo "<script>alert ('Produto Cadastrado com sucesso!');
			location.href = 'produto.php';
			</script>";
		}else{
			echo "<script>alert ('Erro ao Cadastrar!');</script>";
	  	}
		
	}
}
include "header.php";
?>
      <?php include "menu.php";?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Cadastro Produto</li>
      </ol>
      <div class="row">
        <div class="col-12">
           <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Registrar Produto</div>
      <div class="card-body">
        <form method="post" action="">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Codigo</label>
                <input class="form-control" name="codigo" id="codigo" placeholder="Ex.: dd/mm/aaaa" data-mask="00/00/0000" maxlength="10" autocomplete="off" type="text" aria-describedby="nameHelp" >
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
					$query = mysql_query("SELECT * FROM categoria where cat_id_categoria");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["cat_id_categoria"].'">'.$reg["cat_descricao"].'</option>';}
				?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Fornecedor</label>
                <font color="#FF0000">*</font>
                <select name="fornecedor" class="form-control">
                <option value=""><------Selecione------></option>
                <?php 
					$query = mysql_query("SELECT * FROM fornecedor where for_id_fornecedor");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["for_id_fornecedor"].'">'.$reg["for_nome_fornecedor"].'</option>';}
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
					$query = mysql_query("SELECT * FROM marca where ma_id_marca");
					while($reg=mysql_fetch_array($query)){
					echo '<option value="'.$reg["ma_id_marca"].'">'.$reg["ma_descricao"].'</option>';}
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
                R$<input class="form-control" name="preco_custo" id="preco_custo" type="text" placeholder="R$0.00">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Preço Venda</label>
                <font color="#FF0000">*</font>
                R$<input class="form-control" name="preco_venda" id="preco_venda" type="text" placeholder="R$0.00">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Porcentagem de Lucro %</label>
                <input class="form-control" name="porc_lucro" id="porc_lucro" type="text" placeholder="0%">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">Unidade</label>
                <font color="#FF0000">*</font>
                <select name="unidade" class="form-control">
                <option value="unid"><font color="#00CC00">Unidade</font></option>
                <option value="galão">Galão</option>
                <option value="litro">Litro</option>
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
                <input class="form-control" type="file"  name="imagem" id="imagem">
            </div> 
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Minimo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_minimo" id="estoque_minimo" type="text" placeholder="0">
            </div>
            <div class="col-md-6">
                <label for="exampleInputName">Estoque Maximo</label>
                <font color="#FF0000">*</font>
                <input class="form-control" name="estoque_maximo" id="estoque_maximo" type="text" placeholder="0">
            </div> 
            </div>
          </div>
          
           <input name="button1" class="btn btn-primary btn-block" id="button1" type="submit" value="Cadastrar" /> 
        </form>
        <div class="text-center">
          
          <a class="d-block small" href="admin.php">Pagina Inicial</a>
        </div>
      </div>
    </div>
  </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
  </div>
</body>

</html>
