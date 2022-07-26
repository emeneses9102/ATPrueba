<?php

class UsuariosController
{
    /* Método para logearse */
    static public function ctrIngresoUsuario()
    {
        require_once "../model/usuarios.model.php";

        session_start();
        if (isset($_POST['username'])) {
            if (
                preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['password'])
            ) {

                $tabla = "persona";
                $encriptar = $_POST['password'];
                $item = "usuario";
                $valor = $_POST['username'];

                $respuesta = UsuariosModel::MdlMostrarUsuarios($tabla, $item, $valor);

                //var_dump($respuesta);
                if ($respuesta == 0) {
                    echo "<script>window.location = '../login-error';</script>";
                    //header('Location: ../login-error');
                } else {
                    //print_r($respuesta);

                    if ($respuesta['usuario'] == $_POST['username'] && password_verify($encriptar, $respuesta['password'])) {

                        $_SESSION['iniciarSesion'] = 'ok';
                        $_SESSION['usuario_id'] = $respuesta['idEmpleado'] != null ? $respuesta['idEmpleado'] : $respuesta['idPlayer'];
                        $_SESSION['nombre'] = $respuesta['nombre_persona'];
                        $_SESSION['apellidos'] = $respuesta['apellido_persona'];
                        $_SESSION['usuario'] = $respuesta['usuario'];
                        $_SESSION['dni'] = $respuesta['documento_persona'];
                        $_SESSION['tipo'] = $respuesta['tipo'];

                        if ($_SESSION['tipo'] == '2') {
                            echo "<script>window.location = '../inicio';</script>";
                        }
                    } else {
                        if ($respuesta['estado'] == 2) {
                            echo "<script>window.location = '../login-inactivo';</script>";
                        } else {
                            echo "<script>window.location = '../login';</script>";
                        }
                    }
                }
            }
        }
    }

    //Crear Usuario
    static public function ctrCrearUsuario()
    {

        if (isset($_POST['usuario_persona'])) {

            if (
                preg_match('/^[a-zA-Z0-9\sñÑáéíóúÁÉÍÓÚ]+$/', $_POST['nombres_persona']) &&
                preg_match('/^[a-zA-Z0-9\sñÑáéíóúÁÉÍÓÚ]+$/', $_POST['apellidos_persona']) &&
                preg_match('/^[a-zA-Z0-9_]+$/', $_POST['usuario_persona']) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST['password_persona'])
            ) {


                $tabla = "persona";
                $encriptar = password_hash($_POST['password_persona'], PASSWORD_DEFAULT);

                $datos = array(
                    "nombre_persona" => $_POST['nombres_persona'],
                    "apellido_persona" => $_POST['apellidos_persona'],
                    "direccion_persona" => $_POST['direccion_persona'],
                    "telefono_persona" => $_POST['telefono_persona'],
                    "documento_persona" => $_POST['documento_persona'],
                    "usuario" => $_POST['usuario_persona'],
                    "password" => $encriptar,
                    "correo_persona" => $_POST['correo_persona'],
                    "sexo_persona" => $_POST['sexo_persona'],
                    "nacionalidad_persona" => $_POST['nacionalidad_persona'],
                    "fechaNacimiento_persona" => $_POST['fechaNacimiento_persona']
                );



                $respuesta = UsuariosModel::mdlRegistrarUsuarios($tabla, $datos);
                var_dump($respuesta);
                if ($respuesta == "ok") {
                    echo '<script>
                    swal.fire({
                        type:"success",
                        title : "El usuario ha sido registrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result)=>{
                        if(result.value){
                            window.location = "usuarios";
                        }
                    })
    
                    </script>';
                } else {
                    if ($respuesta == "repet") {
                        echo '<script>
                        swal.fire({
                            type:"error",
                            title : "El alumno ya existe",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
        
                        </script>';
                    } else {
                        echo '<script>
                        swal.fire({
                            type:"error",
                            title : "El usuario no se registró",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
        
                        </script>';
                    }
                }
            } else {

                echo '<script>
                swal.fire({
                    type:"error",
                    title : "El usuario no puede ir vacío o llevar caracteres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                }).then((result)=>{
                    if(result.value){
                        window.location = "usuarios";
                    }
                })

                </script>';
            }
        }
    }

    //Mostrar usuario
    static public function ctrMostrarUsuarios($item, $valor)
    {
        $tabla = "persona";

        $respuesta = UsuariosModel::MdlMostrarUsuarios($tabla, $item, $valor);
        //var_dump($respuesta);
        return $respuesta;
    }

    //Crear Usuario
    static public function ctrActualizarUsuario(){
        
        if(isset($_POST['idPersona'])){
            if(preg_match('/^[a-zA-Z0-9_\sñÑáéíóúÁÉÍÓÚ]+$/',$_POST['nombres_persona_edit'])){
                
                $tabla="persona";
                if(isset($_POST['password_persona_edit']) && !empty($_POST['password_persona_edit'])){
                    if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['password_persona_edit'])){
                        $encriptar=password_hash($_POST['editClave'],PASSWORD_DEFAULT);
                    }else{
                        echo '<script>
                            swal.fire({
                                type:"error",
                                title : "La contraseña no puede ir vacía o llevar caracteres especiales",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result)=>{
                                if(result.value){
                                    window.location = "alumnos";
                                }
                            })

                            </script>';
                    }
                    
                }else{
                    $encriptar = $_POST['password_persona_edit_actual'];
                }
                if($_POST['fechaNacimiento_persona_edit'] == 0){
                    $_POST['fechaNacimiento_persona_edit']= NULL;
                 }
                $datos = array("nombre_persona" => $_POST['nombres_persona_edit'],
                                "idPersona" => $_POST['idPersona'],
                                "apellido_persona" => $_POST['apellidos_persona_edit'],
                                "direccion_persona" => $_POST['direccion_persona_edit'],
                                "telefono_persona" => $_POST['telefono_persona_edit'],  
                                "documento_persona" => $_POST['documento_persona_edit'],
                                "usuario" => $_POST['usuario_persona_edit'],
                                "passowrd" => $encriptar,
                                "sexo_persona" => $_POST['sexo_persona_edit'],
                                "correo_persona" => $_POST['correo_persona_edit'],
                                "nacionalidad_persona" => $_POST['nacionalidad_persona_edit'],
                                "fechaNacimiento_persona" => $_POST['fechaNacimiento_persona_edit']
                                );
                
                $respuesta = UsuariosModel :: mdlEditarUsuarios($tabla,$datos);
                //var_dump($respuesta);
                if($respuesta == "ok"){
                    echo '<script>
                    swal.fire({
                        type:"success",
                        title : "El usuario ha sido editado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result)=>{
                        if(result.value){
                            window.location = "usuarios";
                        }
                    })
    
                    </script>';
                    
                    
                }else if($respuesta == "repet-dni"){
                    echo '<script>
                        swal.fire({
                            type:"error",
                            title : "Usuario con dni duplicado",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
        
                        </script>';
                }
                else{
                    
                        echo '<script>
                        swal.fire({
                            type:"error",
                            title : "El usuario no se actualizó",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result)=>{
                            if(result.value){
                                window.location = "usuarios";
                            }
                        })
        
                        </script>';
                    
                    
                }

            }
         }
    }

    //Mostrar usuario
    static public function ctrMostrarcliente($item, $valor)
    {
        $tabla = "cliente";

        $respuesta = UsuariosModel::MdlMostrarcliente($tabla, $item, $valor);
        //var_dump($respuesta);
        
            return $respuesta; 
    }

    //Ver movimientos
    static public function ctrMostrarMovimientos($item, $valor)
    {
        $tabla = "cliente";

        $respuesta = UsuariosModel::MdlMostrarMovimientos($tabla, $item, $valor);
        //var_dump($respuesta);
        
            return $respuesta; 
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $instancia = new UsuariosController();
    return $instancia->ctrIngresoUsuario();
}
