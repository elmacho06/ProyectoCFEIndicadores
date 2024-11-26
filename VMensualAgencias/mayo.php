<?php
// index.php

// Incluir el archivo de conexión
include '../conexion/db_conect.php';

// Consulta para obtener los datos de la tabla empleado
$sql = "SELECT a.indice, a.meta, a.tolerancia, a.reales, 
               c.meta4 AS meta_chenalho, c.tolerancia4 AS tolerancia_chenalho, c.reales4 AS reales_chenalho, 
               o.meta4 AS meta_comalapa, o.tolerancia4 AS tolerancia_comalapa, o.reales4 AS reales_comalapa, 
               b.meta4 AS meta_comitam, b.tolerancia4 AS tolerancia_comitam, b.reales4 AS reales_comitam, 
               d.meta4 AS meta_empleado, d.tolerancia4 AS tolerancia_empleado, d.reales4 AS reales_empleado, 
               e.meta4 AS meta_margaritas, e.tolerancia4 AS tolerancia_margaritas, e.reales4 AS reales_margaritas, 
               f.meta4 AS meta_ocosingo, f.tolerancia4 AS tolerancia_ocosingo, f.reales4 AS reales_ocosingo, 
               g.meta4 AS meta_teopisca, g.tolerancia4 AS tolerancia_teopisca, g.reales4 AS reales_teopisca, 
               h.meta4 AS meta_vcarranza, h.tolerancia4 AS tolerancia_vcarranza, h.reales4 AS reales_vcarranza, 
               i.meta4 AS meta_yajalon, i.tolerancia4 AS tolerancia_yajalon, i.reales4 AS reales_yajalon
        FROM acala a 
        INNER JOIN chenalho c ON a.id = c.id
        INNER JOIN comalapa o ON a.id = o.id
        INNER JOIN comitam b ON a.id = b.id
        INNER JOIN empleado d ON a.id = d.id
        INNER JOIN margaritas e ON a.id = e.id
        INNER JOIN ocosingo f ON a.id = f.id
        INNER JOIN teopisca g ON a.id = g.id
        INNER JOIN vcarranza h ON a.id = h.id
        INNER JOIN yajalon i ON a.id = i.id";

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
        <h2 style="margin: 0;">"Valores De Mayo Por Agencias"</h2>
       

    </div>
    
    <table id='tabla-acumulado'>


    <th rowspan="1" class="month">INDICE</th>
		<th colspan="3" class="month">DK03R</th><!--acala-->
		<th colspan="3" class="month">DK03F</th><!--chenalho-->
		<th colspan="3" class="month">DK03J</th><!--comalapa-->
		<th colspan="3" class="month">DK03A</th><!--comitan-->
		<th colspan="3" class="month">DK03E</th><!--san cristobal-->
		<th colspan="3" class="month">DK03M</th><!--margaritas-->
		<th colspan="3" class="month">DK03C </th><!--ocosingo-->
		<th colspan="3" class="month">DK03L</th> <!--teopisca-->
		<th colspan="3" class="month">DK03H</th><!--v. carranza-->
		<th colspan="3" class="month">DK03D</th><!--Yajalon-->
		

    </tr>
    <button onclick="exportToExcel('Mayo')" style="
    display: block; 
    margin: 20px auto; 
    padding: 10px 20px; 
    font-size: 16px; 
    color: black; 
    background-color: white; 
    border: 2px solid #4CAF50; 
    border-radius: 5px; 
    cursor: pointer; 
    font-weight: bold; 
    transition: all 0.3s ease;
