<?php
	
	//Validación de session activa
	session_start();

	//Agregación de codigo php de database para conexión
	require 'database.php';

	//Validamos si la sesión o login de usuario está activa
	if(isset($_SESSION['user_id'])){
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		//Validamos la cantidad de resultados entregados por base de datos
		if(count($results) > 0){
			$user = $results;
		}
	}
?>

<!-- Ejecución del HTML Frontend -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bienvenido al visor de Reportes de Impresion</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<!-- Agregamos el header de la web -->
		<?php require 'partials/header.php' ?>

		<!-- Validamos si el usuario está logeado -->
		<?php if(!empty($user)): ?>
			<br> Bienvenido. <?= $user['email']; ?>
			<br>
			<br>
			<br>
			<a href="http://192.168.1.70:631/jobs?which_jobs=all"> Haga Clic aqui para ver el reporte detallado de impresiones</a>
			<br>
			<br>Usted ha iniciado sesión
			<a href="logout.php">
			Cerrar sesión
			</a>
			<?php else: ?>
			<h1>Por favor inice sesión o registrese</h1>

			<a href="login.php">Inicio de sesión</a> or
			<a href="signup.php">Registrese</a>
		<?php endif; ?>
	</body>
</html>