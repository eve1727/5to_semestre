
<?php

session_start();
require_once "conexion.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: haber.php");
    exit;
}

$nombre_usuario = $_SESSION["usuario_nombre"];
$correo_usuario = $_SESSION["usuario_correo"];

$consulta = $conn->query(
    "SELECT ID, Nombre, correo, contrasena_hash
     FROM usuario
     ORDER BY ID DESC"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zona privada</title>
</head>
<body>

<h1>Zona privada</h1>

<p>Bienvenido, <strong><?= htmlspecialchars($correo_usuario) ?></strong>
   (<?= htmlspecialchars($contrasena_usuario) ?>)</p>

<nav>
  <a href="registrar.php">Crear usuario</a> |
  <a href="privado.php">Inicio</a> |
  <a href="salir.php">Cerrar sesión</a>
</nav>

<hr>

<h2>Usuarios registrados</h2>

</body>
</html>