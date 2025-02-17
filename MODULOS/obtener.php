<?php
$servername = "localhost"; // Reemplazar
$username = "root";      // Reemplazar
$password = "";          // Reemplazar
$dbname = "muchomercado"; // Reemplazar

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_GET['codigo1'])) { //cambia a post
    echo "comparando código.";
    $codigo = $_GET['codigo1']; //cambia a post
    $sql = "SELECT * FROM caracteristicas WHERE codigo1 = '$codigo1'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        echo "Código encontrado.";
        $fila = $resultado->fetch_assoc();
        echo "Descripción: " . $fila["descripcion"] . "<br>";
        echo "Peso: " . $fila["peso"] . "<br>";
        // ... muestra otras características
    } else {
        echo "Código no encontrado.";
    }
}
$conn->close();
?>
