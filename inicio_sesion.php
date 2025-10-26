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
                              $_SESSION["usuario_contrasena"] = $usuario["contrasena_hash"];
                              header("Location: privado.php");
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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="estilos.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Iniciar sesión</h1>
      </div>
      <p class="sub">Accede con tu correo y contraseña.</p>

      <!-- Mensaje -->
      <?php if ($mensaje !== ""): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <!-- Formulario -->
      <form method="post" action="inicio_sesion.php" novalidate>
        <div class="campo">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email">
        </div>

        <div class="campo">
          <label for="contrasena">Contraseña</label>
          <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="current-password">
        </div>

        <div class="barra-acciones">
          <button class="boton" type="submit">Entrar</button>
          <a class="boton boton-sec" href="registrar.php">Crear cuenta</a>
        </div>
      </form>

      <hr class="hr">

      <!-- Navegación -->
      <p class="nav">
        <a href="registrar.php">Registrar</a>
        <a href="inicio_sesion.php">Iniciar sesión</a>
        <a href="privado.php">Privado</a>
        <a href="salir.php">Salir</a>
        <a href="index.php">Inicio</a>
      </p>
    </div>
  </div>
</body>
<footer>
  <div class="foot">
  <div id="seccion2">
    <div id="seccion1">
       <h2>MyEmotions</h2>
       <p>Creado para poder acompañarte día a día <br>y tener un registro de tus emociones</p>
    </div>
    

      <div>
        <h3>Privacidad</h3>
        <div id="privacidad">
          <a href="privacidad" class="footer_links">Politica de Privacidad</a>
          <p><a href="privacidad" class="footer_links">Terminos de Seguridad</a></p>
        </div>
      </div>

      <div class="espacio">
        <h3 ><a href="inicio_sesion.php" class="footer_links">Inicia Sesion</a></h3>
      </div>

      <div class="espacio2">
        <h3>Nuestras redes</h3>
           <p>Instagram</p>
      </div>
        
    </div>
  </div>
</footer>
</html>

