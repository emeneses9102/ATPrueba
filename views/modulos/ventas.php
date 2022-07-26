<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row align-items-center">
            <div class="col-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 d-flex align-items-center">
                        <li class="breadcrumb-item"><a href="inicio" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ventas</li>
                    </ol>
                </nav>
                <h1 class="mb-0 fw-bold">Ventas</h1>
            </div>
            
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <div>
                                <h4 class="card-title">Recarga de saldo</h4>

                            </div>
                        </div>

                        <div class="">
                            <form class="form-horizontal form-material mx-2" id="formRecarga" name="formRecarga" method="post" rol="form" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="col-md-12">ID Player</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="ID Player" class="form-control form-control-line" id="idPlayer" name="idPlayer" required>
                                            <input type="text"  class="form-control form-control-line" id="idEmpleado" name="idEmpleado" value="<?php echo $_SESSION['usuario_id']?>" hidden >
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Monto</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="S/." class="form-control form-control-line" id="monto_recarga" name="monto_recarga" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Código de recarga</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" id="codigo_recarga" name="codigo_recarga" required> 
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Banco</label>
                                        <div class="col-md-12">
                                            <select class="form-select shadow-none form-control-line" id="banco_recarga" name="banco_recarga" >
                                                <option>BCP</option>
                                                <option>BBVA</option>
                                                <option>SCOTIABANK</option>
                                                <option>INTERBANK</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Canal de comunicación</label>
                                        <div class="col-md-12">
                                            <select class="form-select shadow-none form-control-line" id="canalComunicacion_recarga" name="canalComunicacion_recarga">
                                                <option>WHATSAPP</option>
                                                <option>TELEGRAM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Medio de pago</label>
                                        <div class="col-md-12">
                                            <select class="form-select shadow-none form-control-line" id="medioPago_recarga" name="medioPago_recarga">
                                                <option>Deposito</option>
                                                <option>Transferencia</option>
                                                <option>PagoEfectivo</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                    <input type="text" class="form-control form-control-line" id="idCliente" name="idCliente" hidden>
                                        <label class="col-md-12">Nombres</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" id="nombre_persona" name="nombre_persona" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="col-md-12">Apellidos</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" id="apellido_persona" name="apellido_persona" readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-control-line">
                                    <button type="submit" class="btn btn-success text-white">Registrar</button>
                                    <button type="button" class="btn btn-danger text-white" onclick="limpiarFormVentas()">Limpiar</button>
                                </div>
                                <?php
                                    $crearVenta = new VentasController();
                                    $crearVenta->ctrRegistrarVenta();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Últimas recargas</h4>
                        <div id="ultimasRecargas">
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales chart -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Table -->
        <!-- ============================================================== -->
        
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->