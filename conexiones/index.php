<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/estilo.css"/>
	<title>LOGGIN</title>
</head>
<body>
	<h1>Loggin</h1>
<form method="post">
  <label for="user">USER:</label><br>
  <input type="text" id="user" name="user"><br>
  <label for="pas">PASSWORD:</label><br>
  <input type="password" id="pas" name="pas">
  <input type="submit" name="ingresar" value="Ingresar">
</form>

	<?php
	error_reporting(0);
	if(isset($_REQUEST['ingresar'])){
		$user=$_POST['user'];
		$pas=$_POST['pas'];
		if($cnn= oci_connect($user,$pas)){
			session_start();
			$_SESSION['user']= $_POST['user'];
			$_SESSION['pas']= $_POST['pas'];
			echo "<script>window.location='Menu.php'</script>";
		} else{
		echo'<script>alert("DATOS INVALIDOS")</script>';
		}
	}

	?>


</body>
</html>