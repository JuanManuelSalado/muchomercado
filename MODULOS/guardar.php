<?php
$servername = "localhost"; // Reemplazar
$username = "root";      // Reemplazar
$password = "";          // Reemplazar
$dbname = "muchomercado"; // Reemplazar

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (is_array($data)) {
    foreach ($data as $row) {
        $codigo = $conn->real_escape_string($row['codigo']);
        $nombre = $conn->real_escape_string($row['nombre']);
        $cantidad = $conn->real_escape_string($row['cantidad']);
        $precio = $conn->real_escape_string($row['precio']);
        $total = $conn->real_escape_string($row['total']);

        $sql = "INSERT INTO productos (codigo, nombre, cantidad, precio, total) VALUES ('$codigo', '$nombre', '$cantidad', '$precio', '$total')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error al guardar registro: " . $conn->error;
            exit; // Detiene la ejecución en caso de error
        }
    }
    echo "Datos guardados correctamente 3";
} else {
    echo "No se recibieron datos válidos";
}

$conn->close();
?>