<?php
include_once 'funciones/funciones.php';

// Leer los datos
if (isset($_POST['titulo_evento'])){
    $titulo = $_POST['titulo_evento'];
};
if (isset($_POST['categoria_evento'])){
    $categoria_id = $_POST['categoria_evento'];
};
if (isset($_POST['invitado_evento'])){
    $invitado_id = $_POST['invitado_evento'];
};
if (isset($_POST['cupo_evento'])){
    $cupo = $_POST['cupo_evento'];
};
if (isset($_POST['fecha_evento'])){
    $fecha = $_POST['fecha_evento'];
    $fecha_formato = date("Y-m-d", strtotime($fecha));
};
if (isset($_POST['hora_evento'])){
    $hora = $_POST['hora_evento'];
};
if (isset($_POST['id_registro'])){
    $id_registro = $_POST['id_registro'];
};
if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
};

if($_POST['registro'] == 'nuevo') {
    try {
        $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, cupo, id_cat_evento, id_inv, fecha_creado, estado_evento) VALUES (?,?,?,?,?,?,now(), 1)");
        $stmt->bind_param("sssiii", $titulo, $fecha_formato, $hora, $cupo, $categoria_id, $invitado_id);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'eventos'
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
        $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?,  fecha_evento = ?, hora_evento = ? , cupo = ?, id_cat_evento = ?, id_inv = ?, fecha_editado = now(), estado_evento = ?  WHERE evento_id = ?  ");
        $stmt->bind_param("sssiiiii", $titulo, $fecha_formato, $hora, $cupo,  $categoria_id, $invitado_id, $estado, $id_registro);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $stmt->insert_id,
                'tipo' => 'eventos'
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
        $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo' => 'eventos'
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
