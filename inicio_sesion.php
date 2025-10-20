<?php

session_start(); //Inicia la sesion
require_once "conexion.php";

$mensaje = "";//Variable sin valor para despues utilizarla

//solo se envia el formulario si es por el metodo post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  //Variables que recibimos del formulario
  $correo     = trim($_POST["correo"] ?? "");
  $contrasena = $_POST["contrasena"] ?? "";

  // Validar que los campos no estén vacíos
  if ($correo === "" || $contrasena === "") {
    $mensaje = "Ingresa tu correo y tu contraseña.";
  } else { //Hace una consulta a la base de datos para verificar si el correo existe
                $sql = "SELECT ID, Nombre, correo, contrasena_hash
                FROM usuario
                WHERE correo = ?"; //Con where nos ayuda a especificar que solo traera valores que tenga el correo que el usuario ingreso
                
                $sentencia = $conn->prepare($sql); // Prepara la sentencia y agrega seguridad


                      if ($sentencia) {
                      $sentencia->bind_param("s", $correo);//Esto sirve para conectar el valor que puso el usuario con el de la base de datos
                      $sentencia->execute();
                      $resultado = $sentencia->get_result();//Los resultados de la consulta se guardan en esta variable
          

                          if ($resultado && $resultado->num_rows === 1) {//Esto solo verifica que haiga llegado un resultado de la consulta con el correo que el usuario puso
                            $usuario = $resultado->fetch_assoc(); 
                                 //fetch_assoc() obtiene una fila de resultados como un array asociativo para poder acceder a los datos
                              

                            if ($contrasena == $usuario["contrasena_hash"]) {//Verifica que la contraseña que ingreso el usuario sea igual a la de la base de datos
                              $_SESSION["usuario_id"]     = $usuario["ID"];
                              $_SESSION["usuario_nombre"] = $usuario["Nombre"];
                              $_SESSION["usuario_correo"] = $usuario["correo"];
                              header("Location: priv.php");
                              //Session nos ayuda a crear una variable que dura mientras el navegador este abierto y es superglobal
                              exit;
                            } else {
                                  $mensaje = "Contraseña incorrecta.";
                              }
                            } else {
                              $mensaje = "No existe una cuenta con ese correo.";
                              }

                              $sentencia->close();
                            } else {
                            $mensaje = "Error al preparar la consulta: " . $conn->error;
                            }
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
  <link rel="stylesheet" type="text/css" href="inicio.css">
</head>
<body>

<div id="container">

<h1>Iniciar sesión</h1>
<form method="POST">
  <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email" placeholder ="Correo">
   <br><br>
  <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="current-password" placeholder ="Contraseña">

  <button type="submit">Entrar</button>
</form>

<p id="registrarse">¿No tienes cuenta? <a href="registros.php">Regístrate</a></p>
<a href="index.php" id="regresar">Regresar</a>

</div>

</body>
</html>