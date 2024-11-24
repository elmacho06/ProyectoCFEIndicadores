<?php
// Configuración de la conexión a la base de datos
include '../conexion/db_conect.php';

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
        $sql = "SELECT indice, meta, tolerancia, reales FROM chenalho LIMIT 12";
    } elseif ($month === 'febrero') {
        $sql = "SELECT indice, meta1 AS meta, tolerancia1 AS tolerancia, reales1 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'marzo') {
        $sql = "SELECT indice, meta2 AS meta, tolerancia2 AS tolerancia, reales2 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'abril') {
        $sql = "SELECT indice, meta3 AS meta, tolerancia3 AS tolerancia, reales3 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'mayo') {
        $sql = "SELECT indice, meta4 AS meta, tolerancia4 AS tolerancia, reales4 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'junio') {
        $sql = "SELECT indice, meta5 AS meta, tolerancia5 AS tolerancia, reales5 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'julio') {
        $sql = "SELECT indice, meta6 AS meta, tolerancia6 AS tolerancia, reales6 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'agosto') {
        $sql = "SELECT indice, meta7 AS meta, tolerancia7 AS tolerancia, reales7 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'septiembre') {
        $sql = "SELECT indice, meta8 AS meta, tolerancia8 AS tolerancia, reales8 AS reales FROM vcarranza LIMIT 12";
    } elseif ($month === 'octubre') {
        $sql = "SELECT indice, meta9 AS meta, tolerancia9 AS tolerancia, reales9 AS reales FROM vcarrranza LIMIT 12";
    } elseif ($month === 'noviembre') {
        $sql = "SELECT indice, meta10 AS meta, tolerancia10 AS tolerancia, reales10 AS reales FROM vcarranza LIMIT 12";
    } 
    elseif ($month === 'diciembre') {
        $sql = "SELECT indice, meta11 AS meta, tolerancia11 AS tolerancia, reales11 AS reales FROM vcarranza LIMIT 12";
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
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficos de Datos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@sgratzl/chartjs-chart-boxplot"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        #chartContainer { width: 90%; height: 500px; margin: 20px auto; position: relative; }
        select, button, input { margin: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px; font-size: 16px; }
        button { background-color: #28a745; color: white; cursor: pointer; }
        button:hover { background-color: #218838; }
        .chart-panel { width: 90%; margin: 20px auto; background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        h2 { text-align: center; color: #333; }
    </style>
</head>
<body>

<!-- Formulario para buscar mes y seleccionar tipo de gráfico -->
<form id="chartForm">
    <label for="monthSearch">Buscar mes:</label>
    <input type="text" id="monthSearch" placeholder="Ejemplo: enero o febrero" />
    <label for="chartType">Selecciona tipo de gráfico:</label>
    <select id="chartType" name="chartType">
        <option value="bar">Gráfico de Barras</option>
        <option value="line">Gráfico de Líneas</option>
        
        <option value="combined">Gráfico Combinado</option>
    </select>
    <button type="button" onclick="searchMonth()">Generar Gráfica</button>
    <button type="button" onclick="generateExcelReport()">Generar Reporte Excel</button>
    <button type="button" onclick="downloadImage()">Descargar Imagen del Gráfico</button>
</form>

<div class="chart-panel">
    <h2>Gráfico de Datos</h2>
    <div id="chartContainer">
        <canvas id="myChart"></canvas>
    </div>
</div>

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
<div id="colorLegend" style="margin-top: 20px; font-size: 16px;">
    <p><strong>Significado de los colores en el gráfico:</strong></p>
    <ul>
        <li><span style="display:inline-block;width:20px;height:20px;background-color:green;"></span> <strong>Verde:</strong> El valor real cumple con la meta establecida, lo cual indica un desempeño superior al esperado.</li>
        <li><span style="display:inline-block;width:20px;height:20px;background-color:yellow;"></span> <strong>Amarillo:</strong> El valor real está dentro del rango de la meta y la tolerancia, indicando un desempeño aceptable.</li>
        <li><span style="display:inline-block;width:20px;height:20px;background-color:red;"></span> <strong>Rojo:</strong> El valor real supera la tolerancia, lo que indica un desempeño por debajo de lo esperado.</li>
        <li><span style="display:inline-block;width:20px;height:20px;background-color:rgba(0, 123, 255, 1);"></span> <strong>Azul (Línea):</strong> Representa la "Meta", que es el valor objetivo que se debe alcanzar.</li>
        <li><span style="display:inline-block;width:20px;height:20px;background-color:rgba(255, 193, 7, 1);"></span> <strong>Amarillo (Línea):</strong> Representa la "Tolerancia", el rango dentro del cual el valor real puede estar sin considerar el desempeño como insatisfactorio.</li>
    </ul>
</div>
</html>






