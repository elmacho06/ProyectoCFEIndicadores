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
            <option value="../vistas/indexComitan.php">Página DK03A</option>
            <option value="../vistas/indexMargaritas.php">Página DK03M</option>
            <option value="../vistas/indexSanCristobal.php">Página DK03E</option>
            <option value="../vistas/indexCarranza.php">Página DK03H</option>
            <option value="../vistas/indexAcala.php">Página DK03R</option>
            <option value="../vistas/indexChenalho.php">Página DK03F</option>
            <option value="../vistas/indexComalapa.php">Página DK03J</option>
            <option value="../vistas/indexTeopisca.php">Página DK03L</option>
            <option value="../vistas/indexYajalon.php">Página DK03D</option>
            <option value="../vistas/indexOcosingo.php">Página DK03C</option>
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
        <div id="buttonContainer">
    <button onclick="navigateToPage('../generalidades/reconocimiento.html')">
        Generar Reconocimiento
    </button>
    <button onclick="navigateToPage('../generalidades/pruebainsercion.php')">
        Actualizar Contraseña
    </button>
</div>
<style>
  #buttonContainer {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 0; /* Sin margen superior */
  }

  #buttonContainer button {
    background-color: #007bff; /* Color azul */
    color: white;
    border: none;
    border-radius: 5px;
    padding: 8px 16px; /* Padding reducido para botones más pequeños */
    font-size: 14px; /* Tamaño de fuente reducido */
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  #buttonContainer button:hover {
    background-color: #0056b3; /* Azul más oscuro al pasar el cursor */
    transform: scale(1.05); /* Ligeramente más grande */
  }

  #buttonContainer button:active {
    transform: scale(0.95); /* Más pequeño al hacer clic */
  }
</style>
<script>
    function navigateToPage(url) {
        if (url) {
            // Redirigir al usuario al enlace proporcionado
            window.location.href = url;
        }
    }
</script>



        <button class="logout-button" id="logoutButton">
            <img src="../Imagenes/salida.png" alt="Cerrar sesión">
            Salir
        </button>
        <div class="modal" id="logoutModal">
        <div class="modal-content">
            <h3>¿Estás seguro que deseas cerrar sesión?</h3>
            <button class="confirm" id="confirmLogout">Sí</button>
            <button class="cancel" id="cancelLogout">No</button>
        </div>
    </div>
    </div>
    <script>
        // Elementos del DOM
        const logoutButton = document.getElementById("logoutButton");
        const logoutModal = document.getElementById("logoutModal");
        const confirmLogout = document.getElementById("confirmLogout");
        const cancelLogout = document.getElementById("cancelLogout");

        // Mostrar el modal al hacer clic en "Salir"
        logoutButton.addEventListener("click", () => {
            logoutModal.style.display = "flex";
        });

        // Confirmar cierre de sesión
        confirmLogout.addEventListener("click", () => {
            // Aquí puedes agregar la lógica para cerrar sesión, por ejemplo:
            window.location.href = "../index.html"; // Redirigir a una página de cierre de sesión
        });

        // Cancelar cierre de sesión
        cancelLogout.addEventListener("click", () => {
            logoutModal.style.display = "none"; // Ocultar el modal
        });

        // Cerrar el modal al hacer clic fuera de él
        window.addEventListener("click", (event) => {
            if (event.target === logoutModal) {
                logoutModal.style.display = "none";
            }
        });
    </script>

    <!-- Contenedor dinámico de contenido -->
    <div class="content-container" id="contentContainer">
    <div class="carousel-container">
        <div class="carousel">
            <!-- Imágenes originales -->
            <img src="../imagenes/cfehome.png" alt="Imagen 1" class="carousel-image">
            <img src="../imagenes/cfehome1.jpg" alt="Imagen 2" class="carousel-image">
            <img src="../imagenes/cfehome2.jpg" alt="Imagen 3" class="carousel-image">
            <img src="../imagenes/cfehome3.jpg" alt="Imagen 4" class="carousel-image">
            <img src="../imagenes/CFE.jpeg" alt="Imagen 5" class="carousel-image">
            <!-- Imágenes duplicadas para efecto cíclico -->
            <img src="../imagenes/cfehome.png" alt="Imagen 1 Duplicada" class="carousel-image">
            <img src="../imagenes/cfehome1.jpg" alt="Imagen 2 Duplicada" class="carousel-image">
            <img src="../imagenes/cfehome2.jpg" alt="Imagen 3 Duplicada" class="carousel-image">
            <img src="../imagenes/cfehome3.jpg" alt="Imagen 4 Duplicada" class="carousel-image">
            <img src="../imagenes/CFE.jpeg" alt="Imagen 5 Duplicada" class="carousel-image">
        </div>
    </div>
