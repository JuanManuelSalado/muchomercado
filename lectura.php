<div>HOLA MUNDO</div>
<?php
if (isset($_POST['parametro'])) {
  $parametroRecibido = $_POST['parametro'];
  echo "El parámetro recibido es: " . $parametroRecibido;
  //Aquí puedes hacer lo que necesites con el parámetro recibido, como interactuar con una base de datos
} else {
  echo "No se recibió ningún parámetro.";
}
?>