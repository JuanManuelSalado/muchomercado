function calcularTotal() {
    let cantidad = parseFloat(document.getElementById("cantidad").value) || 0;
    let precio = parseFloat(document.getElementById("precio").value) || 0;
    document.getElementById("total").value = cantidad * precio;
}

document.getElementById("cantidad").addEventListener("input", calcularTotal);
document.getElementById("precio").addEventListener("input", calcularTotal);

function agregarFila() {
    let codigo = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let cantidad = document.getElementById("cantidad").value;
    let precio = document.getElementById("precio").value;
    let total = document.getElementById("total").value;

    let tabla = document.getElementById("tablaDatos").getElementsByTagName('tbody')[0];
    let newRow = tabla.insertRow(tabla.rows.length);
    let cell1 = newRow.insertCell(0);
    let cell2 = newRow.insertCell(1);
    let cell3 = newRow.insertCell(2);
    let cell4 = newRow.insertCell(3);
    let cell5 = newRow.insertCell(4);

    cell1.innerHTML = codigo;
    cell2.innerHTML = nombre;
    cell3.innerHTML = cantidad;
    cell4.innerHTML = precio;
    cell5.innerHTML = total;

    // Limpia los campos de entrada después de agregar la fila
    document.getElementById("codigo").value = "";
    document.getElementById("nombre").value = "";
    document.getElementById("cantidad").value = "";
    document.getElementById("precio").value = "";
    document.getElementById("total").value = "";
}

function guardarDatos() {
    let tabla = document.getElementById("tablaDatos");
    let filas = tabla.rows;
    let datos = [];

    for (let i = 1; i < filas.length; i++) { // Empieza desde 1 para omitir el encabezado
        let celdas = filas[i].cells;
        datos.push({
            codigo: celdas[0].innerHTML,
            nombre: celdas[1].innerHTML,
            cantidad: celdas[2].innerHTML,
            precio: celdas[3].innerHTML,
            total: celdas[4].innerHTML
        });
    }

    // Enviar datos a PHP usando fetch API
    fetch('guardar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra la respuesta del servidor
        if (data === "Datos guardados correctamente") { // Comprueba la respuesta específica
            let tablaBody = document.getElementById("tablaDatos").getElementsByTagName('tbody')[0];
            tablaBody.innerHTML = ""; // Vacía el contenido del tbody
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}