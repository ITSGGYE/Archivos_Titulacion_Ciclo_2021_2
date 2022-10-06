<?php include_once 'includes/templates/header.php'; ?>

<section class="seccion contenedor">
    <h2><span>XIT</span> ACADEMY</h2>
    <p style="text-align: justify;">
        XenturionIT está conformado por un equipo de profesionales especializados en diferentes campos de TI cuyo
        propósito es generar valor agregado a nuestros socios estratégicos poniendo a su disposición toda la experiencia
        adquirida durante la dilatada trayectoria profesional de sus colaboradores y la constante capacitación del
        personal interno.
    </p>
</section> <!--seccion-->

<section class="programa">
    <div class="contenedor-video">
        <video autoplay loop muted poster="img/bg-talleres.jpg">
            <source src="video/video.mp4" type="video/mp4">
            <source src="video/video.webm" type="video/webm">
            <source src="video/video.ogv" type="video/ogg">
        </video>
    </div> <!--.contenedor-video-->
    <div class="contenido-programa">
        <div class="contenedor">
            <div class="programa-evento">
                <div class="section-header">
                    <h2>Programas del Evento</h2>
                </div>

                <?php
                try {
                    require_once('includes/funciones/bd_conexion.php');
                    $sql = "SELECT * FROM `categoria_evento` where estado_categoria = 1";
                    $resultado = $conn->query($sql);
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
                ?>
                <nav class="menu-programa">
                    <?php while ($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
                        <?php $categoria = $cat['cat_evento']; ?>
                        <a href="#<?php echo strtolower($categoria) ?>">
                            <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i> <?php echo $categoria ?>
                        </a>
                    <?php } ?>
                </nav>

                <?php
                try {
                    require_once('includes/funciones/bd_conexion.php');
                    $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado`, `estado_evento` ";
                    $sql .= "FROM `eventos` ";
                    $sql .= "INNER JOIN `categoria_evento` ";
                    $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                    $sql .= "INNER JOIN `invitados` ";
                    $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                    $sql .= "AND eventos.id_cat_evento = 1 ";
                    $sql .= "WHERE estado_evento = 1  ORDER BY `evento_id` LIMIT 2;";
                    $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado`,`estado_evento` ";
                    $sql .= "FROM `eventos` ";
                    $sql .= "INNER JOIN `categoria_evento` ";
                    $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                    $sql .= "INNER JOIN `invitados` ";
                    $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                    $sql .= "AND eventos.id_cat_evento = 2 ";
                    $sql .= "WHERE estado_evento = 1  ORDER BY `evento_id` LIMIT 2;";
                    $sql .= "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `nombre_invitado`, `apellido_invitado`, `estado_evento` ";
                    $sql .= "FROM `eventos` ";
                    $sql .= "INNER JOIN `categoria_evento` ";
                    $sql .= "ON eventos.id_cat_evento=categoria_evento.id_categoria ";
                    $sql .= "INNER JOIN `invitados` ";
                    $sql .= "ON eventos.id_inv=invitados.invitado_id ";
                    $sql .= "AND eventos.id_cat_evento = 3 ";
                    $sql .= "WHERE estado_evento = 1 ORDER BY `evento_id` LIMIT 2;";
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
                ?>

                <?php $conn->multi_query($sql); ?>

                <?php
                do {
                    $resultado = $conn->store_result();
                    $row = $resultado->fetch_all(MYSQLI_ASSOC); ?>

                    <?php $i = 0; ?>
                    <?php foreach ($row as $evento): ?>
                        <?php if ($i % 2 == 0) { ?>
                            <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                        <?php } ?>
                        <div class="detalle-evento">
                            <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
                            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?>
                            </p>
                            <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?>
                            </p>
                            <p><i class="fa fa-user"
                                  aria-hidden="true"></i> <?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?>
                            </p>
                        </div>
                        <?php if ($i % 2 == 1): ?>
                            <a href="calendario.php" class="button float-right">Ver todos</a>
                            </div> <!--#talleres-->
                        <?php endif; ?>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                    <?php $resultado->free(); ?>
                <?php } while ($conn->more_results() && $conn->next_result()); ?>


            </div> <!--.programa-evento-->
        </div> <!--.contenedor-->
    </div><!--.contenido-programa-->
</section> <!--.programa-->


<?php include_once 'includes/templates/invitados.php'; ?>

<div class="contador parallax">
    <div class="contenedor" data-aos="fade-up">
        <ul class="resumen-evento clearfix">
            <li><p class="numero">0</p> Invitados</li>
            <li><p class="numero">0</p> Cursos</li>
            <li><p class="numero">0</p> Categorias</li>
            <li><p class="numero">0</p> Capacitaciones</li>
        </ul>
    </div>
</div>
<section id="buy-tickets" class="section-with-bg">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Precios</h2>
            <p>Compra Tickets</p>
        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Pase por 1 dia</h5>
                        <h6 class="card-price text-center">$30</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Asientos regulares</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Bocadillos Gratis</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Todos los eventos</li>
                            <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Insignia
                                personalizada
                            </li>
                        </ul>
                        <hr>
                        <div class="text-center">
                            <a href="registro.php" class="btn">Comprar Ahora!</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pro Tier -->
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Todos los dias</h5>
                        <h6 class="card-price text-center">$50</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Asientos regulares</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Bocadillos Gratis</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Todos los eventos</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Insignia personalizada</li>
                        </ul>
                        <hr>
                        <div class="text-center">
                            <a href="registro.php" class="btn">Comprar Ahora!</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card mb-5 mb-lg-0">
                    <div class="card-body">
                        <h5 class="card-title text-muted text-uppercase text-center">Pase por 2 Dias</h5>
                        <h6 class="card-price text-center">$45</h6>
                        <hr>
                        <ul class="fa-ul">
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Asientos regulares</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Bocadillos Gratis</li>
                            <li><span class="fa-li"><i class="fa fa-check"></i></span>Todos los eventos</li>
                            <li class="text-muted"><span class="fa-li"><i class="fa fa-times"></i></span>Insignia
                                personalizada
                            </li>
                        </ul>
                        <hr>
                        <div class="text-center">
                            <a href="registro.php" class="btn">Comprar Ahora!</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="venue section-padding" id="section_6" style="background: #f6f7fd; padding-bottom: 20px">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 style="color: #0E1B4D; margin-top: 10px;">Contáctanos</h2>
            </div>
            <div class="col-lg-6 col-12">
                <iframe style="border-radius: 30px;" class="google-map"
                        src="https://maps.google.com/maps?q=Pichincha%20%23%20y%20Elizalde&t=m&z=18&output=embed&iwloc=near"
                        width="100%" height="371.59" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div id="divcontact">
                <i style="color: #0E1B4D;" class="bi bi-geo-alt"></i>
                <h3 style="color: #0E1B4D;"><b>Dirección</b></h3>
                <address style="color: #0E1B4D;">Pichincha 334 y Elizalde
                    Edificio El Comercio
                    Piso 6 – Oficina 601 <br/>Guayaquil, Ecuador.
                </address>
                <i style="color: #0E1B4D;" class="bi bi-phone"></i>
                <h3 style="color: #0E1B4D;"><b>Teléfono</b></h3>
                <p><a style="color: #0E1B4D;" href="tel:(04) 232-8580">(04) 232-8580</a></p>
                <i style="color: #0E1B4D;" class="bi bi-envelope"></i>
                <h3 style="color: #0E1B4D;"><b>Email</b></h3>
                <p><a style="color: #0E1B4D;" href="mailto:solucionesit@xenturionit.com">solucionesit@xenturionit.com</a>
                </p>

            </div>

        </div>
    </div>
</section>

<section id="subscribe">
    <div class="container" data-aos="zoom-in">
        <h2  style="color: white;">Faltan</h2>
        <div class="cuenta-regresiva contenedor" data-aos="fade-up">
            <ul class="clearfix">
                <li style="color: white;"><p id="dias" class="numero_contador"></p> días </li>
                <li style="color: white;"><p id="horas" class="numero_contador"></p> horas</li>
                <li style="color: white;"><p id="minutos" class="numero_contador"></p> minutos</li>
                <li style="color: white;"><p id="segundos" class="numero_contador"></p> segundos</li>
            </ul>
        </div>
        <?php
        $conn = new mysqli('localhost', 'robregon_user', 'Pa$$w0rd.2022', 'robregon_xitacademy');
        if ($conn->connect_error) {
            echo $error->$conn->connect_error;
        }
        $sql = "SELECT * FROM eventos  WHERE estado_evento = 1 ORDER BY CONCAT(fecha_evento, ' ', hora_evento) DESC LIMIT 1";

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) { ?>
            <h3 id="contador" style="display: none"><?php echo str_replace("-", "/", $row['fecha_evento']); ?></h3>
        <?php } ?>
    </div>
</section>

<?php include_once 'includes/templates/footer.php'; ?>
