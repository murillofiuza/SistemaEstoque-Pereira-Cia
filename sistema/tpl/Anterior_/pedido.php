<?php 
include "include/autSis.php";
	/*************************************************************
	******************** Busca de produtos ***********************
	**************************************************************/
	
	//DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
	$delid = $_GET['del'];
		$sqlDel = "DELETE FROM pedido WHERE ped_id_pedido = {$delid}";
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		if($exeqrDel){
			echo "<script> alert ('Pedido removido com sucesso!');
			location.href = 'pedido.php';
			</script>";
			echo "";
		}
	}
	@$busca = mysql_real_escape_string($_POST['consulta']);
	
	$id = @$_GET['id'];
$sql_code = "SELECT  * FROM produto";
$query3 = mysql_query($sql_code);
	
	
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
          <i class="fa fa-table"></i> <a href="carrinho.php">Ver Carrinho</a>&nbsp; </div>
        <div class="card-body">
          <div>
          
			<form method="POST">
                <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">Codigo</label>
                <input class="form-control" name="consulta" id="consulta" type="text">
                <input type="submit" value="Buscar" name="consultar"/>
              </div>
              
            </div>
          </div>
                
			</form>
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                   <th>Nome</th>
                  <th>Preço Venda</th>
                  <th>Imagem</th>
                  <th>Ação</th>
              </thead>
              <tfoot>
                <tr>
                  <th>Nome</th>
                  <th>Preço Venda</th>
                  <th>Imagem</th>
                  <th>Ação</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php while (@$resultado = mysql_fetch_assoc($query3)) {
               $nome = $resultado['pro_descricao'];
		$preco_venda = number_format($resultado['pro_preco_venda'], 2, ',', '.');
		$imagem = '<img src="img/produtos/'.$resultado['pro_imagem'].'" width="50" height="50"/>';
		$add = '<a href="carrinho.php?acao=add&id='.$resultado['pro_id_produto'].'"><img src="img/icons/cart_add.png"/></a>';
              ?>
                <tr>
                  <td><?php echo $nome ?></td>
                  <td><?php echo $preco_venda ?></td>
                  <td><?php echo $imagem ?></td>
                  <td><?php echo $add ?></td>		
                </tr>
                <?php } ?>
              </tbody>
            </table>
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
