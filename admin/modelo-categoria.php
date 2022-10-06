<?php
include_once 'funciones/funciones.php';

// Leer los datos
$titulo = isset($_POST['titulo_evento']);
$categoria_id = isset($_POST['categoria_evento']);
$invitado_id =  isset($_POST['invitado_evento']);
$cupo =  isset($_POST['cupo_evento']);
// obtener fecha
$fecha = isset($_POST['fecha_evento']);
$fecha_formato = date("Y-m-d", strtotime($fecha));
//obtener hora
$hora =isset($_POST['hora_evento']);
$id_registro = isset($_POST['id_registro']);
if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
};

if($_POST['registro'] == 'nuevo') {

    $icono = $_POST['icono'];
    $nombre_categoria = $_POST['nombre_categoria'];

    try {
        $stmt = $conn->prepare("INSERT INTO categoria_evento (cat_evento, icono, estado_categoria) VALUES (?,?, 1)");
        $stmt->bind_param("ss", $nombre_categoria, $icono);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'categorias'
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

    $categoria = $_POST['categoria'];
    $icono = $_POST['icono'];
    $id_registro = $_POST['id_registro'];


    try {
        $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?,  icono = ?, actualizado = NOW(), estado_categoria = ? WHERE id_categoria = ?  ");
        $stmt->bind_param("ssii", $categoria, $icono, $estado, $id_registro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $stmt->insert_id,
                'tipo' => 'categorias'
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
        $stmt = $conn->prepare("UPDATE categoria_evento SET estado_categoria = 0 WHERE id_categoria = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo' => 'categorias'

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
