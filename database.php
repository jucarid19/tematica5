<?php
//conexion con el servidor mysql Base de datos
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'Tematica5-Nfs';

try{
	// Conexión a base de datos
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
}catch(PDOException $e){
	// Conexión fallida con mensaje de error
	die('Connection Failed: ' . $e->getMessage());
}

?>
