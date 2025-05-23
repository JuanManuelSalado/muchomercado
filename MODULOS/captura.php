<!DOCTYPE html>
<html>
<head>
    <title>Página Dividida</title>
    <link rel="stylesheet" type="text/css" href="../css/stilo3.css">
    </head>
<body>
    <!-- bloque del primer contenedor -->
<div id="contenedor">
    <div id="bloque1"> 
        <h1>Primera prueba de captura</h1>
        <div class="cuadro">
            <!-- la cabecera del primer contenedor -->
            <table id="tablaDatos2">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>
            <!-- los imput del primer contenedor -->
            <div class="horizontal_inputs">
                <input type="text" id="codigo" placeholder="Código">
                <input type="text" id="nombre" placeholder="Nombre">
                <input type="number" id="cantidad" placeholder="Cantidad">
                <input type="number" id="precio" placeholder="Precio">
                <input type="number" id="total" placeholder="Total" readonly>
                <!-- la funcion agregarFila esta en script.js  -->

                <button onclick="agregarFila()">Agregar</button> 
            </div>
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
            <table id="tablaDatos1">
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
            <form id="formularioDatos1">
                Código: <input type="text" id="codigo1" name="codigo"><br>
                Nombre: <input type="text" id="nombre1" name="nombre"><br>
                Cantidad: <input type="number" id="cantidad1" name="cantidad"><br>
                Precio: <input type="number" id="precio1" name="precio"><br>
                Total: <input type="number" id="total1" name="total" readonly><br>
            </form>
            <button type="button" onclick="agregarDatos1()">Agregar</button>
        </div>

        <div id="parte3">
            <h2>Características del Código</h2>
            <div id="caracteristicas">
                <h1>hola mundo</h1>
            </div>
        </div>
    </div>
    <div id="bloque3">
<!-- bloque vacio -->
    </div>
</div>

<script>

function calcularTotal1() {
    let cantidad1 = parseFloat(document.getElementById("cantidad1").value) || 0;
    let precio1 = parseFloat(document.getElementById("precio1").value) || 0;
    document.getElementById("total1").value = cantidad1 * precio1;
}

    document.getElementById("cantidad1").addEventListener("input", calcularTotal1);
    document.getElementById("precio1").addEventListener("input", calcularTotal1);

    function agregarDatos1() {
        const codigo1 = document.getElementById("codigo1").value;
        const nombre1 = document.getElementById("nombre1").value;
        const cantidad1 = document.getElementById("cantidad1").value;
        const precio1 = document.getElementById("precio1").value;
        const total1 = cantidad1 * precio1;

        document.getElementById("total1").value = total1;

        const tabla = document.getElementById("tablaDatos1").getElementsByTagName('tbody')[0];
        const newRow = tabla.insertRow(tabla.rows.length);
        const cell1 = newRow.insertCell(0);
        const cell2 = newRow.insertCell(1);
        const cell3 = newRow.insertCell(2);
        const cell4 = newRow.insertCell(3);
        const cell5 = newRow.insertCell(4);

        cell1.innerHTML = codigo1;
        cell2.innerHTML = nombre1;
        cell3.innerHTML = cantidad1;
        cell4.innerHTML = precio1;
        cell5.innerHTML = total1;

                // Llamada AJAX para obtener las características
        
        obtenerCaracteristicas(codigo1);

        document.getElementById("formularioDatos1").reset(); // Limpia el formulario
        document.getElementById("total1").value = ""; // Limpia el campo total
    }

    async function obtenerCaracteristicas(codigo1) {
    const caracteristicasDiv = document.getElementById("caracteristicas");
    caracteristicasDiv.innerHTML = "Loading...";
        

    try {
        const response = await fetch("obtener.php?codigo1=" + codigo1);
        if (!response.ok) {
            alert("Estoy dentro" + codigo1) ;
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.text(); // or response.json() if the data is JSON
        alert("imprimir datos) ;
        caracteristicasDiv.innerHTML = data;
    } catch (error) {
        alert("Código no encontrado." + codigo1) ;
        console.error("Error:", error);
        caracteristicasDiv.innerHTML = "Error loading data.";
    }
}
</script>

</body>
</html>
