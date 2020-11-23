<?php
  //Validación de session activa
  session_start();

  //Desagrupar session
  session_unset();

  //Desactivación de todas las session
  session_destroy();

  //Redireccionar al inicio
  header('Location: /tematica5/index.php');
?>
