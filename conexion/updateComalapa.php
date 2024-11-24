<?php
// update_data.php

// Incluir el archivo de conexión
include 'db_conect.php';

// Obtener los datos del POST
$indice = $_POST['indice'];
$campo = $_POST['campo'];
$valor = $_POST['valor'];

// Sanitizar la entrada
$indice = $conn->real_escape_string($indice);
$campo = $conn->real_escape_string($campo);
$valor = strval($valor);

// Generar la consulta SQL
$sql = "UPDATE comalapa SET $campo = ? WHERE indice = ?";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $valor, $indice);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}
$ids = [1, 6, 9];

// Recorremos cada ID para aplicar las mismas operaciones
foreach ($ids as $id) {
    $sql_meta = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = ?";
    $stmt = $conn->prepare($sql_meta);
    $stmt->bind_param('i', $id); // Pasamos el ID actual
    $stmt->execute();
    $resultado_meta = $stmt->get_result();

    if ($resultado_meta->num_rows > 0) {
        $fila_meta = $resultado_meta->fetch_assoc();
        
        // Procesar todas las metas para el ID actual
        $meta_a = floatval($fila_meta['meta']);
        $nuevo_valor_tolerancia_a = number_format($meta_a * 1.07, 2, '.', '');

        $meta_b = floatval($fila_meta['meta1']);
        $nuevo_valor_tolerancia_b = number_format($meta_b * 1.07, 2, '.', '');

        $meta_c = floatval($fila_meta['meta2']);
        $nuevo_valor_tolerancia_c = number_format($meta_c * 1.07, 2, '.', '');

        $meta_d = floatval($fila_meta['meta3']);
        $nuevo_valor_tolerancia_d = number_format($meta_d * 1.07, 2, '.', '');

        $meta_e = floatval($fila_meta['meta4']);
        $nuevo_valor_tolerancia_e = number_format($meta_e * 1.07, 2, '.', '');

        $meta_f = floatval($fila_meta['meta5']);
        $nuevo_valor_tolerancia_f = number_format($meta_f * 1.07, 2, '.', '');

        $meta_g = floatval($fila_meta['meta6']);
        $nuevo_valor_tolerancia_g = number_format($meta_g * 1.07, 2, '.', '');

        $meta_h = floatval($fila_meta['meta7']);
        $nuevo_valor_tolerancia_h = number_format($meta_h * 1.07, 2, '.', '');

        $meta_i = floatval($fila_meta['meta8']);
        $nuevo_valor_tolerancia_i = number_format($meta_i * 1.07, 2, '.', '');

        $meta_j = floatval($fila_meta['meta9']);
        $nuevo_valor_tolerancia_j = number_format($meta_j * 1.07, 2, '.', '');

        $meta_k = floatval($fila_meta['meta10']);
        $nuevo_valor_tolerancia_k = number_format($meta_k * 1.07, 2, '.', '');

        $meta_l = floatval($fila_meta['meta11']);
        $nuevo_valor_tolerancia_l = number_format($meta_l * 1.07, 2, '.', '');

        // Actualizar los campos del registro con el ID actual
        $sql_actualizacion = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = ?";
        $stmt_tolerancia = $conn->prepare($sql_actualizacion);
        $stmt_tolerancia->bind_param(
            'ddddddddddddi',
            $nuevo_valor_tolerancia_a,
            $nuevo_valor_tolerancia_b,
            $nuevo_valor_tolerancia_c,
            $nuevo_valor_tolerancia_d,
            $nuevo_valor_tolerancia_e,
            $nuevo_valor_tolerancia_f,
            $nuevo_valor_tolerancia_g,
            $nuevo_valor_tolerancia_h,
            $nuevo_valor_tolerancia_i,
            $nuevo_valor_tolerancia_j,
            $nuevo_valor_tolerancia_k,
            $nuevo_valor_tolerancia_l,
            $id
        );
        $stmt_tolerancia->execute();

        if ($stmt_tolerancia->affected_rows > 0) {
            echo "El registro con id = $id ha sido actualizado correctamente.<br>";
        } else {
            echo "No se actualizó ningún registro o no hubo cambios en el id = $id.<br>";
        }
    } else {
        echo "No se encontró el registro con id = $id.<br>";
    }
}


