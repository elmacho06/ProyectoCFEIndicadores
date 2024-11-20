<?php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "ejemplo");

// Query para obtener el primer registro de la tabla acala
$sql = "SELECT 
            id,
            indice,
            meta AS meta_enero, tolerancia AS tolerancia_enero, reales AS reales_enero,
            meta1 AS meta_febrero, tolerancia1 AS tolerancia_febrero, reales1 AS reales_febrero,
            meta2 AS meta_marzo, tolerancia2 AS tolerancia_marzo, reales2 AS reales_marzo,
            meta3 AS meta_abril, tolerancia3 AS tolerancia_abril, reales3 AS reales_abril,
            meta4 AS meta_mayo, tolerancia4 AS tolerancia_mayo, reales4 AS reales_mayo,
            meta5 AS meta_junio, tolerancia5 AS tolerancia_junio, reales5 AS reales_junio,
            meta6 AS meta_julio, tolerancia6 AS tolerancia_julio, reales6 AS reales_julio,
            meta7 AS meta_agosto, tolerancia7 AS tolerancia_agosto, reales7 AS reales_agosto,
            meta8 AS meta_septiembre, tolerancia8 AS tolerancia_septiembre, reales8 AS reales_septiembre,
            meta9 AS meta_octubre, tolerancia9 AS tolerancia_octubre, reales9 AS reales_octubre,
            meta10 AS meta_noviembre, tolerancia10 AS tolerancia_noviembre, reales10 AS reales_noviembre,
            meta11 AS meta_diciembre, tolerancia11 AS tolerancia_diciembre, reales11 AS reales_diciembre
        FROM acala
        ";

$resultado = $conexion->query($sql);

// CSS para la tabla compacta
echo "
<style>
    table {
        border-collapse: collapse;
        width: 50%; /* Reduce aún más el ancho de la tabla */
        margin: auto;
        font-size: 8px; /* Tamaño de fuente reducido */
        text-align: center;
        background-color: #ffffff;
        border: 1px solid #000000; /* Bordes negros para la tabla */
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    }
    th, td {
        border: 1px solid #000000; /* Bordes negros en celdas */
        padding: 1px 2px; /* Padding mínimo para compactar celdas */
        height: 15px; /* Altura reducida para una tabla más compacta */
    }
    th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        font-size: 9px; /* Fuente más pequeña en encabezados */
        text-transform: uppercase;
    }
    tr:nth-child(even) {
        background-color: #f4f4f4;
    }
    tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    td {
        width: 35px; /* Ancho de celdas más estrecho */
    }
    td:hover {
        background-color: #e0e0e0;
        cursor: pointer;
    }
    caption {
        font-size: 10px; /* Tamaño de fuente más pequeño para el título */
        font-weight: bold;
        color: #333333;
        margin-bottom: 6px;
        text-align: center;
    }
</style>
";

// Título
echo "<h2 style='text-align: center;'>ACUMULADO VALORES MENSUALES AGENCIA ACALA </h2>";

echo "<button onclick='exportToExcel()' style='display: block; margin: 20px auto;'>Generar Excel</button>"; // Botón para exportar

if ($resultado->num_rows > 0) {
    $row_count_5 = 0; // Contador para los registros procesados después de 5
    $row_count_3 = 0; // Contador para los registros procesados después de 3
    
    // Mostrar la tabla
    echo "<table id='tabla-acumulado'>
            <tr>
                <th>ID</th>
                <th>Índice</th>
                <th colspan='3'>Enero</th>
                <th colspan='3'>Febrero</th>
                <th colspan='3'>Marzo</th>
                <th colspan='3'>Abril</th>
                <th colspan='3'>Mayo</th>
                <th colspan='3'>Junio</th>
                <th colspan='3'>Julio</th>
                <th colspan='3'>Agosto</th>
                <th colspan='3'>Septiembre</th>
                <th colspan='3'>Octubre</th>
                <th colspan='3'>Noviembre</th>
                <th colspan='3'>Diciembre</th>
            </tr>
            <th colspan='48'>HACIA LOS CLIENTES</th>
            <tr>
                <th></th>
                <th></th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
                <th>M</th><th>T</th><th>R</th>
            </tr>";

    // Mostrar los datos y calcular los valores acumulados
    while ($fila = $resultado->fetch_assoc()) {
        // Inicializar las variables acumuladoras para cada mes
        $acum_meta = 0;
        $acum_tolerancia = 0;
        $acum_reales = 0;

        echo "<tr>
            <td>{$fila['id']}</td>
            <td>{$fila['indice']}</td>";

        // Definir un arreglo de los nombres de los meses para iterar
        $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        // Iterar sobre cada mes
        foreach ($meses as $mes) {
            // Comprobar si hay un valor para el mes, de lo contrario, dejar el campo vacío
            if (isset($fila["meta_$mes"]) && isset($fila["tolerancia_$mes"]) && isset($fila["reales_$mes"]) &&
                ($fila["meta_$mes"] != 0 && $fila["tolerancia_$mes"] != 0 && $fila["reales_$mes"] != 0)) {
                
                // Acumular los valores para ese mes específico
                $acum_meta += $fila["meta_$mes"];
                $acum_tolerancia += $fila["tolerancia_$mes"];
                $acum_reales += $fila["reales_$mes"];

                // Imprimir el valor acumulado para ese mes con 2 decimales
                echo "<td>" . number_format($acum_meta, 2) . "</td>
                      <td>" . number_format($acum_tolerancia, 2) . "</td>
                      <td>" . number_format($acum_reales, 2) . "</td>";
            } else {
                // Si no hay valores para el mes o son 0, dejar los campos vacíos
                echo "<td></td><td></td><td></td>";
            }
        }

        echo "</tr>";

        // Después de 5 registros, se agrega una fila separadora
        $row_count_5++;
        if ($row_count_5 == 5) {
            echo "<tr><td colspan='38' style='background-color: #4CAF50; height: 10px;'>HACIA LA EMPRESA</td></tr>"; // Fila separadora después de 5 registros
        }

        // Después de 10 registros, se agrega otra fila separadora
        $row_count_3++;
        if ($row_count_3 == 10) {
            echo "<tr><td colspan='38' style='background-color: #4CAF50; height: 10px;'>HACIA EL PERSONAL</td></tr>"; // Fila separadora después de 10 registros
            $row_count_3 = 0; // Resetear contador de 3
        }
    }
}
?>

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


