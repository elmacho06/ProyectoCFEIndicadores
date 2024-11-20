<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valores de Enero</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }
        table {
            width: 60%;
            margin: 0 auto 30px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e9e9e9;
        }
        #charts-container {
            display: none;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .chart-box {
            width: 45%; /* Reducido al 45% para dos gráficas por fila */
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        canvas {
            max-width: 100%;
            height: 200px; /* Altura fija para reducir tamaño */
        }
        @media (max-width: 800px) {
            .chart-box {
                width: 100%;
            }
            table {
                width: 100%;
            }
        }
        /* Estilos para el botón y select */
        #controls {
            text-align: center;
            margin: 20px 0;
        }
        #grafica-button, #download-button, #download-excel-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-left: 10px;
        }
        #grafica-button:hover {
            background-color: #45a049;
        }
        #download-button {
            background-color: #007BFF;
        }
        #download-button:hover {
            background-color: #0056b3;
        }
        #download-excel-button {
            background-color: #28a745;
        }
        #download-excel-button:hover {
            background-color: #218838;
        }
        #chart-type {
            padding: 10px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        /* Estilos para la medalla */
        .medal {
            margin-left: 5px;
            font-size: 16px;
        } .chart-container {
            margin-bottom: 40px;
        }.titulo-enero {
  font-family: 'Arial', sans-serif;
  font-size: 28px;
  color: #4a4a4a;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-bottom: 2px solid #4a4a4a;
  padding-bottom: 10px;
  margin-top: 20px;
}
    </style>
    <!-- Incluimos la librería de Chart.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Incluir ExcelJS desde CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.3.0/exceljs.min.js"></script>
    <!-- Incluir FileSaver.js desde CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
</head>
<body>

<center><h1 class="titulo-enero">Valores de Enero</h1></center>
<div id="tabla-container">
    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ejemplo";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT 
                a.indice,
                a.reales AS acala_reales, 
                c.reales AS chenalho_reales, 
                o.reales AS comalapa_reales, 
                b.reales AS comitam_reales, 
                d.reales AS empleado_reales, 
                e.reales AS margaritas_reales, 
                f.reales AS ocosingo_reales, 
                g.reales AS teopisca_reales, 
                h.reales AS vcarranza_reales, 
                i.reales AS yajalon_reales
            FROM acala a
            INNER JOIN chenalho c ON a.id = c.id
            INNER JOIN comalapa o ON a.id = o.id
            INNER JOIN comitam b ON a.id = b.id
            INNER JOIN empleado d ON a.id = d.id
            INNER JOIN margaritas e ON a.id = e.id
            INNER JOIN ocosingo f ON a.id = f.id
            INNER JOIN teopisca g ON a.id = g.id
            INNER JOIN vcarranza h ON a.id = h.id
            INNER JOIN yajalon i ON a.id = i.id
            LIMIT 1 OFFSET 0";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Variables para guardar los valores para las gráficas
    $labels = [];
    $reales = [];

    $maxValue = -INF;
    $maxIndex = -1;

    if ($result->num_rows > 0) {
        // Crear la tabla HTML
        echo "<table>";
        echo "<tr>
                <th>Índice</th>
                <th>Acala Reales</th>
                <th>Chenalho Reales</th>
                <th>Comalapa Reales</th>
                <th>Comitán Reales</th>
                <th>San Cristobal Reales</th>
                <th>Margaritas Reales</th>
                <th>Ocosingo Reales</th>
                <th>Teopisca Reales</th>
                <th>VCarranza Reales</th>
                <th>Yajalón Reales</th>
              </tr>";

        // Mostrar los datos y preparar los valores para las gráficas
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['indice']) . "</td>";

            // Definir las categorías y sus respectivos valores
            $categorias = [
                'Acala' => 'acala_reales',
                'Chenalho' => 'chenalho_reales',
                'Comalapa' => 'comalapa_reales',
                'Comitán' => 'comitam_reales',
                'Empleado' => 'empleado_reales',
                'Margaritas' => 'margaritas_reales',
                'Ocosingo' => 'ocosingo_reales',
                'Teopisca' => 'teopisca_reales',
                'VCarranza' => 'vcarranza_reales',
                'Yajalón' => 'yajalon_reales'
            ];

            // Obtener los valores y determinar el máximo
            $labels = array_keys($categorias);
            foreach ($categorias as $categoria => $campo) {
                $valor = floatval($row[$campo]);
                $reales[] = $valor;
                echo "<td>" . htmlspecialchars($valor);
                // Determinar si este es el valor máximo
                if ($valor > $maxValue) {
                    $maxValue = $valor;
                    $maxIndex = array_search($categoria, $labels);
                }
                echo "</td>";
            }

            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No se encontraron resultados.</p>";
    }

    // Cerrar la conexión
    $conn->close();
    ?>