//---------------------------------------------------------------(-5%)--------------------------------------------------------------

// IDs que queremos procesar (2 y 5)
$ids = [2, 5,12];

// Recorremos cada ID para aplicar las mismas operaciones
foreach ($ids as $id) {
    $sql_meta = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = ?";
    $stmt = $conn->prepare($sql_meta);
    $stmt->bind_param('i', $id); // Pasamos el ID actual
    $stmt->execute();
    $resultado_meta = $stmt->get_result();

    if ($resultado_meta->num_rows > 0) {
        $fila_meta = $resultado_meta->fetch_assoc();
        
        // Procesar todas las metas para el ID actual aplicando la regla del 5% de tolerancia
        $meta_a = floatval($fila_meta['meta']);
        $tolerancia_a = number_format($meta_a + ($meta_a * -0.05), 2, '.', '');

        $meta_b = floatval($fila_meta['meta1']);
        $tolerancia_b = number_format($meta_b + ($meta_b * -0.05), 2, '.', '');

        $meta_c = floatval($fila_meta['meta2']);
        $tolerancia_c = number_format($meta_c + ($meta_c * -0.05), 2, '.', '');

        $meta_d = floatval($fila_meta['meta3']);
        $tolerancia_d = number_format($meta_d + ($meta_d * -0.05), 2, '.', '');

        $meta_e = floatval($fila_meta['meta4']);
        $tolerancia_e = number_format($meta_e + ($meta_e * -0.05), 2, '.', '');

        $meta_f = floatval($fila_meta['meta5']);
        $tolerancia_f = number_format($meta_f + ($meta_f * -0.05), 2, '.', '');

        $meta_g = floatval($fila_meta['meta6']);
        $tolerancia_g = number_format($meta_g + ($meta_g * -0.05), 2, '.', '');

        $meta_h = floatval($fila_meta['meta7']);
        $tolerancia_h = number_format($meta_h + ($meta_h * -0.05), 2, '.', '');

        $meta_i = floatval($fila_meta['meta8']);
        $tolerancia_i = number_format($meta_i + ($meta_i * -0.05), 2, '.', '');

        $meta_j = floatval($fila_meta['meta9']);
        $tolerancia_j = number_format($meta_j + ($meta_j * -0.05), 2, '.', '');

        $meta_k = floatval($fila_meta['meta10']);
        $tolerancia_k = number_format($meta_k + ($meta_k * -0.05), 2, '.', '');

        $meta_l = floatval($fila_meta['meta11']);
        $tolerancia_l = number_format($meta_l + ($meta_l * -0.05), 2, '.', '');

        // Actualizar los campos de tolerancia del registro con el ID actual
        $sql_actualizacion = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = ?";
        $stmt_tolerancia = $conn->prepare($sql_actualizacion);
        $stmt_tolerancia->bind_param(
            'ddddddddddddi',
            $tolerancia_a,
            $tolerancia_b,
            $tolerancia_c,
            $tolerancia_d,
            $tolerancia_e,
            $tolerancia_f,
            $tolerancia_g,
            $tolerancia_h,
            $tolerancia_i,
            $tolerancia_j,
            $tolerancia_k,
            $tolerancia_l,
            $id
        );
        $stmt_tolerancia->execute();

        if ($stmt_tolerancia->affected_rows > 0) {
            echo "El registro con id = $id ha sido actualizado correctamente.<br>";
        } else {
            echo "No se actualizó ningún registro o no hubo cambios en el id = $id.<br>";
        }
    } else {
        echo "No se encontró el registro con id = $id.<br>";
    }
}

//---------------------------------------------------------------+3%--------------------------------------------------------------

