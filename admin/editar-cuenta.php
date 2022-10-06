<?php
    include_once 'funciones/sesion.php';
    include_once 'funciones/funciones.php';
    include_once 'templates/header.php';

     $id_banco = $_GET['id'];

     if (!filter_var($id_banco, FILTER_VALIDATE_INT)):
        die('ERROR!');
     else:

?>

<body  class="hold-transition skin-blue fixed sidebar-mini" data-elemento="Cuentas Bancarias">
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
        Actualizar Cuenta Bancaria
        <small>Utilice el formulario para actualizar la Cuenta Bancaria</small>
      </h1>


    </section>

    <!-- Main content -->
    <section class="content">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Información Cuenta Bancaria</h3>
                            </div>
                            <!-- /.box-header -->
                                <!-- form start -->
                                <?php
                                    $sql = "SELECT * FROM cuentas_bancarias WHERE id = $id_banco AND estado = 1";
                                    $res = $conn->query($sql);
                                    $banco = $res->fetch_assoc();
                                ?>
                                <form role="form" id="guardar-registro" action="modelo-cuenta.php" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="nombre_evento">Nombre Banco: </label>
                                            <input type="text" class="form-control" id="nombre_banco"
                                                   name="nombre_banco" value="<?php echo $banco['nombre_banco']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipo_cuenta">Tipo de Cuenta</label>
                                            <select name="tipo_cuenta" id="tipo_cuenta" class="form-control">
                                                <?php
                                                if ($banco['tipo_cuenta'] == 'AHORRO') { ?>
                                                    <option value="AHORRO" selected><?php echo 'AHORRO'; ?></option>
                                                    <option value="CORRIENTE"><?php echo 'CORRIENTE'; ?></option>
                                                <?php } else { ?>
                                                    <option value="AHORRO"><?php echo 'AHORRO'; ?></option>
                                                    <option value="CORRIENTE"
                                                            selected><?php echo 'CORRIENTE'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nro_cuenta">Numero de Cuenta: </label>
                                            <input type="text" class="form-control" id="nro_cuenta"
                                                   name="nro_cuenta" value="<?php echo $banco['nro_cuenta']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="nro_cuenta">Email </label>
                                            <input type="text" class="form-control" id="email"
                                                   name="email" value="<?php echo $banco['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="ced_ruc">Identificación </label>
                                            <input type="text" class="form-control" id="email"
                                                   name="ced_ruc" value="<?php echo $banco['ced_ruc']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="descripcion">Descripción </label>
                                            <input type="text" class="form-control" id="email"
                                                   name="descripcion" value="<?php echo $banco['descripcion']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select name="estado" id="estado" class="form-control">
                                                <?php
                                                if($banco['estado'] == 0 ) {?>
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
                                        <?php $id = $_GET['id']; ?>
                                        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                                        <button type="submit" name="actualizar" id="actualizar" class="btn btn-primary btn_actualizar_cuenta">Actualizar</button>
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

  endif;
?>
