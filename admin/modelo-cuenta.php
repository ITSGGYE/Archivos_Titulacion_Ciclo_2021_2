<?php
include_once 'funciones/funciones.php';

// Leer los datos
if(isset($_POST['nombre_banco'])){
    $nombre_banco = $_POST['nombre_banco'];
}
if(isset($_POST['tipo_cuenta'])){
    $tipo_cuenta = $_POST['tipo_cuenta'];
}
if(isset($_POST['email'])){
    $email = $_POST['email'];
}
if (isset($_POST['ced_ruc'])) {
    $ced_ruc = $_POST['ced_ruc'];
}
if(isset($_POST['descripcion'])){
    $descripcion = $_POST['descripcion'];
}
if(isset($_POST['nro_cuenta'])){
    $nro_cuenta = $_POST['nro_cuenta'];
}
if(isset($_POST['id_registro'])){
    $id_registro = $_POST['id_registro'];
}
if(isset($_POST['estado'])){
    $estado = $_POST['estado'];
}


if($_POST['registro'] == 'nuevo') {
    try {
        $stmt = $conn->prepare("INSERT INTO cuentas_bancarias (nombre_banco, tipo_cuenta, nro_cuenta, email, ced_ruc, descripcion, creado, estado)values(?, ?, ?, ?, ?, ?, now(), 1)");
        $stmt->bind_param("ssssss", $nombre_banco, $tipo_cuenta, $nro_cuenta, $email, $ced_ruc, $descripcion);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'cuentas'
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
        $stmt = $conn->prepare("UPDATE cuentas_bancarias SET nombre_banco = ?,  tipo_cuenta = ?, nro_cuenta = ?, email = ?, ced_ruc = ?, descripcion = ?, estado = ?, actualizado = NOW() WHERE id = ?  ");
        $stmt->bind_param("ssssssii", $nombre_banco, $tipo_cuenta, $nro_cuenta, $email, $ced_ruc, $descripcion, $estado, $id_registro);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $stmt->insert_id,
                'tipo' => 'cuentas'
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
        $stmt = $conn->prepare("UPDATE cuentas_bancarias SET estado = 0 WHERE id = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo'=>'cuentas'
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