$sql_meta3 = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = 3";
$resultado_meta3 = $conn->query($sql_meta3);

if ($resultado_meta3->num_rows > 0) {
    $fila_meta3 = $resultado_meta3->fetch_assoc();
    
    // Obtener y procesar meta1
    $meta1_id3 = floatval($fila_meta3['meta']);
    $nuevo_valor_tolerancia1_id3 = $meta1_id3 * 1.03;
    $nuevo_valor_tolerancia1_id3 = number_format($nuevo_valor_tolerancia1_id3, 2, '.', '');

    // Obtener y procesar meta2
    $meta2_id3 = floatval($fila_meta3['meta1']);
    $nuevo_valor_tolerancia2_id3 = $meta2_id3 * 1.03;
    $nuevo_valor_tolerancia2_id3 = number_format($nuevo_valor_tolerancia2_id3, 2, '.', '');

    // Obtener y procesar meta3
    $meta3_id3 = floatval($fila_meta3['meta2']);
    $nuevo_valor_tolerancia3_id3 = $meta3_id3 * 1.03;
    $nuevo_valor_tolerancia3_id3 = number_format($nuevo_valor_tolerancia3_id3, 2, '.', '');

    // Obtener y procesar meta4
    $meta4_id3 = floatval($fila_meta3['meta3']);
    $nuevo_valor_tolerancia4_id3 = $meta4_id3 * 1.03;
    $nuevo_valor_tolerancia4_id3 = number_format($nuevo_valor_tolerancia4_id3, 2, '.', '');

    // Obtener y procesar meta5
    $meta5_id3 = floatval($fila_meta3['meta4']);
    $nuevo_valor_tolerancia5_id3 = $meta5_id3 * 1.03;
    $nuevo_valor_tolerancia5_id3 = number_format($nuevo_valor_tolerancia5_id3, 2, '.', '');

    // Obtener y procesar meta6
    $meta6_id3 = floatval($fila_meta3['meta5']);
    $nuevo_valor_tolerancia6_id3 = $meta6_id3 * 1.03;
    $nuevo_valor_tolerancia6_id3 = number_format($nuevo_valor_tolerancia6_id3, 2, '.', '');

    // Obtener y procesar meta7
    $meta7_id3 = floatval($fila_meta3['meta6']);
    $nuevo_valor_tolerancia7_id3 = $meta7_id3 * 1.03;
    $nuevo_valor_tolerancia7_id3 = number_format($nuevo_valor_tolerancia7_id3, 2, '.', '');

    // Obtener y procesar meta8
    $meta8_id3 = floatval($fila_meta3['meta7']);
    $nuevo_valor_tolerancia8_id3 = $meta8_id3 * 1.03;
    $nuevo_valor_tolerancia8_id3 = number_format($nuevo_valor_tolerancia8_id3, 2, '.', '');

    // Obtener y procesar meta9
    $meta9_id3 = floatval($fila_meta3['meta8']);
    $nuevo_valor_tolerancia9_id3 = $meta9_id3 * 1.03;
    $nuevo_valor_tolerancia9_id3 = number_format($nuevo_valor_tolerancia9_id3, 2, '.', '');

    // Obtener y procesar meta10
    $meta10_id3 = floatval($fila_meta3['meta9']);
    $nuevo_valor_tolerancia10_id3 = $meta10_id3 * 1.03;
    $nuevo_valor_tolerancia10_id3 = number_format($nuevo_valor_tolerancia10_id3, 2, '.', '');

    // Obtener y procesar meta11
    $meta11_id3 = floatval($fila_meta3['meta10']);
    $nuevo_valor_tolerancia11_id3 = $meta11_id3 * 1.03;
    $nuevo_valor_tolerancia11_id3 = number_format($nuevo_valor_tolerancia11_id3, 2, '.', '');

    // Obtener y procesar meta12
    $meta12_id3 = floatval($fila_meta3['meta11']);
    $nuevo_valor_tolerancia12_id3 = $meta12_id3 * 1.03;
    $nuevo_valor_tolerancia12_id3 = number_format($nuevo_valor_tolerancia12_id3, 2, '.', '');

    // Actualizar los campos del registro con id = 3
    $sql_actualizacion_id3 = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = 3";
    $stmt_tolerancia_id3 = $conn->prepare($sql_actualizacion_id3);
    $stmt_tolerancia_id3->bind_param('dddddddddddd', $nuevo_valor_tolerancia1_id3, $nuevo_valor_tolerancia2_id3, $nuevo_valor_tolerancia3_id3, $nuevo_valor_tolerancia4_id3, $nuevo_valor_tolerancia5_id3, $nuevo_valor_tolerancia6_id3, $nuevo_valor_tolerancia7_id3, $nuevo_valor_tolerancia8_id3, $nuevo_valor_tolerancia9_id3, $nuevo_valor_tolerancia10_id3, $nuevo_valor_tolerancia11_id3, $nuevo_valor_tolerancia12_id3);
    $stmt_tolerancia_id3->execute();

    if ($stmt_tolerancia_id3->affected_rows > 0) {
        echo "El registro con id = 3 ha sido actualizado correctamente.";
    } else {
        echo "No se actualizó ningún registro o no hubo cambios.";
    }
} else {
    echo "No se encontró el registro con id = 3.";
}
//---------------------------------------------------------------(-4%)--------------------------------------------------------------

