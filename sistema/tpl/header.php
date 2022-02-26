<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  
 <script type="text/javascript" language="javascript" src="js/jquery-1.7.1.js"></script>
  <script type="text/javascript" language="javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
  
  <title>Pereira&Cia - Sistema de Estoque</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>
<script type="text/javascript">
$(document).ready(function(){
	$("input.data").mask("99/99/9999");
        $("input.cpf").mask("999.999.999-99");
        $("input.cep").mask("99.999-999");
		$("input.tel").mask("(99)9999-9999");
});
</script>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">