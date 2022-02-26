<?php
	session_start();
	//PUXA CONEXÃO COM O SERVIDOR
	require_once "../dts/iniSis.php";
	//CONEXÃO COM O SERVIDOR E BANCO DE DADOS
		$conn = @mysql_connect(HOST, USER, PASS) or die ('Erro ao conectar ao servidor!'.mysql_error());
		$dbsa = @mysql_select_db(DBSA) or die ('Erro ao conectar com o banco de dados!'.mysql_error());
   
   //INICIA SESSÃO
	if(!isset($_SESSION['userLog'])){
		header("Location: login.php");
		die();
	}
   
    $login = base64_decode($_SESSION['userInfo']['login']);
	$senha = base64_decode($_SESSION['userInfo']['senha']);
	
	$query = mysql_query("SELECT * FROM vendedor WHERE ve_login = '$login' AND ve_senha = '$senha'") or die(mysql_error());
	//verifica se o usuario existe
	if(mysql_num_rows($query) <=0){
		unset($_SESSION['userLog'], $_SESSION['userLog']);
		session_destroy();
       header("Location: login.php");
	   die();
   }else {
   $infoUser = mysql_fetch_assoc($query);
   //nivel de acesso
   $_SESSION['ve_nivel'] = $infoUser['ve_nivel'];
   }
   //RETORNA PARA A PAGINA LIGIN.PHP
	if(isset($_GET['acao']) && $_GET['acao'] == 'sair'){
		unset($_SESSION['userLog'], $_SESSION['userLog']);
		session_destroy();
		header("Location: login.php");
		die();
 }
 
 ?>