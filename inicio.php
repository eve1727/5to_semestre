<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Variables que recibimos del formulario
  $correo=$_POST['correo'];
  $contrasena=$_POST['contrasena'];

  // Configuración de la base de datos
  $host = 'localhost';
  $dbname = 'usuarios';//Nombre de base de datos
  $username = 'evelyn';
  $password = '1234';
  
  // Crear conexión a la base de datos
  $conn = new mysqli($host, $username, $password, $dbname);


// Consulta para validar los datos con la tabla de la base de datos 
$sql = $conn->query("select * from usuario where correo = '$correo' and contrasena_hash = '$contrasena' ");

if ($datos = $sql-> fetch_object()){
  header("location: registros.php");
}else{
  echo "Acceso denegado";
}
}

  // Recibir datos del formulario
  
//Esto solo sirve para verificar si es que se concecto o no a la base

//   if ($conn->connect_error) {
//       die("Conexión fallida: " . $conn->connect_error);
//   }else{
//     echo "Conexión lograda";
//   }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
</head>
<body>
<h1>Iniciar sesión</h1>

<form method="post">
  <label for="correo">Correo</label>
  <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email">

  <label for="contrasena">Contraseña</label>
  <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="current-password">

  <button type="submit">Entrar</button>
</form>

<p>¿No tienes cuenta? <a href="registros.php">Regístrate</a></p>
</body>
</html>

