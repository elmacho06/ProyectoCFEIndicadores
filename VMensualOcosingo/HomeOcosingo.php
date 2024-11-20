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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
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
            box-shadow: 0 0 15px 10px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            mask-image: radial-gradient(circle, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0) 100%);
            -webkit-mask-image: radial-gradient(circle, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0) 100%);
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
        <img src="../imagenes/mano.png" alt="Logo" class="logo">
        <select id="pageSelect">
            <option value="" disabled selected>Valores Mensuales</option>
            <option value="../vistaagencia/indexOcosingo.php">Página ocosingo</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=enero">Enero</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=febrero">Febrero</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=marzo">Marzo</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=abril">Abril</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=mayo">Mayo</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=junio">Junio</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=julio">Julio</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=agosto">Agosto</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=septiembre">Septiembre</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=octubre">Octubre</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=noviembre">Noviembre</option>
            <option value="../VMensualOcosingo/consulta_mensual_ocosingo.php?month=diciembre">Diciembre</option>
        </select>
        
        <button class="chart-button" id="chartButton">
            <img src="../imagenes/graph_icon.png" alt="Graficar"> Graficar
        </button>

        <h1>"Transparencia y Eficiencia: Seguimiento de Indicadores en Ocosingo"</h1>
        <button><a href="../vistaagencia/indexOcosingo.php">Subir Avances</a></button> 
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
        <h2>Bienvenido</h2>
        <p>Selecciona una página del menú para cargar su contenido aquí sin recargar la página.</p>
    </div>

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
            loadPage('../graficos_agencias_mensuales/consultar_datos_ocosingo.php'); // Cargar contenido de enero.php
        });
    
    
    let data = [];
    let myChart;

    function searchMonth() {
        const month=document.getElementById('monthSearch').value;
        console.log(month)
        const monthLower = month.toLowerCase();
        console.log(monthLower)
        //fetch(`../graficos_carranza_mensuales/enero.php?month=${monthLower}`)
        fetch(`../graficos_agencias_mensuales/consultar_datos_ocosingo.php?month=${monthLower}`)
            .then(response => response.json())
            .then(newData => {
                data = newData;
                renderChart();
            })
            .catch(error => console.error('Error al buscar datos:', error));
    }

    function renderChart() {
        const chartType = document.getElementById('chartType').value;
        const ctx = document.getElementById('myChart').getContext('2d');

        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: data.map(item => item.indice),
                datasets: [{
                    label: 'Valores Reales',
                    data: data.map(item => parseFloat(item.reales)),
                    backgroundColor: generateColors(data.length),
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    }

    function generateColors(count) {
        const colors = ['#FF5733', '#33FF57', '#3357FF', '#FF33A6', '#FFB833', '#B833FF', '#33FFF8', '#F8FF33'];
        return Array.from({ length: count }, (_, i) => colors[i % colors.length]);
    }

    function generateReport() {
        const worksheet = XLSX.utils.json_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Reporte");
        XLSX.writeFile(workbook, "reporte.xlsx");
    }

    function downloadImage() {
        const link = document.createElement('a');
        link.href = document.getElementById('myChart').toDataURL('image/png');
        link.download = 'grafico.png';
        link.click();
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
function exportToExceles() {
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