">Generar Excel Mayo</button>
    <!-- Fila con el título 'Hacia los Empleados' -->
    <?php
 echo "<tr><td colspan='31' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia Los Clientes</td></tr>";
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
				
                $meta1 = floatval($row["meta_chenalho"]);
                $tolerancia1 = floatval($row["tolerancia_chenalho"]);
                $real1 = floatval($row["reales_chenalho"]);
        
                $meta2 = floatval($row["meta_comalapa"]);
                $tolerancia2 = floatval($row["tolerancia_comalapa"]);
                $real2 = floatval($row["reales_comalapa"]);
        
                $meta3 = floatval($row["meta_comitam"]);
                $tolerancia3 = floatval($row["tolerancia_comitam"]);
                $real3 = floatval($row["reales_comitam"]);
        
                $meta4 = floatval($row["meta_empleado"]);
                $tolerancia4 = floatval($row["tolerancia_empleado"]);
                $real4 = floatval($row["reales_empleado"]);
        
                $meta5 = floatval($row["meta_margaritas"]);
                $tolerancia5 = floatval($row["tolerancia_margaritas"]);
                $real5 = floatval($row["reales_margaritas"]);
        
                $meta6 = floatval($row["meta_ocosingo"]);
                $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
                $real6 = floatval($row["reales_ocosingo"]);
        
                $meta7 = floatval($row["meta_teopisca"]);
                $tolerancia7 = floatval($row["tolerancia_teopisca"]);
                $real7 = floatval($row["reales_teopisca"]);
        
                $meta8 = floatval($row["meta_vcarranza"]);
                $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
                $real8 = floatval($row["reales_vcarranza"]);
        
                $meta9 = floatval($row["meta_yajalon"]);
                $tolerancia9 = floatval($row["tolerancia_yajalon"]);
                $real9 = floatval($row["reales_yajalon"]);
        
             
                
				
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
              
               
                    
                echo "<tr>";
                echo "<td>q" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_margaritas"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_margaritas"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_margaritas"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

                

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
        
                $meta1 = floatval($row["meta_chenalho"]);
                $tolerancia1 = floatval($row["tolerancia_chenalho"]);
                $real1 = floatval($row["reales_chenalho"]);
        
                $meta2 = floatval($row["meta_comalapa"]);
                $tolerancia2 = floatval($row["tolerancia_comalapa"]);
                $real2 = floatval($row["reales_comalapa"]);
        
                $meta3 = floatval($row["meta_comitam"]);
                $tolerancia3 = floatval($row["tolerancia_comitam"]);
                $real3 = floatval($row["reales_comitam"]);
        
                $meta4 = floatval($row["meta_empleado"]);
                $tolerancia4 = floatval($row["tolerancia_empleado"]);
                $real4 = floatval($row["reales_empleado"]);
        
                $meta5 = floatval($row["meta_margaritas"]);
                $tolerancia5 = floatval($row["tolerancia_margaritas"]);
                $real5 = floatval($row["reales_margaritas"]);
        
                $meta6 = floatval($row["meta_ocosingo"]);
                $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
                $real6 = floatval($row["reales_ocosingo"]);
        
                $meta7 = floatval($row["meta_teopisca"]);
                $tolerancia7 = floatval($row["tolerancia_teopisca"]);
                $real7 = floatval($row["reales_teopisca"]);
        
                $meta8 = floatval($row["meta_vcarranza"]);
                $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
                $real8 = floatval($row["reales_vcarranza"]);
        
                $meta9 = floatval($row["meta_yajalon"]);
                $tolerancia9 = floatval($row["tolerancia_yajalon"]);
                $real9 = floatval($row["reales_yajalon"]);
        
               
                
                
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

				

				// Output the table rows with the appropriate colors
				echo "<tr>";
				echo "<td>" . $row["indice"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

				
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
        
                $meta1 = floatval($row["meta_chenalho"]);
                $tolerancia1 = floatval($row["tolerancia_chenalho"]);
                $real1 = floatval($row["reales_chenalho"]);
        
                $meta2 = floatval($row["meta_comalapa"]);
                $tolerancia2 = floatval($row["tolerancia_comalapa"]);
                $real2 = floatval($row["reales_comalapa"]);
        
                $meta3 = floatval($row["meta_comitam"]);
                $tolerancia3 = floatval($row["tolerancia_comitam"]);
                $real3 = floatval($row["reales_comitam"]);
        
                $meta4 = floatval($row["meta_empleado"]);
                $tolerancia4 = floatval($row["tolerancia_empleado"]);
                $real4 = floatval($row["reales_empleado"]);
        
                $meta5 = floatval($row["meta_margaritas"]);
                $tolerancia5 = floatval($row["tolerancia_margaritas"]);
                $real5 = floatval($row["reales_margaritas"]);
        
                $meta6 = floatval($row["meta_ocosingo"]);
                $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
                $real6 = floatval($row["reales_ocosingo"]);
        
                $meta7 = floatval($row["meta_teopisca"]);
                $tolerancia7 = floatval($row["tolerancia_teopisca"]);
                $real7 = floatval($row["reales_teopisca"]);
        
                $meta8 = floatval($row["meta_vcarranza"]);
                $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
                $real8 = floatval($row["reales_vcarranza"]);
        
                $meta9 = floatval($row["meta_yajalon"]);
                $tolerancia9 = floatval($row["tolerancia_yajalon"]);
                $real9 = floatval($row["reales_yajalon"]);
        
               
                
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

            
               
                    
                echo "<tr>";
                echo "<td>" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

                

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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

     
        
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



// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";



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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

        
        
        
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



// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";



echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}

echo "<tr><td colspan='31' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia La Empresa</td></tr>";


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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

        
        
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
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

        

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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

       
        
        
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



// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";



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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

       
        
        
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



// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
echo "<td contenteditable='true' class='$cellColor1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
echo "<td contenteditable='true' class='$cellColor2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
echo "<td contenteditable='true' class='$cellColor3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
echo "<td contenteditable='true' class='$cellColor4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
echo "<td contenteditable='true' class='$cellColor5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
echo "<td contenteditable='true' class='$cellColor6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
echo "<td contenteditable='true' class='$cellColor7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
echo "<td contenteditable='true' class='$cellColor8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
echo "<td contenteditable='true' class='$cellColor9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";


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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

        
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

       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

       
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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

        
        
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

        
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

        

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}// Cerrar la conexión a la base de datos



echo "<tr><td colspan='31' style='font-weight: bold; text-align: center; background-color: #f4f4f4; padding: 5px; font-size: 14px; color: #333;'>Hacia El Personal</td></tr>";

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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

       
        
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

                    
            
        echo "<tr>";
        echo "<td>d" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

        

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

        $meta1 = floatval($row["meta_chenalho"]);
        $tolerancia1 = floatval($row["tolerancia_chenalho"]);
        $real1 = floatval($row["reales_chenalho"]);

        $meta2 = floatval($row["meta_comalapa"]);
        $tolerancia2 = floatval($row["tolerancia_comalapa"]);
        $real2 = floatval($row["reales_comalapa"]);

        $meta3 = floatval($row["meta_comitam"]);
        $tolerancia3 = floatval($row["tolerancia_comitam"]);
        $real3 = floatval($row["reales_comitam"]);

        $meta4 = floatval($row["meta_empleado"]);
        $tolerancia4 = floatval($row["tolerancia_empleado"]);
        $real4 = floatval($row["reales_empleado"]);

        $meta5 = floatval($row["meta_margaritas"]);
        $tolerancia5 = floatval($row["tolerancia_margaritas"]);
        $real5 = floatval($row["reales_margaritas"]);

        $meta6 = floatval($row["meta_ocosingo"]);
        $tolerancia6 = floatval($row["tolerancia_ocosingo"]);
        $real6 = floatval($row["reales_ocosingo"]);

        $meta7 = floatval($row["meta_teopisca"]);
        $tolerancia7 = floatval($row["tolerancia_teopisca"]);
        $real7 = floatval($row["reales_teopisca"]);

        $meta8 = floatval($row["meta_vcarranza"]);
        $tolerancia8 = floatval($row["tolerancia_vcarranza"]);
        $real8 = floatval($row["reales_vcarranza"]);

        $meta9 = floatval($row["meta_yajalon"]);
        $tolerancia9 = floatval($row["tolerancia_yajalon"]);
        $real9 = floatval($row["reales_yajalon"]);

       
        
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

       
       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta1'>" . $row["meta_chenalho"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia1'>" . $row["tolerancia_chenalho"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass1' data-indice='" . $row["indice"] . "' data-campo='reales1'>" . $row["reales_chenalho"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta2'>" . $row["meta_comalapa"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia2'>" . $row["tolerancia_comalapa"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass2' data-indice='" . $row["indice"] . "' data-campo='reales2'>" . $row["reales_comalapa"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta3'>" . $row["meta_comitam"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia3'>" . $row["tolerancia_comitam"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass3' data-indice='" . $row["indice"] . "' data-campo='reales3'>" . $row["reales_comitam"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta4'>" . $row["meta_empleado"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia4'>" . $row["tolerancia_empleado"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass4' data-indice='" . $row["indice"] . "' data-campo='reales4'>" . $row["reales_empleado"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta5'>" . $row["meta_margaritas"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia5'>" . $row["tolerancia_margaritas"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass5' data-indice='" . $row["indice"] . "' data-campo='reales5'>" . $row["reales_margaritas"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta6'>" . $row["meta_ocosingo"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia6'>" . $row["tolerancia_ocosingo"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass6' data-indice='" . $row["indice"] . "' data-campo='reales6'>" . $row["reales_ocosingo"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta7'>" . $row["meta_teopisca"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia7'>" . $row["tolerancia_teopisca"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass7' data-indice='" . $row["indice"] . "' data-campo='reales7'>" . $row["reales_teopisca"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta8'>" . $row["meta_vcarranza"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia8'>" . $row["tolerancia_vcarranza"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass8' data-indice='" . $row["indice"] . "' data-campo='reales8'>" . $row["reales_vcarranza"] . "</td>";

        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta9'>" . $row["meta_yajalon"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia9'>" . $row["tolerancia_yajalon"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass9' data-indice='" . $row["indice"] . "' data-campo='reales9'>" . $row["reales_yajalon"] . "</td>";

      

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

	for ($i = 1; $i <= 9; $i++) {
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
            url: '../conexion/updateAcala.php',
            method: 'POST',
            data: {indice: indice, campo: campo, valor: valor},
            success: function(response) {
                
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
