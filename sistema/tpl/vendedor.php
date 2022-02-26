<?php 
include "include/autSis.php";
	
	//DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
	$delid = $_GET['del'];
		$sqlDel = "DELETE FROM vendedor WHERE ve_id = {$delid}";
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		if($exeqrDel){
			echo "<script> alert ('Vendedor removido com sucesso!');
			location.href = 'vendedor.php';
			</script>";
			echo "";
		}
	}
	/*************************************************************
	*********** Busca de produtos ********************************
	**************************************************************/
	@$busca = mysql_real_escape_string($_POST['consulta']);
	//$id = @$_GET['id'];
	$sql_code = "SELECT  * FROM vendedor WHERE ve_nome LIKE '%$busca%'";
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
        <li class="breadcrumb-item active">Vendedor</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> <a href="cadastro_vendedor.php">Inserir Vendedor</a></div>
        <div class="card-body">
          <div>
          
			<div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>CPF</th>
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Email</th>
                  <th>Nivel</th>
                  <th>Ações</th>
              </thead>
              <tfoot>
                <tr>
                  <th>CPF</th>
                  <th>Nome</th>
                  <th>Telefone</th>
                  <th>Email</th>
                  <th>Nivel</th>
                  <th>Ações</th>
                </tr>
              </tfoot>
              <tbody>
			 	 <?php while (@$resultado = mysql_fetch_assoc($query3)) {
					$codigo = $resultado['ve_id'];
					$cpf = $resultado['ve_cpf'];
					$nome = $resultado['ve_nome'];
					$tel = $resultado['ve_telefone'];
					$email = $resultado['ve_email'];
					$nivel = $resultado['ve_nivel'];
				?>
                <tr>
                  <td><?php echo $cpf;?></td>
                  <td><?php echo $nome;?></td>
                  <td><?php echo $tel;?></td>
                  <td><?php echo $email?></td>
                  <td><?php echo $nivel?></td>
                  <td><?php echo "<a href=altera_vendedor.php?id=$codigo><img src='img/icons/user_edit.png' width='20px'/></a>
								  <a href=vendedor.php?del=$codigo><img src='img/icons/user_delete.png' width='20px'></a> ";  ?></td>
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
