<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/stilo2.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   
</head>
<body>
 
    <div class="login-container" id="login-container">
        <h2>Iniciar Sesión</h2>
        <input type="text" id="username" placeholder="Usuario" value="juan">
        <input type="password" id="password" placeholder="Contraseña" value="1234">
        <button onclick="login()">Iniciar Sesión</button>
    </div>
    <div class="menu-container" id="menu-container">
        <h2>Menú Principal</h2>      
        <button onclick="option1()">Opción 1</button>
        <button onclick="option2()">Opción 2</button>
        <button onclick="option3()">Opción 3</button>
    </div>
    <div id="resultado"></div>
    <script>
        function login() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            if(username === 'juan' && password === '1234') {
                document.getElementById('login-container').style.display = 'none';
                document.getElementById('menu-container').style.display = 'block';
            } else {
                alert('Usuario o contraseña incorrectos.');
            }
        }
        
        function option1() { location.href = "lectura.php"  }
        function option2() { location.href = "MODULOS/captura.php"; }
        function option3() { alert('Opción 3 seleccionada'); }
        

    </script>
    
</script>
</body>
</html>
