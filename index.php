<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyEmotions</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<header id ="inicio">
    <div>
    <a href= "registros.php">Registrate</a>
    <a href= "inicio.php">Iniciar sesion</a>
    </div>
</header>
    <header id="encabezado">
        <h2>Bienvenido a MyEmotions</h2>
    </header>
    <hr id="hr">

    <h2 id="queEmocion">¿Con qué emoción comienzas hoy tú día?</h2>

    <div id="botones">
        <div style="display=inline-block;">
          <input type="button" name="enojo" id="enojo">
          <h3 class="nombreEmo">Enojo</h3>
       </div>
          
       <div style="display=inline-block;">
          <input type="button" name="neutral" id="neutral">
          <h3 class="nombreEmo">Neutral</h3>
      </div>

      <div style="display=inline-block;">
          <input type="button" name="feliz" id="feliz">
          <h3 class="nombreEmo">Felíz</h3>
      </div>
     
      <div style="display=inline-block;">
          <input type="button" name="aburrido" id="aburrido">
          <h3 class="nombreEmo">Aburrido</h3>
     </div>

     <div style="display=inline-block;">
          <input type="button" name="triste" id="triste">
          <h3 class="nombreEmo">Triste</h3>
    </div>

    <div style="display=inline-block;">
          <input type="button" name="nostalgico" id="nostalgico">
          <h3 class="nombreEmo">Nostalgico</h3>
    </div>

    </div>
</body>
</html>