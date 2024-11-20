<?php
session_start(); // Iniciar sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header('Location: login.html'); // Redirigir si no está autenticado
    exit();
}

// Obtener el nombre de usuario
$username = $_SESSION['username'];
?>

<script>
    // Mostrar mensaje de bienvenida en un alert
    alert("¡Bienvenido, <?php echo htmlspecialchars($username); ?>!");
</script>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Carga Dinámica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .navbar {
            display: flex;
            align-items: center;
            background-color: #4CAF50;
            padding: 8px 10px;
            color: white;
            font-size: 12px;
        }

        .navbar .logo {
            width: 80px;
            height: 50px;
            margin-right: 15px;
        }

        .navbar select, .navbar input[type="text"] {
            padding: 8px 12px;
            font-size: 12px;
            border-radius: 4px;
            border: 1px solid #ddd;
            margin-right: 10px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .navbar select:hover, .navbar input[type="text"]:hover {
            background-color: #e8f5e9;
            border-color: #4CAF50;
        }

        .navbar .logout-button {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .navbar .logout-button img {
            width: 25px;
            height: auto;
            margin-right: 5px;
        }

        .navbar .logout-button:hover {
            background-color: #f8d7da;
        }

        .content-container {
            padding: 15px;
        }

        .content-iframe {
            width: 100%;
            height: 600px;
            border: none;
        }

        /* Estilo del modal de confirmación */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .modal-content h3 {
            margin-bottom: 15px;
        }

        .modal-content button {
            padding: 8px 12px;
            margin: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .modal-content .confirm {
            background-color: #4CAF50;
            color: white;
        }

        .modal-content .confirm:hover {
            background-color: #45a049;
        }

        .modal-content .cancel {
            background-color: #f44336;
            color: white;
        }

        .modal-content .cancel:hover {
            background-color: #e53935;
        }
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<body>

    <!-- Barra superior con logo, select y botón de cerrar sesión -->
    <div class="navbar">
        <img src="CFE.png" alt="Logo" class="logo">
        
        <!-- Buscador -->
       <head>
  <!-- Agregar Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  
  <style>
    h3 {
      font-size: 14px; /* Tamaño de la fuente más pequeño */
      color: #000000; /* Color del texto más oscuro */
      text-align: center; /* Alinear el texto al centro */
      margin-bottom: 10px; /* Espaciado inferior */
      font-family: 'Arial', sans-serif; /* Cambiar el tipo de letra */
      text-transform: lowercase; /* Convertir texto a minúsculas */
      letter-spacing: 1px; /* Espaciado entre letras */
      border-radius: 5px; /* Bordes redondeados más sutiles */
      padding: 5px; /* Espaciado interno reducido */
      box-shadow: none; /* Sin sombra */
      display: flex; /* Usar flexbox para alinear el ícono y el texto */
      align-items: center; /* Alinear verticalmente */
      justify-content: center; /* Centrar horizontalmente */
      border: none; /* Sin contorno */
      background-color: transparent; /* Sin fondo */
    }

    /* Estilo para el ícono */
    h3 i {
      margin-right: 5px; /* Espaciado a la derecha del ícono */
      color: #e67e22; /* Color para el ícono (naranja) */
    }
  </style>
</head>

<body>
  <h3><i class="fas fa-chart-line"></i> graficar indicador:</h3>
  <input type="text" id="searchInput" placeholder="Buscar...">
</body>





        <select id="pageSelect">
            <option value="" disabled selected>Vistas por agencias</option>
            <option value="../vistas/indexComitan.php">Página Comitan</option>
            <option value="../vistas/indexMargaritas.php">Página Margaritas</option>
            <option value="../vistas/indexSanCristobal.php">Página San Cristóbal</option>
            <option value="../vistas/indexCarranza.php">Página Carranza</option>
            <option value="../vistas/indexAcala.php">Página Acala</option>
            <option value="../vistas/indexChenalho.php">Página Chenalho</option>
            <option value="../vistas/indexComalapa.php">Página Comalapa</option>
            <option value="../vistas/indexTeopisca.php">Página Teopisca</option>
            <option value="../vistas/indexYajalon.php">Página Yajalon</option>
            <option value="../vistas/indexOcosingo.php">Página Ocosingo</option>
           <!-- <option value="../pruebas.php">Graficar</option>-->
           
          
        </select>

        <select id="pageSelect2">
            <option value="" disabled selected>Reporte Mensual De Agencias</option>
            <option value="../VMensualAgencias/enero.php">Enero</option>
            <option value="../VMensualAgencias/febrero.php">Febrero</option>
            <option value="../VMensualAgencias/marzo.php">Marzo</option>
            <option value="../VMensualAgencias/abril.php">Abril</option>
            <option value="../VMensualAgencias/mayo.php">Mayo</option>
            <option value="../VMensualAgencias/junio.php">Junio</option>
            <option value="../VMensualAgencias/julio.php">Julio</option>
            <option value="../VMensualAgencias/agosto.php">Agosto</option>
            <option value="../VMensualAgencias/septiembre.php">Septiembre</option>
            <option value="../VMensualAgencias/octubre.php">Octubre</option>
            <option value="../VMensualAgencias/noviembre.php">Noviembre</option>
            <option value="../VMensualAgencias/diciembre.php">Diciembre</option>
        </select>

        <button class="logout-button" id="logoutButton">
            <img src="../Imagenes/salida.png" alt="Cerrar sesión">
            Salir
        </button>
    </div>

    <!-- Contenedor dinámico de contenido -->
    <div class="content-container" id="contentContainer">
        <h2>Bienvenido</h2>
        <p>Selecciona una página del menú para cargar su contenido aquí sin recargar la página.</p>
    </div>

    <!-- Modal de confirmación de cierre de sesión -->
    <div class="modal" id="logoutModal">
        <div class="modal-content">
            <h3>¿Estás seguro que deseas cerrar sesión?</h3>
            <button class="confirm" id="confirmLogout">Sí</button>
            <button class="cancel" id="cancelLogout">No</button>
        </div>
    </div>

    <script>
        // Capturar los select, el buscador y el contenedor de contenido
        const pageSelect = document.getElementById('pageSelect');
        const pageSelect2 = document.getElementById('pageSelect2');
        const searchInput = document.getElementById('searchInput');
        const contentContainer = document.getElementById('contentContainer');

        function loadPage(selectedPage) {
            if (selectedPage === "../pruebas.php") {
                contentContainer.innerHTML = '<iframe src="' + selectedPage + '" class="content-iframe"></iframe>';
            } else {
                contentContainer.innerHTML = '<p>Cargando contenido...</p>';
                fetch(selectedPage)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al cargar la página');
                        }
                        return response.text();
                    })
                    .then(data => {
                        contentContainer.innerHTML = data;
                    })
                    .catch(error => {
                        contentContainer.innerHTML = '<p>Hubo un problema al cargar el contenido.</p>';
                        console.error(error);
                    });
            }
        }

        // Listener para la selección de las páginas
        pageSelect.addEventListener('change', function() {
            loadPage(pageSelect.value);
        });

        pageSelect2.addEventListener('change', function() {
            loadPage(pageSelect2.value);
        });

        // Listener para el buscador
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const searchTerm = searchInput.value.trim();
                if (searchTerm.toLowerCase() === 'imu') {
                    loadPage('../pruebas.php');
                }
            }
        });
        pageSelect.addEventListener('change', function() {
            loadPage(pageSelect.value);
        });

        pageSelect2.addEventListener('change', function() {
            loadPage(pageSelect2.value);
        });

        // Listener para el buscador
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                const searchTerm = searchInput.value.trim();
                if (searchTerm.toLowerCase() === 'comser') {
                    loadPage('../index.html');
                }
            }
        })

        // Listener para el botón de cerrar sesión
        document.getElementById('logoutButton').addEventListener('click', function() {
            document.getElementById('logoutModal').style.display = 'flex';
        });

        // Listener para confirmar cierre de sesión
        document.getElementById('confirmLogout').addEventListener('click', function() {
            window.location.href = '../conexion/logout.php'; // Cambiar a la ruta de tu script de logout
        });

        // Listener para cancelar cierre de sesión
        document.getElementById('cancelLogout').addEventListener('click', function() {
            document.getElementById('logoutModal').style.display = 'none';
        });
    </script>
</body>
</html>
