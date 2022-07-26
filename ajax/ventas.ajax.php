<?php

require_once "../controller/ventas.controller.php";
require_once "../model/ventas.model.php";

class ajaxVentas{

    public function ajaxRecargasRecientes(){
        $respuesta = VentasController::ctrRecargasRecientes();
        echo json_encode($respuesta); 
    }
    
}

//Editar USuario
if(isset($_POST["recargasRecientes"]))
{
    $editar = new ajaxVentas();
    $editar->ajaxRecargasRecientes();
}

