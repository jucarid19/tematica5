<?php

	//Validación de session activa
	session_start();

	//Si la sesión está activa redireccionamos al inicio
	if(isset($_SESSION['user_id'])){
		header('Location: /tematica5/index.php');
	}

	//Agregación de codigo php de database para conexión
	require 'database.php';

	//Validamos si email y password son diferentes a vacías para logear usuario
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
		$records->bindParam(':email', $_POST['email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		//Iniciamos la variable message vacía
		$message = '';

		//Validamos inicio de sesión
		if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
			//Acceso correcto, creación de session y con mensaje
			$_SESSION['user_id'] = $results['id'];
			header("Location: /tematica5/index.php");
		}else{
			//Acceso incorrecto con mensaje
			$message = 'Lo siento, credenciales incorrectas';
		}
	}

?>

<!-- Ejecución del HTML Frontend -->
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
		<title>Inicio de sesión</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<!-- Agregamos el header de la web -->
		<?php require 'partials/header.php' ?>

		<!-- Validamos si hay algún mensaje para mostrar -->
		<?php if(!empty($message)): ?>
			<p><?= $message ?></p>
		<?php endif; ?>

		<h1>Inicie sesión</h1>
		<span>Si no tiene cuenta <a href="signup.php">Registrese</a></span>

		<form action="login.php" method="POST">
			<input name="email" type="text" placeholder="Ingrese su email">
			<input name="password" type="password" placeholder="Ingrese su password">
			<input type="submit" value="Enviar">
		</form>
	</body>
</html>