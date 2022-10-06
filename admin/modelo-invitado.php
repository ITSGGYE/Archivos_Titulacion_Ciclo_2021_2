<?php
include_once 'funciones/funciones.php';
if(isset($_POST['nombre_invitado'])){
    $nombre =$_POST['nombre_invitado'];
}
if(isset($_POST['apellido_invitado'])){
    $apellido =$_POST['apellido_invitado'];
}
if(isset($_POST['biografia_invitado'])){
    $biografia =$_POST['biografia_invitado'];
}
if(isset($_POST['id_registro'])){
    $id_registro =$_POST['id_registro'];
}
if(isset($_POST['url_twitter'])){
    $url_twitter =$_POST['url_twitter'];
}
if(isset($_POST['url_linkedin'])){
    $url_linkedin =$_POST['url_linkedin'];
}
if(isset($_POST['url_instagram'])){
    $url_instagram =$_POST['url_instagram'];
}
if (isset($_POST['estado'])){
    $estado = $_POST['estado'];
};

// funciones
if($_POST['registro'] == 'nuevo') {
    /*
    $respuesta = array(
        'respuesta' => $_POST,
        'file' => $_FILES
    );
    die(json_encode($respuesta));
    */
    $directorio = '../img/invitados/';

    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'],  $directorio . $_FILES['archivo_imagen']['name'] ) ) {
        $imagen_url = $_FILES['archivo_imagen']['name'];
        $imagen_resultado = "Se subió correctamente";
    }  else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }

    try {
        $stmt = $conn->prepare("INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen, url_linkedin, url_twitter, url_instagram, estado_invitado ) VALUES (?,?,?,?,?,?,?, 1)");
        $stmt->bind_param("sssssss", $nombre, $apellido, $biografia, $imagen_url, $url_linkedin, $url_twitter, $url_instagram);
        $stmt->execute();
        // $stmt->error
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'resultado_imagen' => $imagen_resultado,
                'tipo' => 'invitados'
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

    if($_FILES['archivo_imagen']['size'] > 0){

        $directorio = '../img/invitados/';

        if (!is_dir($directorio)) {
            mkdir($directorio, 0755, true);
        }

        if(move_uploaded_file($_FILES['archivo_imagen']['tmp_name'],  $directorio . $_FILES['archivo_imagen']['name'] ) ) {
            $imagen_url = $_FILES['archivo_imagen']['name'];
            $imagen_resultado = "Se subió correctamente";
        }  else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }
    }

    try {

        if($_FILES['archivo_imagen']['size'] > 0){
            // con imagen
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, editado = NOW(), url_linkedin = ?, url_twitter = ?, url_instagram = ?, estado_invitado = ? WHERE invitado_id = ? ");
            $stmt->bind_param("sssssssii", $nombre, $apellido, $biografia, $imagen_url, $url_linkedin, $url_twitter, $url_instagram, $estado, $id_registro);
        } else {
            // sin imagen
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, editado = NOW(),  url_linkedin = ?, url_twitter = ?, url_instagram = ?, estado_invitado = ?  WHERE invitado_id = ? ");
            $stmt->bind_param("ssssssii", $nombre, $apellido, $biografia,  $url_linkedin, $url_twitter, $url_instagram, $estado, $id_registro);
        }
        $stmt->execute();
        $rows = $stmt->affected_rows;

        $respuesta = array(
            'rows' => $rows
        );
        // $stmt->error
        if($rows > 0) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_actualizado' => $id_registro,
                'tipo' => 'invitados'
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
        $stmt = $conn->prepare("UPDATE invitados set estado_invitado = 0 WHERE invitado_id = ? ");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'correcto',
                'id_eliminado' => $id_borrar,
                'tipo' => 'invitados'
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
