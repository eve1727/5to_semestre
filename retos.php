<?php  //reto D1
  echo "FIGHTHING :) LOBA LOBA!!";
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


<?php   //2D
    //Esta en index.php

?>
