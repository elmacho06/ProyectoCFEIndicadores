<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ejemplo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);


// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar solicitud AJAX
if (isset($_GET['month'])) {
    $month = strtolower($_GET['month']);
    
    // Consulta SQL dependiendo del mes
    if ($month === 'enero') {
        $sql = "SELECT indice, meta, tolerancia, reales FROM comitam LIMIT 12";
    } elseif ($month === 'febrero') {
        $sql = "SELECT indice, meta1 AS meta, tolerancia1 AS tolerancia, reales1 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'marzo') {
        $sql = "SELECT indice, meta2 AS meta, tolerancia2 AS tolerancia, reales2 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'abril') {
        $sql = "SELECT indice, meta3 AS meta, tolerancia3 AS tolerancia, reales3 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'mayo') {
        $sql = "SELECT indice, meta4 AS meta, tolerancia4 AS tolerancia, reales4 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'junio') {
        $sql = "SELECT indice, meta5 AS meta, tolerancia5 AS tolerancia, reales5 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'julio') {
        $sql = "SELECT indice, meta6 AS meta, tolerancia6 AS tolerancia, reales6 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'agosto') {
        $sql = "SELECT indice, meta7 AS meta, tolerancia7 AS tolerancia, reales7 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'septiembre') {
        $sql = "SELECT indice, meta8 AS meta, tolerancia8 AS tolerancia, reales8 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'octubre') {
        $sql = "SELECT indice, meta9 AS meta, tolerancia9 AS tolerancia, reales9 AS reales FROM comitam LIMIT 12";
    } elseif ($month === 'noviembre') {
        $sql = "SELECT indice, meta10 AS meta, tolerancia10 AS tolerancia, reales10 AS reales FROM comitam LIMIT 12";
    } 
    elseif ($month === 'diciembre') {
        $sql = "SELECT indice, meta11 AS meta, tolerancia11 AS tolerancia, reales11 AS reales FROM comitam LIMIT 12";
    } 
    // Agregar aquí los otros casos de meses
    else {
        echo json_encode([]);
        exit;
    }

    $result = $conn->query($sql);

    $data = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    } else {
        echo json_encode([]);
        exit;
    }

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
    $conn->close();
    exit;
}
?>

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
<!DOCTYPE html>
<html lang="es">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background-color: #338b3f;
            padding: 8px 10px;
            color: white;
            font-size: 12px;
        }

        .navbar .logo {
    width: 180px;
    height: 100px;
    margin-right: 15px;
    box-shadow: 0 0 8px 4px rgba(0, 0, 0, 0.3); /* Sombra más compacta y ligera */
    border-radius: 10px;
}

        .navbar select {
            padding: 8px 12px;
            margin: 0 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 2px solid #007bff;
            background-color: #f8f9fa;
            color: #495057;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar select:hover {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .navbar .logout-button {
            margin-left: auto;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
        }

        .navbar .logout-button img {
            width: 25px;
            height: auto;
        }

        button {
            background-color: #4CAF50;
            border: 2px solid #ffffff;
            color: white;
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 12px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button a {
            color: white;
            text-decoration: none;
            display: block;
        }

        button:hover {
            background-color: #45a049;
            transform: scale(1.05);
            border-color: #000000;
        }

        .content-container {
            padding: 15px;
        }

        h1 {
            text-align: left;
            margin-left: 28%;
            transform: translateX(-50%);
        }

        dialog {
            border: none;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            padding: 20px;
            max-width: 300px;
            text-align: center;
            background-color: #fff;
        }

        dialog p {
            margin-bottom: 20px;
            font-size: 16px;
            color: #333;
        }

        dialog button {
            margin: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .confirm {
            background-color: #4CAF50;
            color: white;
        }

        .confirm:hover {
            background-color: #45a049;
        }

        .cancel {
            background-color: #f44336;
            color: white;
        }

        .cancel:hover {
            background-color: #e53935;
        }

        .chart-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .chart-button:hover {
            background-color: #0056b3;
        }

        .chart-button img {
            width: 20px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <img src="../imagenes/cfepanel.png" alt="Logo" class="logo">
        <select id="pageSelect">
            <option value="" disabled selected>Valores Mensuales</option>
            <option value="../vistaagencia/indexComitan.php">Página Comitan</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=enero">Enero</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=febrero">Febrero</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=marzo">Marzo</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=abril">Abril</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=mayo">Mayo</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=junio">Junio</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=julio">Julio</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=agosto">Agosto</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=septiembre">Septiembre</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=octubre">Octubre</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=noviembre">Noviembre</option>
            <option value="../VMensualComitan/consulta_mensual_comitan.php?month=diciembre">Diciembre</option>
        </select>
        
        <button class="chart-button" id="chartButton">
            <img src="../imagenes/grafic.png" alt="Graficar"> Graficar
        </button>

        <h1>"Transparencia y Eficiencia: Seguimiento de Indicadores en Comitan De Dominguez"</h1>
        <button><a href="../vistaagencia/indexComitan.php">Subir Avances</a></button> 
        <a href="#" class="logout-button" onclick="confirmLogout(event)">
            <img src="../Imagenes/salida.png" alt="Cerrar sesión">
        </a>
    </div>

    <dialog id="logoutDialog">
        <p>¿Estás seguro de que deseas cerrar sesión?</p>
        <button class="confirm" onclick="performLogout()">Sí</button>
        <button class="cancel" onclick="cancelLogout()">No</button>
    </dialog>

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
.chart-button {
    background-color: white; /* Fondo blanco */
    border: 2px solid green; /* Contorno verde */
    color: black; /* Color del texto negro */
    padding: 10px 20px; /* Espaciado interno del botón */
    font-size: 16px; /* Tamaño de la fuente */
    font-weight: bold; /* Fuente en negrita */
    display: flex; /* Usamos flex para alinear la imagen y el texto */
    align-items: center; /* Centra el contenido verticalmente */
    justify-content: center; /* Centra el contenido horizontalmente */
    border-radius: 5px; /* Bordes redondeados */
    cursor: pointer; /* Cambio de cursor al pasar por encima */
    transition: background-color 0.3s, border-color 0.3s; /* Efecto de transición */
}

.chart-button img {
    width: 20px; /* Ajusta el tamaño de la imagen */
    height: auto; /* Mantiene la proporción de la imagen */
    margin-right: 8px; /* Espacio entre la imagen y el texto */
}

.chart-button:hover {
    background-color: green; /* Fondo verde cuando se pasa el ratón */
    color: white; /* Color del texto blanco */
    border-color: darkgreen; /* Contorno verde oscuro cuando se pasa el ratón */
}
#title {
    font-size: 28px; /* Tamaño de la fuente más grande */
    font-weight: bold; /* Negrita */
    color: white; /* Color blanco para el texto */
    font-family: 'Arial', sans-serif; /* Familia tipográfica */
    text-align: center; /* Centrado del texto */
    margin-bottom: 20px; /* Espacio debajo del texto */
    width: 50%; /* Limitar el ancho del contenedor */
    margin-left: auto; /* Centrado horizontal */
    margin-right: auto; /* Centrado horizontal */
}


</style>




    <script>
     
    
        const logoutDialog = document.getElementById('logoutDialog');
        const pageSelect = document.getElementById('pageSelect');
        const contentContainer = document.getElementById('contentContainer');
        const chartButton = document.getElementById('chartButton');

        function confirmLogout(event) {
            event.preventDefault();
            if (typeof logoutDialog.showModal === "function") {
                logoutDialog.showModal();
            } else {
                alert("Tu navegador no soporta diálogos nativos.");
            }
        }

        function performLogout() {
            window.location.href = '../conexion/logout.php';
        }

        function cancelLogout() {
            logoutDialog.close();
        }

        pageSelect.addEventListener('change', function() {
            const pageUrl = pageSelect.value;
            loadPage(pageUrl);
        });

        function loadPage(url) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    contentContainer.innerHTML = data;
                })
                .catch(error => {
                    contentContainer.innerHTML = '<p>Error al cargar el contenido.</p>';
                    console.error('Error:', error);
                });
        }

        // Cargar el contenido de enero.php al hacer clic en el botón "Graficar"
        chartButton.addEventListener('click', function() {
            loadPage('../graficos_agencias_mensuales/consultar_datos_comitan.php'); // Cargar contenido de enero.php
        });
    
    
        </script>


