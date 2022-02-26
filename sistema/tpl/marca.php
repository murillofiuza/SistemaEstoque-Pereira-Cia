<?php 
include "include/autSis.php";
	/*************************************************************
	*********** Busca de produtos ********************************
	**************************************************************/
	
	//DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
	$delid = $_GET['del'];
		$sqlDel = "DELETE FROM marca WHERE ma_id = {$delid}";
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		if($exeqrDel){
			echo "<script> alert ('Marca removido com sucesso!');
			location.href = 'marca.php';
			</script>";
			echo "";
		}
	}
	@$busca = mysql_real_escape_string($_POST['consulta']);
	//$id = @$_GET['id'];
	$sql_code = "SELECT  * FROM marca  WHERE ma_id LIKE '%$busca%'";
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
        <li class="breadcrumb-item active">Marca</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <a href="cadastro_marca.php">Inserir Marca</a></div>
        <div class="card-body">
          <div>
          
			<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Cod.</th>
                  <th>Nome marca</th>
                  <th>Ações</th>
              </thead>
              <tfoot>
                <tr>
                  <th>Cod.</th>
                  <th>Nome marca</th>
                  <th>Ações</th>
                </tr>
              </tfoot>
              <tbody>
			  <?php while (@$resultado = mysql_fetch_assoc($query3)) {
                $codigo = $resultado['ma_id'];
                $nomeMarca = $resultado['ma_descricao'];
                
              ?>
                <tr>
                  <td><?php echo $codigo?></td>
                  <td><?php echo $nomeMarca?></td>
                  <td><?php echo "<a href=altera_marca.php?id=$codigo><img src='img/icons/user_edit.png' width='20px'/></a>
								  <a href=marca.php?del=$codigo><img src='img/icons/user_delete.png' width='20px'></a> ";  ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Atualização ontem 11:59 PM &nbsp; 
              </div>
      </div>
    </div>
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
