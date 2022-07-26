<?php

class VentasController
{
    //Crear venta
    static public function ctrRegistrarVenta()
    {


        if (isset($_POST['idPlayer'])) {

            $tabla = "recargas";


            $datos = array(
                "idPlayer" => $_POST['idPlayer'],
                "idEmpleado" => $_POST['idEmpleado'],
                "idCliente" => $_POST['idCliente'],
                "monto_recarga" => $_POST['monto_recarga'],
                "codigo_recarga" => $_POST['codigo_recarga'],
                "banco_recarga" => $_POST['banco_recarga'],
                "canalComunicacion_recarga" => $_POST['canalComunicacion_recarga'],
                "medioPago_recarga" => $_POST['medioPago_recarga'],
            );


            $respuesta = VentasModel::mdlRegistrarVenta($tabla, $datos);
            //var_dump($respuesta);
            if ($respuesta == "ok") {
                echo '<script>
                    swal.fire({
                        icon:"success",
                        title : "Depósito realizado",
                        confirmButtonText: "Cerrar",
                    }).then((result)=>{
                        if(result.value){
                            window.location = "ventas";
                        }
                    })
    
                    </script>';
            } else {
                echo '<script>
                        swal.fire({
                            icon:"error",
                            title : "No se pudo realizar el depósito",
                            confirmButtonText: "Cerrar",
                        }).then((result)=>{
                            if(result.value){
                                window.location = "ventas";
                            }
                        })
        
                        </script>';
            }
        }
    }

    //Mostrar ultimas recargas
    static public function ctrRecargasRecientes()
    {
        $tabla = "recargas";

        $respuesta = VentasModel::MdlRecargasRecientes($tabla);
        //var_dump($respuesta);
        return $respuesta;
    }
}