</div>
<div class="cfe-title">
    <h2>Conoce CFE y los Servicios que Ofrecemos</h2>
  </div>
<div class="cfe-info">
  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/325/PNG/256/Question-mark-icon_34771.png" alt="Icono Empresa" class="panel-icon">
    <h3>¿Quiénes somos?</h3>
    <p>Somos la Comisión Federal de Electricidad (CFE), la empresa encargada de proveer energía eléctrica a todo México.</p>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/1077/PNG/512/information_77957.png" alt="Icono Servicios" class="panel-icon">
    <h3>¿Qué hacemos?</h3>
    <p>Generamos, distribuimos y comercializamos electricidad, impulsando el desarrollo energético del país.</p>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/39/PNG/128/servicesconfig_servicios_6119.png" alt="Icono Servicios Eléctricos" class="panel-icon">
    <h3>Servicios</h3>
    <ul>
      <li><a href="https://www.cfe.mx/servicios_externos/Paginas/default.aspx" target="_blank">Servicios Externos</a></li>
      <li><a href="https://www.cfe.mx/hogar/infcliente/pages/catalogo-tramites.aspx" target="_blank">Trámites y Servicios</a></li>
      <li><a href="https://www.revistainfraestructura.com.mx/los-proyectos-de-infraestructura-electrica-mas-importantes-del-2024/" target="_blank">Proyectos e infraestructura eléctrica</a></li>
    </ul>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/179/PNG/128/news_128x128-32_22252.png" alt="Icono Noticias" class="panel-icon">
    <h3>Noticias Relevantes</h3>
    <p>Conoce las últimas noticias sobre CFE y los proyectos que impactan al país:</p>
    <ul>
      <li><a href="https://app.cfe.mx/Aplicaciones/OTROS/Boletines/Prensa" target="_blank">Sala de prensa CFE</a></li>
    </ul>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/4215/PNG/512/recruitment_employee_search_talent_acquisition_hiring_process_icon_262948.png" alt="Icono Contratación" class="panel-icon">
    <h3>Procedimientos de Contratación y Venta de Bienes</h3>
    <p><a href="https://www.cfe.mx/concursoscontratos/pages/default.aspx" target="_blank">Conoce los procedimientos para contratar bienes y servicios con CFE.</a></p>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/3087/PNG/512/lines_electricity_electrical_energy_cable_icon_191370.png" alt="Icono Ahorro de Energía" class="panel-icon">
    <h3>Ahorro de Energía</h3>
    <p><a href="https://www.gob.mx/semarnat/articulos/consejos-para-ahorrar-energia-en-casa#:~:text=Aprovecha%20al%20m%C3%A1ximo%20la%20luz%20natural%3B%20utiliza%20la%20energ%C3%ADa%20el%C3%A9ctrica,%2C%20horno%20de%20microondas%2C%20dvd." target="_blank">Infórmate sobre cómo ahorrar energía y contribuir al medio ambiente.</a></p>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/1165/PNG/512/1488492642-people07_81742.png" alt="Icono Desarrollo Social" class="panel-icon">
    <h3>Desarrollo Social</h3>
    <p><a href="https://www.cfe.mx/desarrollo_social/pages/default.aspx" target="_blank">Descubre cómo CFE impulsa el desarrollo social a través de sus programas.</a></p>
  </div>

  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/1465/PNG/512/701electricplug_100845.png" alt="Icono Contrataciones Electrónicas" class="panel-icon">
    <h3>Sistema Electrónico de Contrataciones</h3>
    <p><a href="https://www.gob.mx/sfp/documentos/conoce-el-estudio-del-sistema-electronico-de-contratacion-publica-en-mexico" target="_blank">Accede al sistema electrónico para contrataciones públicas.</a></p>
  </div>
  <div class="info-panel">
    <img src="https://cdn.icon-icons.com/icons2/8/PNG/256/night_rain_weather_1464.png" alt="Icono Contrataciones Electrónicas" class="panel-icon">
    <h3>Micrositio Huracán Otis</h3>
    <p><a href="https://www.cfe.mx/huracanotis/Pages/default.aspx" target="_blank">Micrositio Especial sobre el Huracán Otis</a></p>
  </div>
  
