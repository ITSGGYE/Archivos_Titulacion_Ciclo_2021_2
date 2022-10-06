<?php
try {
    require_once('includes/funciones/bd_conexion.php');
    $sql = "SELECT * FROM `invitados` WHERE estado_invitado = 1 ";
    $resultado = $conn->query($sql);
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<section id="speakers">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>Invitados</h2>
            <p>Aquí están algunos de nuestros invitados</p>
        </div>
        <div class="row">
            <?php while ($invitados = $resultado->fetch_assoc()) { ?>
                <div class="col-lg-4 col-md-6">
                    <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                        <img src="img/invitados/<?php echo $invitados['url_imagen'] ?>" alt="<?php echo $invitados['nombre_invitado'] ?>" class="img-fluid">
                        <div class="details">
                            <h3><a><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado'] ?></a></h3>
<!--                            <p>Quas alias incidunt</p>-->
                            <p></p>
                            <div class="social">
                                <?php if(($invitados['url_linkedin'])){?>
                                    <a href="<?php echo $invitados['url_linkedin'];?>" target="_blank""><i class="bi bi-linkedin"></i></a>
                                <?php }?>

                                <?php if(($invitados['url_twitter'])){?>
                                    <a href="<?php echo $invitados['url_twitter'];?>" target="_blank"><i class="bi bi-twitter"></i></a>
                                <?php }?>

                                <?php if(($invitados['url_instagram'])){?>
                                    <a href="<?php echo $invitados['url_instagram'];?>" target="_blank"><i class="bi bi-instagram"></i></a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</section>
<?php
$conn->close();
?>
