<?php
include_once 'funciones/funciones.php';
if (isset($_POST['estado'])){
    $nombre = $_POST['nombre'];
};
if (isset($_POST['apellido'])){
    $apellido = $_POST['apellido'];
};
if (isset($_POST['email'])){
    $email = $_POST['email'];
};
if (isset($_POST['pagado'])){
    $pagado = $_POST['pagado'];
};

if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
};
if (isset($_POST['id_registro'])){
    $id_registro = $_POST['id_registro'];
};
//$fecha_registro = $_POST['fecha_registro'];

if($_POST['registro'] == 'nuevo') {
    // boletos
    $boletos_adquiridos = $_POST['boletos'];
    // Pedido
    $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
    $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
    $pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);
    $total = $_POST['total_pedido'];
    $regalo = $_POST['regalo'];
    $eventos = $_POST['registro_evento'];
    $registro_eventos = eventos_json($eventos);



    try {
        $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado, forma_pago) VALUES (?,?,?, NOW(),?,?,?,?,1)");
        $stmt->bind_param("sssssiss", $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'registrados'
            );

        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();

    } catch(Exception $e) {
        $respuesta = array(
            'respuesta' =>  $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar') {
    try {
        $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, pagado = ? , email_registrado = ?, estado_registrado = ? WHERE ID_Registrado = ?  ");
        $stmt->bind_param("ssisii", $nombre, $apellido, $pagado, $email, $estado, $id_registro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $stmt->insert_id,
                'tipo' => 'registrados'
            );

        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();

    } catch(Exception $e) {
        $respuesta = array(
            'respuesta' =>  $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar'){
    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare("UPDATE registrados SET estado_registrado = 0 WHERE ID_Registrado = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo' => 'registrados'
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();

    } catch(Exception $e) {
        $respuesta = array(
            'respuesta' =>  $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}
