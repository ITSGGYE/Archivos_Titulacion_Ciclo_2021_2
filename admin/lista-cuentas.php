<?php
include_once 'funciones/sesion.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php'; ?>


<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php include_once 'templates/barra.php'; ?>
    <?php include_once 'templates/navegacion.php'; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Cuentas Bancarias
              <small>Lista de cuentas bancarias almacenadas en la base de datos.</small>
          </h1>
      </section>

    <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Listado de todas las cuentas bancarias</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
              <a href="nuevo-cuenta.php" class="btn btn-success">Añadir Nuevo</a>
              <table id="registros" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Nro de Cuenta</th>
                      <th>Correo Electrónico</th>
                      <th>Identificación</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                  </thead>

                  <tbody>
                  <?php

                  try {
                      $sql = "SELECT * FROM cuentas_bancarias WHERE estado = 1"; //Crea consulta SQL

                      $respuesta = $conn->query($sql); //Ejecuta consulta SQL

                  } catch(Exception $e){
                      $error = $e->getMessage();
                      echo $error;
                  }

                  $numero = 1;
                  while($resultado = $respuesta->fetch_assoc()){
                      ?>
                      <tr>
                          <td> <?php echo $numero; ?> </td>
                          <td> <?php echo $resultado['nombre_banco']; ?> </td>
                          <td> <?php echo $resultado['tipo_cuenta']; ?> </td>
                          <td> <?php echo $resultado['nro_cuenta']; ?> </td>
                          <td> <?php echo $resultado['email']; ?> </td>
                          <td> <?php echo $resultado['ced_ruc']; ?> </td>
                          <td> <?php echo $resultado['descripcion']; ?> </td>
                          <td>
                              <?php
                              $estado = $resultado['estado'];
                              if($estado == 1):
                                  echo ' '.'<span class="badge bg-green">Activo</span>';
                              else:
                                  echo ' '.'<span class="badge bg-red">Inactivo</span>';
                              endif;
                              ?>
                          </td>
                          <td>
                              <a href="editar-cuenta.php?id=<?php echo $resultado['id'];?>" class="btn bg-orange btn-flat margin">
                                  <i class="fa fa-pencil"></i>
                              </a>
                              <a href="#" data-id="<?php echo $resultado['id']; ?>" data-tipo="cuenta" type="button" class="btn bg-maroon btn-flat margin borrar_registro"><i class="fa fa-trash" aria-hidden="true"></i></a>

                          </td>
                      </tr>

                      <?php
                      $numero++;
                  }
                  ?>

                  </tbody>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Nro de Cuenta</th>
                      <th>Correo Electrónico</th>
                      <th>Identificación</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                  </tr>
                  </tfoot>
              </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php
  $conn->close();
  include_once 'templates/footer.php';
  include_once 'templates/footer-scripts.php';


?>
