
<?php

require_once "conexion.php"; //Conectas a la base de datos

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO usuario (Nombre, correo, contrasena_hash) VALUES (?, ?, ?)"; // Creas una consulta que insertara datos 
    //en la base de datos con valores desconocidos ya que estos seran los que inserte el usuario

    $stmt = $conn->prepare($sql); // Prepara la sentencia y agrega seguridad 

    if ($stmt === false) {
        die("Error al preparar la sentencia: " . $conn->error);
    }

    // basicamente esta linea conecta los valores que pone el usuario (bind_param)con los de la base de datos
    $stmt->bind_param("sss", $nombre, $correo, $contrasena); 

    
//con exucute mandas un mensaje si es que todo se logro
if ($stmt->execute()) {
    echo "<h2>Se registro correctamente</h2>";
} else {
    echo "Error al intentar registrarse" . $stmt->error;
}
}
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de usuario</title>
  <link rel="stylesheet" href="estilos.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Registro de usuario</h1>
      </div>

      <p class="sub">Crea una cuenta para acceder a la zona privada.</p>

      <!-- Mensaje -->
      <?php if ($mensaje !== ""): ?>
        <p class="mensaje.ok"><?= htmlspecialchars($mensaje) ?></p>
      <?php endif; ?>

      <!-- Formulario -->
      <form method="post" action="registrar.php" novalidate>
        <div class="campo">
          <label for="nombre">Nombre</label>
          <input id="nombre" name="nombre" type="text" required maxlength="100" autocomplete="name">
        </div>

        <div class="campo">
          <label for="correo">Correo</label>
          <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email">
        </div>

        <div class="campo">
          <label for="contrasena">Contraseña</label>
          <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="new-password">
        </div>

        <div class="barra-acciones">
          <button class="boton" type="submit">Crear cuenta</button>
          <a class="boton boton-sec" href="inicio_sesion.php">Iniciar sesión</a>
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


