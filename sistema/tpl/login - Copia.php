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
<html >
<head>
  <meta charset="UTF-8">
  <title>Pereira&Cia-Acesso</title>
  
  
  
      <link rel="stylesheet" href="css/login_css.css">

  
</head>

<body>
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
  <body>
	<div class="login">
		<div class="login-screen">
			<div class="app-title">
				<h1><img src="img/logo.png" width="174" height="156"></h1>
			</div>

			<div class="login-form">
				<div class="control-group">
                <form action="" method="post">
				<input type="text" name="login" class="login-field" value=""<?php echo $login;?>"" placeholder="usuario" id="login">
				<label class="login-field-icon fui-user" for="login-name"></label>
				

				<div class="control-group">
				<input type="password" name="senha" class="login-field" value=""<?php echo $senha;?>"" placeholder="senha" id="senha">
				<label class="login-field-icon fui-lock" for="login-pass"></label>
				</div>

				<input type="submit" name="logar" value="logar" class="btn btn-primary btn-large btn-block"/>
				<a class="login-link" href="#">Esqueceu a senha?</a>
			</div>
		</div>
	</div>
</body>
  
  
</body>
</html>
