<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> <!--Importante--->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar</title>
</head>
<body>

<?php
$conn = new mysqli('localhost', 'robregon_user', 'Pa$$w0rd.2022', 'robregon_xitacademy');

if ($conn->connect_error) {
    echo $error->$conn->connect_error;
}

date_default_timezone_set("America/Guayaquil");
$fecha = date("d/m/Y");

header("Content-Type: text/html;charset=utf-8");
header("Content-Type: application/vnd.ms-excel charset=iso-8859-1");
$filename = "registrados activos al " . $fecha . ".xls";
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=" . $filename . "");


$sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
$sql .= " JOIN regalos ";
$sql .= " ON registrados.regalo = regalos.id_regalo WHERE estado_registrado = 1";

$registrados = $conn->query($sql);

?>


<table style="text-align: center; font-size: 15px;" border='1' cellpadding=1 cellspacing=1>
    <thead>
    <tr style="text-align: center;">
        <th style="background: #D0CDCD;">#</th>
        <th style="background: #D0CDCD;">Nombre</th>
        <th style="background: #D0CDCD;">Apellido</th>
        <th style="background: #D0CDCD;">Email</th>
        <th style="background: #D0CDCD;">Fecha Registro</th>
        <th style="background: #D0CDCD;">Articulos</th>
        <th style="background: #D0CDCD;">Eventos</th>
        <th style="background: #D0CDCD;">Regalo</th>
        <th style="background: #D0CDCD;">Total Pagado</th>
        <th style="background: #D0CDCD;">Pagado</th>
        <th style="background: #D0CDCD;">Estado</th>
    </tr>
    </thead>
    <?php
    $i = 1;
    while ($registrado = mysqli_fetch_array($registrados)) { ?>
        <tbody>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $registrado['nombre_registrado']; ?></td>
            <td><?php echo $registrado['apellido_registrado']; ?></td>
            <td><?php echo $registrado['email_registrado']; ?></td>
            <td><?php echo $registrado['fecha_registro']; ?></td>

            <td>
                <?php
                $articulos = json_decode($registrado['pases_articulos'], true);
                $arreglo_articulos = array(
                    'un_dia' => 'Pase 1 día',
                    'pase_2dias' => 'Pase 2 días',
                    'pase_completo' => 'Pase 3 días',
                    'camisas' => 'Camisas',
                    'etiquetas' => 'Etiquetas'
                );
                foreach ($articulos as $llave => $articulo) {
                    if (is_array($articulo) && array_key_exists('cantidad', $articulo)) {
                        if ($articulo['cantidad'] >= 1) {
                            echo "<b>" . $articulo['cantidad'] . "</b>" . "<b>" . " " . $arreglo_articulos[$llave] . "</b>" . "<br>";
//                                                echo  . " " .  $arreglo_articulos[$llave] . "<br>";
                        }
                    } else {
                        echo $articulo . " " . $arreglo_articulos[$llave] . "<br>";
                    }
                }
                ?>
            </td>
            <td>
                <?php
                $eventos_resultado = $registrado['talleres_registrados'];
                $talleres = json_decode($eventos_resultado, true);

                $talleres = implode("', '", $talleres['eventos']);


                $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN  ('$talleres') OR clave IN ('$talleres')  ";
                // echo $sql_talleres;
                $resultado_talleres = $conn->query($sql_talleres);


                while ($eventos = $resultado_talleres->fetch_assoc()) {
                    echo $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                }
                ?>
            </td>


            <td><?php echo $registrado['nombre_regalo']; ?></td>
            <td style="text-align:right;">$<?php echo $registrado['total_pagado']; ?></td>
            <td>
                <?php
                $pagado = $registrado['pagado'];
                if ($pagado == '1') {
                    echo "SI";
                } else {
                    echo "NO";
                }
                ?>
            </td>
            <td>
                <?php
                $estado = $registrado['estado_registrado'];
                if ($estado == 1):
                    echo '<span class="badge bg-green">Activo</span>';
                else:
                    echo '<span class="badge bg-red">Inactivo</span>';
                endif;
                ?>
            </td>

        </tr>
        </tbody>

    <?php } ?>
</table>

</body>
</html>
