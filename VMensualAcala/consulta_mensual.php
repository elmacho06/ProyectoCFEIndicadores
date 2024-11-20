<?php
// index.php

// Incluir el archivo de conexión
include '../conexion/db_conect.php';
//
// Consulta para obtener los datos de la tabla empleado
//$sql = "SELECT indice, meta, tolerancia, reales FROM vcarranza";

//$result = $conn->query($sql);

// Procesar solicitud AJAX
if (isset($_GET['month'])) {
    $month = strtolower($_GET['month']);
    
    // Consulta SQL dependiendo del mes
    if ($month === 'enero') {
        $sql = "SELECT indice, meta, tolerancia, reales FROM acala";
    } elseif ($month === 'febrero') {
        $sql = "SELECT indice, meta1 AS meta, tolerancia1 AS tolerancia, reales1 AS reales FROM acala";
    } elseif ($month === 'marzo') {
        $sql = "SELECT indice, meta2 AS meta, tolerancia2 AS tolerancia, reales2 AS reales FROM acala";
    } elseif ($month === 'abril') {
        $sql = "SELECT indice, meta3 AS meta, tolerancia3 AS tolerancia, reales3 AS reales FROM acala";
    } elseif ($month === 'mayo') {
        $sql = "SELECT indice, meta4 AS meta, tolerancia4 AS tolerancia, reales4 AS reales FROM acala";
    } elseif ($month === 'junio') {
        $sql = "SELECT indice, meta5 AS meta, tolerancia5 AS tolerancia, reales5 AS reales FROM acala";
    } elseif ($month === 'julio') {
        $sql = "SELECT indice, meta6 AS meta, tolerancia6 AS tolerancia, reales6 AS reales FROM acala";
    } elseif ($month === 'agosto') {
        $sql = "SELECT indice, meta7 AS meta, tolerancia7 AS tolerancia, reales7 AS reales FROM acala";
    } elseif ($month === 'septiembre') {
        $sql = "SELECT indice, meta8 AS meta, tolerancia8 AS tolerancia, reales8 AS reales FROM acala";
    } elseif ($month === 'octubre') {
        $sql = "SELECT indice, meta9 AS meta, tolerancia9 AS tolerancia, reales9 AS reales FROM acala";
    } elseif ($month === 'noviembre') {
        $sql = "SELECT indice, meta10 AS meta, tolerancia10 AS tolerancia, reales10 AS reales FROM acala";
    } 
    elseif ($month === 'diciembre') {
        $sql = "SELECT indice, meta11 AS meta, tolerancia11 AS tolerancia, reales11 AS reales FROM acala";
    } 
    // Agregar aquí los otros casos de meses
    else {
        echo json_encode([]);
        exit;
    }
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
    width: 70%; /* Aumenta el ancho total de la tabla */
    margin: 10px auto; /* Aumenta ligeramente el margen */
    border-collapse: collapse;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); /* Sombra más notoria */
}

th, td {
    padding: 6px 10px; /* Aumenta el padding para hacer las celdas más espaciosas */
    font-size: 12px; /* Tamaño de fuente más grande */
    line-height: 1.4; /* Aumenta el espacio vertical */
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
        <h2 style="margin: 0;">"Valores Mensuales "<?php echo htmlspecialchars($month); ?></h2>
       

    </div>
    <table>


		

    
    </tr>
    <!-- Fila con el título 'Hacia los Empleados' -->
    <?php
echo "<tr>
        <td colspan='4' style='
            font-weight: bold; 
            text-align: left; 
            background-color: #f4f4f4; 
            padding: 5px 5px 5px 800px;  /* Aumenta este valor para mover el texto más a la derecha */
            font-size: 14px; 
            color: #333;'>
            Hacia Los Clientes
        </td>
      </tr>";
?>

    
    <!-- Aquí se añadirán las filas de datos -->
     

        <tr>
        <th rowspan="1" class="month">INDICE</th>

          
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
				
                		// FILA UNO - ENERO
                $colorClass = '';
				if ($real < $meta) { $colorClass = 'color-green';} elseif ($real > $tolerancia) {
                    $colorClass = 'color-red'; $RedFlagCliente++; } else {$colorClass = 'color-yellow';}

				
                    
                echo "<tr>";
                echo "<td>q" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

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
        
                
                
                $cellColor = '';
				if ($real > $meta) {
					$cellColor = 'highlight-green'; // Verde si es mayor que meta
				} elseif ($real < $tolerancia) {
					$cellColor = 'highlight-red';
					$RedFlagCliente++;
					
				} elseif ($real >= $tolerancia && $real <= $meta) {
					$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
				}

				

				// Output the table rows with the appropriate colors
				echo "<tr>";
				echo "<td>" . $row["indice"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
				echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
				echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

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
        
                                
                $colorClass = '';
                
                if ($real < $meta) {
                    $colorClass = 'color-green';
                } elseif ($real > $tolerancia) {
                    $colorClass = 'color-red';
					$RedFlagCliente++;
				}else{
                    $colorClass = 'color-yellow';
                }

               
                    
                echo "<tr>";
                echo "<td>" . $row["indice"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
                echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
                echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

                
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

        
        $cellColor = '';
		if ($real > $meta) {
		$cellColor = 'highlight-green'; // Verde si es mayor que meta
		} elseif ($real < $tolerancia) {
		$cellColor = 'highlight-red'; 
		$RedFlagCliente++;
		} elseif ($real >= $tolerancia && $real <= $meta) {
		$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
		}

		

// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";


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

        
        
        
        $cellColor = '';
        if ($real > $meta) {
        $cellColor = 'highlight-green'; // Verde si es mayor que meta
        } elseif ($real < $tolerancia) {
        $cellColor = 'highlight-red';
        $RedFlagCliente++;
        
        } elseif ($real >= $tolerancia && $real <= $meta) {
        $cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
        }

// Output the table rows with the appropriate colors

echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";
echo "</tr>";

        
        


        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}

echo "<tr>
        <td colspan='4' style='
            font-weight: bold; 
            text-align: left; 
            background-color: #f4f4f4; 
            padding: 5px 5px 5px 800px;  /* Aumenta este valor para mover el texto más a la derecha */
            font-size: 14px; 
            color: #333;'>
            Hacia La Emppresa
        </td>
      </tr>";

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

        
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }
  
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}

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
        $cellColor = '';
