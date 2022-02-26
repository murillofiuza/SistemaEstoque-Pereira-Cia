<?php
  include "include/autSis.php";
  
	$id = @$_GET['id'];
	$sql_code = "SELECT  * FROM estoque e INNER JOIN produto p ON p.pro_id_produto=e.id_produto";
	$query3 = mysql_query($sql_code);


	$sql_code = "SELECT  * FROM produto p INNER JOIN saida_produto sp ON p.pro_id_produto=sp.id_produto";
	$query4 = mysql_query($sql_code);
	
	$sql =  "SELECT * FROM venda v INNER JOIN cliente c ON v.v_id_cliente=c.cli_id";
 	$query5 = @mysql_query($sql);

	include "header.php"; ?>
  <!-- Navigation-->
<a href="login.php">login</a><?php include "menu.php"; ?>

<?php 
	   if($_SESSION['ve_nivel'] == 10){
	   ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Home</li>
      </ol>  
    </div>
    <div class="card mb-3">
      <div class="card-header">
          <i class="fa fa-area-chart"></i> Link Rápido</div>
        <div class="card-body">
          <a href="categoria.php"><img src="img/btn/btn_categoria.png"></a>&nbsp;&nbsp;
          <a href="produto.php"><img src="img/btn/btn_produto.png"></a>&nbsp;&nbsp;
		  <a href="cliente.php"> <img src="img/btn/btn_cliente.png"></a>&nbsp;&nbsp;
          <a href="pedido.php"><img src="img/btn/btn_vendas.png"></a>&nbsp;&nbsp;
          <a href="fornecedor.php"><img src="img/btn/btn_fornecedor.png"></a>&nbsp;&nbsp;
          <a href="vendedor.php"><img src="img/btn/btn_vendedor.png"></a>&nbsp;&nbsp;
          <a href="relatorio_produto.php"><img src="img/btn/btn_relatorio.png"></a>&nbsp;&nbsp;
		  
          <br><br>
       </div>
	  
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pedidos Realizados</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nº do pedido</th>
                  <th>V. Total</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Status</th>
                  <th>Data</th>
				  <th>Ação</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nº do pedido</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
             
			
			  while($resultado = mysql_fetch_assoc($query5)){
			  	$id = $resultado['v_id'];
				$total = $resultado['v_valor'];
				$cliente = $resultado['cli_nome'];
				$vendedor = $resultado['v_id_vendedor'];
				$status = $resultado['v_status'];
				$data = strtotime(str_replace('/','-',$resultado['v_data']));
			  ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $total ?></td>
                  <td><?php echo $cliente ?></td>
                  <td><?php echo $vendedor ?></td>
				  <td><?php echo $status ?></td>
                  <td><?php echo date('d-m-Y',$data);?></td>
                  <td><?php echo "<!--a href=pedido_feito.php?del=$id><img src='img/icons/page_white_delete.png' width='20px'></a--> ";
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
          <small>© Copyright 2017. Pereira&Cia - Todos os direitos reservados.</small>
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
  
  <?php }elseif($_SESSION['ve_nivel'] == 5){?>
  
    <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Home</li>
      </ol>  
    </div>
    <div class="card mb-3">
      <div class="card-header">
          <i class="fa fa-area-chart"></i> Link Rápido</div>
        <div class="card-body">

          <a href="pedido.php"><img src="img/btn/btn_vendas.png"></a>&nbsp;&nbsp;
		  <a href="relatorio_produto.php"><img src="img/btn/btn_relatorio.png"></a>&nbsp;&nbsp;
		  
          <br><br>
       </div>
	  
    </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Pedidos Realizados</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nº do pedido</th>
                  <th>V. Total</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Status</th>
                  <th>Data</th>
				  <th>Ação</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nº do pedido</th>
                  <th>Position</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
             
			
			  while($resultado = mysql_fetch_assoc($query5)){
			  	$id = $resultado['v_id'];
				$total = $resultado['v_valor'];
				$cliente = $resultado['cli_nome'];
				$vendedor = $resultado['v_id_vendedor'];
				$status = $resultado['v_status'];
				$data = strtotime(str_replace('/','-',$resultado['v_data']));
			  ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $total ?></td>
                  <td><?php echo $cliente ?></td>
                  <td><?php echo $vendedor ?></td>
				  <td><?php echo $status ?></td>
                  <td><?php echo date('d-m-Y',$data);?></td>
                  <td><?php echo "<!--a href=pedido_feito.php?del=$id><img src='img/icons/page_white_delete.png' width='20px'></a--> ";
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
          <small>© Copyright 2017. Pereira&Cia - Todos os direitos reservados.</small>
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
  
  <?php }?>
  
</body>

</html>
