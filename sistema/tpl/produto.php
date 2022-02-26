<?php 
include "include/autSis.php";
	
	
	//DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
	$delid = $_GET['del'];
		$sqlDel = "DELETE FROM produto WHERE pro_id = {$delid}";
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		if($exeqrDel){
			echo "<script> alert ('Produto removido com sucesso!');
			location.href = 'produto.php';
			</script>";
			echo "";
		}
	}
	@$busca = mysql_real_escape_string($_POST['consulta']);
	//$id = @$_GET['id'];
	$sql_code = "SELECT  * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id 
										  WHERE pro_descricao LIKE '%$busca%' ORDER BY p.pro_id asc";
	$query3 = mysql_query($sql_code);
	
	
?>

<?php include "header.php";?>
  
  <!-- Navigation-->
 
<?php include "menu.php"; ?>

    
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admin.php">Início</a>
        </li>
        <li class="breadcrumb-item active">Cadastro de Produtos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <a href="cadastro_produto.php">Inserir Produto</a></div>
        <div class="card-body">
          
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Imagem</th>
                  <th>Cod.</th>
                  <th>Produto</th>
                  <th>Marca</th>
                  <th>Preço</th>
				  <th>Ação</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Imagem</th>
                  <th>Cod.</th>
                  <th>Produto</th>
                  <th>Marca</th>
                  <th>Preço</th>
				  <th>Ação</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
             
			
			  while (@$resultado = mysql_fetch_assoc($query3)) {
                $codigoProduto = $resultado['pro_id'];
                $nomeProduto = $resultado['pro_descricao'];
                //$status = $resultado['pro_status'];
                $precoVenda = $resultado['pro_preco_venda'];
                //$precoCusto = $resultado['pro_preco_custo'];
                $categoriaProduto = $resultado['pro_categoria'];
                $marca = $resultado['pro_marca'];
                $fornecedor = $resultado['for_nome'];
				$img = $resultado['pro_imagem'];
			  ?>
                <tr>
                  <td><img src='img/produtos/<?php echo $img ?>' height='50' width='50' /> </td>
                  <td><?php echo $codigoProduto?></td>
                  <td><?php echo $nomeProduto?></td>
                  <td><?php echo $marca?></td>
                  <td><?php echo $precoVenda?></td>
                  <td><?php echo "<a href=altera_produto.php?id=$codigoProduto><img src='img/icons/user_edit.png' width='20px'/></a>
								  <a href=produto.php?del=$codigoProduto><img src='img/icons/user_delete.png' width='20px'></a> ";  ?></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
	
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright 2017. Pereira&Cia - Todos os direitos reservados.</small>
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