</div>

<!-- Franja de redes sociales con iconos y dirección -->
<div class="social-bar">
  <h3>Síguenos en nuestras redes sociales:</h3>
  <div class="social-icons">
    <a href="https://www.facebook.com/CFE" target="_blank">
      <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" alt="Facebook" class="social-icon">
    </a>
    
    <a href="https://www.instagram.com/cfemexico/" target="_blank">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/95/Instagram_logo_2022.svg/1024px-Instagram_logo_2022.svg.png" alt="Instagram" class="social-icon">
    </a>
    <a href="https://www.youtube.com/user/CFEMexico" target="_blank">
      <img src="https://upload.wikimedia.org/wikipedia/commons/4/42/YouTube_icon_%282013-2017%29.png" alt="YouTube" class="social-icon">
    </a>
  </div>

  <div class="contact-info">
    <p><strong>Dirección:</strong> Calzada del Cementerio, Barrio de Fátima, Número 16, San Cristóbal de las Casas, Chiapas</p>
    <p><a href="https://www.google.com/maps?q=Calzada+del+Cementerio,+Barrio+de+Fátima,+Número+16,+San+Cristóbal+de+las+Casas,+Chiapas" target="_blank">Ver en Google Maps</a></p>
  </div>
</div>

<script>
    
</script>
<style>
 .cfe-title {
  text-align: center; /* Centra el texto */
  margin: 40px 0; /* Espaciado arriba y abajo */
}

.cfe-title h2 {
  font-size: 32px; /* Aumenta el tamaño del texto */
  font-weight: bold; /* Pone el texto en negrita */
  color: #1E2A3D; /* Color gris oscuro */
  font-family: 'Roboto', sans-serif; /* Fuente moderna y profesional */
  text-transform: uppercase; /* Mayúsculas */
  letter-spacing: 4px; /* Espacio entre letras */
  position: relative; /* Necesario para colocar la línea debajo */
}

.cfe-title h2::after {
  content: ""; /* Crea una línea */
  position: absolute;
  bottom: -10px; /* Coloca la línea un poco debajo del texto */
  left: 50%;
  transform: translateX(-50%); /* Centra la línea */
  width: 80%; /* Ajusta el largo de la línea */
  height: 3px; /* Altura de la línea */
  background-color: #FF5733; /* Color naranja para la línea */
  border-radius: 2px; /* Bordes redondeados de la línea */
}



  .carousel-container {
      position: relative;
      max-width: 1200px;
      margin: auto;
      overflow: hidden;
      border: 3px solid green;
  }

  .carousel {
      display: flex;
      animation: scrollCarousel 15s linear infinite;
  }

  .carousel-image {
      width: 100%;
      height: 270px;
      object-fit: cover;
  }

  /* Animación de desplazamiento infinito */
  @keyframes scrollCarousel {
      0% {
          transform: translateX(0);
      }
      100% {
          transform: translateX(-50%);
      }
  }

  .prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    padding: 15px;
    cursor: pointer;
    font-size: 24px;
  }

  .prev {
    left: 10px;
  }

  .next {
    right: 10px;
  }

  .cfe-info {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 40px;
  }

  .info-panel {
    background-color: white;
    border: 2px solid #ccc;
    border-radius: 8px;
    padding: 20px;
    width: 28%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  }

  .panel-icon {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
  }

  .info-panel h3 {
    font-size: 1.5em;
    margin-bottom: 10px;
  }

  .info-panel a {
    color: #4CAF50;
    text-decoration: none;
  }

  .info-panel a:hover {
    text-decoration: underline;
  }

  .social-bar {
    background-color: #333;
    color: white;
    padding: 20px;
    text-align: center;
    margin-top: 50px;
  }

  .social-icons a {
    margin: 0 15px;
  }

  .social-icons img {
    width: 40px;
    height: 40px;
  }

  .contact-info {
    margin-top: 20px;
  }

  @media (max-width: 768px) {
    .info-panel {
      width: 48%;
    }
  }

  @media (max-width: 480px) {
    .info-panel {
      width: 100%;
    }
  }

