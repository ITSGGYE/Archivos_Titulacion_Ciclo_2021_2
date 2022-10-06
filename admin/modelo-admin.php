<?php
include_once 'funciones/funciones.php';

// Leer los datos
if(isset($_POST['usuario'])){
    $usuario=$_POST['usuario'];
}
if(isset($_POST['nombre_admin'])){
    $nombre=$_POST['nombre_admin'];
}
if(isset($_POST['apellido_admin'])){
    $apellido=$_POST['apellido_admin'];
}
if (isset($_POST['nuevo_password'])) {
    $password = $_POST['nuevo_password'];
    $opciones = array(
        'cost' => 12
    );
    $password_hassed = password_hash($password, PASSWORD_BCRYPT, $opciones);
}
if(isset($_POST['nivel'])){
    $nivel = $_POST['nivel'];
}
if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
};


if($_POST['registro'] == 'nuevo') {
    try {
        $stmt = $conn->prepare("INSERT INTO admins (nombre_admin, apellido_admin, usuario, hash_pass, nivel, creado)values(?, ?, ?, ?, ?, now())");
        $stmt->bind_param("ssssi", $nombre, $apellido, $usuario, $password_hassed, $nivel);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'admins'
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
    $id_registro = $_POST['id_registro'];
    $usuario = $_POST['usuario'];
    $nuevo_password = $_POST['nuevo_password'];
    try {
        $opciones = array(
            'cost' => 12,
        );
        if(empty($_POST['nuevo_password']) && empty($_POST['repetir_password'])) {
            $stmt = $conn->prepare("UPDATE admins SET usuario = ?, actualizado = NOW(), estado_admin = ? WHERE ID_admin = ?  ");
            $stmt->bind_param("sii", $usuario, $estado, $id_registro);

        } else {
            $hash_password = password_hash($nuevo_password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare("UPDATE admins SET usuario = ?,  hash_pass = ?, actualizado = NOW(), estado_admin = ? WHERE ID_admin = ?  ");
            $stmt->bind_param("ssii", $usuario, $hash_password, $estado, $id_registro);

        }

        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $stmt->insert_id,
                'tipo' => 'admins'
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
        $stmt = $conn->prepare("UPDATE admins SET estado_invitado = 0 WHERE ID_admin = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo'=>'admins'
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
