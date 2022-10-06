<?php
include_once 'funciones/sesion.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
?>

<body class="hold-transition skin-blue fixed sidebar-mini" data-elemento="Eventos">
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
                Crear Cuentas Bancarias
                <small> Llena el formulario para poder crear una cuenta.</small>
            </h1>

        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Información Cuentas Bancarias</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="guardar-registro" action="modelo-cuenta.php" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="nombre_banco">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre_banco" name="nombre_banco" placeholder="Ingresa el nombre del Banco" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="tipo_cuenta">Tipo de Cuenta </label>
                                        <select name="tipo_cuenta" id="nivel" class="form-control" required>
                                            <option value=""> Seleccione</option>
                                            <option value="AHORRO">Ahorro</option>
                                            <option value="CORRIENTE">Corriente</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nro de Cuenta:</label>
                                    <input type="text" class="form-control" id="nro_cuenta" name="nro_cuenta" placeholder="Ingresa el número de cuenta" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico:</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa correo electrónico de contacto" required>
                                </div>

                                <div class="form-group">
                                    <label for="nombre">Ced/Ruc:</label>
                                    <input type="text" class="form-control" id="ced_ruc" name="ced_ruc" placeholder="Ingresa la identificación del propietario de la cuenta" required>
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Ingresa una descripción">
                                </div>
                            </div>
                            <div class="box-footer">
                                <input  type="hidden" name="registro" value="nuevo">
                                <button type="submit" name="agregar" id="agregar" class="btn btn-primary">Agregar</button>
                            </div>

                    </div>
                    <!-- /.box-body -->
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