<script>
    let data = [];
    let myChart;

    function searchMonth() {
        const month = document.getElementById('monthSearch').value;
        const monthLower = month.toLowerCase();
        fetch(`?month=${monthLower}`)
            .then(response => response.json())
            .then(newData => {
                data = newData;
                renderChart();
            })
            .catch(error => console.error('Error al buscar datos:', error));
    }
    function calculateColors(metas, tolerancias, reales) {
        return reales.map((val, index) => {
            if (index === 0) {
                if (val < metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'yellow';
                if (val > tolerancias[index]) return 'red';
            } else if (index === 1) {
                if (val > metas[index]) {
        return 'green';
    }
    // Si el valor está entre la meta y la tolerancia (sin importar el orden), se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
            } else if (index === 2) {
                if (val < metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'yellow';
                if (val > tolerancias[index]) return 'red';
            } else if (index === 3) {
    // Si el valor es mayor que la meta, se pinta de verde
    if (val > metas[index]) {
        return 'green';
    }
    // Si el valor está entre la meta y la tolerancia (sin importar el orden), se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
}
else if (index === 4) {
    // Si el valor está entre la meta y la tolerancia, se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es mayor que la meta, se pinta de verde
    if (val > metas[index]) {
        return 'green';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
}

 else if (index === 5) {
                if (val < metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'yellow';
                if (val > tolerancias[index]) return 'red';
            } else if (index === 6) {
                if (val > metas[index]) {
        return 'green';
    }
    // Si el valor está entre la meta y la tolerancia (sin importar el orden), se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
            } else if (index === 7) {
              if (val > metas[index]) {
        return 'green';
    }
    // Si el valor está entre la meta y la tolerancia (sin importar el orden), se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
            } else if (index === 8) {
                if (val < metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'yellow';
                if (val > tolerancias[index]) return 'red';
            } else if (index === 9) {
                if (val < metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'yellow';
                if (val > tolerancias[index]) return 'red';
            } else if (index === 10) {
                if (val > metas[index]) return 'green';
                if (val >= metas[index] && val <= tolerancias[index]) return 'green';
                if (val < tolerancias[index]) return 'red';
            } else if (index === 11) {
                if (val > metas[index]) {
        return 'green';
    }
    // Si el valor está entre la meta y la tolerancia (sin importar el orden), se pinta de amarillo
    if ((val >= metas[index] && val <= tolerancias[index]) || (val >= tolerancias[index] && val <= metas[index])) {
        return 'yellow';
    }
    // Si el valor es menor que la tolerancia, se pinta de rojo
    if (val < tolerancias[index]) {
        return 'red';
    }
            }
        });
    }

    function renderChart() {
        const chartType = document.getElementById('chartType').value;
        const ctx = document.getElementById('myChart').getContext('2d');

        if (myChart) {
            myChart.destroy();
        }

        const metas = data.map(item => item.meta);
        const tolerancias = data.map(item => item.tolerancia);
        const reales = data.map(item => parseFloat(item.reales));
        const labels = data.map(item => item.indice);
        const colors = calculateColors(metas, tolerancias, reales);

        if (chartType === "combined") {
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Meta',
                            data: metas,
                            backgroundColor: 'rgba(0, 123, 255, 0.6)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Tolerancia',
                            data: tolerancias,
                            backgroundColor: 'rgba(255, 193, 7, 0.6)',
                            borderColor: 'rgba(255, 193, 7, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reales (Barras)',
                            data: reales,
                            backgroundColor: colors,
                            borderColor: 'rgba(255, 255, 255, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Reales (Línea)',
                            data: reales,
                            type: 'line',
                            borderColor: 'rgba(40, 167, 69, 1)',
                            borderWidth: 2,
                            tension: 0.4,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { size: 14 },
                                color: '#333'
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Índice',
                                font: { size: 16 }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Valores',
                                font: { size: 16 }
                            },
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    return value.toFixed(2);
                                }
                            }
                        }
                    }
                }
            });
        } else {
            renderOtherCharts(chartType, ctx, labels, metas, tolerancias, reales, colors);
        }
    }

    function renderOtherCharts(chartType, ctx, labels, metas, tolerancias, reales, colors) {
        myChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Valores Reales',
                        data: reales,
                        backgroundColor: colors,
                        borderColor: 'rgba(255, 255, 255, 1)',
                        borderWidth: 2
                    },
                    {
                        label: 'Meta',
                        data: metas,
                        type: 'line',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'Tolerancia',
                        data: tolerancias,
                        type: 'line',
                        borderColor: 'rgba(255, 193, 7, 1)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: { size: 14 },
                            color: '#333'
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Índice',
                            font: { size: 16 }
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Valores',
                            font: { size: 16 }
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return value.toFixed(2);
                            }
                        }
                    }
                }
            }
        });
    }
    

</script>
<script>
function generateExcelReport() {
        const ws = XLSX.utils.json_to_sheet(data);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Datos');
        XLSX.writeFile(wb, 'Reporte.xlsx');
    }

    function downloadImage() {
            const container = document.getElementById('chartContainer');
            html2canvas(container, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = 'grafico.png';
                link.click();
            }).catch(error => console.error('Error al descargar la imagen:', error));
        }
     
</script>

</body>

</html>
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
            tr:nth-childS(even) { background-color: #f2f2f2; }
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
function exportToExceles() {
    var table = document.getElementById("acumulados");
    var html = table.outerHTML;
    
    // Añadir algo de estilo básico
    var style = `
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { padding: 8px 12px; text-align: left; border: 1px solid #ddd; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-childS(even) { background-color: #f2f2f2; }
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




