<?php
  require_once "conexion.php";
  
  // 1) Validar y obtener ID de usuario desde GET
  if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
      die("ID de usuario inválido.");
  }else{
        $id = (int)$_GET["id"];
  }

// 2) Obtener datos actuales del usuario desde la base de datos
$usuario = null;//Inicializamos la variable usuario
$sql_sel = "SELECT ID, Nombre, correo FROM usuario WHERE ID = ?";
   
$sentencia_sel = $conn->prepare($sql_sel);//1- Prepara la sentencia para mayor seguridad

   if (!$sentencia_sel) 
  { die("Error al preparar la consulta: " . $conn->error); }

  // 2- Conectar el valor del "?" con la variable que ingreso el usuario
$sentencia_sel->bind_param("i", $id);/* El bind_param nos ayuda para conectar el valor de la consulta que tiene "?" 
con la variable que ingresa el usuario, asi diciendole a php que va a recibir en ese "?" un valor entero = "i" el cual lo contendra la variable
$id */

//3- Ejecutar la consulta (envia datos y genera la consulta)
$sentencia_sel->execute();

$resultado_sel = $sentencia_sel->get_result();//4- Los resultados de la consulta se guardan en esta variable
if ($resultado_sel && $resultado_sel->num_rows === 1) {//5- Verifica que haiga llegado un resultado de la consulta con el ID que el usuario puso
    $usuario = $resultado_sel->fetch_assoc();//6- fetch_assoc() obtiene una fila de resultados como un array asociativo para poder acceder a los datos
} else {
    die("Usuario no encontrado.");
}
$sentencia_sel->close();//Cierra la sentencia despues de usarla

/* 3) Procesar envío de formulario (POST) */
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre            = trim($_POST["nombre"] ?? "");
    $correo            = trim($_POST["correo"] ?? "");
    $contrasena_nueva  = $_POST["contrasena_nueva"] ?? ""; // opcional
     

    if ($nombre === "" || $correo === "") {
        $mensaje = "Nombre y correo son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {//Filtro para validar el email, estructura: filter_var(valor, filtro)
        $mensaje = "El correo no es válido.";
    } else {//else por si el correo si es valido

        //ESTE IF ES PARA MOSTRAR RESULTADO SI ES QUE EL USUARIO DECIDE CAMBIAR SU CONTRASEÑA O NO
        if ($contrasena_nueva !== "") {
            $contrasena_hash = $contrasena_nueva;
            $sql_up = "UPDATE usuario
                       SET Nombre = ?, correo = ?, contrasena_hash = ?
                       WHERE ID = ?";
            $sentencia_up = $conn->prepare($sql_up);
            if (!$sentencia_up) {
                $mensaje = "Error al preparar actualización: " . $conn->error;
            } else {
                $sentencia_up->bind_param("sssi", $nombre, $correo, $contrasena_hash, $id);
                if ($sentencia_up->execute()) {
                    $mensaje = "Usuario actualizado (incluye nueva contraseña).";
                    $usuario["Nombre"] = $nombre;
                    $usuario["correo"] = $correo;
                } else {
                    if ($conn->errno === 1062) {
                        $mensaje = "El correo ya está registrado en otro usuario.";
                    } else {
                        $mensaje = "Error al actualizar: " . $conn->error;
                    }
                }
                $sentencia_up->close();
            }
        } else {//Y ESTE ES PARA SI EL USUARIO NO QUIERE CAMBIAR SU CONTRASEÑA
            $sql_up = "UPDATE usuario
                       SET Nombre = ?, correo = ?
                       WHERE ID = ?";
            $sentencia_up = $conn->prepare($sql_up);
            if (!$sentencia_up) {
                $mensaje = "Error al preparar actualización: " . $conn->error;
            } else {
                $sentencia_up->bind_param("ssi", $nombre, $correo, $id);

                if ($conn->errno === 1062) {
                    $mensaje = "El correo ya está registrado en otro usuario.";
                }else if ($sentencia_up->execute()) {
                    $mensaje = "Usuario actualizado.";
                    $usuario["Nombre"] = $nombre;
                    $usuario["correo"] = $correo;
                }else {
                    $mensaje = "Error al actualizar: " . $conn->error;
                }
                $sentencia_up->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar usuario</title>
  <link rel="stylesheet" href="estilo.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div class="contenedor">
    <div class="tarjeta">
      <div class="encabezado">
        <h1>Editar usuario</h1>
</div>
  <?php if ($mensaje !== ""): ?>
    <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
  <?php endif; ?>

  <form method="post">
    <label for="nombre">Nombre</label>
    <input id="nombre" name="nombre" type="text" required maxlength="100"
           value="<?= htmlspecialchars($usuario['Nombre']) ?>">

    <label for="correo">Correo</label>
    <input id="correo" name="correo" type="email" required maxlength="120"
           value="<?= htmlspecialchars($usuario['correo']) ?>">

    <label for="contrasena_nueva">Contraseña nueva (opcional)</label>
    <input id="contrasena_nueva" name="contrasena_nueva" type="password" minlength="6"
           placeholder="Déjalo vacío para no cambiarla">

    <button type="submit" class ="boton">Guardar cambios</button>
    <a href="privado.php">Volver</a>
  </form>
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
