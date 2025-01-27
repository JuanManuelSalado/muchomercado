<!DOCTYPE html>
<html>
<head>
    <title>Página Dividida</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Asegura que el cuerpo ocupe al menos la altura de la ventana */
            margin: 0; /* Elimina márgenes predeterminados */
        }
        #contenedor {
            display: flex;
            flex: 1; /* Permite que el contenedor principal se expanda */
        }
        #bloque1, #bloque2, #bloque3 {
            border: 1px solid black;
            padding: 10px;
            flex: 1; /* Distribuye el espacio equitativamente */
            overflow: auto; /* Agrega scroll si el contenido se desborda */
        }
        #parte1, #parte2, #parte3 {
            border: 1px solid black;
            padding: 10px;
            flex: 1; /* Distribuye el espacio equitativamente */
            overflow: auto; /* Agrega scroll si el contenido se desborda */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
                
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: right; /* Alinea el texto a la derecha */
        }
        /* Estilo para inputs horizontales */
        .horizontal-inputs > * {
            display: inline-block; /* Muestra los elementos en línea */
            width: 15%; /* Ajusta el ancho según necesites */
            margin-right: 5px; /* Espacio entre inputs */
        }
    </style>
</head>
<body>

<div id="contenedor">
    <div id="bloque1">
        <div class="horizontal-inputs">
            <input type="text" id="codigo" placeholder="Código">
            <input type="text" id="nombre" placeholder="Nombre">
            <input type="number" id="cantidad" placeholder="Cantidad">
            <input type="number" id="precio" placeholder="Precio">
            <input type="number" id="total" placeholder="Total" readonly>
            <button onclick="agregarFila()">Agregar</button>
        </div>

        <table id="tablaDatos">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <button onclick="guardarDatos()">Guardar Datos</button>

        <script src="script.js"></script>
    </div>

    <div id="bloque2">

    
        <div id="parte1">
            <h2>Tabla de Datos</h2>
            <table id="tablaDatos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div id="parte2">
            <h2>Ingreso de Datos</h2>
            <form id="formularioDatos">
                Código: <input type="text" id="codigo" name="codigo"><br>
                Nombre: <input type="text" id="nombre" name="nombre"><br>
                Cantidad: <input type="number" id="cantidad" name="cantidad"><br>
                Precio: <input type="number" id="precio" name="precio"><br>
                Total: <input type="number" id="total" name="total" value="precio*candidad" readonly><br>
                <button type="button" onclick="agregarDatos()">Agregar</button>
            </form>
        </div>

        <div id="parte3">
            <h2>Características del Código</h2>
            <div id="caracteristicas">
                </div>
        </div>
    </div>
    <div id="bloque3">

    </div>
</div>

<script>
    function agregarDatos() {
        const codigo = document.getElementById("codigo").value;
        const nombre = document.getElementById("nombre").value;
        const cantidad = document.getElementById("cantidad").value;
        const precio = document.getElementById("precio").value;
        const total = cantidad * precio;

        document.getElementById("total").value = total;

        const tabla = document.getElementById("tablaDatos").getElementsByTagName('tbody')[0];
        const newRow = tabla.insertRow(tabla.rows.length);
        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        const cell3 = newRow.insertCell(2);
        const cell4 = newRow.insertCell(3);
        const cell5 = newRow.insertCell(4);

        cell1.innerHTML = codigo;
        cell2.innerHTML = nombre;
        cell3.innerHTML = cantidad;
        cell4.innerHTML = precio;
        cell5.innerHTML = total;

                // Llamada AJAX para obtener las características
        obtenerCaracteristicas(codigo);

        document.getElementById("formularioDatos").reset(); // Limpia el formulario
        document.getElementById("total").value = ""; // Limpia el campo total
    }

    function obtenerCaracteristicas(codigo) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("caracteristicas").innerHTML = this.responseText;
            }
        };
        xhr.open("GET", "obtener_caracteristicas.php?codigo=" + codigo, true); //cambia a post
        xhr.send();
    }
</script>

</body>
</html>
<?php
// obtener_caracteristicas.php
$conexion = new mysqli("localhost", "root", "", "muchomercado"); // Reemplaza con tus datos
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_GET['codigo'])) { //cambia a post
    $codigo = $_GET['codigo']; //cambia a post
    $sql = "SELECT * FROM caracteristicas WHERE codigo = '$codigo'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        echo "Descripción: " . $fila["descripcion"] . "<br>";
        echo "Peso: " . $fila["peso"] . "<br>";
        // ... muestra otras características
    } else {
        echo "Código no encontrado.";
    }
}
$conexion->close();
?>
<!-- Explicación:

HTML:
Divide la página en tres divs con flexbox para un diseño responsivo.
Crea una tabla en la primera parte para mostrar los datos.
Crea un formulario en la segunda parte con los campos necesarios.
Añade un campo "Total" que se calcula con JavaScript.
En la tercera parte se mostrarán las características.
JavaScript:
La función agregarDatos():
Obtiene los valores de los campos del formulario.
Calcula el total.
Agrega una nueva fila a la tabla con los datos ingresados.
Limpia el formulario después de agregar los datos.
Llama a la función obtenerCaracteristicas() para mostrar las características.
La función obtenerCaracteristicas():
Realiza una petición AJAX a obtener_caracteristicas.php para obtener la información del código.
Muestra la respuesta en el div #caracteristicas.
PHP (obtener_caracteristicas.php):
Recibe el código por GET. //cambia a post
Se conecta a la base de datos (recuerda configurar tus credenciales).
Ejecuta una consulta SQL para obtener las características del código.
Muestra las características o un mensaje si el código no se encuentra.
Base de datos:

Debes crear una tabla llamada caracteristicas en tu base de datos con al menos las columnas codigo, descripcion y peso (puedes agregar más según necesites).

Ejemplo de creación de tabla en MySQL:

CREATE TABLE caracteristicas (
    codigo VARCHAR(255) PRIMARY KEY,
    descripcion TEXT,
    peso DECIMAL(10, 2)
);
Mejoras importantes:

Validación: Agrega validación en JavaScript para asegurarte de que los campos no estén vacíos y que los tipos de datos sean correctos.
Manejo de errores: Mejora el manejo de errores en PHP y JavaScript para mostrar mensajes más informativos al usuario.
Seguridad: Utiliza consultas preparadas en PHP para prevenir inyecciones SQL.
Estilo: Mejora el estilo CSS para una mejor presentación.
Método POST: Usar el método POST para enviar datos al script PHP es más seguro, especialmente para datos sensibles. He añadido comentarios en el código indicando dónde realizar los cambios.
Conexión a la base de datos: Asegúrate de configurar correctamente la conexión a tu base de datos en el archivo PHP.
Este ejemplo te proporciona una base sólida para tu proyecto. Recuerda implementar las mejoras mencionadas para una aplicación más robusta y segura. -->