$sql_meta = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = 4";
$resultado_meta = $conn->query($sql_meta);

if ($resultado_meta->num_rows > 0) {
    $fila_meta = $resultado_meta->fetch_assoc();
    
    // Obtener y procesar meta1
    $meta1_id4 = floatval($fila_meta['meta']);  // Asegurarse de que 'meta' es un valor decimal
    $tolerancia1_id4 = $meta1_id4 + ($meta1_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia1_id4 = number_format($tolerancia1_id4, 2, '.', '');

    // Obtener y procesar meta2
    $meta2_id4 = floatval($fila_meta['meta1']);  // Asegurarse de que 'meta1' es un valor decimal
    $tolerancia2_id4 = $meta2_id4 + ($meta2_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia2_id4 = number_format($tolerancia2_id4, 2, '.', '');

    // Obtener y procesar meta3
    $meta3_id4 = floatval($fila_meta['meta2']);  // Asegurarse de que 'meta2' es un valor decimal
    $tolerancia3_id4 = $meta3_id4 + ($meta3_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia3_id4 = number_format($tolerancia3_id4, 2, '.', '');

    // Obtener y procesar meta4
    $meta4_id4 = floatval($fila_meta['meta3']);  // Asegurarse de que 'meta3' es un valor decimal
    $tolerancia4_id4 = $meta4_id4 + ($meta4_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia4_id4 = number_format($tolerancia4_id4, 2, '.', '');

    // Obtener y procesar meta5
    $meta5_id4 = floatval($fila_meta['meta4']);  // Asegurarse de que 'meta4' es un valor decimal
    $tolerancia5_id4 = $meta5_id4 + ($meta5_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia5_id4 = number_format($tolerancia5_id4, 2, '.', '');

    // Obtener y procesar meta6
    $meta6_id4 = floatval($fila_meta['meta5']);  // Asegurarse de que 'meta5' es un valor decimal
    $tolerancia6_id4 = $meta6_id4 + ($meta6_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia6_id4 = number_format($tolerancia6_id4, 2, '.', '');

    // Obtener y procesar meta7
    $meta7_id4 = floatval($fila_meta['meta6']);  // Asegurarse de que 'meta6' es un valor decimal
    $tolerancia7_id4 = $meta7_id4 + ($meta7_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia7_id4 = number_format($tolerancia7_id4, 2, '.', '');

    // Obtener y procesar meta8
    $meta8_id4 = floatval($fila_meta['meta7']);  // Asegurarse de que 'meta7' es un valor decimal
    $tolerancia8_id4 = $meta8_id4 + ($meta8_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia8_id4 = number_format($tolerancia8_id4, 2, '.', '');

    // Obtener y procesar meta9
    $meta9_id4 = floatval($fila_meta['meta8']);  // Asegurarse de que 'meta8' es un valor decimal
    $tolerancia9_id4 = $meta9_id4 + ($meta9_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia9_id4 = number_format($tolerancia9_id4, 2, '.', '');

    // Obtener y procesar meta10
    $meta10_id4 = floatval($fila_meta['meta9']);  // Asegurarse de que 'meta9' es un valor decimal
    $tolerancia10_id4 = $meta10_id4 + ($meta10_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia10_id4 = number_format($tolerancia10_id4, 2, '.', '');

    // Obtener y procesar meta11
    $meta11_id4 = floatval($fila_meta['meta10']);  // Asegurarse de que 'meta10' es un valor decimal
    $tolerancia11_id4 = $meta11_id4 + ($meta11_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia11_id4 = number_format($tolerancia11_id4, 2, '.', '');

    // Obtener y procesar meta12
    $meta12_id4 = floatval($fila_meta['meta11']);  // Asegurarse de que 'meta11' es un valor decimal
    $tolerancia12_id4 = $meta12_id4 + ($meta12_id4 * -0.04);  // Aplicar la nueva regla del -4%
    $tolerancia12_id4 = number_format($tolerancia12_id4, 2, '.', '');

    // Actualizar los campos del registro con id = 4
    $sql_actualizacion = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = 4";
    $stmt_tolerancia = $conn->prepare($sql_actualizacion);
    $stmt_tolerancia->bind_param('dddddddddddd', $tolerancia1_id4, $tolerancia2_id4, $tolerancia3_id4, $tolerancia4_id4, $tolerancia5_id4, $tolerancia6_id4, $tolerancia7_id4, $tolerancia8_id4, $tolerancia9_id4, $tolerancia10_id4, $tolerancia11_id4, $tolerancia12_id4);
    $stmt_tolerancia->execute();

    if ($stmt_tolerancia->affected_rows > 0) {
        echo "El registro con id = 4 ha sido actualizado correctamente.";
    } else {
        echo "No se actualizó ningún registro o no hubo cambios.";
    }
} else {
    echo "No se encontró el registro con id = 4.";
}
//---------------------------------------------------(-7%)(id: 7,8)--------------------------------------------------------------


$ids = [7, 8];

// Recorremos cada ID para aplicar las mismas operaciones
foreach ($ids as $id) {
    // Consultamos los valores para el ID actual
    $sql_meta = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = ?";
    $stmt = $conn->prepare($sql_meta);
    $stmt->bind_param('i', $id); // Pasamos el ID actual
    $stmt->execute();
    $resultado_meta = $stmt->get_result();

    if ($resultado_meta->num_rows > 0) {
        $fila_meta = $resultado_meta->fetch_assoc();

        // Procesar todas las metas para el ID actual aplicando la regla del -7% de tolerancia
        $meta_a = floatval($fila_meta['meta']);
        $tolerancia_a = number_format($meta_a + ($meta_a * -0.07), 2, '.', '');

        $meta_b = floatval($fila_meta['meta1']);
        $tolerancia_b = number_format($meta_b + ($meta_b * -0.07), 2, '.', '');

        $meta_c = floatval($fila_meta['meta2']);
        $tolerancia_c = number_format($meta_c + ($meta_c * -0.07), 2, '.', '');

        $meta_d = floatval($fila_meta['meta3']);
        $tolerancia_d = number_format($meta_d + ($meta_d * -0.07), 2, '.', '');

        $meta_e = floatval($fila_meta['meta4']);
        $tolerancia_e = number_format($meta_e + ($meta_e * -0.07), 2, '.', '');

        $meta_f = floatval($fila_meta['meta5']);
        $tolerancia_f = number_format($meta_f + ($meta_f * -0.07), 2, '.', '');

        $meta_g = floatval($fila_meta['meta6']);
        $tolerancia_g = number_format($meta_g + ($meta_g * -0.07), 2, '.', '');

        $meta_h = floatval($fila_meta['meta7']);
        $tolerancia_h = number_format($meta_h + ($meta_h * -0.07), 2, '.', '');

        $meta_i = floatval($fila_meta['meta8']);
        $tolerancia_i = number_format($meta_i + ($meta_i * -0.07), 2, '.', '');

        $meta_j = floatval($fila_meta['meta9']);
        $tolerancia_j = number_format($meta_j + ($meta_j * -0.07), 2, '.', '');

        $meta_k = floatval($fila_meta['meta10']);
        $tolerancia_k = number_format($meta_k + ($meta_k * -0.07), 2, '.', '');

        $meta_l = floatval($fila_meta['meta11']);
        $tolerancia_l = number_format($meta_l + ($meta_l * -0.07), 2, '.', '');

        // Actualizar los campos de tolerancia del registro con el ID actual
        $sql_actualizacion = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = ?";
        $stmt_tolerancia = $conn->prepare($sql_actualizacion);
        $stmt_tolerancia->bind_param(
            'ddddddddddddi',
            $tolerancia_a,
            $tolerancia_b,
            $tolerancia_c,
            $tolerancia_d,
            $tolerancia_e,
            $tolerancia_f,
            $tolerancia_g,
            $tolerancia_h,
            $tolerancia_i,
            $tolerancia_j,
            $tolerancia_k,
            $tolerancia_l,
            $id
        );
        $stmt_tolerancia->execute();

        if ($stmt_tolerancia->affected_rows > 0) {
            echo "El registro con id = $id ha sido actualizado correctamente.<br>";
        } else {
            echo "No se actualizó ningún registro o no hubo cambios en el id = $id.<br>";
        }
    } else {
        echo "No se encontró el registro con id = $id.<br>";
    }
}

//------------------------------------------------------registro 10(+10%)---------------------------------------------------------------
$sql_meta10 = "SELECT meta, meta1, meta2, meta3, meta4, meta5, meta6, meta7, meta8, meta9, meta10, meta11 FROM comalapa WHERE id = 10";
$resultado_meta10 = $conn->query($sql_meta10);

if ($resultado_meta10->num_rows > 0) {
    $fila_meta10 = $resultado_meta10->fetch_assoc();
    
    // Obtener y procesar meta1
    $meta1_id10 = floatval($fila_meta10['meta']);
    $nuevo_valor_tolerancia1_id10 = $meta1_id10 * 1.10;
    $nuevo_valor_tolerancia1_id10 = number_format($nuevo_valor_tolerancia1_id10, 2, '.', '');

    // Obtener y procesar meta2
    $meta2_id10 = floatval($fila_meta10['meta1']);
    $nuevo_valor_tolerancia2_id10 = $meta2_id10 * 1.10;
    $nuevo_valor_tolerancia2_id10 = number_format($nuevo_valor_tolerancia2_id10, 2, '.', '');

    // Obtener y procesar meta3
    $meta3_id10 = floatval($fila_meta10['meta2']);
    $nuevo_valor_tolerancia3_id10 = $meta3_id10 * 1.10;
    $nuevo_valor_tolerancia3_id10 = number_format($nuevo_valor_tolerancia3_id10, 2, '.', '');

    // Obtener y procesar meta4
    $meta4_id10 = floatval($fila_meta10['meta3']);
    $nuevo_valor_tolerancia4_id10 = $meta4_id10 * 1.10;
    $nuevo_valor_tolerancia4_id10 = number_format($nuevo_valor_tolerancia4_id10, 2, '.', '');

    // Obtener y procesar meta5
    $meta5_id10 = floatval($fila_meta10['meta4']);
    $nuevo_valor_tolerancia5_id10 = $meta5_id10 * 1.10;
    $nuevo_valor_tolerancia5_id10 = number_format($nuevo_valor_tolerancia5_id10, 2, '.', '');

    // Obtener y procesar meta6
    $meta6_id10 = floatval($fila_meta10['meta5']);
    $nuevo_valor_tolerancia6_id10 = $meta6_id10 * 1.10;
    $nuevo_valor_tolerancia6_id10 = number_format($nuevo_valor_tolerancia6_id10, 2, '.', '');

    // Obtener y procesar meta7
    $meta7_id10 = floatval($fila_meta10['meta6']);
    $nuevo_valor_tolerancia7_id10 = $meta7_id10 * 1.10;
    $nuevo_valor_tolerancia7_id10 = number_format($nuevo_valor_tolerancia7_id10, 2, '.', '');

    // Obtener y procesar meta8
    $meta8_id10 = floatval($fila_meta10['meta7']);
    $nuevo_valor_tolerancia8_id10 = $meta8_id10 * 1.10;
    $nuevo_valor_tolerancia8_id10 = number_format($nuevo_valor_tolerancia8_id10, 2, '.', '');

    // Obtener y procesar meta9
    $meta9_id10 = floatval($fila_meta10['meta8']);
    $nuevo_valor_tolerancia9_id10 = $meta9_id10 * 1.10;
    $nuevo_valor_tolerancia9_id10 = number_format($nuevo_valor_tolerancia9_id10, 2, '.', '');

    // Obtener y procesar meta10
    $meta10_id10 = floatval($fila_meta10['meta9']);
    $nuevo_valor_tolerancia10_id10 = $meta10_id10 * 1.10;
    $nuevo_valor_tolerancia10_id10 = number_format($nuevo_valor_tolerancia10_id10, 2, '.', '');

    // Obtener y procesar meta11
    $meta11_id10 = floatval($fila_meta10['meta10']);
    $nuevo_valor_tolerancia11_id10 = $meta11_id10 * 1.10;
    $nuevo_valor_tolerancia11_id10 = number_format($nuevo_valor_tolerancia11_id10, 2, '.', '');

    // Obtener y procesar meta12
    $meta12_id10 = floatval($fila_meta10['meta11']);
    $nuevo_valor_tolerancia12_id10 = $meta12_id10 * 1.10;
    $nuevo_valor_tolerancia12_id10 = number_format($nuevo_valor_tolerancia12_id10, 2, '.', '');

    // Actualizar los campos del registro con id = 10
    $sql_actualizacion_id10 = "UPDATE comalapa SET tolerancia = ?, tolerancia1 = ?, tolerancia2 = ?, tolerancia3 = ?, tolerancia4 = ?, tolerancia5 = ?, tolerancia6 = ?, tolerancia7 = ?, tolerancia8 = ?, tolerancia9 = ?, tolerancia10 = ?, tolerancia11 = ? WHERE id = 10";
    $stmt_tolerancia_id10 = $conn->prepare($sql_actualizacion_id10);
    $stmt_tolerancia_id10->bind_param(
        'dddddddddddd',
        $nuevo_valor_tolerancia1_id10,
        $nuevo_valor_tolerancia2_id10,
        $nuevo_valor_tolerancia3_id10,
        $nuevo_valor_tolerancia4_id10,
        $nuevo_valor_tolerancia5_id10,
        $nuevo_valor_tolerancia6_id10,
        $nuevo_valor_tolerancia7_id10,
        $nuevo_valor_tolerancia8_id10,
        $nuevo_valor_tolerancia9_id10,
        $nuevo_valor_tolerancia10_id10,
        $nuevo_valor_tolerancia11_id10,
        $nuevo_valor_tolerancia12_id10
    );
    $stmt_tolerancia_id10->execute();

    if ($stmt_tolerancia_id10->affected_rows > 0) {
        echo "El registro con id = 10 ha sido actualizado correctamente.";
    } else {
        echo "No se actualizó ningún registro o no hubo cambios.";
    }
} else {
    echo "No se encontró el registro con id = 10.";
}




// Cerrar conexión
$conn->close();

?>