if ($real > $meta) {
$cellColor = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real < $tolerancia) {
$cellColor = 'highlight-red'; 
$RedFlagEmpresa++;
} elseif ($real >= $tolerancia && $real <= $meta) {
$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}

        
// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";



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

        
        $cellColor = '';
if ($real > $meta) {
$cellColor = 'highlight-green'; // Verde si es mayor que meta
} elseif ($real < $tolerancia) {
$cellColor = 'highlight-red'; 
$RedFlagEmpresa++;
} elseif ($real >= $tolerancia && $real <= $meta) {
$cellColor = 'highlight-yellow'; // Amarillo si está entre la tolerancia y la meta
}


// Output the table rows with the appropriate colors
echo "<tr>";
echo "<td>" . $row["indice"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
echo "<td contenteditable='true' class='$cellColor' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";



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

        
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }

       
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        

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

        
        
        $colorClass = '';
        
        if ($real < $meta) {
            $colorClass = 'color-green';
        } elseif ($real > $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagEmpresa++;
        } else {
            $colorClass = 'color-yellow';
        }
      
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        

        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}// Cerrar la conexión a la base de datos



echo "<tr>
        <td colspan='4' style='
            font-weight: bold; 
            text-align: left; 
            background-color: #f4f4f4; 
            padding: 5px 5px 5px 800px;  /* Aumenta este valor para mover el texto más a la derecha */
            font-size: 14px; 
            color: #333;'>
            Hacia El Personal
        </td>
      </tr>";
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
            
                     // Real está por debajo de la met          
        echo "<tr>";
        echo "<td>d" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";

        

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

        
        $colorClass = '';
        
        if ($real > $meta) {
            $colorClass = 'color-green';
        } elseif ($real < $tolerancia) {
            $colorClass = 'color-red';
            $RedFlagPersonal++;
        } else {
            $colorClass = 'color-yellow';
        }

        
            
        echo "<tr>";
        echo "<td>" . $row["indice"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='meta'>" . $row["meta"] . "</td>";
        echo "<td contenteditable='true' data-indice='" . $row["indice"] . "' data-campo='tolerancia'>" . $row["tolerancia"] . "</td>";
        echo "<td contenteditable='true' class='$colorClass' data-indice='" . $row["indice"] . "' data-campo='reales'>" . $row["reales"] . "</td>";


        echo "</tr>";
        if ($count == 1) {
            break;
        }
        
    }
} else {
    echo "<tr><td colspan='39'>No hay datos disponibles</td></tr>";
}// Cerrar la conexión a la base de datos


    echo "<tr>
            <td colspan=''>cumplimiento de contrato programa</td>";

	
	if($RedFlagEmpresa >=2 || $RedFlagPersonal >=2)
		echo "<td colspan='3' class='color-red'><span> No". $RedFlagCliente ." </span></td>";
	elseif($RedFlagCliente >= 3)
		echo "<td colspan='3' class='color-red'><span> No". $RedFlagCliente ." </span></td>";
	else
		echo "<td colspan='3' class='color-green'><span> Si". $RedFlagCliente ." </span></td>";
	

	function checkRedFlags($empresa, $personal, $cliente) {
    if ($empresa >= 1 || $personal >= 1) {
        return "<td colspan='3' class='color-red'><span> No:". $cliente ." </span></td>";
    } elseif ($cliente >= 2) {
        return "<td colspan='3' class='color-red'><span> No:". $cliente ." </span></td>";
    } else {
        return "<td colspan='3' class='color-green'><span> Si: ". $cliente ." </span></td>";
    }
}

	for ($i = 1; $i <= 0; $i++) {
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
