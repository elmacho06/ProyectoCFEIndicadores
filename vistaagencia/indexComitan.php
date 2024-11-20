<?php
// index.php

// Incluir el archivo de conexión
include '../conexion/db_conect.php';

// Consulta para obtener los datos de la tabla empleado
$sql = "SELECT * FROM comitam";

$result = $conn->query($sql);

//Variables especiales -> SE VAN A REONSTRUIR
$RedFlagCliente=1;
$RedFlagEmpresa=1;
$RedFlagPersonal=1;
//________________

for ($i = 1; $i <=11; $i++) {
    ${"RedFlagCliente".$i} = 0; // se aplicaran 5 hiladas, de registro uno hasta cinco (fila uno - fila cinco)
	${"RedFlagEmpresa".$i} = 0; //se aplicaran 5 hiladas, de registro seis hasta 10 (fila seis - fila diez)
	${"RedFlagPersonal".$i} = 0; // se aplicara una hilada en regito 11 (fila 11)
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Empleados</title>
    

    <style>
      table {
    width: 55%; /* Reduce aún más el ancho total de la tabla */
    margin: 8px auto; /* Margen más pequeño */
    border-collapse: collapse;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Sombra más suave */
}

th, td {
    padding: 0.5px 2px; /* Reduce aún más el padding para hacer las celdas compactas */
    font-size: 9px; /* Tamaño de fuente más pequeño */
    line-height: 1; /* Espacio vertical mínimo */
    text-align: center;
    border: 1px solid black;
}

th {
    background-color: #f0f0f0;
    color: #333;
    text-transform: uppercase;
}

th.month {
    background-color: #28a745;
    color: white;
}



.color-green {
    background-color: green;
    color: white;
}

.color-yellow {
    background-color: yellow;
    color: black;
}

.color-red {
    background-color: red;
    color: white;
}
.highlight-green {
    background-color: green;
    color: white;
}

.highlight-yellow {
    background-color: yellow;
}
.highlight-green {
    background-color: green;
    color: white;
}

.highlight-yellow {
    background-color: yellow;
    color: black;
}
.highlight-red {
    background-color: red;
    color: white;
}

.highlight-yellow {
    background-color: yellow;
    color: black;
}

.highlight-green {
    background-color: green;
    color: white;
}

color1-blue {
    background-color: #007bff; /* Azul, o cualquier color que prefieras para el rango verde */
}

.color1-red {
    background-color: #dc3545; /* Rojo */
}

.color-default {
    background-color: #6c757d; /* Gris por defecto (opcional) */
}



    </style>
    
    
</head>

<body>
<div id="tabla-container">
        <!-- Título que se añadirá dinámicamente -->
        <div id="titulo" class="titulo" style="display: none;">Hacia el Personal</div>

        <!-- Contenedor para los registros -->
        <div id="registros"></div>
    </div>

        
<body>
    <div style="background-color: green; color: white; padding: 10px; text-align: center;">
        <h2 style="margin: 0;">"Valores Mensuales"</h2>
       

    </div>
    <table id='tabla-acumulado'>


		<th rowspan="1" class="month">INDICE</th>
		<th colspan="3" class="month">ENERO</th>
		<th colspan="3" class="month">FEBRERO</th>
		<th colspan="3" class="month">MARZO</th>
		<th colspan="3" class="month">ABRIL</th>
		<th colspan="3" class="month">MAYO</th>
		<th colspan="3" class="month">JUNIO</th>
		<th colspan="3" class="month">JULIO</th>
		<th colspan="3" class="month">AGOSTO</th>
		<th colspan="3" class="month">SEPTIEMBRE</th>
		<th colspan="3" class="month">OCTUBRE</th>
		<th colspan="3" class="month">NOVIEMBRE</th>
		<th colspan="3" class="month">DICIEMBRE</th>

    
    </tr>
    <!-- Fila con el título 'Hacia los Empleados' -->
    <?php
     echo "<button onclick='exportToExcel()' style='display: block; margin: 20px auto;'>Generar Excel</button>"; // Botón para exportar
 
 echo "<tr><td colspan='39' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia Los Clientes</td></tr>";
?>
    <!-- Aquí se añadirán las filas de datos -->
        <tr>
            <th></th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
            <th class="month">M</th>
            <th class="month">T</th>
            <th class="month">R</th>
        </tr>
        
        <?php
        //--------------------registro uno "Inconformidades por cada Mil Usuarios (Número) +7%"------------------------
        
		//FILA UNO 

		
		if ($result->num_rows > 0) {
            $count = 0; // Contador para controlar el número de registros procesados
            
            // Iterar sobre todos los registros
            while ($row = $result->fetch_assoc()) {
                // Incrementar el contador
                $count++;
                
                // Obtener los valores y convertirlos a flotantes, solo enero porque no tiene numero asociado a la variable
                $meta = floatval($row["meta"]);
                $tolerancia = floatval($row["tolerancia"]);
                $real = floatval($row["reales"]);
				
                $meta1 = floatval($row["meta1"]);
                $tolerancia1 = floatval($row["tolerancia1"]);
                $real1 = floatval($row["reales1"]);
        
                $meta2 = floatval($row["meta2"]);
                $tolerancia2 = floatval($row["tolerancia2"]);
                $real2 = floatval($row["reales2"]);
        
                $meta3 = floatval($row["meta3"]);
                $tolerancia3 = floatval($row["tolerancia3"]);
                $real3 = floatval($row["reales3"]);
        
                $meta4 = floatval($row["meta4"]);
                $tolerancia4 = floatval($row["tolerancia4"]);
                $real4 = floatval($row["reales4"]);
        
                $meta5 = floatval($row["meta5"]);
                $tolerancia5 = floatval($row["tolerancia5"]);
                $real5 = floatval($row["reales5"]);
        
                $meta6 = floatval($row["meta6"]);
                $tolerancia6 = floatval($row["tolerancia6"]);
                $real6 = floatval($row["reales6"]);
        
                $meta7 = floatval($row["meta7"]);
                $tolerancia7 = floatval($row["tolerancia7"]);
                $real7 = floatval($row["reales7"]);
        
                $meta8 = floatval($row["meta8"]);
                $tolerancia8 = floatval($row["tolerancia8"]);
                $real8 = floatval($row["reales8"]);
        
                $meta9 = floatval($row["meta9"]);
                $tolerancia9 = floatval($row["tolerancia9"]);
                $real9 = floatval($row["reales9"]);
        
                $meta10 = floatval($row["meta10"]);
                $tolerancia10 = floatval($row["tolerancia10"]);
                $real10 = floatval($row["reales10"]);
        
                $meta11 = floatval($row["meta11"]);
                $tolerancia11 = floatval($row["tolerancia11"]);
                $real11 = floatval($row["reales11"]);
                
				
				// FILA UNO - ENERO
                $colorClass = '';
				if ($real < $meta) { $colorClass = 'color-green';} elseif ($real > $tolerancia) {
                    $colorClass = 'color-red'; $RedFlagCliente++; } else {$colorClass = 'color-yellow';}

				//FILA UNO - FEBRERO
                $colorClass1 = '';
                if ($real1 < $meta1) { $colorClass1 = 'color-green'; } elseif ($real1 > $tolerancia1) {
                    $colorClass1 = 'color-red'; $RedFlagCliente1++; } else { $colorClass1 = 'color-yellow';}
				
				//FILA UNO - MARZO
                $colorClass2 = ''; 
				if ($real2 < $meta2) { $colorClass2 = 'color-green'; } elseif ($real2 > $tolerancia2) {
                    $colorClass2 = 'color-red'; $RedFlagCliente2++; } else { $colorClass2 = 'color-yellow'; }
				
				//FILA UNO - ABRIL
                $colorClass3 = '';
                if ($real3 < $meta3) { $colorClass3 = 'color-green'; } elseif ($real3 > $tolerancia3) { 
					$colorClass3 = 'color-red'; $RedFlagCliente3++; } else { $colorClass3 = 'color-yellow'; }

				//FILA UNO - MAYO
                $colorClass4 = '';
                if ($real4 < $meta4) { $colorClass4 = 'color-green'; } elseif ($real4 > $tolerancia4) {
                    $colorClass4 = 'color-red'; $RedFlagCliente4++; } else { $colorClass4 = 'color-yellow'; }
				
				//FILA UNO - JUNIO
                $colorClass5 = '';
                if ($real5 < $meta5) { $colorClass5 = 'color-green'; } elseif ($real5 > $tolerancia5) {
                    $colorClass5 = 'color-red'; $RedFlagCliente5++; } else { $colorClass5 = 'color-yellow'; }
				
				//FILA UNO - JULIO

                $colorClass6 = '';
                if ($real6 < $meta6) { $colorClass6 = 'color-green'; } elseif ($real6 > $tolerancia6) {
                    $colorClass6 = 'color-red'; $RedFlagCliente6++; } else { $colorClass6 = 'color-yellow';}

				//FILA UNO - AGOSTO
                $colorClass7 = '';
                if ($real7 < $meta7) { $colorClass7 = 'color-green'; } elseif ($real7 > $tolerancia7) {
                    $colorClass7 = 'color-red'; $RedFlagCliente7++; } else {$colorClass7 = 'color-yellow';}
				
				//FILA UNO - SEPTIEMBRE
                $colorClass8 = '';
                if ($real8 < $meta8) { $colorClass8 = 'color-green'; } elseif ($real8 > $tolerancia8) {
                    $colorClass8 = 'color-red'; $RedFlagCliente8++; } else { $colorClass8 = 'color-yellow'; }
				
				//FILA UNO - OCTUBRE
                $colorClass9 = '';
                if ($real9 < $meta9) { $colorClass9 = 'color-green'; } elseif ($real9 > $tolerancia9) {
                    $colorClass9 = 'color-red'; $RedFlagCliente9++; } else { $colorClass9 = 'color-yellow'; }
				
				//FILA UNO - NOVIEMBRE
                $colorClass10 = '';
                if ($real10 < $meta10) { 
                    $colorClass10 = 'color-green'; 
                } elseif ($real10 > $tolerancia10) {
                    $colorClass10 = 'color-red'; $RedFlagCliente10++;
                 } else { $colorClass10 = 'color-yellow'; }
				
				//FILA UNO - DICIEMBRE
                $cellColor11 = '';
if ($real11 < $meta11) {
    $cellColor11 = 'highlight-green';
} elseif ($real11 > $tolerancia11) {
    $cellColor11 = 'highlight-red';
    $RedFlagCliente11++;
} else {
    $cellColor11 = 'highlight-yellow';
}
               
                    
                echo "<tr>";
                echo "<td>q" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

                echo "</tr>";
                if ($count == 1) {
                    break;
                }
                
            }
        } else {
            echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
        }
        
        //-------------------------------------segundo registro "Compromisos de Servicio (%) -5%"-----------------------------------------------
        
		// FILA DOS
		
		if ($result->num_rows > 0) {
            $count = 0; // Contador para controlar el número de registros procesados
            
            // Iterar sobre todos los registros
            while ($row = $result->fetch_assoc()) {
                // Incrementar el contador
                $count++;
                
                // Obtener los valores y convertirlos a flotantes
                $meta = floatval($row["meta"]);
                $tolerancia = floatval($row["tolerancia"]);
                $real = floatval($row["reales"]);
        
                $meta1 = floatval($row["meta1"]);
                $tolerancia1 = floatval($row["tolerancia1"]);
                $real1 = floatval($row["reales1"]);
        
                $meta2 = floatval($row["meta2"]);
                $tolerancia2 = floatval($row["tolerancia2"]);
                $real2 = floatval($row["reales2"]);
        
                $meta3 = floatval($row["meta3"]);
                $tolerancia3 = floatval($row["tolerancia3"]);
                $real3 = floatval($row["reales3"]);
        
                $meta4 = floatval($row["meta4"]);
                $tolerancia4 = floatval($row["tolerancia4"]);
                $real4 = floatval($row["reales4"]);
        
                $meta5 = floatval($row["meta5"]);
                $tolerancia5 = floatval($row["tolerancia5"]);
                $real5 = floatval($row["reales5"]);
        
                $meta6 = floatval($row["meta6"]);
                $tolerancia6 = floatval($row["tolerancia6"]);
                $real6 = floatval($row["reales6"]);
        
                $meta7 = floatval($row["meta7"]);
                $tolerancia7 = floatval($row["tolerancia7"]);
                $real7 = floatval($row["reales7"]);
        
                $meta8 = floatval($row["meta8"]);
                $tolerancia8 = floatval($row["tolerancia8"]);
                $real8 = floatval($row["reales8"]);
        
                $meta9 = floatval($row["meta9"]);
                $tolerancia9 = floatval($row["tolerancia9"]);
                $real9 = floatval($row["reales9"]);
        
                $meta10 = floatval($row["meta10"]);
                $tolerancia10 = floatval($row["tolerancia10"]);
                $real10 = floatval($row["reales10"]);
        
                $meta11 = floatval($row["meta11"]);
                $tolerancia11 = floatval($row["tolerancia11"]);
                $real11 = floatval($row["reales11"]);
                
                
                $cellColor = '';
				if ($real > $meta) {
					$cellColor = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real < $tolerancia) {
					$cellColor = 'highlight-red';
					$RedFlagCliente++;
					
				} elseif ($real >= $tolerancia && $real <= $meta) {
					$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor1 = '';
				if ($real1 > $meta1) {
					$cellColor1 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real1 < $tolerancia1) {
					$cellColor1 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente1++;
				} elseif ($real1 >= $tolerancia1 && $real1 <= $meta1) {
					$cellColor1 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor2 = '';
				if ($real2 > $meta2) {
					$cellColor2 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real2 < $tolerancia2) {
					$cellColor2 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente2++;
				} elseif ($real2 >= $tolerancia2 && $real2 <= $meta2) {
					$cellColor2 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}


				$cellColor3 = '';
				if ($real3 > $meta3) {
					$cellColor3 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real3 < $tolerancia3) {
					$cellColor3 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente3++;
				} elseif ($real3 >= $tolerancia3 && $real3 <= $meta3) {
					$cellColor3 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor4 = '';
				if ($real4 > $meta4) {
					$cellColor4 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real4 < $tolerancia4) {
					$cellColor4 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente4++;
				} elseif ($real4 >= $tolerancia4 && $real4 <= $meta4) {
					$cellColor4 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}



				$cellColor5 = '';
				if ($real5 > $meta5) {
					$cellColor5 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real5 < $tolerancia5) {
					$cellColor5 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente5++;
				} elseif ($real5 >= $tolerancia5 && $real5 <= $meta5) {
					$cellColor5 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor6 = '';
				if ($real6 > $meta6) {
					$cellColor6 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real6 < $tolerancia6) {
					$cellColor6 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente6++;
				} elseif ($real6 >= $tolerancia6 && $real6 <= $meta6) {
					$cellColor6 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}



				$cellColor7 = '';
				if ($real7 > $meta7) {
					$cellColor7 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real7 < $tolerancia7) {
					$cellColor7 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente7++;
				} elseif ($real7 >= $tolerancia7 && $real7 <= $meta7) {
					$cellColor7 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor8 = '';
				if ($real8 > $meta8) {
					$cellColor8 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real8 < $tolerancia8) {
					$cellColor8 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente8++;
				} elseif ($real8 >= $tolerancia8 && $real8 <= $meta8) {
					$cellColor8 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}


				$cellColor9 = '';
				if ($real9 > $meta9) {
					$cellColor9 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real9 < $tolerancia9) {
					$cellColor9 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente9++;
				} elseif ($real9 >= $tolerancia9 && $real9 <= $meta9) {
					$cellColor9 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				$cellColor10 = '';
				if ($real10 > $meta9) {
					$cellColor10 = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real10 < $tolerancia10) {
					$cellColor10 = 'highlight-red'; // Rojo si es menor que la tolerancia
					$RedFlagCliente10++;
				} elseif ($real10 >= $tolerancia10 && $real9 <= $meta10) {
					$cellColor10 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}


				$cellColor11 = '';
				if ($real11 > $meta11) {
					$cellColor11 = 'highlight-green';
				} elseif ($real11 >= $meta11 && $real11 <= $tolerancia11) {
					$cellColor11 = 'highlight-yellow';
				} else {
					$cellColor11 = 'highlight-red';
					$RedFlagCliente11++;
				}

				// Output the table rows with the appropriate colors
				echo "<tr>";
				echo "<td>" . $row["indice"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

				echo "</tr>";

                
                


                if ($count == 1) {
                    break;
                }
                
            }
        } else {
            echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
        }


        //----------------------------registro 3----------------------------------
        
		// FILA TRES -> COLOCAR $RedFlagCliente++; HASTA $RedFlagCliente11++;
		
		if ($result->num_rows > 0) {
            $count = 0; // Contador para controlar el número de registros procesados
            
            // Iterar sobre todos los registros
            while ($row = $result->fetch_assoc()) {
                // Incrementar el contador
                $count++;
                
                // Obtener los valores y convertirlos a flotantes
                $meta = floatval($row["meta"]);
                $tolerancia = floatval($row["tolerancia"]);
                $real = floatval($row["reales"]);
        
                $meta1 = floatval($row["meta1"]);
                $tolerancia1 = floatval($row["tolerancia1"]);
                $real1 = floatval($row["reales1"]);
        
                $meta2 = floatval($row["meta2"]);
                $tolerancia2 = floatval($row["tolerancia2"]);
                $real2 = floatval($row["reales2"]);
        
                $meta3 = floatval($row["meta3"]);
                $tolerancia3 = floatval($row["tolerancia3"]);
                $real3 = floatval($row["reales3"]);
        
                $meta4 = floatval($row["meta4"]);
                $tolerancia4 = floatval($row["tolerancia4"]);
                $real4 = floatval($row["reales4"]);
        
                $meta5 = floatval($row["meta5"]);
                $tolerancia5 = floatval($row["tolerancia5"]);
                $real5 = floatval($row["reales5"]);
        
                $meta6 = floatval($row["meta6"]);
                $tolerancia6 = floatval($row["tolerancia6"]);
                $real6 = floatval($row["reales6"]);
        
                $meta7 = floatval($row["meta7"]);
                $tolerancia7 = floatval($row["tolerancia7"]);
                $real7 = floatval($row["reales7"]);
        
                $meta8 = floatval($row["meta8"]);
                $tolerancia8 = floatval($row["tolerancia8"]);
                $real8 = floatval($row["reales8"]);
        
                $meta9 = floatval($row["meta9"]);
                $tolerancia9 = floatval($row["tolerancia9"]);
                $real9 = floatval($row["reales9"]);
        
                $meta10 = floatval($row["meta10"]);
                $tolerancia10 = floatval($row["tolerancia10"]);
                $real10 = floatval($row["reales10"]);
        
                $meta11 = floatval($row["meta11"]);
                $tolerancia11 = floatval($row["tolerancia11"]);
                $real11 = floatval($row["reales11"]);
                
                $colorClass = '';
                
                if ($real < $meta) {
                    $colorClass = 'color-green';
                } elseif ($real > $tolerancia) {
                    $colorClass = 'color-red';
					$RedFlagCliente++;
				}else{
                    $colorClass = 'color-yellow';
                }

                $colorClass1 = '';
                if ($real1 < $meta1) {
                    $colorClass1 = 'color-green';
                } elseif ($real1 > $tolerancia1) {
                    $colorClass1 = 'color-red';
					$RedFlagCliente1++;
                } else {
                    $colorClass1 = 'color-yellow';
                }

                $colorClass2 = '';
                if ($real2 < $meta2) {
                    $colorClass2 = 'color-green';
                } elseif ($real2 > $tolerancia2) {
                    $colorClass2 = 'color-red';
					$RedFlagCliente2++;
                } else {
                    $colorClass2 = 'color-yellow';
                }

                $colorClass3 = '';
                if ($real3 < $meta3) {
                    $colorClass3 = 'color-green';
                } elseif ($real3 > $tolerancia3) {
                    $colorClass3 = 'color-red';
					$RedFlagCliente3++;
                } else {
                    $colorClass3 = 'color-yellow';
                }

                $colorClass4 = '';
                if ($real4 < $meta4) {
                    $colorClass4 = 'color-green';
                } elseif ($real4 > $tolerancia4) {
                    $colorClass4 = 'color-red';
					$RedFlagCliente4++;
                } else {
                    $colorClass4 = 'color-yellow';
                }

                $colorClass5 = '';
                if ($real5 < $meta5) {
                    $colorClass5 = 'color-green';
                } elseif ($real5 > $tolerancia5) {
                    $colorClass5 = 'color-red';
					$RedFlagCliente5++;
                } else {
                    $colorClass5 = 'color-yellow';
                }

                $colorClass6 = '';
                if ($real6 < $meta6) {
                    $colorClass6 = 'color-green';
                } elseif ($real6 > $tolerancia6) {
                    $colorClass6 = 'color-red';
					$RedFlagCliente6++;
                } else {
                    $colorClass6 = 'color-yellow';
                }

                $colorClass7 = '';
                if ($real7 < $meta7) {
                    $colorClass7 = 'color-green';
                } elseif ($real7 > $tolerancia7) {
                    $colorClass7 = 'color-red';
					$RedFlagCliente7++;
                } else {
                    $colorClass7 = 'color-yellow';
                }

                $colorClass8 = '';
                if ($real8 < $meta8) {
                    $colorClass8 = 'color-green';
                } elseif ($real8 > $tolerancia8) {
                    $colorClass8 = 'color-red';
					$RedFlagCliente8++;
                } else {
                    $colorClass8 = 'color-yellow';
                }

                $colorClass9 = '';
                if ($real9 < $meta9) {
                    $colorClass9 = 'color-green';
                } elseif ($real9 > $tolerancia9) {
                    $colorClass9 = 'color-red';
					$RedFlagCliente9++;
                } else {
                    $colorClass9 = 'color-yellow';
                }

                $colorClass10 = '';
                if ($real10 < $meta10) {
                    $colorClass10 = 'color-green';
                } elseif ($real10 > $tolerancia10) {
                    $colorClass10 = 'color-red';
					$RedFlagCliente10++;
                } else {
                    $colorClass10 = 'color-yellow';
                }

                $colorClass11 = '';
                if ($real11 < $meta11) {
                    $colorClass11 = 'color-green';
                } elseif ($real11 > $tolerancia11) {
                    $colorClass11 = 'color-red';
					$RedFlagCliente11++;
                } else {
                    $colorClass11 = 'color-yellow';
                }
               
                    
                echo "<tr>";
                echo "<td>" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

                echo "</tr>";
                if ($count == 1) {
                    break;
                }
                
            }
        } else {
            echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
        }

//-------------------cuarto registro--------------------------------------------

// FILA CUATRO -> COLOCAR $RedFlagCliente++; HASTA $RedFlagCliente11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        
        $cellColor = '';
		if ($real > $meta) {
		$cellColor = 'highlight-green'; // Verde si es mayor que meta
		} elseif ($real < $tolerancia) {
		$cellColor = 'highlight-red'; 
		$RedFlagCliente++;
		} elseif ($real >= $tolerancia && $real <= $meta) {
		$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
		}

		$cellColor1 = '';
		if ($real1 > $meta1) {
		$cellColor1 = 'highlight-green'; // Verde si es mayor que meta
		} elseif ($real1 < $tolerancia1) {
		$cellColor1 = 'highlight-red'; // Rojo si es menor que la tolerancia
		$RedFlagCliente1++;
		} elseif ($real1 >= $tolerancia1 && $real1 <= $meta1) {
		$cellColor1 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
		}




$cellColor2 = '';
if ($real2 > $meta2) {
$cellColor2 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real2 < $tolerancia2) {
$cellColor2 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente2++;
} elseif ($real2 >= $tolerancia2 && $real2 <= $meta2) {
$cellColor2 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor3 = '';
if ($real3 > $meta3) {
$cellColor3 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real3 < $tolerancia3) {
$cellColor3 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente3++;
} elseif ($real3 >= $tolerancia3 && $real3 <= $meta3) {
$cellColor3 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor4 = '';
if ($real4 > $meta4) {
$cellColor4 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real4 < $tolerancia4) {
$cellColor4 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente4++;
} elseif ($real4 >= $tolerancia4 && $real4 <= $meta4) {
$cellColor4 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor5 = '';
if ($real5 > $meta5) {
$cellColor5 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real5 < $tolerancia5) {
$cellColor5 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente5++;
} elseif ($real5 >= $tolerancia5 && $real5 <= $meta5) {
$cellColor5 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor6 = '';
if ($real6 > $meta6) {
$cellColor6 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real6 < $tolerancia6) {
$cellColor6 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente6++;
} elseif ($real6 >= $tolerancia6 && $real6 <= $meta6) {
$cellColor6 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor7 = '';
if ($real7 > $meta7) {
$cellColor7 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real7 < $tolerancia7) {
$cellColor7 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente7++;
} elseif ($real7 >= $tolerancia7 && $real7 <= $meta7) {
$cellColor7 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor8 = '';
if ($real8 > $meta8) {
$cellColor8 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real8 < $tolerancia8) {
$cellColor8 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente8++;
} elseif ($real8 >= $tolerancia8 && $real8 <= $meta8) {
$cellColor8 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor9 = '';
if ($real9 > $meta9) {
$cellColor9 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real9 < $tolerancia9) {
$cellColor9 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente9++;
} elseif ($real9 >= $tolerancia9 && $real9 <= $meta9) {
$cellColor9 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor10 = '';
if ($real10 > $meta9) {
$cellColor10 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real10 < $tolerancia10) {
$cellColor10 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente10++;
} elseif ($real10 >= $tolerancia10 && $real9 <= $meta10) {
$cellColor10 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor11 = '';
if ($real11 > $meta11) {
$cellColor11 = 'highlight-green';
} elseif ($real11 >= $meta11 && $real11 <= $tolerancia11) {
$cellColor11 = 'highlight-yellow';
} else {
$cellColor11 = 'highlight-red';
$RedFlagCliente11++;
}

// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
echo "<td contenteditable='true' class='$cellColor10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}


//----------------------------registro 5---------------------------

// FILA CINCO -> COLOCAR $RedFlagCliente++; HASTA $RedFlagCliente11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        
        $cellColor = '';
if ($real > $meta) {
$cellColor = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real < $tolerancia) {
$cellColor = 'highlight-red';
$RedFlagCliente++;

} elseif ($real >= $tolerancia && $real <= $meta) {
$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor1 = '';
if ($real1 > $meta1) {
$cellColor1 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real1 < $tolerancia1) {
$cellColor1 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente1++;
} elseif ($real1 >= $tolerancia1 && $real1 <= $meta1) {
$cellColor1 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}




$cellColor2 = '';
if ($real2 > $meta2) {
$cellColor2 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real2 < $tolerancia2) {
$cellColor2 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente2++;
} elseif ($real2 >= $tolerancia2 && $real2 <= $meta2) {
$cellColor2 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor3 = '';
if ($real3 > $meta3) {
$cellColor3 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real3 < $tolerancia3) {
$cellColor3 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente3++;
} elseif ($real3 >= $tolerancia3 && $real3 <= $meta3) {
$cellColor3 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor4 = '';
if ($real4 > $meta4) {
$cellColor4 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real4 < $tolerancia4) {
$cellColor4 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente4++;
} elseif ($real4 >= $tolerancia4 && $real4 <= $meta4) {
$cellColor4 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor5 = '';
if ($real5 > $meta5) {
$cellColor5 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real5 < $tolerancia5) {
$cellColor5 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente5++;
} elseif ($real5 >= $tolerancia5 && $real5 <= $meta5) {
$cellColor5 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor6 = '';
if ($real6 > $meta6) {
$cellColor6 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real6 < $tolerancia6) {
$cellColor6 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente6++;
} elseif ($real6 >= $tolerancia6 && $real6 <= $meta6) {
$cellColor6 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor7 = '';
if ($real7 > $meta7) {
$cellColor7 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real7 < $tolerancia7) {
$cellColor7 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente7++;
} elseif ($real7 >= $tolerancia7 && $real7 <= $meta7) {
$cellColor7 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor8 = '';
if ($real8 > $meta8) {
$cellColor8 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real8 < $tolerancia8) {
$cellColor8 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente8++;
} elseif ($real8 >= $tolerancia8 && $real8 <= $meta8) {
$cellColor8 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor9 = '';
if ($real9 > $meta9) {
$cellColor9 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real9 < $tolerancia9) {
$cellColor9 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente9++;
} elseif ($real9 >= $tolerancia9 && $real9 <= $meta9) {
$cellColor9 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor10 = '';
if ($real10 > $meta9) {
$cellColor10 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real10 < $tolerancia10) {
$cellColor10 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagCliente10++;
} elseif ($real10 >= $tolerancia10 && $real9 <= $meta10) {
$cellColor10 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor11 = '';
if ($real11 > $meta11) {
$cellColor11 = 'highlight-green';
} elseif ($real11 >= $meta11 && $real11 <= $tolerancia11) {
$cellColor11 = 'highlight-yellow';
} else {
$cellColor11 = 'highlight-red';
$RedFlagCliente11++;
}

// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
echo "<td contenteditable='true' class='$cellColor10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}

echo "<tr><td colspan='39' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia La Empresa</td></tr>";


//------------------------registro 6-------

// FILA SEIS -> COLOCAR $RedFlagEmpresa++; HASTA $RedFlagEmpresa11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }

        $colorClass1 = '';
        if ($real1 < $meta1) {
            $colorClass1 = 'color-green';
        } elseif ($real1 > $tolerancia1) {
            $colorClass1 = 'color-red';
			$RedFlagEmpresa1++;
        } else {
            $colorClass1 = 'color-yellow';
        }

        $colorClass2 = '';
        if ($real2 < $meta2) {
            $colorClass2 = 'color-green';
        } elseif ($real2 > $tolerancia2) {
            $colorClass2 = 'color-red';
			$RedFlagEmpresa2++;
        } else {
            $colorClass2 = 'color-yellow';
        }

        $colorClass3 = '';
        if ($real3 < $meta3) {
            $colorClass3 = 'color-green';
        } elseif ($real3 > $tolerancia3) {
            $colorClass3 = 'color-red';
			$RedFlagEmpresa3++;
        } else {
            $colorClass3 = 'color-yellow';
        }

        $colorClass4 = '';
        if ($real4 < $meta4) {
            $colorClass4 = 'color-green';
        } elseif ($real4 > $tolerancia4) {
            $colorClass4 = 'color-red';
			$RedFlagEmpresa4++;
        } else {
            $colorClass4 = 'color-yellow';
        }

        $colorClass5 = '';
        if ($real5 < $meta5) {
            $colorClass5 = 'color-green';
        } elseif ($real5 > $tolerancia5) {
            $colorClass5 = 'color-red';
			$RedFlagEmpresa5++;
        } else {
            $colorClass5 = 'color-yellow';
        }

        $colorClass6 = '';
        if ($real6 < $meta6) {
            $colorClass6 = 'color-green';
        } elseif ($real6 > $tolerancia6) {
            $colorClass6 = 'color-red';
			$RedFlagEmpresa6++;
        } else {
            $colorClass6 = 'color-yellow';
        }

        $colorClass7 = '';
        if ($real7 < $meta7) {
            $colorClass7 = 'color-green';
        } elseif ($real7 > $tolerancia7) {
            $colorClass7 = 'color-red';
			$RedFlagEmpresa7++;
        } else {
            $colorClass7 = 'color-yellow';
        }

        $colorClass8 = '';
        if ($real8 < $meta8) {
            $colorClass8 = 'color-green';
        } elseif ($real8 > $tolerancia8) {
            $colorClass8 = 'color-red';
			$RedFlagEmpresa8++;
        } else {
            $colorClass8 = 'color-yellow';
        }

        $colorClass9 = '';
        if ($real9 < $meta9) {
            $colorClass9 = 'color-green';
        } elseif ($real9 > $tolerancia9) {
            $colorClass9 = 'color-red';
			$RedFlagEmpresa9++;
        } else {
            $colorClass9 = 'color-yellow';
        }

        $colorClass10 = '';
        if ($real10 < $meta10) {
            $colorClass10 = 'color-green';
        } elseif ($real10 > $tolerancia10) {
            $colorClass10 = 'color-red';
			$RedFlagEmpresa10++;
        } else {
            $colorClass10 = 'color-yellow';
        }

        $colorClass11 = '';
        if ($real11 < $meta11) {
            $colorClass11 = 'color-green';
        } elseif ($real11 > $tolerancia11) {
            $colorClass11 = 'color-red';
			$RedFlagEmpresa11++;
        } else {
            $colorClass11 = 'color-yellow';
        }
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}


// FILA SIETE -> COLOCAR $RedFlagEmpresa++; HASTA $RedFlagEmpresa11++;


if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        
        $cellColor = '';
if ($real > $meta) {
$cellColor = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real < $tolerancia) {
$cellColor = 'highlight-red'; 
$RedFlagEmpresa++;
} elseif ($real >= $tolerancia && $real <= $meta) {
$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor1 = '';
if ($real1 > $meta1) {
$cellColor1 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real1 < $tolerancia1) {
$cellColor1 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa1++;
} elseif ($real1 >= $tolerancia1 && $real1 <= $meta1) {
$cellColor1 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}




$cellColor2 = '';
if ($real2 > $meta2) {
$cellColor2 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real2 < $tolerancia2) {
$cellColor2 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa2++;
} elseif ($real2 >= $tolerancia2 && $real2 <= $meta2) {
$cellColor2 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor3 = '';
if ($real3 > $meta3) {
$cellColor3 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real3 < $tolerancia3) {
$cellColor3 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa3++;
} elseif ($real3 >= $tolerancia3 && $real3 <= $meta3) {
$cellColor3 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor4 = '';
if ($real4 > $meta4) {
$cellColor4 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real4 < $tolerancia4) {
$cellColor4 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa4++;
} elseif ($real4 >= $tolerancia4 && $real4 <= $meta4) {
$cellColor4 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor5 = '';
if ($real5 > $meta5) {
$cellColor5 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real5 < $tolerancia5) {
$cellColor5 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa5++;
} elseif ($real5 >= $tolerancia5 && $real5 <= $meta5) {
$cellColor5 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor6 = '';
if ($real6 > $meta6) {
$cellColor6 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real6 < $tolerancia6) {
$cellColor6 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa6++;
} elseif ($real6 >= $tolerancia6 && $real6 <= $meta6) {
$cellColor6 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor7 = '';
if ($real7 > $meta7) {
$cellColor7 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real7 < $tolerancia7) {
$cellColor7 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa7++;
} elseif ($real7 >= $tolerancia7 && $real7 <= $meta7) {
$cellColor7 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor8 = '';
if ($real8 > $meta8) {
$cellColor8 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real8 < $tolerancia8) {
$cellColor8 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa8++;
} elseif ($real8 >= $tolerancia8 && $real8 <= $meta8) {
$cellColor8 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor9 = '';
if ($real9 > $meta9) {
$cellColor9 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real9 < $tolerancia9) {
$cellColor9 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa9++;
} elseif ($real9 >= $tolerancia9 && $real9 <= $meta9) {
$cellColor9 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor10 = '';
if ($real10 > $meta9) {
$cellColor10 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real10 < $tolerancia10) {
$cellColor10 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa10++;
} elseif ($real10 >= $tolerancia10 && $real9 <= $meta10) {
$cellColor10 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor11 = '';
if ($real11 > $meta11) {
$cellColor11 = 'highlight-green';
} elseif ($real11 >= $meta11 && $real11 <= $tolerancia11) {
$cellColor11 = 'highlight-yellow';
} else {
$cellColor11 = 'highlight-red';
$RedFlagEmpresa11++;
}

// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
echo "<td contenteditable='true' class='$cellColor10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}


// FILA OCHO -> COLOCAR $RedFlagEmpresa++; HASTA $RedFlagEmpresa11++;


if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        
        $cellColor = '';
if ($real > $meta) {
$cellColor = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real < $tolerancia) {
$cellColor = 'highlight-red'; 
$RedFlagEmpresa++;
} elseif ($real >= $tolerancia && $real <= $meta) {
$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor1 = '';
if ($real1 > $meta1) {
$cellColor1 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real1 < $tolerancia1) {
$cellColor1 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa1++;
} elseif ($real1 >= $tolerancia1 && $real1 <= $meta1) {
$cellColor1 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}




$cellColor2 = '';
if ($real2 > $meta2) {
$cellColor2 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real2 < $tolerancia2) {
$cellColor2 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa2++;
} elseif ($real2 >= $tolerancia2 && $real2 <= $meta2) {
$cellColor2 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor3 = '';
if ($real3 > $meta3) {
$cellColor3 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real3 < $tolerancia3) {
$cellColor3 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa3++;
} elseif ($real3 >= $tolerancia3 && $real3 <= $meta3) {
$cellColor3 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor4 = '';
if ($real4 > $meta4) {
$cellColor4 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real4 < $tolerancia4) {
$cellColor4 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa4++;
} elseif ($real4 >= $tolerancia4 && $real4 <= $meta4) {
$cellColor4 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor5 = '';
if ($real5 > $meta5) {
$cellColor5 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real5 < $tolerancia5) {
$cellColor5 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa5++;
} elseif ($real5 >= $tolerancia5 && $real5 <= $meta5) {
$cellColor5 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor6 = '';
if ($real6 > $meta6) {
$cellColor6 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real6 < $tolerancia6) {
$cellColor6 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa6++;
} elseif ($real6 >= $tolerancia6 && $real6 <= $meta6) {
$cellColor6 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}



$cellColor7 = '';
if ($real7 > $meta7) {
$cellColor7 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real7 < $tolerancia7) {
$cellColor7 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa7++;
} elseif ($real7 >= $tolerancia7 && $real7 <= $meta7) {
$cellColor7 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor8 = '';
if ($real8 > $meta8) {
$cellColor8 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real8 < $tolerancia8) {
$cellColor8 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa8++;
} elseif ($real8 >= $tolerancia8 && $real8 <= $meta8) {
$cellColor8 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor9 = '';
if ($real9 > $meta9) {
$cellColor9 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real9 < $tolerancia9) {
$cellColor9 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa9++;
} elseif ($real9 >= $tolerancia9 && $real9 <= $meta9) {
$cellColor9 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

$cellColor10 = '';
if ($real10 > $meta9) {
$cellColor10 = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real10 < $tolerancia10) {
$cellColor10 = 'highlight-red'; // Rojo si es menor que la tolerancia
$RedFlagEmpresa10++;
} elseif ($real10 >= $tolerancia10 && $real9 <= $meta10) {
$cellColor10 = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


$cellColor11 = '';
if ($real11 > $meta11) {
$cellColor11 = 'highlight-green';
} elseif ($real11 >= $meta11 && $real11 <= $tolerancia11) {
$cellColor11 = 'highlight-yellow';
} else {
$cellColor11 = 'highlight-red';
$RedFlagEmpresa11++;
}

// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
echo "<td contenteditable='true' class='$cellColor10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
echo "<td contenteditable='true' class='$cellColor11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}


// FILA NUEVE -> COLOCAR $RedFlagEmpresa++; HASTA $RedFlagEmpresa11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }

        $colorClass1 = '';
        if ($real1 < $meta1) {
            $colorClass1 = 'color-green';
        } elseif ($real1 > $tolerancia1) {
            $colorClass1 = 'color-red';
			$RedFlagEmpresa1++;
        } else {
            $colorClass1 = 'color-yellow';
        }

        $colorClass2 = '';
        if ($real2 < $meta2) {
            $colorClass2 = 'color-green';
        } elseif ($real2 > $tolerancia2) {
            $colorClass2 = 'color-red';
			$RedFlagEmpresa2++;
        } else {
            $colorClass2 = 'color-yellow';
        }

        $colorClass3 = '';
        if ($real3 < $meta3) {
            $colorClass3 = 'color-green';
        } elseif ($real3 > $tolerancia3) {
            $colorClass3 = 'color-red';
			$RedFlagEmpresa3++;
        } else {
            $colorClass3 = 'color-yellow';
        }

        $colorClass4 = '';
        if ($real4 < $meta4) {
            $colorClass4 = 'color-green';
        } elseif ($real4 > $tolerancia4) {
            $colorClass4 = 'color-red';
			$RedFlagEmpresa4++;
        } else {
            $colorClass4 = 'color-yellow';
        }

        $colorClass5 = '';
        if ($real5 < $meta5) {
            $colorClass5 = 'color-green';
        } elseif ($real5 > $tolerancia5) {
            $colorClass5 = 'color-red';
			$RedFlagEmpresa5++;
        } else {
            $colorClass5 = 'color-yellow';
        }

        $colorClass6 = '';
        if ($real6 < $meta6) {
            $colorClass6 = 'color-green';
        } elseif ($real6 > $tolerancia6) {
            $colorClass6 = 'color-red';
			$RedFlagEmpresa6++;
        } else {
            $colorClass6 = 'color-yellow';
        }

        $colorClass7 = '';
        if ($real7 < $meta7) {
            $colorClass7 = 'color-green';
        } elseif ($real7 > $tolerancia7) {
            $colorClass7 = 'color-red';
			$RedFlagEmpresa7++;
        } else {
            $colorClass7 = 'color-yellow';
        }

        $colorClass8 = '';
        if ($real8 < $meta8) {
            $colorClass8 = 'color-green';
        } elseif ($real8 > $tolerancia8) {
            $colorClass8 = 'color-red';
			$RedFlagEmpresa8++;
        } else {
            $colorClass8 = 'color-yellow';
        }

        $colorClass9 = '';
        if ($real9 < $meta9) {
            $colorClass9 = 'color-green';
        } elseif ($real9 > $tolerancia9) {
            $colorClass9 = 'color-red';
			$RedFlagEmpresa9++;
        } else {
            $colorClass9 = 'color-yellow';
        }

        $colorClass10 = '';
        if ($real10 < $meta10) {
            $colorClass10 = 'color-green';
        } elseif ($real10 > $tolerancia10) {
            $colorClass10 = 'color-red';
			$RedFlagEmpresa10++;
        } else {
            $colorClass10 = 'color-yellow';
        }

        $colorClass11 = '';
        if ($real11 < $meta11) {
            $colorClass11 = 'color-green';
        } elseif ($real11 > $tolerancia11) {
            $colorClass11 = 'color-red';
			$RedFlagEmpresa11++;
        } else {
            $colorClass11 = 'color-yellow';
        }
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}
       


// FILA DIEZ -> COLOCAR $RedFlagEmpresa++; HASTA $RedFlagEmpresa11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }

        $colorClass1 = '';
        if ($real1 < $meta1) {
            $colorClass1 = 'color-green';
        } elseif ($real1 > $tolerancia1) {
            $colorClass1 = 'color-red';
			$RedFlagEmpresa1++;
        } else {
            $colorClass1 = 'color-yellow';
        }

        $colorClass2 = '';
        if ($real2 < $meta2) {
            $colorClass2 = 'color-green';
        } elseif ($real2 > $tolerancia2) {
            $colorClass2 = 'color-red';
			$RedFlagEmpresa2++;
        } else {
            $colorClass2 = 'color-yellow';
        }

        $colorClass3 = '';
        if ($real3 < $meta3) {
            $colorClass3 = 'color-green';
        } elseif ($real3 > $tolerancia3) {
            $colorClass3 = 'color-red';
			$RedFlagEmpresa3++;
        } else {
            $colorClass3 = 'color-yellow';
        }

        $colorClass4 = '';
        if ($real4 < $meta4) {
            $colorClass4 = 'color-green';
        } elseif ($real4 > $tolerancia4) {
            $colorClass4 = 'color-red';
			$RedFlagEmpresa4++;
        } else {
            $colorClass4 = 'color-yellow';
        }

        $colorClass5 = '';
        if ($real5 < $meta5) {
            $colorClass5 = 'color-green';
        } elseif ($real5 > $tolerancia5) {
            $colorClass5 = 'color-red';
			$RedFlagEmpresa5++;
        } else {
            $colorClass5 = 'color-yellow';
        }

        $colorClass6 = '';
        if ($real6 < $meta6) {
            $colorClass6 = 'color-green';
        } elseif ($real6 > $tolerancia6) {
            $colorClass6 = 'color-red';
			$RedFlagEmpresa6++;
        } else {
            $colorClass6 = 'color-yellow';
        }

        $colorClass7 = '';
        if ($real7 < $meta7) {
            $colorClass7 = 'color-green';
        } elseif ($real7 > $tolerancia7) {
            $colorClass7 = 'color-red';
			$RedFlagEmpresa7++;
        } else {
            $colorClass7 = 'color-yellow';
        }

        $colorClass8 = '';
        if ($real8 < $meta8) {
            $colorClass8 = 'color-green';
        } elseif ($real8 > $tolerancia8) {
            $colorClass8 = 'color-red';
			$RedFlagEmpresa8++;
        } else {
            $colorClass8 = 'color-yellow';
        }

        $colorClass9 = '';
        if ($real9 < $meta9) {
            $colorClass9 = 'color-green';
        } elseif ($real9 > $tolerancia9) {
            $colorClass9 = 'color-red';
			$RedFlagEmpresa9++;
        } else {
            $colorClass9 = 'color-yellow';
        }

        $colorClass10 = '';
        if ($real10 < $meta10) {
            $colorClass10 = 'color-green';
        } elseif ($real10 > $tolerancia10) {
            $colorClass10 = 'color-red';
			$RedFlagEmpresa10++;
        } else {
            $colorClass10 = 'color-yellow';
        }

        $colorClass11 = '';
        if ($real11 < $meta11) {
            $colorClass11 = 'color-green';
        } elseif ($real11 > $tolerancia11) {
            $colorClass11 = 'color-red';
			$RedFlagEmpresa11++;
        } else {
            $colorClass11 = 'color-yellow';
        }
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}// Cerrar la conexión a la base de datos



echo "<tr><td colspan='39' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia El Personal</td></tr>";

// FILA ONCE -> COLOCAR $RedFlagPersonal++; HASTA $RedFlagPersonal11++;

if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        $colorClass = '';
        
        if ($real == $meta) {
            // Si el real es igual a la meta, se pinta de verde
            $colorClass = 'color-green';
        } elseif ($real == $tolerancia) {
            // Si el real es igual a la tolerancia, también se pinta de verde
            $colorClass = 'color-green';
        } elseif ($real > $meta && $real < $tolerancia) {
            // Si el real está entre meta y tolerancia, se pinta de verde
            $colorClass = 'color-green';
        } elseif ($real < $tolerancia) {
            // Si el real está por debajo de la meta, se pinta de rojo
            $colorClass = 'color-red';
			$RedFlagPersonal++; // BANDERA RedFlagPersonal
        } else {
            // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
            $colorClass = 'color-green'; // O cualquier otro color que prefieras
        }
            
                     // Real está por debajo de la meta
            
     
                     $colorClass1 = '';
        
                     if ($real1 == $meta1) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass1 = 'color-green';
                     } elseif ($real1 == $tolerancia1) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass1 = 'color-green';
                     } elseif ($real1 > $meta1 && $real1 < $tolerancia1) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass1 = 'color-green';
                     } elseif ($real1 < $tolerancia1) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass1 = 'color-red';
						 $RedFlagPersonal1++; //BANDERA RED FLAG PERSONAL
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass1 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass2 = '';
        
                     if ($real2 == $meta2) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass2 = 'color-green';
                     } elseif ($real2 == $tolerancia2) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass2 = 'color-green';
                     } elseif ($real2 > $meta2 && $real2< $tolerancia2) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass2 = 'color-green';
                     } elseif ($real2 < $tolerancia2) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass2 = 'color-red';
						 $RedFlagPersonal2++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass2 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass3 = '';
        
                     if ($real3 == $meta3) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass3 = 'color-green';
                     } elseif ($real3 == $tolerancia3) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass3 = 'color-green';
                     } elseif ($real3 > $meta3 && $real3< $tolerancia3) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass3 = 'color-green';
                     } elseif ($real3 < $tolerancia3) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass3 = 'color-red';
						 $RedFlagPersonal3++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass3 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass4 = '';
        
                     if ($real4 == $meta4) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass4 = 'color-green';
                     } elseif ($real4 == $tolerancia4) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass4 = 'color-green';
                     } elseif ($real4 > $meta4 && $real4< $tolerancia4) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass4 = 'color-green';
                     } elseif ($real4 < $tolerancia4) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass4 = 'color-red';
						 $RedFlagPersonal4++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass4 = 'color-green'; // O cualquier otro color que prefieras
                     }
                     $colorClass5 = '';
        
                     if ($real5 == $meta5) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass5 = 'color-green';
                     } elseif ($real5 == $tolerancia5) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass5 = 'color-green';
                     } elseif ($real5 > $meta5 && $real5< $tolerancia5) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass5 = 'color-green';
                     } elseif ($real5 < $tolerancia5) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass5 = 'color-red';
						 $RedFlagPersonal5++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass5 = 'color-green'; // O cualquier otro color que prefieras
                     }
                     $colorClass6 = '';
        
                     if ($real6 == $meta6) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass6 = 'color-green';
                     } elseif ($real6 == $tolerancia6) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass6 = 'color-green';
                     } elseif ($real6 > $meta6 && $real6< $tolerancia6) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass6 = 'color-green';
                     } elseif ($real6 < $tolerancia6) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass6 = 'color-red';
						 $RedFlagPersonal6++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass6 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass7 = '';
        
                     if ($real7 == $meta7) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass7 = 'color-green';
                     } elseif ($real7 == $tolerancia7) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass7 = 'color-green';
                     } elseif ($real7 > $meta7 && $real7< $tolerancia7) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass7 = 'color-green';
                     } elseif ($real7 < $tolerancia7) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass7 = 'color-red';
						 $RedFlagPersonal7++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass6 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass8 = '';
        
                     if ($real8 == $meta8) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass8 = 'color-green';
                     } elseif ($real8 == $tolerancia8) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass8 = 'color-green';
                     } elseif ($real8 > $meta8 && $real8< $tolerancia8) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass8 = 'color-green';
                     } elseif ($real8 < $tolerancia8) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass8 = 'color-red';
						 $RedFlagPersonal8++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass8 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass9 = '';
        
                     if ($real9 == $meta9) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass9 = 'color-green';
                     } elseif ($real9 == $tolerancia7) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass9 = 'color-green';
                     } elseif ($real9 > $meta9 && $real9< $tolerancia9) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass9 = 'color-green';
                     } elseif ($real9 < $tolerancia9) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass9 = 'color-red';
						 $RedFlagPersonal9++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass9 = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass10 = '';
        
                     if ($real10  == $meta10 ) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass10  = 'color-green';
                     } elseif ($real10  == $tolerancia10 ) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass10  = 'color-green';
                     } elseif ($real10  > $meta10  && $real10 < $tolerancia10 ) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass10  = 'color-green';
                     } elseif ($real10  < $tolerancia10 ) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass10  = 'color-red';
						 $RedFlagPersonal10++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass10  = 'color-green'; // O cualquier otro color que prefieras
                     }

                     $colorClass11 = '';
        
                     if ($real11 == $meta11) {
                         // Si el real es igual a la meta, se pinta de verde
                         $colorClass11  = 'color-green';
                     } elseif ($real11  == $tolerancia11 ) {
                         // Si el real es igual a la tolerancia, también se pinta de verde
                         $colorClass11  = 'color-green';
                     } elseif ($real11  > $meta11  && $real11 < $tolerancia11 ) {
                         // Si el real está entre meta y tolerancia, se pinta de verde
                         $colorClass11  = 'color-green';
                     } elseif ($real11  < $tolerancia11 ) {
                         // Si el real está por debajo de la meta, se pinta de rojo
                         $colorClass11  = 'color-red';
						 $RedFlagPersonal11++;
                     } else {
                         // Si el real está por encima de la tolerancia, se puede agregar una clase adicional o manejar otro caso
                         $colorClass11  = 'color-green'; // O cualquier otro color que prefieras
                     }
            
        echo "<tr>";
        echo "<td>d" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }

// --------------------------------------------------------------------
// PARA FILA DOCE -> Es de PERSONAL


if ($result->num_rows > 0) {
    $count = 0; // Contador para controlar el número de registros procesados
    
    // Iterar sobre todos los registros
    while ($row = $result->fetch_assoc()) {
        // Incrementar el contador
        $count++;
        
        // Obtener los valores y convertirlos a flotantes
        $meta = floatval($row["meta"]);
        $tolerancia = floatval($row["tolerancia"]);
        $real = floatval($row["reales"]);

        $meta1 = floatval($row["meta1"]);
        $tolerancia1 = floatval($row["tolerancia1"]);
        $real1 = floatval($row["reales1"]);

        $meta2 = floatval($row["meta2"]);
        $tolerancia2 = floatval($row["tolerancia2"]);
        $real2 = floatval($row["reales2"]);

        $meta3 = floatval($row["meta3"]);
        $tolerancia3 = floatval($row["tolerancia3"]);
        $real3 = floatval($row["reales3"]);

        $meta4 = floatval($row["meta4"]);
        $tolerancia4 = floatval($row["tolerancia4"]);
        $real4 = floatval($row["reales4"]);

        $meta5 = floatval($row["meta5"]);
        $tolerancia5 = floatval($row["tolerancia5"]);
        $real5 = floatval($row["reales5"]);

        $meta6 = floatval($row["meta6"]);
        $tolerancia6 = floatval($row["tolerancia6"]);
        $real6 = floatval($row["reales6"]);

        $meta7 = floatval($row["meta7"]);
        $tolerancia7 = floatval($row["tolerancia7"]);
        $real7 = floatval($row["reales7"]);

        $meta8 = floatval($row["meta8"]);
        $tolerancia8 = floatval($row["tolerancia8"]);
        $real8 = floatval($row["reales8"]);

        $meta9 = floatval($row["meta9"]);
        $tolerancia9 = floatval($row["tolerancia9"]);
        $real9 = floatval($row["reales9"]);

        $meta10 = floatval($row["meta10"]);
        $tolerancia10 = floatval($row["tolerancia10"]);
        $real10 = floatval($row["reales10"]);

        $meta11 = floatval($row["meta11"]);
        $tolerancia11 = floatval($row["tolerancia11"]);
        $real11 = floatval($row["reales11"]);
        
        $colorClass = '';
        
        if ($real > $meta) {
            $colorClass = 'color-green';
        } elseif ($real < $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagPersonal++;
        } else {
            $colorClass = 'color-yellow';
        }

        $colorClass1 = '';
        if ($real1 > $meta1) {
            $colorClass1 = 'color-green';
        } elseif ($real1 < $tolerancia1) {
            $colorClass1 = 'color-red';
			$RedFlagPersonal1++;
        } else {
            $colorClass1 = 'color-yellow';
        }

        $colorClass2 = '';
        if ($real2 > $meta2) {
            $colorClass2 = 'color-green';
        } elseif ($real2 < $tolerancia2) {
            $colorClass2 = 'color-red';
			$RedFlagPersonal2++;
        } else {
            $colorClass2 = 'color-yellow';
        }

        $colorClass3 = '';
        if ($real3 > $meta3) {
            $colorClass3 = 'color-green';
        } elseif ($real3 < $tolerancia3) {
            $colorClass3 = 'color-red';
			$RedFlagPersonal3++;
        } else {
            $colorClass3 = 'color-yellow';
        }

        $colorClass4 = '';
        if ($real4 > $meta4) {
            $colorClass4 = 'color-green';
        } elseif ($real4 < $tolerancia4) {
            $colorClass4 = 'color-red';
			$RedFlagPersonal4++;
        } else {
            $colorClass4 = 'color-yellow';
        }

        $colorClass5 = '';
        if ($real5 > $meta5) {
            $colorClass5 = 'color-green';
        } elseif ($real5 < $tolerancia5) {
            $colorClass5 = 'color-red';
			$RedFlagPersonal5++;
        } else {
            $colorClass5 = 'color-yellow';
        }

        $colorClass6 = '';
        if ($real6 > $meta6) {
            $colorClass6 = 'color-green';
        } elseif ($real6 < $tolerancia6) {
            $colorClass6 = 'color-red';
			$RedFlagPersonal6++;
        } else {
            $colorClass6 = 'color-yellow';
        }

        $colorClass7 = '';
        if ($real7 > $meta7) {
            $colorClass7 = 'color-green';
        } elseif ($real7 < $tolerancia7) {
            $colorClass7 = 'color-red';
			$RedFlagPersonal7++;
        } else {
            $colorClass7 = 'color-yellow';
        }

        $colorClass8 = '';
        if ($real8 > $meta8) {
            $colorClass8 = 'color-green';
        } elseif ($real8 < $tolerancia8) {
            $colorClass8 = 'color-red';
			$RedFlagPersonal8++;
        } else {
            $colorClass8 = 'color-yellow';
        }

        $colorClass9 = '';
        if ($real9 > $meta9) {
            $colorClass9 = 'color-green';
        } elseif ($real9 < $tolerancia9) {
            $colorClass9 = 'color-red';
			$RedFlagPersonal9++;
        } else {
            $colorClass9 = 'color-yellow';
        }

        $colorClass10 = '';
        if ($real10 > $meta10) {
            $colorClass10 = 'color-green';
        } elseif ($real10 < $tolerancia10) {
            $colorClass10 = 'color-red';
			$RedFlagPersonal10++;
        } else {
            $colorClass10 = 'color-yellow';
        }

        $colorClass11 = '';
        if ($real11 > $meta11) {
            $colorClass11 = 'color-green';
        } elseif ($real11 < $tolerancia11) {
            $colorClass11 = 'color-red';
			$RedFlagPersonal11++;
        } else {
            $colorClass11 = 'color-yellow';
        }
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta1"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia1"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales1"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta2"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia2"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales2"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta3"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia3"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales3"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta4"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia4"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales4"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta5"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia5"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales5"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta6"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia6"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales6"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta7"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia7"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales7"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta8"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia8"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales8"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta9"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia9"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales9"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta10'>" . $row["meta10"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia10'>" . $row["tolerancia10"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass10' data-indice='" . $row["indice"] . "' data-campo='reales10'>" . $row["reales10"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta11'>" . $row["meta11"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia11'>" . $row["tolerancia11"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass11' data-indice='" . $row["indice"] . "' data-campo='reales11'>" . $row["reales11"] . "</td>";

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}// Cerrar la conexión a la base de datos






// -------------------------------------------------------
// SALIDAS DE VALIDACION SI - NO


    echo "<tr>
            <td colspan=''>cumplimiento de contrato programa</td>";

	//Condicion especial	
	// RedFlagCliente Va al ultimo por el incremento que se considera para validación
	// debido a que si, queda al principio y alguno de los dos anteriores no se cumple
	// lo devolvera a verde, aunque tenga dos o más rojos.
	
	if($RedFlagEmpresa >=2 || $RedFlagPersonal >=2)
		echo "<td colspan='3' class='color-red'><span> No". $RedFlagCliente ." </span></td>";
	elseif($RedFlagCliente >= 3)
		echo "<td colspan='3' class='color-red'><span> No". $RedFlagCliente ." </span></td>";
	else
		echo "<td colspan='3' class='color-green'><span> Si". $RedFlagCliente ." </span></td>";
	
	/*
	
	if($RedFlagEmpresa1 >=2 || $RedFlagPersonal1 >=2)
		echo "<td colspan='3' class='color-red'><span> No </span></td>";
	elseif($RedFlagCliente1 >= 3)
		echo "<td colspan='3' class='color-red'><span> No </span></td>";
	else
		echo "<td colspan='3' class='color-green'><span> Si </span></td>";
	
	if($RedFlagEmpresa2 >=2 || $RedFlagPersonal2 >=2)
		echo "<td colspan='3' class='color-red'><span> No </span></td>";
	elseif($RedFlagCliente2 >= 3)
		echo "<td colspan='3' class='color-red'><span> No </span></td>";
	else
		echo "<td colspan='3' class='color-green'><span> Si </span></td>";
	*/
	
	
	// Lo mismo que arriba pero en un ciclo para evitar sobreescritura de codigo
	function checkRedFlags($empresa, $personal, $cliente) {
    if ($empresa >= 1 || $personal >= 1) {
        return "<td colspan='3' class='color-red'><span> No:". $cliente ." </span></td>";
    } elseif ($cliente >= 2) {
        return "<td colspan='3' class='color-red'><span> No:". $cliente ." </span></td>";
    } else {
        return "<td colspan='3' class='color-green'><span> Si: ". $cliente ." </span></td>";
    }
}

	for ($i = 1; $i <= 11; $i++) {
		$RedFlagEmpresa = ${"RedFlagEmpresa".$i};
		$RedFlagPersonal = ${"RedFlagPersonal".$i};
		$RedFlagCliente = ${"RedFlagCliente".$i};

		echo checkRedFlags($RedFlagEmpresa, $RedFlagPersonal, $RedFlagCliente);
	}
	
    echo "</tr>";



} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}
        $conn->close();
        ?>
    </table>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            function updateColor(row) {
                // Aquí se actualizan los colores para todos los campos
                var meta = parseFloat(row.find('td[data-campo="meta"]').text());
                var tolerancia = parseFloat(row.find('td[data-campo="tolerancia"]').text());
                var real = parseFloat(row.find('td[data-campo="reales"]').text());


                var meta1 = parseFloat(row.find('td[data-campo="meta1"]').text());
                var tolerancia1 = parseFloat(row.find('td[data-campo="tolerancia1"]').text());
                var real1 = parseFloat(row.find('td[data-campo="reales1"]').text());
                
      

                var meta2 = parseFloat(row.find('td[data-campo="meta2"]').text());
                var tolerancia2 = parseFloat(row.find('td[data-campo="tolerancia2"]').text());
                var real2 = parseFloat(row.find('td[data-campo="reales2"]').text());

                var meta3 = parseFloat(row.find('td[data-campo="meta3"]').text());
                var tolerancia3 = parseFloat(row.find('td[data-campo="tolerancia3"]').text());
                var real3 = parseFloat(row.find('td[data-campo="reales3"]').text());

                var meta4 = parseFloat(row.find('td[data-campo="meta4"]').text());
                var tolerancia4 = parseFloat(row.find('td[data-campo="tolerancia4"]').text());
                var real4 = parseFloat(row.find('td[data-campo="reales4"]').text());

                var meta5 = parseFloat(row.find('td[data-campo="meta5"]').text());
                var tolerancia5 = parseFloat(row.find('td[data-campo="tolerancia5"]').text());
                var real5 = parseFloat(row.find('td[data-campo="reales5"]').text());

                var meta6 = parseFloat(row.find('td[data-campo="meta6"]').text());
                var tolerancia6 = parseFloat(row.find('td[data-campo="tolerancia6"]').text());
                var real6 = parseFloat(row.find('td[data-campo="reales6"]').text());

                var meta7 = parseFloat(row.find('td[data-campo="meta7"]').text());
                var tolerancia7 = parseFloat(row.find('td[data-campo="tolerancia7"]').text());
                var real7 = parseFloat(row.find('td[data-campo="reales7"]').text());

                var meta8 = parseFloat(row.find('td[data-campo="meta8"]').text());
                var tolerancia8 = parseFloat(row.find('td[data-campo="tolerancia8"]').text());
                var real8 = parseFloat(row.find('td[data-campo="reales8"]').text());

                var meta9 = parseFloat(row.find('td[data-campo="meta9"]').text());
                var tolerancia9 = parseFloat(row.find('td[data-campo="tolerancia9"]').text());
                var real9 = parseFloat(row.find('td[data-campo="reales9"]').text());

                var meta10 = parseFloat(row.find('td[data-campo="meta10"]').text());
                var tolerancia10 = parseFloat(row.find('td[data-campo="tolerancia10"]').text());
                var real10 = parseFloat(row.find('td[data-campo="reales10"]').text());

                var meta11 = parseFloat(row.find('td[data-campo="meta11"]').text());
                var tolerancia11 = parseFloat(row.find('td[data-campo="tolerancia11"]').text());
                var real11 = parseFloat(row.find('td[data-campo="reales11"]').text());
                
                
  

                function setColor(fieldMeta, fieldTolerance, fieldReal) {
                    if (fieldReal < fieldMeta) {
                        return 'color-green';
                        var fila1 = 'color-red';
                    } else if (fieldReal > fieldTolerance) {
                        return 'color-red';
                        var fila1 = 'color-red';
                    } else {
                        return 'color-yellow';
                    }
                }

               
               

               
                
            }
          
            $('td[contenteditable="true"]').on('input', function() {
                updateColor($(this).closest('tr'));
            });

            $('tr').each(function() {
                updateColor($(this));
                
            });
        });
        
        $(document).ready(function(){
    $('td[contenteditable="true"]').blur(function(){
        var indice = $(this).data('indice');
        var campo = $(this).data('campo');
        var valor = $(this).text();

        $.ajax({
            url: '../conexion/updateComitan.php',
            method: 'POST',
            data: {indice: indice, campo: campo, valor: valor},
            success: function(response) {
                console.log('Datos actualizados exitosamente');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al actualizar los datos: ' + textStatus, errorThrown);
            }
        });
    });
});

    </script>
    


<script>
var Real0 = document.getElementById('real0');
Real0.style.backgroundColor = 'red';


function obtenerNombreDeClase(dataCampo) {

            var elemento = document.querySelector([data-campo="${dataCampo}"]);
            if (elemento) {
                return elemento.className;
            }
            return null;
        }

        var claseReal0 = obtenerNombreDeClase('reales');
        var claseReal1 = obtenerNombreDeClase('reales1');

        if(claseReal0='color-red'){
        	Real0.style.backgroundColor = 'red';
            Real0.textContent = 'No';
        }else{
        	Real0.style.backgroundColor = 'green';
            Real0.textContent = 'Si';
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


<?php

// Conexión a la base de datos
include '../conexion/db_conect.php';
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
        FROM comitam
        ";

$resultado = $conn->query($sql);

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
echo "<h2 style='text-align: center;'>ACUMULADO VALORES MENSUALES AGENCIA COMITAN</h2>";

echo "<button onclick='exportToExceles()' style='display: block; margin: 20px auto;'>Generar Excel</button>"; // Botón para exportar

if ($resultado->num_rows > 0) {
    $row_count_5 = 0; // Contador para los registros procesados después de 5
    $row_count_3 = 0; // Contador para los registros procesados después de 3
    
    // Mostrar la tabla
    echo "<table id='acumulados'>
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
