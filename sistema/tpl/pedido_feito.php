

<?php
	include "include/autSis.php";

 //DELETA REGISTRO DE TABELA
	if(!empty($_GET['del'])){
		
	$delid = $_GET['del'];
		
		$sqlDel =  "DELETE FROM venda_item WHERE vi_id_venda = {$delid}";
		
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		
		$sqlDel = "DELETE FROM venda WHERE v_id = {$delid}";
		
		$exeqrDel = mysql_query($sqlDel) or die (mysql_error());
		if($exeqrDel){
			echo "<script> alert ('Pedido removido com sucesso!');
			location.href = 'pedido_feito.php';
			</script>";
			echo "";
	}
	}
 				
				$sql =  "SELECT * FROM venda v INNER JOIN cliente c ON v.v_id_cliente=c.cli_id";
 				$query = @mysql_query($sql);
				 
				  //$data = $resultado['data_orcamento'];
			
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
          <a href="admin.php">Inicio</a>
        </li>
		<li class="breadcrumb-item">
          <a href="pedido.php">Pedidos</a>
        </li>
        <li class="breadcrumb-item active">Vendas Atuais</li>
      </ol>
      <!-- Icon Cards-->
      
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pedidos Realizados </div>
        <div class="card-body">
          <div class="table-responsive">
          
            <table width="100%" cellspacing="0">
              <thead>
              
                <tr>
                  <th>No Venda</th>
				  <th>Valor Total</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Status</th>
                  <th>Data</th>
                  <th>Ação</th>
                </tr>
              </thead>
              
              
              <tbody>
			  <?php
             
			
			  while($resultado = mysql_fetch_assoc($query)){
			  	$id = $resultado['v_id'];
				$total = $resultado['v_valor'];
				$cliente = $resultado['cli_nome'];
				$vendedor = $resultado['v_id_vendedor'];
				$status = $resultado['v_status'];
				$data = @strtotime(str_replace('/','-',$resultado['v_data']));
			  ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $total ?></td>
                  <td><?php echo $cliente ?></td>
                  <td><?php echo $vendedor ?></td>
				  <td><?php echo $status ?></td>
                  <td><?php echo @date('d-m-Y',$data);?></td>
                  <td><?php echo "<a href=pedido_feito.php?del=$id><img src='img/icons/page_white_delete.png' width='20px'></a> ";
					echo "<a href=pedido_feitoPdf.php?id=$id target='_blank'><img src='img/icons/_pdf.gif' width='20px'></a>";
					echo "<a href=orcamentoExcel.php?id=$id><img src='img/icons/xls.jpg' width='20px'></a>";
					?></td>
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
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Pereiraecia 2017</small>
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
