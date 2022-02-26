<?php 
include "include/autSis.php";
	/*************************************************************
	******************** Busca de produtos ***********************
	**************************************************************/
	if(!isset($_SESSION['carrinho'])){
		$_SESSION['carrinho'] = array();
	}
	//adiciona produto
	if(isset($_GET['acao'])){
		//adicionar carrinho
		if($_GET['acao'] == 'add'){
			$id = intval($_GET['id']);
			if(isset($_SESSION['carrinho'][$id])){
				$_SESSION['carrinho'][$id] = 1;
			}else{
				@$_SESSION['carrinho'][$id] += 1;
			}
		}
		//REMOVER CARRINHO
		if($_GET['acao'] == 'del'){
			$id = intval($_GET['id']);
			if(isset($_SESSION['carrinho'][$id])){
				unset($_SESSION['carrinho'][$id]);
			}
		}
		
		//ALTERAR QUANTIDADE
		if($_GET['acao'] == 'up'){
			if(is_array(@$_POST['prod'])){
				foreach($_POST['prod'] as $id => $qtd){
					$id = intval($id);
					$qtd = intval($qtd);
					if(!empty($qtd) || $qtd <> 0){
						$_SESSION['carrinho'][$id] = $qtd;
					}else{
						unset($_SESSION['carrinho'][$id]);
					}
				}
			}
		}
		
		
		
	}
	
?>

<?php include "header.php";?>
  <!-- Navigation-->
 
       
<?php include "menu.php"; ?>

    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admin.php">Início</a>
        </li>
        <li class="breadcrumb-item active">Pedidos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <a href="pedido.php">Continuar Comprando</a>&nbsp; </div>
        <div class="card-body">
          
       
			
                <div class="form-group">
         	
            <table class="table table-bordered" width="100%" cellspacing="0">
    
            
            <form method="POST" action="?acao=up">
			
             <input type="submit" value="ATUALIZAR CARRINHO" name="consultar"/>
			 
              <thead>
                <tr>
                  
                  <th>Produto</th>
                  <th>Quantidade</th>
                  <th>Preço Venda</th>
                  <th>Sub Total</th>
                  <th>Ação</th>
              </thead>
            
              <tbody>
			  <?php 
			  	if(count($_SESSION['carrinho']) == 0){
					echo '<tr><td>Não há produtos no carrinho</td></tr>';
				}else{
					foreach($_SESSION['carrinho'] as $id => $qtd){
						$sql 	 = "SELECT * FROM produto WHERE pro_id = $id";
						$query	 = mysql_query($sql) or die (mysql_error());
						$linha	 = mysql_fetch_assoc($query);
						
						$nome 	 = $linha['pro_descricao'];
						$preco_venda = number_format($linha['pro_preco_venda'], 2, ',', '.');
						$sub	 = number_format($linha['pro_preco_venda'] * $qtd, 2, ',', '.'); 
						@$total += $sub;
				
              echo
                '<tr>
                  <td>'.$nome.'</td>
                  <td><input type="text" size="3" name= "prod['.$id.']" value="'.$qtd.'" /></td>
                  <td>'.$preco_venda.'</td>
                  <td>'.$sub.'</td>
                  <td><a href=?acao=del&id='.$id.'><img src="img/icons/user_delete.png" width="20px"></a></td>
                </tr>';
                	
					}
				$total = number_format($total, 2, ',', '.');	
			   echo 
				'<tr>
				  <td colspan="4" align="right"><strong>TOTAL</strong></td>
				  <td><strong>R$ '.$total.'</strong></td>
				 </tr>';
				}
				?>
              </tbody>
			  
              </form>
            </table>
            <?php
			if(isset($_POST['enviar'])){
			if(empty($total) && empty($IdVenda) && empty($ProdInsert)){//verifica se o usuario preencheu todos os campos
			echo  "<script>alert ('O carrinho está vazio, adicione algum produto!');
			location.href = 'pedido.php';
			</script>";
		
			}else{
			$vendedor = $infoUser['ve_nome'];
			$cliente = @$_POST['cliente'];
			$status = 'Pendente';
			$SqlInserirVenda = mysql_query("INSERT INTO venda (v_valor, v_id_cliente, v_id_vendedor, v_status) VALUES ('$total','$cliente','$vendedor', '$status')");
			
			$IdVenda = mysql_insert_id();
			
			foreach($_SESSION['carrinho'] as $ProdInsert => $qtd):
				$SqlInserirItens = mysql_query ("INSERT INTO venda_item (vi_id_venda, vi_id_produto,vi_quantidade) VALUES ('$IdVenda','$ProdInsert','$qtd')");
			endforeach;
			
			if($SqlInserirItens){
		echo "<script>alert ('Venda Concluida com sucesso!');
			location.href = 'pedido_feito.php';
			</script>";
	  }else{
		echo "<script>alert ('Erro ao concluir a venda!');</script>";
	  }
		}
		}
	?>        
    <form method="post" enctype="multipart/form-data" action="">
	<div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Cliente</label>
               <select name="cliente">
					<option value=""><-----SELECIONE O CLIENTE-------></option>
                          <?php 
							$query = mysql_query("SELECT * FROM cliente");
							while($reg=mysql_fetch_array($query)){
							echo '<option value="'.$reg["cli_id"].'">'.$reg["cli_id"]." - ".$reg["cli_nome"] .'</option>';}	 
						  ?>
					</optgroup>
                </select>
              </div>
            </div>
          </div>
            
    	<input type="submit" name="enviar" value="Finalizar Pedido"/>
            
    </form>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM &nbsp; 
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
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
