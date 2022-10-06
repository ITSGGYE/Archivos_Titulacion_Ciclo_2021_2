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
                Crear Administradores
                <small> Llena el formulario para poder crear un administrador.</small>
            </h1>


        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Información Administradores</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" id="guardar-registro" action="modelo-admin.php" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" name="usuario"
                                           placeholder="Ingresa un usuario" required>
                                </div>

                                <div class="form-group">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre_admin" name="nombre_admin" placeholder="Ingresa tu nombre" required>
                                </div>

                                <div class="form-group">
                                    <label for="nombre">Apellido:</label>
                                    <input type="text" class="form-control" id="apellido_admin" name="apellido_admin" placeholder="Ingresa tu nombre" required>
                                </div>

                                <div class="form-group">
                                    <label>Nuevo Password:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </div>
                                        <input id="password" type="password" name="nuevo_password" class="form-control pull-right" placeholder="Password" >
                                    </div>
                                    <!-- /.input group -->
                                </div>

                                <div class="form-group">
                                    <label>Repetir Password:</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </div>
                                        <input id="password_repetir" type="password" name="repetir_password" class="form-control pull-right" placeholder="Password" >
                                    </div>
                                    <span id="resultado_password" class="help-block"></span>

                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label for="nivel">Nivel de usuario </label>
                                    <select name="nivel" id="nivel" class="form-control">
                                        <option value=""> Seleccione </option>
                                        <option value="0">Usuario</option>
                                        <option value="1">Administrador</option>
                                    </select>
                                    <span id="resultado_nivel_usuario" class="help-block"></span>
                                </div>
                                <!-- /.input group -->
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
