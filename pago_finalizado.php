<?php
    include_once 'includes/templates/header.php';
    use PayPal\Rest\ApiContext;
    use PayPal\Api\PaymentExecution ;
    use PayPal\Api\Payment;

    require 'includes/paypal.php';
?>
<section class="seccion contenedor">
    <h2>Resumen Registro</h2>

    <?php
        use PHPMailer\PHPMailer\PHPMailer;
        if(isset($_GET['exito'])){
            $resultado = $_GET['exito'];
        }
        $paymentId = $_GET['paymentId'];
        $id_pago = (int) $_GET['id_pago'];

        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId( $_GET['PayerID'] );


        //Execute the payment
        $result = $payment->execute($execution, $apiContext);

        // echo "<pre>";
        // var_dump(json_decode( $result ) );
        // echo "</pre>";
        echo "<hr>";

        $respuesta = $result->transactions[0]->related_resources[0]->sale->state;

        if($respuesta == "completed"){
              echo "<div class='resultado correcto'>";
              echo "El pago se realizo correctamente.<br/>";
              echo "el ID es {$paymentId}";
              echo "</div>";
              echo "</div>";
              echo "<div class='resultado'>
                        <td align='center' style='padding:40px 0 30px 0;'>
                            <img src='images/carrito.png' alt='' width='300' style='height:auto;display:block;'/>
                        </td>
                    </div>";

              require_once('includes/funciones/bd_conexion.php');
              $stmt = $conn->prepare("UPDATE `registrados` SET `pagado` = ? WHERE `ID_registrado` =  ? ");
              $pagado = 1;
              $stmt->bind_param("ii", $pagado, $id_pago);
              $stmt->execute();

              $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados JOIN regalos ON registrados.regalo = regalos.ID_regalo WHERE ID_Registrado = $id_pago";
              $resultado = $conn->query($sql);

               while ($registrado = $resultado->fetch_assoc()) {
                    $regalo = $registrado['nombre_regalo'];
                    $nombre = $registrado['nombre_registrado'];
                    $apellido = $registrado['apellido_registrado'];
                    $email = $registrado['email_registrado'];
                    $total = $registrado['total_pagado'];

                    $articulos = json_decode($registrado['pases_articulos'], true);
                    $arreglo_articulos = array(
                        'un_dia' => 'Pase 1 día',
                        'pase_2dias' => 'Pase 2 día',
                        'pase_completo' => 'Pase 3 día',
                        'camisas' => 'Camisas',
                        'etiquetas' => 'Etiquetas'
                    );
                    foreach ($articulos as $llave => $articulo) {
                        if (is_array($articulo) && array_key_exists('cantidad', $articulo)) {
                            if ($articulo['cantidad'] >= 1) {
                                $resumen_articulos =  "<b>" . $articulo['cantidad'] . "</b>" . "<b>" . " " . $arreglo_articulos[$llave] . "</b>" . "<br>";
                            }
                        } else {
                            $resumen_articulos = $arreglo_articulos[$llave] . "<br>";
                        }
                    }

                    $eventos_resultado = $registrado['talleres_registrados'];
                    $talleres = json_decode($eventos_resultado, true);
                    $talleres = implode("', '", $talleres['eventos']);
                    $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN ('$talleres')";
                    $resultado_talleres = $conn->query($sql_talleres);

                    $array_eventos = array();

                    while ($eventos = $resultado_talleres->fetch_assoc()) {
                        $nombres_eventos = $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento']. "\n";
                        array_push($array_eventos, $nombres_eventos);
                        $resumen_eventos = implode(", ", $array_eventos);
                    }

                }
              $stmt->close();
              $conn->close();
              sendmailpaypalprocess($nombre, $apellido, $email, $total, $resumen_articulos, $resumen_eventos, $regalo);


        } else {
            echo "<div class='resultado error'>";
            echo "El pago no se realizo";
            echo "</div>";
        }

    function sendmailpaypalprocess(string $name_input, string $apellido_name, string $email_input, float $total_pedido, string $articulos, string $eventos, string $regalo)
    {
        date_default_timezone_set('America/Guayaquil');
        $DateAndTime = date('d-m-Y', time());

        $name_complete = $name_input . " " . $apellido_name;

        $name = 'XITAcademy';
        $to = $email_input;
        $subject = 'Hemos confirmado tu pedido! ';
        $from = "info@xitacademy.xenturionit.com";
        $password = 'Pa$$w0rd.2022';

        $Message = "
<table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
    <tr>
        <td align='center' style='padding:0;'>
            <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #ffffff;border-spacing:0;text-align:left;'>
                 <tr>
                    <td style='padding:36px 30px 42px 30px;'>
                        <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                        <tr>
                            <td align='center' style='padding:40px 0 30px 0;background:#ffffff;'>
                                <img src='http://xenturionit.com/wp-content/uploads/2020/11/Iso-250x10px.png' alt='' width='300'
                                     style='height:auto;display:block;'/>
                            </td>
                        </tr>
                            <tr>
                                <td style='padding:0 0 36px 0;color:#333333;'>
                                    <p style='color:#666666;font-size:18px;line-height:1.33;padding:0;margin:30px 0;letter-spacing:normal'>
                                        Gracias,
                                        <b style='color:#0c4aa6'>$name_input!</b>
                                    </p>
                                </td>
                            </tr>
                             <tr>
                                <td align='center' style='padding:0px 0 30px 0;'>
                                    <img src='https://cdn-icons-png.flaticon.com/512/4522/4522559.png' alt='100' width='300'
                                         style='height:auto;display:block;'/>
                                </td>
                            </tr>
                        </table>

                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                            <tbody>
                            <tr valign='top'>
                                <td style='background:#ffffff;border-radius:10px;padding:20px 0 20px 20px'>
                                    <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                        <tbody>
                                            <tr valign='top'>
                                                <td style='padding:20px 0 20px 20px'>
                                                        <img style='display:block'
                                                         src='https://ci3.googleusercontent.com/proxy/vymItUE0RYxc3o7DBf43xX5CcL8QZ83m91SBBww4iYN67-A0siZoo45LfUk-SoagryLrOGcwQZc1aw_w61TBlg=s0-d-e1-ft#https://stc.boacompra.com/mail/icon-check.png'
                                                         class='CToWUd' data-bit='iit'>

                                                </td>
                                                <td width='100%' style='padding:20px'>
                                                    <p style='margin:0;padding:0;color:#333333;font-size:14px;line-height:normal;letter-spacing:normal'>
                                                        Hemos procesado tu pago Correctamente, Que tengas un buen dia!
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                         <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                            <tbody>
                                <tr valign='top'>
                                    <td style='padding:30px 0 0 0'>
                                        <table cellpadding='0' cellspacing='0' border='0' width='100%' style='border:1px solid #e7e7e7;border-radius:5px'>
                                            <tbody>
                                                <tr valign='top'>
                                                    <td style='color:#333333;font-size:16px;font-weight:bold;margin:0;padding:24px;line-height:normal;letter-spacing:normal;border-bottom:1px solid #e7e7e7'>
                                                        Forma de Pago: Paypal
                                                    </td>
                                                </tr>

                                                <tr valign='top'>
                                                    <td style='padding:20px'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%'>
                                                            <tbody>
                                                                <tr valign='top'>
                                                                    <td style='line-height:1.38'>
                                                                        <p style='padding:0;margin:0;color:#999999;font-size:14px;letter-spacing:normal'>
                                                                            Pedido:
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style='color:#333333;font-size:16px;letter-spacing:normal;padding-top:14px'>
                                                                        <table cellpadding='0' cellspacing='0' border='0'
                                                                           width='100%' style='line-height:normal'>
                                                                            <tbody>
                                                                                <tr valign='top'>
                                                                                    <td> - </td>
                                                                                    <td style='padding:0 0 0 8px;width:100%'>
                                                                                        $articulos
                                                                                    </td>
                                                                                </tr>
                                                                                <tr valign='top'>
                                                                                    <td> - </td>
                                                                                    <td style='padding:0 0 0 8px;width:100%'>
                                                                                        $eventos
                                                                                    </td>
                                                                                </tr>
                                                                                 <tr valign='top'>
                                                                                    <td> - </td>
                                                                                    <td style='padding:0 0 0 8px;width:100%'>
                                                                                        $regalo
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr valign='top'>
                                                    <td style='padding:20px;background:#f7f7f7;border-top:1px solid #e7e7e7'>
                                                        <table cellpadding='0' cellspacing='0' border='0' width='100%'
                                                               class='m_-5170131244438620164responsive-block'>
                                                            <tbody>
                                                                <tr style='text-align:right'
                                                                    class='m_-5170131244438620164responsive-row' valign='top'
                                                                    align='right'>
                                                                    <td width='60%' style='padding-right:5px'
                                                                        class='m_-5170131244438620164responsive-column'>
                                                                    </td>
                                                                    <td width='40%' style='padding-left:5px'
                                                                        class='m_-5170131244438620164responsive-column'>
                                                                        <p style='margin:0;padding:0;font-size:20px;color:#999999;line-height:normal;letter-spacing:normal'>
                                                                            Total: <b style='color:#333333'>USD$&nbsp;$total_pedido</b></p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                         </table>
                    </td>
                 </tr>

                 <tr>
                    <td style='padding:30px;background:#0c4aa6;'>
                        <table role='presentation'
                               style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
                            <tr>
                                <td style='padding:0;width:50%;' align='left'>
                                    <p style='margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;'>
                                        &copy; Copyright. All Rights Reserved<br/>
                                    </p>
                                </td>
                                <td style='padding:0;width:50%;' align='right'>
                                    <table role='presentation'
                                           style='border-collapse:collapse;border:0;border-spacing:0;'>
                                        <tr>
                                            <td style='padding:0 0 0 10px;width:38px;'>
                                                <a href='https://www.facebook.com/XenturionIT' target='_blank'
                                                   style='color:#ffffff;'><img
                                                    src='https://assets.codepen.io/210284/fb_1.png' alt='Facebook'
                                                    width='38' style='height:auto;display:block;border:0;'/></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
    ";

        $body = $Message;

        // Ignore from here

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        //$mail->SMTPDebug = 1;
        $mail->Host = "usm1.noc41.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 465;  // port
        $mail->SMTPSecure = "ssl";  // tls or ssl
        $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo '';
        } else {
            echo '<script type="text/javascript">';
            echo ' alert("NO")';  //not showing an alert box.
            echo '</script>';
        }
    }

    ?>



</section>
<script>
    $(window).on('popstate', function(event) {
        window.location.href = "index.php";
        return false;
    });
</script>


<?php include_once 'includes/templates/footer.php'; ?>
