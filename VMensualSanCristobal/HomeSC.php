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
        $sql = "SELECT indice, meta, tolerancia, reales FROM empleado LIMIT 12";
    } elseif ($month === 'febrero') {
        $sql = "SELECT indice, meta1 AS meta, tolerancia1 AS tolerancia, reales1 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'marzo') {
        $sql = "SELECT indice, meta2 AS meta, tolerancia2 AS tolerancia, reales2 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'abril') {
        $sql = "SELECT indice, meta3 AS meta, tolerancia3 AS tolerancia, reales3 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'mayo') {
        $sql = "SELECT indice, meta4 AS meta, tolerancia4 AS tolerancia, reales4 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'junio') {
        $sql = "SELECT indice, meta5 AS meta, tolerancia5 AS tolerancia, reales5 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'julio') {
        $sql = "SELECT indice, meta6 AS meta, tolerancia6 AS tolerancia, reales6 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'agosto') {
        $sql = "SELECT indice, meta7 AS meta, tolerancia7 AS tolerancia, reales7 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'septiembre') {
        $sql = "SELECT indice, meta8 AS meta, tolerancia8 AS tolerancia, reales8 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'octubre') {
        $sql = "SELECT indice, meta9 AS meta, tolerancia9 AS tolerancia, reales9 AS reales FROM empleado LIMIT 12";
    } elseif ($month === 'noviembre') {
        $sql = "SELECT indice, meta10 AS meta, tolerancia10 AS tolerancia, reales10 AS reales FROM empleado LIMIT 12";
    } 
    elseif ($month === 'diciembre') {
        $sql = "SELECT indice, meta11 AS meta, tolerancia11 AS tolerancia, reales11 AS reales FROM empleado LIMIT 12";
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
<html lang="es">
<head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-boxplot"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
            <option value="../vistaagencia/indexSanCristobal.php">Página San Cristobal</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=enero">Enero</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=febrero">Febrero</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=marzo">Marzo</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=abril">Abril</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=mayo">Mayo</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=junio">Junio</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=julio">Julio</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=agosto">Agosto</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=septiembre">Septiembre</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=octubre">Octubre</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=noviembre">Noviembre</option>
            <option value="../VMensualSanCristobal/consulta_mensual_SC.php?month=diciembre">Diciembre</option>
        </select>
        
        <button class="chart-button" id="chartButton">
            <img src="../imagenes/graph_icon.png" alt="Graficar"> Graficar
        </button>

        <h1>"Transparencia y Eficiencia: Seguimiento de Indicadores en San Cristobal De Las Casas"</h1>
        <button><a href="../vistaagencia/indexSanCristobal.php">Subir Avances</a></button> 
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
            loadPage('../graficos_agencias_mensuales/consultar_datos_SC.php'); // Cargar contenido de enero.php
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






