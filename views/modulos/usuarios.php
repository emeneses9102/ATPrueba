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
                        <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                    </ol>
                </nav>
                <h1 class="mb-0 fw-bold">Usuarios</h1>
            </div>
            <div class="col-6">
                <div class="text-end upgrade-btn">
                    <button type="button" onclick="openRegistrarUsuario()" class="btn btn-primary text-white" id="btnRegistrarUsuario">Registrar nuevo</button>
                </div>
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

        <!-- Table -->
        <!-- ============================================================== -->
        <div class="row" id="listaUsuarios">
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Listado de usuarios</h4>

                            </div>

                        </div>
                        <!-- title -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover align-middle text-nowrap" id="tableUsuarios">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Nombres</th>
                                        <th class="border-top-0">Apellidos</th>
                                        <th class="border-top-0">Correo</th>
                                        <th class="border-top-0">Teléfono</th>
                                        <th class="border-top-0">Saldo actual</th>
                                        <th class="border-top-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $usuarios = UsuariosController::ctrMostrarUsuarios($item, $valor);
                                    foreach ($usuarios as $value) {
                                        echo '<tr>
                                                    <th>' . $value['nombre_persona'] . '</th>
                                                    <th>' . $value['apellido_persona'] . '</th>
                                                    <th>' . $value['correo_persona'] . '</th>
                                                    <th>' . $value['telefono_persona'] . '</th>
                                                    <th><h5 class="m-b-0">' . $value['saldo'] . '</h5></th>
                                                    <th><button class="btn btn-info btn-sm mt-1" title="Editar" onclick="editarPersona(' . $value["idPersona"] . ')"><i class="mdi mdi-account-edit"></i></button>
                                                    <button class="btn btn-purple btn-sm mt-1 ml-1" title="movimientos"  onclick="verMovimientos(' . $value["idPersona"] . ')"><i class="mdi mdi-search-web"></i></i></button></th>
                                                    </tr>
                                                ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Registrar -->
        <!-- ============================================================== -->
        <!-- Modal -->
        <div class="col-lg-12 col-xlg-12 col-md-12" id="registrarUsuarios">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Agregar Usuario</h4>

                        </div>

                    </div>
                    <form class="form-horizontal form-material mx-2" id="formUsuario" name="formUsuario" method="post" rol="form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Nombres</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Nombres" class="form-control form-control-line" id="nombres_persona" name="nombres_persona">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Apellidos</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Apellidos" class="form-control form-control-line" id="apellidos_persona" name="apellidos_persona">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label class="col-md-12">Correo</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Correo" class="form-control form-control-line" id="correo_persona" name="correo_persona">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="col-md-12">Documento</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="DNI" class="form-control form-control-line" id="documento_persona" name="documento_persona">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="col-md-12">Sexo</label>
                                <div class="col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona" id="hombre" value="hombre">
                                        <label class="form-check-label" for="inlineRadio1">Hombre</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona" id="Mujer" value="Mujer">
                                        <label class="form-check-label" for="inlineRadio2">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona" id="Otro" value="Otro">
                                        <label class="form-check-label" for="inlineRadio3">Otro</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Dirección</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Dirección" class="form-control form-control-line" id="direccion_persona" name="direccion_persona">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Teléfono</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Teléfono" class="form-control form-control-line" id="telefono_persona" name="telefono_persona">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Fecha de nacimiento</label>
                                <div class="col-md-12">
                                    <input type="date" class="form-control form-control-line" id="fechaNacimiento_persona" name="fechaNacimiento_persona">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Nacionalidad</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Nacionalidad" class="form-control form-control-line" id="nacionalidad_persona" name="nacionalidad_persona">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Usuario</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Usuario" class="form-control form-control-line" id="usuario_persona" name="usuario_persona">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" placeholder="password" class="form-control form-control-line" id="password_persona" name="password_persona">
                                </div>
                            </div>
                        </div>

                        <div class="form-control-line">
                            <button type="submit" class="btn btn-success text-white">Registrar</button>
                            <button type="button" class="btn btn-danger text-white" onclick="closeRegistrarUsuario()">Cerrar</button>
                        </div>
                        <?php

                        $crearUsuario = new UsuariosController();
                        $crearUsuario->ctrCrearUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- Editar -->
        <!-- ============================================================== -->
        <!-- Modal -->
        <div class="col-lg-12 col-xlg-12 col-md-12" id="editarUsuarios">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <div>
                            <h4 class="card-title">Editar Usuario</h4>

                        </div>

                    </div>
                    <form class="form-horizontal form-material mx-2" id="formUsuario" name="formUsuarioEdit" method="post" rol="form" enctype="multipart/form-data">
                        <input type="hidden" name="idPersona" id="idPersona" value="">
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Nombres</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Nombres" class="form-control form-control-line" id="nombres_persona_edit" name="nombres_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Apellidos</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Apellidos" class="form-control form-control-line" id="apellidos_persona_edit" name="apellidos_persona_edit">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label class="col-md-12">Correo</label>
                                <div class="col-md-12">
                                    <input type="email" placeholder="Correo" class="form-control form-control-line" id="correo_persona_edit" name="correo_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="col-md-12">Documento</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="DNI" class="form-control form-control-line" id="documento_persona_edit" name="documento_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <label class="col-md-12">Sexo</label>
                                <div class="col-md-12">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona_edit" id="hombre_edit" value="hombre">
                                        <label class="form-check-label" for="inlineRadio1">Hombre</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona_edit" id="Mujer_edit" value="Mujer">
                                        <label class="form-check-label" for="inlineRadio2">Mujer</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sexo_persona_edit" id="Otro_edit" value="Otro">
                                        <label class="form-check-label" for="inlineRadio3">Otro</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Dirección</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Dirección" class="form-control form-control-line" id="direccion_persona_edit" name="direccion_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Teléfono</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Teléfono" class="form-control form-control-line" id="telefono_persona_edit" name="telefono_persona_edit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Fecha de nacimiento</label>
                                <div class="col-md-12">
                                    <input type="date" class="form-control form-control-line" id="fechaNacimiento_persona_edit" name="fechaNacimiento_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Nacionalidad</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Nacionalidad" class="form-control form-control-line" id="nacionalidad_persona_edit" name="nacionalidad_persona_edit">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="col-md-12">Usuario</label>
                                <div class="col-md-12">
                                    <input type="text" placeholder="Usuario" readonly class="form-control form-control-line" id="usuario_persona_edit" name="usuario_persona_edit">
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <input type="password" placeholder="password" class="form-control form-control-line" id="password_persona_edit" name="password_persona_edit_actual" hidden>
                                    <input type="password" placeholder="password" class="form-control form-control-line" id="password_persona_edit" name="password_persona_edit">
                                </div>
                            </div>
                        </div>

                        <div class="form-control-line">
                            <button type="submit" class="btn btn-success text-white">Actualizar</button>
                            <button type="button" class="btn btn-danger text-white" onclick="closeRegistrarUsuario()">Cerrar</button>
                        </div>
                        <?php

                        $crearUsuario = new UsuariosController();
                        $crearUsuario->ctrActualizarUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="row" id="listaMovimientosUsuarios">
            <div class="text-end upgrade-btn mb-2">
                <button type="button" onclick="closeListaMovimientosUsuarios()" class="btn btn-success text-white" id="btnRegistrarUsuario">Regresar</button>
            </div>
            <!-- column -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- title -->
                        <div class="d-md-flex">
                            <div>
                                <h4 class="card-title">Listado de usuarios</h4>

                            </div>

                        </div>
                        <!-- title -->
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover align-middle text-nowrap" id="tableUsuarios">
                                <thead>
                                    <tr>
                                        <th class="border-top-0">Medio de Pago</th>
                                        <th class="border-top-0">Canal</th>
                                        <th class="border-top-0">Banco</th>
                                        <th class="border-top-0">Código de recarga</th>
                                        <th class="border-top-0">Monto</th>
                                        <th class="border-top-0">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="movimientosCliente">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->