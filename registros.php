

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <link rel="stylesheet" href="estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="registros.css">
</head>
<body>
  <div id="container">
  <h1>Registro de usuario</h1>

  <form method="post">
    <input id="nombre" name="nombre" type="text" required maxlength="100" autocomplete="name" placeholder="Nombre">
    <br><br>
    <input id="correo" name="correo" type="email" required maxlength="120" autocomplete="email" placeholder="Correo">
    <br><br>
    <input id="contrasena" name="contrasena" type="password" required minlength="6" autocomplete="new-password" placeholder="Contraseña">
    <br><br>
    <button type="submit">Crear cuenta</button>
  </form>

  <p class="iniciar">¿Ya tienes cuenta? <a href="inicio.php">Inicia sesión</a></p>
  <a href="index.php" id="regresar">Regresar</a>
</body>
</div>

<?php


// Configuración de la base de datos
$host = 'localhost';
$dbname = 'usuarios';
$username = 'evelyn';
$password = '1234';

// Crear conexión
$conn = new mysqli($host, $username, $password, $dbname);//creas la conexion a la base de datos


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO usuario (Nombre, correo, contrasena_hash) VALUES (?, ?, ?)"; // Creas una variable que insertara datos 
    //en la base de datos con valores desconocidos ya que estos seran los que inserte el usuario

    $stmt = $conn->prepare($sql); // Prepara la sentencia y agrega seguridad 

    if ($stmt === false) {
        die("Error al preparar la sentencia: " . $conn->error);
    }

    // basicamente esta linea conecta los valores que pone el usuario (bind_param)con los de la base de datos
    //Las tres 's' indica que los valores que recibira la base de datos son cadenas de caracteres
    $stmt->bind_param("sss", $nombre, $correo, $contrasena); 

    //Execute es como hacer una revision de si todo se logro, primero prepararas el terreno con 'prepare'
//despues le das los valores a ese terreno con 'bind_param' y ya por ultimo 
//con exucute mandas un mensaje si es que todo se logro

if ($stmt->execute()) {
    echo "Se registro correctamente";
} else {
    echo "Error al intentar registrarse" . $stmt->error;
}
}
    ?>
  </body>
</html>
