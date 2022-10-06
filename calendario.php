<?php include_once 'includes/templates/header.php';?>
<section id="schedule" class="section-with-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Calendario de Eventos</h2>
        </div>
        <?php
        header('Content-Type: text/html; utf8');
        ?>
        <?php

        try {
            require_once('includes/funciones/bd_conexion.php');
            $Datecurrent = date('Y-m-d', time());
            $sql = " SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado, url_imagen ";
            $sql .= " FROM eventos ";
            $sql .= " INNER JOIN categoria_evento ";
            $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
            $sql .= " INNER JOIN invitados ";
            $sql .= " ON eventos.id_inv = invitados.invitado_id  AND eventos.estado_evento = 1 AND fecha_evento > '$Datecurrent'";
            $sql .= " ORDER BY fecha_evento ASC";
            $resultado = $conn->query($sql);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        ?>
        <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <?php
                $calendario = array();
                while ($eventos = $resultado->fetch_assoc()) {
                    // obtiene la fecha del evento
                    $fecha = $eventos['fecha_evento'];
                    $evento = array(
                        'titulo' => $eventos['nombre_evento'],
                        'fecha' => $eventos['fecha_evento'],
                        'hora' => $eventos['hora_evento'],
                        'categoria' => $eventos['cat_evento'],
                        'icono' => $eventos['icono'],
                        'url_imagen' => $eventos['url_imagen'],
                        'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
                    );

                    $calendario[$fecha][] = $evento;
                    //var_dump($calendario);
                    ?>
                <?php } // while de fetch_assoc()  ?>

                <?php
					$meses = array(
						1 => "Enero",
						2 => "Febrero",
						3 => "Marzo",
						4 => "Abril",
						5 => "Mayo",
						6 => "Junio",
						7 => "Julio",
						8 => "Agosto",
						9 => "Septiembre",
						10 => "Octubre",
						11 => "Noviembre",
						12 => "Diciembre"
					);
					$dias = array(
					    "Monday"    => "Lunes",
					    "Tuesday"   => "Martes",
					    "Wednesday"  => "Miércoles",
					    "Thursday"  => "Jueves",
					    "Friday"    => "Viernes",
					    "Saturday"  => "Sábado",
					    "Sunday"    => "Domingo"
					    );
                // Imprime todos los eventos
                foreach ($calendario as $dia => $lista_eventos) { ?>
                    <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
                        <li class="nav-item">
                            <a class="nav-link active" role="tab" data-bs-toggle="tab">
                                <?php
                                // Unix
                                setlocale(LC_TIME, 'es_US');
                                // Windows
                                setlocale(LC_TIME, 'es_MX');
                                $ano = intval(strftime("%Y", strtotime($dia)));
                                $mes = $meses[intval(strftime("%m", strtotime($dia)))];
                                $diaEvento = $dias[(strftime("%A", strtotime($dia)))];
                                $date_event = $diaEvento.", ".strftime("%d", strtotime($dia))." de ".$mes." del ".$ano;
                                echo $date_event;?>
                            </a>
                        </li>
                    </ul>
                    <?php foreach ($lista_eventos as $evento) { ?>
                        <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day">
                            <div class="row schedule-item">
                                <div class="col-md-2">
                                    <p class="hora">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <?php echo $evento['fecha'] . " " . $evento['hora']; ?>
                                    </p>

                                </div>

                                <div class="col-md-10">
                                    <div class="speaker">
                                        <img src="img/invitados/<?php echo $evento['url_imagen']; ?>" alt="Brenden Legros">
                                    </div>
                                    <h3><?php header('Content-Type: text/html; utf8'); echo $evento['titulo']; ?></h3>
                                    <p><?php echo $evento['categoria']. ' / '.$evento['invitado'];?></p>

                                </div>
                            </div>
                        </div>
                        <!--                --><?php //foreach($lista_eventos as $evento) { ?>
                        <!--                    <div class="dia">-->
                        <!--                        <p class="titulo_calendar">--><?php //echo $evento['titulo']; ?><!--</p>-->
                        <!--                        <p class="hora">-->
                        <!--                            <i class="fa fa-clock-o" aria-hidden="true"></i>-->
                        <!--                            --><?php //echo $evento['fecha'] . " " . $evento['hora']; ?>
                        <!--                        </p>-->
                        <!--                        <p>-->
                        <!--                            <i class="fa --><?php //echo $evento['icono']; ?><!--" aria-hidden="true"></i>-->
                        <!--                            --><?php //echo $evento['categoria']; ?><!--</p>-->
                        <!--                        <p>-->
                        <!--                            <i class="fa fa-user" aria-hidden="true"></i>-->
                        <!--                            --><?php //echo $evento['invitado']; ?><!--</p>-->
                        <!--                        </p>-->
                        <!---->
                        <!--                    </div>-->
                        <!---->
                    <?php } ?>
                <?php } // fin foreach de dias ?>

            </div>


    </div>
</section>


<?php include_once 'includes/templates/footer.php'; ?>
