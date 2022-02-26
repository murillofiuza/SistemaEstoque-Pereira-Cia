<?php 


if(isset($_SESSION['userLog']))
     header("Location: tpl/admin.php");
  else
     header("Location: tpl/login.php");
  
?>