.cfe-info, .social-bar {
  margin-left: 50px; /* Ajusta este valor para mover más a la derecha */
  max-width: 1600px; /* Controla el ancho máximo del contenido */
}

</style>

    <!-- Modal de confirmación de cierre de sesión -->
   

    <script>
        // Capturar los select, el buscador y el contenedor de contenido
        const pageSelect = document.getElementById('pageSelect');
        const pageSelect2 = document.getElementById('pageSelect2');
        const pageSelect3 = document.getElementById('pageSelect3');
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

        pageSelect3.addEventListener('change', function() {
            loadPage(pageSelect3.value);
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

<script>
function exportToExcel(month) {
    var table = document.getElementById("tabla-acumulado");
    var html = table.outerHTML;

    // Añadir el título al contenido HTML con colspan='31'
    var title = `
        <table>
            <tr>
                <th colspan="31" 
                    style="
                        text-align: center; 
                        font-size: 24px; 
                        font-weight: bold; 
                        background-color: #4CAF50; 
                        color: white; 
                        padding: 15px 0;
                        border: 1px solid #ddd;
                    ">
                    Valor mensual de agencias ${month}
                </th>
            </tr>
        </table>
    `;
    
    // Añadir algo de estilo básico
    var style = `
        <style>
            table { border-collapse: collapse; width: 100%; margin: 20px 0; }
            th, td { padding: 10px 15px; text-align: center; border: 1px solid #ddd; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #ddd; }
        </style>
    `;
    
    // Combinar el título, el estilo y la tabla
    html = style + title + html;
    
    // Crear el archivo Excel
    var uri = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    window.open(uri);
}
</script>
<script>
function exportToExcel() {
    var table = document.getElementById("tabla-acumulado");
    var html = table.outerHTML;
    
    // Añadir algo de estilo básico
    var style = `
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px 12px; text-align: left; border: 1px solid #ddd; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #ddd; }
        </style>
    `;
    
    // Agregar el estilo al contenido HTML
    html = style + html;
    
    // Crear el archivo Excel
    var uri = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    var x = window.open(uri);
    return x;
}
</script>
<script>
function exportToExcele() {
    var table = document.getElementById("acumulados");
    var html = table.outerHTML;
    
    // Añadir algo de estilo básico
    var style = `
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px 12px; text-align: left; border: 1px solid #ddd; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
            tr:hover { background-color: #ddd; }
        </style>
    `;
    
    // Agregar el estilo al contenido HTML
    html = style + html;
    
    // Crear el archivo Excel
    var uri = 'data:application/vnd.ms-excel,' + encodeURIComponent(html);
    var x = window.open(uri);
    return x;
}
</script>
 <script>
        const dateElement = document.getElementById('auto-date');
        const currentDate = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = currentDate.toLocaleDateString('es-ES', options);
        dateElement.textContent = `San Cristóbal de las Casas, ${formattedDate}`;
    </script>