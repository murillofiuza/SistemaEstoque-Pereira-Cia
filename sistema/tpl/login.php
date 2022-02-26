<?php
    
   	require_once "../dts/iniSis.php";
   $conn = @mysql_connect(HOST, USER, PASS) or die ('Erro ao conectar ao servidor!'.mysql_error());
   $dbsa = @mysql_select_db(DBSA) or die ('Erro ao conectar com o banco de dados!'.mysql_error());
   	
	
//está logado
    if (isset($_SESSION['userLog'])){
        header("Location: admin.php");
        die();
    }
	if(isset($_COOKIE['lembrar'])){
		
		$lembrar ="checked";
		$login = base64_decode($_COOKIE['lembrar-login']);
		$senha = base64_decode($_COOKIE['lembrar-senha']);
	}else{
		$lembrar = null;
		$login = null;
		$senha = null;
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pereira&amp;Cia - Sistema de Estoque</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<?php
  if(isset($_POST['logar'])){
	   $login = mysql_real_escape_string(strip_tags(trim($_POST['login'])));
	  $senha = mysql_real_escape_string(strip_tags(trim($_POST['senha'])));
	   $lembrar = (isset($_POST['lembrar']))? true : false;
	  
	  if(empty($login) && empty($senha)){
	    echo "<script>alert ('Preencha o login e senha!');
			location.href = 'login.php';
			</script>";
	  }else if(empty($login)){
	    echo "<script>alert ('Informe seu Login!');
			location.href = 'login.php';
			</script>";
	  }else if(empty($senha)){
	    echo "<script>alert ('Informe seu Senha!');
			location.href = 'login.php';
			</script>";
	  }else{
		  //verifica login
		  $query = mysql_query("SELECT ve_login FROM vendedor WHERE ve_login = '$login'") or die (mysql_error());
		   $checkLogin = mysql_num_rows($query);
		   
		   //verifica senha
		   $query = mysql_query("SELECT * FROM vendedor WHERE ve_login = '$login' AND ve_senha ='$senha' LIMIT 1") or die (mysql_error());
		   $checkPass = mysql_num_rows($query);
		   
		   if($checkLogin <=0){
		    echo "<script> alert ('Não existe esse usuario!');
			
			</script>";
			 
		   }else if ($checkPass <=0){	 
               echo "<script> alert ('Senha incorreta!');
			
			</script>"; 
		   }else{
			   
			   	while($infoUser = mysql_fetch_assoc($query)){
					$adm = $infoUser['adm'];
					
					session_start();
					
					if($adm == 1){
						echo 'Usuario administrador';

					}else{
						echo 'Usuario normal';
					}
					
			   $_SESSION['userLog'] = true; 
			   $_SESSION['userInfo'] = array(
					'nome' => base64_encode($infoUser['ve_nome']),
					'login' => base64_encode($infoUser['ve_login']),
					'senha' => base64_encode($infoUser['ve_senha'])
					);
			   if($lembrar){
				   setcookie('lembrar', true, time()+3600*24*30, '/');
				   setcookie('lembrar-login', base64_encode($login), time()+3600*24*30, '/');
				   setcookie('lembrar-senha', base64_encode($senha), time()+3600*24*30, '/');
			   }else{
				   setcookie('lembrar','', time() -3600*24*30, '/');
				   setcookie('lembrar-login', '', time() -3600*24*30, '/');
				   setcookie('lembrar-senha', '', time() -3600*24*30, '/');
			   } 
			   //se exister session ele redireciona para o painel
			   if(isset($_SESSION['userLog'])){
			        header("Location: admin.php");
			   }else{
				 echo 'Desculpa, ocorreu um erro...';
			   }
				}
		   }
	  }
	  echo '<hr size="1" color="#dfdfdf">';
  
  }
	 ?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><center><img src="img/logo-.png" width="200" height="60"></center></div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <input class="form-control" name="login" id="exampleInputEmail1" type="text"  placeholder="Digite o Usuario">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="exampleInputPassword1" name="senha" type="password" placeholder="Senha">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input"  type="checkbox"> Lembrar senha.</label>
            </div>
          </div>
          <input type="submit" name="logar" value="Login" class="btn btn-primary btn-block"/>
          
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="#">Registrar </a>
          <a class="d-block small" href="#">Esqueci senha!?</a>
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
</body>

</html>
