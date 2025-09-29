<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retos</title>
</head>
<body>


<?php  //reto D1
  echo "TU PUEDES EVE :)!!";
?>

<?php //reto D2
//Variables
    $arma = "arco";
    $rango= "comandante";
    $misiones= 17;

    echo "<br><br>Mi arma: ". $arma . "<br>";
    echo "Rango: ". $rango . "<br>";
    echo "Misiones completadas: ". $misiones . "<br>";
?>

<?php  //reto D3
  //rectangulo
  $base = 8;
  $altura = 10;

  $area = $base * $altura;
  echo "<br><br>El área del rectangulo es: ". $area . "<br><br>";
?>

<?php //reto D4

    echo "<br> Soldado <br>";
    $examenR = 80;

    if ($examenR >= 70) {
      echo "Si pasaste <br>";
    }else{
      echo "No pasaste <br>";
    }
?>

<?php    // reto D5

   for ($i=1; $i <= 10; $i++) { 
    echo "<br>Tenemos $i paletas";
   }
?>

<?php   // reto D6
    //Funciones: Es como crear unas acciones de código dentro de una etiqueta para poder usarlas después,
    //estas pueden llevar variables dentro de sus parametros para que después puedan ser sustituidas por 
    //otras variables que le van a llegar y estos parametros pueden llevar un valor de default

    function presentacion($nombre, $rango){
       echo "<br><br>Nombre: $nombre <br>";
       echo  "Rango: $rango  <br>";
    }
    
    echo presentacion("Lupita", "comandante");
    echo "Lista para la batalla <br><br>";

?>

    
<form method="POST">
    <h2>Calculadora</h2>
    <label for="a">Numero 1:</label>
    <input type="number" step="any" name="a" required>
    <br><br>

    <label for="b">Numero 2:</label>
    <input type="number" step="any" name="b" required>
<br><br>
    <label for="operacion">Operacion</label>
    <select name="operacion" required>
        <option value="suma">Suma</option>
        <option value="resta">Resta</option>
        <option value="multiplicacion">Multiplicacion</option>
        <option value="division">Division</option>
    </select>

    <input type="submit" value="Calcular">
</form>

<hr>
<?php
 function calcular($a, $b, $operacion){
    switch ($operacion) {
        case 'suma':
            return $a + $b;
            case 'resta':
                return $a-$b;
                case 'division':
                  return $a / $b;
                  case 'multiplicacion':
                    return $a * $b;
                    default:
                    return "operacion no valida";
          }
    }

    if ($_SERVER["REQUEST_METHOD"]== "POST") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $operacion = $_POST["operacion"];

        $resultado = calcular($a, $b, $operacion);

        echo "<h3>Resultado: $resultado</h3>";
    }
?>
    

<?php //Semana 2 dia 1
   $nombres=["juan", "pedro", "harry"];
   
   foreach ($nombres as $nombre) {
    echo "Alumno: $nombre <br>";
   }

   $personas =[
    "Eve " => "comandante",
    "Dani" => "capitan",
    "Luna" => "soldado",
    "Lupita" => "soldado",
    "Ana" => "soldado"
   ];

   foreach ($personas as $soldado => $rango) {
    echo "Nombre: $soldado y rango: $rango <br>";
   }
?>



    <form method='POST'>
        <h2>Semana 2 día 2</h2>
        <h3>Nombre: <input type='text' name='nombre'> </h3>
        <h3>Edad: <input type='number' name='edad'></h3>
        <h3>Arma favorita: <input type='text' name='arma'></h3>
        <input type="submit"value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"]== "POST") {
       $nombre = $_POST['nombre'];
       $edad = $_POST['edad'];
       $arma = $_POST['arma'];

       echo "Tu nombre es: $nombre y tu edad es $edad  y tu arma es: $arma .";
    }
    ?>
</body>
</html>