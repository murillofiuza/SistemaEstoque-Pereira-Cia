<?php
include "include/autSis.php";
 
 /*******************Consulta por pagina****************************/
 @$busca = mysql_real_escape_string($_POST['consultar']);
 $categoria_produto = @$_GET['cat'];


//$id = @$_GET['id'];
$sql_code = "SELECT  * FROM produto p INNER JOIN fornecedor f ON p.pro_id_fornecedor=f.for_id_fornecedor
									   INNER JOIN marca m ON p.pro_id_marca=m.ma_id_marca
									   INNER JOIN categoria c  ON p.pro_id_categoria=c.cat_id_categoria
									   WHERE pro_id_categoria=$categoria_produto";
$query3 = mysql_query($sql_code);
	
	$res =@mysql_fetch_assoc($query3);
	$cat_produto = $res['pro_id_categoria'];
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
          <a href="#">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Relatório produto</li>
      </ol>
      <h1>Gerar Relatorio</h1>
      <hr>
      <p>The SB Admin navbar can be either fixed or static, and it supports the navbar-light and navbar-dark Bootstrap 4 classes.</p>
      <label for="exampleInputName">Por categoria: </label>
      <select name="categoria">
    <option value=""><------SELECIONE------></option>
                          <?php 
						  $query = mysql_query("SELECT * FROM categoria where cat_id_categoria");
      						while($reg=mysql_fetch_array($query)){
         					 echo '<option value="'.$reg["cat_id_categoria"].'">'.$reg["cat_descricao"].'</option>';}
							 
						  ?>
                          
                          </optgroup>
      </select>
                        &nbsp;&nbsp;&nbsp;
      <label for="exampleInputName">Por marca: 
        <select name="marca">
    <option value=""><------SELECIONE------></option>
                          <?php 
						  $query = mysql_query("SELECT * FROM marca where ma_id_marca");
      						while($reg = mysql_fetch_array($query)){
         					 echo '<option value="'.$reg["ma_id_marca"].'">'.$reg["ma_descricao"].'</option>';}
							 
						  ?>
                          
                          </optgroup>
                        </select>
      </label>
      <!-- Blank div to give the page height to preview the fixed vs. static navbar-->
      <div style="height: 1000px;"></div>
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
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <!-- Toggle between fixed and static navbar-->
    <script>
    $('#toggleNavPosition').click(function() {
      $('body').toggleClass('fixed-nav');
      $('nav').toggleClass('fixed-top static-top');
    });

    </script>
    <!-- Toggle between dark and light navbar-->
    <script>
    $('#toggleNavColor').click(function() {
      $('nav').toggleClass('navbar-dark navbar-light');
      $('nav').toggleClass('bg-dark bg-light');
      $('body').toggleClass('bg-dark bg-light');
    });

    </script>
  </div>
</body>

</html>