</div>

<!-- Controles para elegir tipo de gráfica y descargar Excel -->
<div id="controls">
    <label for="chart-type">Selecciona el tipo de gráfica:</label>
    <select id="chart-type">
        <option value="bar">Barras</option>
        <option value="pie">Pastel</option>
        <option value="line">Línea</option>
        <option value="doughnut">Anillo</option>
        <option value="radar">radar</option>
        <option value="polarArea">polar</option>
        <option value="doughnut">dona</option>
        <!--option value="all">Todas</option-->
       
    </select>
    <!-- Botón para mostrar las gráficas -->
    <button id="grafica-button">Mostrar Gráfica(s)</button>
    <!-- Botón para descargar la tabla en Excel -->
    <button id="download-button">Descargar Excel</button>
    <!-- Botón para descargar la tabla y gráfica en Excel -->
    <button id="download-excel-button">Descargar Excel con Gráfica</button>
</div>

<!-- Contenedor para las gráficas -->
<div id="charts-container">
    <!-- Gráficas se agregarán dinámicamente aquí -->
</div>

<script>
    
    // Datos pasados desde PHP a JavaScript
    const labels = <?php echo json_encode($labels); ?>;
    const dataValues = <?php echo json_encode($reales); ?>;
    const maxIndex = <?php echo json_encode($maxIndex); ?>;

    // Colores vibrantes para las gráficas
    const backgroundColors = [
        '#FF6384', // Acala
        '#36A2EB', // Chenalho
        '#FFCE56', // Comalapa
        '#4BC0C0', // Comitán
        '#9966FF', // Empleado
        '#FF9F40', // Margaritas
        '#C9CBCF', // Ocosingo
        '#5352FF', // Teopisca
        '#66FF66', // VCarranza
        '#FF66FF'  // Yajalón
    ];

    const borderColors = [
        '#FF6384',
        '#36A2EB',
        '#FFCE56',
        '#4BC0C0',
        '#9966FF',
        '#FF9F40',
        '#C9CBCF',
        '#5352FF',
        '#66FF66',
        '#FF66FF'
    ];

    // Array para almacenar las instancias de Chart.js
    let charts = [];

    /**
     * Función para crear una gráfica individual
     * @param {string} chartType - Tipo de gráfica (bar, pie, line, doughnut)
     * @param {string} canvasId - ID del canvas donde se renderizará la gráfica
     * @param {string} title - Título de la gráfica
     */
    function createChart(chartType, canvasId, title) {
        const ctx = document.getElementById(canvasId).getContext('2d');

        // Clonar los arrays de colores para evitar modificar los originales
        let bgColors = [...backgroundColors];
        let brColors = [...borderColors];

        // Resaltar al ganador
        if (chartType !== 'line') { // En gráficas de línea, el ganador será resaltado de otra manera
            bgColors[maxIndex] = '#FFD700'; // Dorado para el ganador
            brColors[maxIndex] = '#FFD700';
        }

        // Configuración del dataset
        const datasetConfig = {
            label: 'Reales de Enero',
            data: dataValues,
            backgroundColor: bgColors,
            borderColor: brColors,
            borderWidth: 1,
            hoverBackgroundColor: bgColors.map(color => shadeColor(color, -20)),
            hoverBorderColor: brColors,
            fill: chartType === 'line' ? false : true,
        };

        // Si es una gráfica de línea, resaltar el punto ganador
        if (chartType === 'line') {
            datasetConfig.pointBackgroundColor = bgColors.map((color, index) => index === maxIndex ? '#FFD700' : color);
            datasetConfig.pointBorderColor = brColors.map((color, index) => index === maxIndex ? '#FFD700' : color);
            datasetConfig.pointRadius = dataValues.map((_, index) => index === maxIndex ? 7 : 3);
            datasetConfig.pointHoverRadius = dataValues.map((_, index) => index === maxIndex ? 10 : 5);
        }

        const config = {
            type: chartType,
            data: {
                labels: labels,
                datasets: [datasetConfig]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 16
                        }
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: chartType !== 'bar' && chartType !== 'line' // Mostrar leyenda solo para pastel y anillo
                    },
                },
                animation: {
                    duration: 1000,
                    easing: 'easeOutBounce'
                },
                scales: (chartType === 'bar' || chartType === 'line') ? {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toFixed(2); // Mostrar dos decimales en las etiquetas
                            }
                        }
                    }
                } : {}
            }
        };

        // Ajustes específicos para ciertos tipos de gráfica
        if (chartType === 'line') {
            // No se necesita ajuste adicional ya que se manejó en datasetConfig
        }

        // Crear la gráfica y almacenarla en el array
        const chartInstance = new Chart(ctx, config);
        charts.push(chartInstance);
    }

    /**
     * Función para oscurecer o aclarar un color.
     * @param {string} color - Color en formato hexadecimal.
     * @param {number} percent - Porcentaje para oscurecer (-) o aclarar (+).
     * @returns {string} - Color modificado en formato hexadecimal.
     */
    function shadeColor(color, percent) {
        let R = parseInt(color.substring(1,3),16);
        let G = parseInt(color.substring(3,5),16);
        let B = parseInt(color.substring(5,7),16);

        R = parseInt(R * (100 + percent) / 100);
        G = parseInt(G * (100 + percent) / 100);
        B = parseInt(B * (100 + percent) / 100);

        R = (R<255)?R:255;  
        G = (G<255)?G:255;  
        B = (B<255)?B:255;  

        const RR = ((R.toString(16).length==1)?"0"+R.toString(16):R.toString(16));
        const GG = ((G.toString(16).length==1)?"0"+G.toString(16):G.toString(16));
        const BB = ((B.toString(16).length==1)?"0"+B.toString(16):B.toString(16));

        return "#"+RR+GG+BB;
    }

    /**
     * Función para capitalizar la primera letra
     * @param {string} string 
     * @returns {string}
     */
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    /**
     * Función para destruir todas las gráficas existentes
     */
    function destroyCharts() {
        charts.forEach(chart => chart.destroy());
        charts = [];
    }

    /**
     * Función para generar un ID único para cada canvas
     * @param {string} base 
     * @returns {string}
     */
    function generateCanvasId(base) {
        return `${base}-${Date.now()}-${Math.floor(Math.random() * 1000)}`;
    }

    /**
     * Función para crear todas las gráficas
     */
  
    

    /**
     * Función para manejar la creación de gráficas según la selección
     */
    function handleCreateCharts() {
        const selectedType = document.getElementById('chart-type').value;

        // Mostrar el contenedor de las gráficas
        document.getElementById('charts-container').style.display = 'flex';

        // Destruir gráficas anteriores
        destroyCharts();
        // Limpiar el contenedor de gráficas
        document.getElementById('charts-container').innerHTML = '';

        if (selectedType === 'all') {
            // Crear todas las gráficas
            createAllCharts();
        } else {
            // Crear una única gráfica
            const canvasId = generateCanvasId(selectedType + '-chart');
            // Crear un nuevo div para la gráfica
            const chartBox = document.createElement('div');
            chartBox.className = 'chart-box';
            chartBox.innerHTML = `<canvas id="${canvasId}"></canvas>`;
            document.getElementById('charts-container').appendChild(chartBox);
            // Crear la gráfica
            createChart(selectedType, canvasId, `Gráfica de ${capitalizeFirstLetter(selectedType)} - Reales de Enero`);
        }
    }

    // Agregar evento al botón para mostrar gráficas
    document.getElementById('grafica-button').addEventListener('click', handleCreateCharts);

    /**
     * Función para descargar la tabla HTML como un archivo CSV.
     */
    function downloadTableAsCSV(filename) {
        const csv = [];
        const rows = document.querySelectorAll("table tr");
        
        rows.forEach(row => {
            const cols = row.querySelectorAll("th, td");
            const rowData = [];
            cols.forEach(col => {
                // Eliminar comillas y comas para evitar errores en el CSV
                let data = col.innerText.replace(/"/g, '""');
                if (data.includes(',') || data.includes('"') || data.includes('\n')) {
                    data = `"${data}"`;
                }
                rowData.push(data);
            });
            csv.push(rowData.join(","));
        });

        // Unir todas las filas con saltos de línea
        const csvString = csv.join("\n");

        // Agregar BOM para mejorar la compatibilidad con Excel
        const bom = "\uFEFF";
        const blob = new Blob([bom + csvString], { type: 'text/csv;charset=utf-8;' });

        // Crear un enlace temporal para descargar el archivo
        const link = document.createElement("a");
        if (link.download !== undefined) { // Soporte para HTML5
            const url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }

    // Agregar evento al botón de descarga
    document.getElementById('download-button').addEventListener('click', function () {
        downloadTableAsCSV('valores_de_enero.csv');
    });

    /**
     * Función para descargar la tabla y la gráfica seleccionada como un archivo Excel.
     */
    async function downloadExcelWithChart(filename) {
    // Crear un nuevo libro de trabajo
    const workbook = new ExcelJS.Workbook();
    const worksheet = workbook.addWorksheet('Valores de Enero');

    // Obtener los datos de la tabla
    const table = document.querySelector("table");
    const rows = table.querySelectorAll("tr");
    const tableData = [];
    rows.forEach(row => {
        const cols = row.querySelectorAll("th, td");
        const rowData = [];
        cols.forEach(col => {
            // Remover el emoji de la medalla si existe
            let text = col.innerText.replace(' 🏅', '').trim();
            rowData.push(text);
        });
        tableData.push(rowData);
    });

    // Añadir los datos de la tabla al worksheet
    tableData.forEach((row, index) => {
        worksheet.addRow(row);
        if (index === 0) { // Aplicar estilos a la cabecera
            const headerRow = worksheet.getRow(1);
            headerRow.eachCell((cell) => {
                cell.font = { bold: true };
                cell.fill = {
                    type: 'pattern',
                    pattern: 'solid',
                    fgColor: { argb: 'FF4CAF50' }, // Color de fondo de la cabecera
                };
                cell.font = { color: { argb: 'FFFFFFFF' }, bold: true };
            });
        }
    });

    // Autoancho de las columnas
    worksheet.columns.forEach(column => {
        let maxLength = 0;
        column.eachCell({ includeEmpty: true }, cell => {
            const columnLength = cell.value ? cell.value.toString().length : 10;
            if (columnLength > maxLength) {
                maxLength = columnLength;
            }
        });
        column.width = maxLength < 10 ? 10 : maxLength + 2;
    });

    // Obtener la gráfica seleccionada
    const selectedType = document.getElementById('chart-type').value;

    if (selectedType !== 'all') {
        // Obtener la instancia de la gráfica seleccionada
        const chartCanvas = document.querySelector(`canvas#${selectedType}-chart`);
        if (chartCanvas) {
            const imageData = chartCanvas.toDataURL('image/png', 1.0);
            const response = await fetch(imageData);
            const blob = await response.blob();
            const arrayBuffer = await blob.arrayBuffer();

            // Añadir la imagen al libro de trabajo
            const imageId = workbook.addImage({
                buffer: arrayBuffer,
                extension: 'png',
            });

            // Añadir la imagen al worksheet
            worksheet.addImage(imageId, {
                tl: { col: 0, row: tableData.length + 2 }, // Posición de la imagen
                ext: { width: 500, height: 300 }, // Tamaño de la imagen
            });
        }
    } else {
        // Si se seleccionó 'all', agregar todas las gráficas
        const charts = document.querySelectorAll('#charts-container canvas');
        let rowOffset = tableData.length + 2; // Posición inicial para las imágenes

        for (let canvas of charts) {
            const imageData = canvas.toDataURL('image/png', 1.0);
            const response = await fetch(imageData);
            const blob = await response.blob();
            const arrayBuffer = await blob.arrayBuffer();

            const imageId = workbook.addImage({
                buffer: arrayBuffer,
                extension: 'png',
            });

            worksheet.addImage(imageId, {
                tl: { col: 0, row: rowOffset },
                ext: { width: 500, height: 300 },
            });

            rowOffset += 20; // Ajustar la posición para la siguiente imagen
        }
    }

    // Generar el archivo Excel
    await workbook.xlsx.writeBuffer().then((buffer) => {
        const blob = new Blob([buffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
        saveAs(blob, filename);
    });
}

// Agregar evento al botón de descarga de Excel con gráfica
document.getElementById('download-excel-button').addEventListener('click', function () {
    downloadExcelWithChart('valores_de_enero.xlsx');
});

// Función para agregar la medalla a los ganadores con el mismo puntaje después de que la página cargue
window.onload = function () {
    const tabla = document.querySelector("table");
    if (tabla) {
        const filas = Array.from(tabla.getElementsByTagName("tr"));
        if (filas.length > 1) { // Asegurarse de que hay al menos una fila de datos

            let maxScore = -Infinity;
            let maxIndices = [];

            // Iterar sobre las filas de datos (excluyendo la cabecera)
            filas.slice(1).forEach(fila => {
                const celdas = Array.from(fila.getElementsByTagName("td")).slice(1); // Excluir la columna de índice
                celdas.forEach((celda, colIndex) => {
                    const score = parseFloat(celda.innerText.replace(' 🏅', '').trim());
                    if (!isNaN(score)) {
                        if (score > maxScore) {
                            maxScore = score;
                            maxIndices = [colIndex]; // Reiniciar los índices ganadores
                        } else if (score === maxScore) {
                            maxIndices.push(colIndex); // Añadir al índice ganador
                        }
                    }
                });
            });

            // Agregar la medalla a todos los ganadores con el puntaje más alto
            if (maxIndices.length > 0) {
                filas.slice(1).forEach(fila => {
                    maxIndices.forEach(index => {
                        const celdaGanadora = fila.getElementsByTagName("td")[index + 1]; // +1 para excluir la columna de índice
                        if (celdaGanadora && parseFloat(celdaGanadora.innerText.trim()) === maxScore) {
                            celdaGanadora.innerHTML += " 🏅"; // Añadir emoji de medalla
                            celdaGanadora.style.fontWeight = 'bold'; // Resaltar en negrita
                        }
                    });
                });
            }
        }
    }
};

    
</script>

</body>
</html>
