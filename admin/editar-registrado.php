<?php
    $id = $_GET['id'];
    if (!filter_var($id, FILTER_VALIDATE_INT)):
        die('ERROR!');
    endif;
    include_once 'funciones/sesion.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';
?>

<body  class="hold-transition skin-blue fixed sidebar-mini" data-elemento="Eventos">
    <!-- Site wrapper -->
    <div class="wrapper">
        <?php include_once 'templates/barra.php'; ?>
        <?php include_once 'templates/navegacion.php'; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Editar Asistente
        <small>Utilice el formulario para la edición manual</small>
      </h1>


    </section>

    <!-- Main content -->
    <section class="content">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Información Registro</h3>
                            </div>
                            <!-- /.box-header -->
                                <!-- form start -->

                                <?php
                                        $sql = "SELECT * FROM registrados WHERE ID_Registrado = $id ";
                                        $resultado = $conn->query($sql);
                                        $registrado = $resultado->fetch_assoc();
                                ?>
                                <form role="form" id="guardar-registro" action="modelo-registrado.php" method="post" class="editar-registrado">
                                    <div class="box-body">
                                            <div class="form-group">
                                                <label for="nombre">Nombre: </label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $registrado['nombre_registrado']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="apellido">Apellido: </label>
                                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido"  value="<?php echo $registrado['apellido_registrado']; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email: </label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $registrado['email_registrado']; ?>">
                                                <div id="error"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="pagado">Pagado</label>
                                                <select name="pagado" id="pagado" class="form-control">
                                                    <?php
                                                        if($registrado['pagado'] == 0 ) {?>
                                                            <option value="0" selected><?php echo 'NO'; ?></option>
                                                            <option value="1"><?php echo 'SI'; ?></option>
                                                    <?php } else { ?>
                                                            <option value="0"><?php echo 'NO'; ?></option>
                                                            <option value="1" selected><?php echo 'SI'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" id="estado" class="form-control">
                                                <?php
                                                if($registrado['estado_registrado'] == 0 ) {?>
                                                    <option value="0" selected><?php echo 'INACTIVO'; ?></option>
                                                    <option value="1"><?php echo 'ACTIVO'; ?></option>
                                                <?php } else { ?>
                                                    <option value="0"><?php echo 'INACTIVO'; ?></option>
                                                    <option value="1" selected><?php echo 'ACTIVO'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                    </div>
                                    <!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type="hidden" name="registro" value="actualizar">
                                        <input type="hidden" name="id_registro" value="<?php echo $registrado['ID_Registrado'] ?>">
                                        <button type="submit" name="agregar" id="btnRegistro" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>

                    </div>
                </div>
            </div> <!--.row-->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
    $conn->close();

  include_once 'templates/footer.php';
  include_once 'templates/footer-scripts.php';
?>
<script src="../js/cotizar.js"></script>
