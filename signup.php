<?php

	//Agregación de codigo php de database para conexión
	require 'database.php';

	//Iniciamos la variable message vacía
	$message = '';

	//Validamos si email y password son diferentes a vacías para registrar usuario
	if(!empty($_POST['email']) && !empty($_POST['password'])){
		$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':email', $_POST['email']);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password', $password);

		//Si ejecutó bien, registrará el usuario
		if($stmt->execute()){
			//Registró usuario correctamente
			$message = 'Se ha creado el usuario correctamente';
		}else{
			//Error, no pudo registrar usuario
			$message = 'Lo siento, la cuenta no se pudo crear';
		}
	}
?>

<!-- Ejecución del HTML Frontend -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>SignUp</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<!-- Agregamos el header de la web -->
		<?php require 'partials/header.php' ?>

		<!-- Validamos si hay algún mensaje para mostrar -->
		<?php if(!empty($message)): ?>
			<p> <?= $message ?></p>
		<?php endif; ?>

		<h1>Registrese</h1>
		<span>si tiene cuenta <a href="login.php">Inicie sesion</a></span>

		<form action="signup.php" method="POST">
			<input name="email" type="text" placeholder="Escriba su email">
			<input name="password" type="password" placeholder="Escriba su Password">
			<input name="confirm_password" type="password" placeholder="Confirme su Password">
			<input type="submit" value="Enviar">
		</form>

	</body>
</html>