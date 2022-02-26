<?php 
include "include/autSis.php";
	/*************************************************************
	*********** Busca de produtos ********************************
	**************************************************************/
	
	//DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
	$delid = $_GET['del'];
		$sqlDel = "DELETE FROM estoque WHERE esto_id = {$delid}";
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		if($exeqrDel){
			echo "<script> alert ('Produto removido com sucesso!');
			location.href = 'estoque.php';
			</script>";
			echo "";
		}
	}
	@$busca = mysql_real_escape_string($_POST['consulta']);
	
	$id = @$_GET['id'];
$sql_code = "SELECT  * FROM estoque e INNER JOIN produto p ON p.pro_id=e.esto_id_produto ORDER BY pro_descricao ASC";
$query3 = mysql_query($sql_code);
	
	
?>

<?php include "header.php";?>
  <!-- Navigation-->
 
       
<?php include "menu.php"; ?>

    </div>
  </nav>
  <?php 
	   if($_SESSION['ve_nivel'] == 10){
	   ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admin.php">Início</a>
        </li>
        <li class="breadcrumb-item active">Estoque de produtos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <a href="cadastro_entrada.php">Entrada de produto</a>&nbsp; || &nbsp;
          <i class="fa fa-table"></i>&nbsp;<a href="cadastro_saida.php">Saida de produto</a></div>
        <div class="card-body">
          <div>
          
		
            
			<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>P.Unit</th>
                  <th>Ação</th>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>P.Unit</th>
                  <th>Ação</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php while (@$resultado = mysql_fetch_assoc($query3)) {
               $codigoProduto = $resultado['esto_id_produto'];
		$nomeProduto = $resultado['pro_descricao'];
		$quantidade = $resultado['esto_qtde'];
		$precoUnitario = $resultado['esto_valor_unitario'];
              ?>
                <tr>
                  <td><?php echo $codigoProduto ?></td>
                  <td><?php echo $nomeProduto ?></td>
                  <td><?php echo $quantidade ?></td>
                  <td>R$<?php echo $precoUnitario ?></td>
                  <td><?php echo "<a href=alterar_estoque.php?id=$codigoProduto><img src='img/icons/user_edit.png' width='20px'/></a>
								  <a href=cadastra_estoque.php?del=$codigoProduto><img src='img/icons/user_delete.png' width='20px'></a> ";  ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
			 </div>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM &nbsp; 
              </div>
      </div>
    </div>
	<?php }elseif($_SESSION['ve_nivel'] == 5){?>
	<div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admin.php">Início</a>
        </li>
        <li class="breadcrumb-item active">Estoque de produtos</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <!--i class="fa fa-table"></i> <a href="cadastro_entrada.php">Entrada de produto</a>&nbsp; || &nbsp;
          <i class="fa fa-table"></i>&nbsp;<a href="cadastro_saida.php">Saida de produto</a></div-->
        <div class="card-body">
          <div>
            
			<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>P.Unit</th>
                  <th>Ação</th>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Produto</th>
                  <th>Quant.</th>
                  <th>P.Unit</th>
                  <th>Ação</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php while (@$resultado = mysql_fetch_assoc($query3)) {
               $codigoProduto = $resultado['esto_id_produto'];
		$nomeProduto = $resultado['pro_descricao'];
		$quantidade = $resultado['esto_qtde'];
		$precoUnitario = $resultado['esto_valor_unitario'];
              ?>
                <tr>
                  <td><?php echo $codigoProduto ?></td>
                  <td><?php echo $nomeProduto ?></td>
                  <td><?php echo $quantidade ?></td>
                  <td>R$<?php echo $precoUnitario ?></td>
                  <td><?php echo "x";//"<a href=alterar_estoque.php?id=$codigoProduto><img src='img/icons/user_edit.png' width='20px'/></a>
								  //<a href=cadastra_estoque.php?del=$codigoProduto><img src='img/icons/user_delete.png' width='20px'></a> ";  ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
			</div>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM &nbsp; 
              </div>
      </div>
    </div>
	 <?php }?>
	 
	 <!--fim da condição-->
	 
	 
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
