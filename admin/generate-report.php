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
                Reporte
                <small> Llena los campos para obtener un reporte de los registrados por eventos.</small>
            </h1>
        </section>
        <section class="content">
            <div class="row" style="width: 130%;">
                <div class="col-md-8">
                    <!-- Main content -->
                    <section class="content">

                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Generar Reporte por Rango de Fecha</h3>
                            </div>
                            <form role="form" name="generate-report" id="generate-report" method="POST" action="export/export_registrados.php">
                                <div id="datatable_length" style="padding-left: 20px; padding-bottom:20px;">
                                    <!-- RANGO DE FECHAS A BUSCAR Y EXPORTAR -->
                                    <label style="font-weight: normal;">Desde: <input class="form-control" type="date" id="fecha_desde" name="fecha_desde"require/></label>
                                    <label style="font-weight: normal;padding-right: 10px;">Hasta: <input class="form-control" type="date" id="fecha_hasta" name="fecha_hasta" require/></label>
                                    <select id="selected" name="selected">
                                        <option value="0">Seleccione:</option>
                                        <?php
                                        $sql = "SELECT evento_id, nombre_evento, clave FROM eventos WHERE estado_evento = 1 ORDER BY nombre_evento ASC";
                                        $eventos = $conn->query($sql);
                                        while ($evento = mysqli_fetch_array($eventos)){
                                            echo '<option value="'.$evento['evento_id'].'">'.$evento['nombre_evento'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input id="evento_id" name="evento_id" type="hidden">
                                    <script>
                                        var select = document.querySelector("#selected");
                                        select.addEventListener('change', capturarValor);
                                        function capturarValor(){
                                            var valor = select.value;
                                            document.getElementById("evento_id").value = valor;
                                            console.log(valor);
                                        }
                                    </script>

                                    <!-- BOTON PARA EXPORTAR-->
                                    <button type="submit" class="btn-sm btn-success fa fa-file-excel-o" style="padding: 5px 10px; cursor: pointer; position: relative;" > Exportar</button>

                                </div>
                            </form>
                        </div> <!-- /.box -->

                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Generar Reporte por Evento</h3>
                            </div>
                            <form role="form" name="generate-report_event" id="generate-report_event" method="POST" action="export/export_registrados_eventos.php">
                                <div id="datatable_length" style="padding-left: 20px; padding-bottom:20px;">
                                    <select id="event_selected" name="event_selected">
                                        <option value="0">Seleccione:</option>
                                        <?php
                                        $sql = "SELECT evento_id, nombre_evento, clave FROM eventos WHERE estado_evento = 1 ORDER BY nombre_evento ASC";
                                        $eventos = $conn->query($sql);
                                        while ($evento = mysqli_fetch_array($eventos)){
                                            echo '<option value="'.$evento['evento_id'].'">'.$evento['nombre_evento'].'</option>';
                                        }
                                        ?>
                                    </select>
                                    <input id="event_selected_id" name="event_selected_id" type="hidden">
                                    <script>
                                        var select = document.querySelector("#event_selected");
                                        select.addEventListener('change', capturarValor);
                                        function capturarValor(){
                                            var valor = select.value;
                                            document.getElementById("event_selected_id").value = valor;
                                            console.log(valor);
                                        }
                                    </script>

                                    <!-- BOTON PARA EXPORTAR-->
                                    <button type="submit" class="btn-sm btn-success fa fa-file-excel-o" style="padding: 5px 10px; cursor: pointer; position: relative;" > Exportar</button>

                                </div>
                            </form>
                        </div>
                    </section> <!-- /.content -->
                </div>
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
