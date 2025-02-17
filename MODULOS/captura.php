<!DOCTYPE html>
<html>
<head>
    <title>Página Dividida</title>
    <style>
        body {
            font-family: "Lucida Console", Courier, monospace;
            border-color: #71d926;
            border-width: 2px;
            border-style: dashed;
            color: #71d926;
            background-color: #000;
            margin: 2px;
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
            border: 1px solid;
            padding: 10px;
            flex: 1; /* Distribuye el espacio equitativamente */
            overflow: auto; /* Agrega scroll si el contenido se desborda */
        }
        #parte1, #parte2, #parte3 {
            border: 1px solid;
            padding: 10px;
            flex: 1; /* Distribuye el espacio equitativamente */
            overflow: auto; /* Agrega scroll si el contenido se desborda */
        }
        #parte3 {
            background-color: #FFF;
        }
        #bloque2{
            background-color: #FFF;
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
        .horizontal_inputs > * {
            display: inline-block; /* Muestra los elementos en línea */
            width: 15%; /* Ajusta el ancho según necesites */
            margin-right: 5px; /* Espacio entre inputs */
        }
        #bloque1{
            border: 1px solid green;
            padding: 8px;
            text-align: center; /* Alinea el texto a la derecha */
        }
        .cuadro{
            border: 3px solid green;
            padding: 8px;
            text-align: center; /* Alinea el texto a la derecha */
        }
    </style>
</head>
<body>

<div id="contenedor">
    <div id="bloque1"> 
        <h1>Primera prueba de captura</h1>
        <div class="cuadro">
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
            <div class="horizontal_inputs">
                <input type="text" id="codigo" placeholder="Código">
                <input type="text" id="nombre" placeholder="Nombre">
                <input type="number" id="cantidad" placeholder="Cantidad">
                <input type="number" id="precio" placeholder="Precio">
                <input type="number" id="total" placeholder="Total" readonly>
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
