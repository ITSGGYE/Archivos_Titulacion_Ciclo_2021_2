<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 footer-info">
<!--                    <img src="../../img/logo.png" alt="">-->
                    <p>XenturionIT está conformado por un equipo de profesionales especializados en diferentes campos de TI cuyo propósito es generar valor agregado a nuestros socios estratégicos poniendo a su disposición toda la experiencia adquirida durante la dilatada trayectoria profesional de sus colaboradores y la constante capacitación del personal interno.</p>
                </div>

                <div class="col-lg-3 col-md-8 footer-links">
                    <h4>Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="index.php">Inicio</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="calendario.php">Calendario</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="invitados.php">Invitados</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="registro.php">Reservaciones</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="contacto.php">Contacto</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contactanos</h4>
                    <p>
                        Pichincha 334 y Elizalde
                        Edificio El Comercio
                        Piso 6 – Oficina 601
                        <br>
                        Guayaquil, Ecuador<br>
                        <strong>Teléfono:</strong> (04) 232-8580<br>
                        <strong>Email:</strong> solucionesit@xenturionit.com<br>
                    </p>

                    <div class="social-links">
                        <a href="https://www.facebook.com/XenturionIT/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/xenturionit_ecuador/" target="_blank"  class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://ec.linkedin.com/company/xenturionit" target="_blank" class="linkedin"><i class="bi bi-linkedin"></i></a>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong>XenturionIT</strong>. All Rights Reserved
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="js/plugins.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/jquery.countdown.min.js"></script>
<script src="js/jquery.lettering.js"></script>

<?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    if($pagina == 'invitados' || $pagina == 'index'){
      echo '<script src="js/jquery.colorbox-min.js"></script>';
      echo '<script src="js/jquery.waypoints.min.js"></script>';
      echo '<script src="js/leaflet.js"></script>';

    } else if($pagina == 'conferencia') {
      echo '<script src="js/lightbox.js"></script>';
      echo '<script src="js/glightbox.min.js"></script>';
      echo '<script src="js/swiper-bundle.min.js"></script>';
    } else if($pagina == 'contacto') {
        echo '<script src="https://www.google.com/recaptcha/api.js?hl=es" async defer></script>';
    }
?>
<script src="js/main.js"></script>
<script src="js/main2.js"></script>
<script src="js/cotizador.js"></script>
<script src="js/aos.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>

<script type="text/javascript" src="//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us11.list-manage.com","uuid":"b3bb37039b6fbf3db0c1a8331","lid":"20463b69f2"}) })</script>
</body>
</html>
