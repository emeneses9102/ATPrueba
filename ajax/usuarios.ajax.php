<?php

require_once "../controller/usuarios.controller.php";
require_once "../model/usuarios.model.php";

class ajaxUsuarios{
    public $idPersona;

    public function ajaxEditarUsuario(){
        $item="idPersona";
        $valor = $this->idPersona;
        $respuesta = UsuariosController::ctrMostrarUsuarios($item,$valor);
        echo json_encode($respuesta);
        
    }
    public function ajaxBuscarCliente(){
        $item="idPlayer";
        $valor = $this->idPlayer;
        $respuesta = UsuariosController::ctrMostrarCliente($item,$valor);
        echo json_encode($respuesta);
        
    }

    public function ajaxMovimienosUsuario(){
        $item="relacion_persona";
        $valor = $this->idPersonaMovimientos;
        $respuesta = UsuariosController::ctrMostrarMovimientos($item,$valor);
        echo json_encode($respuesta);
        
    }
}

//Editar USuario
if(isset($_POST["idPersona"]))
{
    
    $editar = new ajaxUsuarios();
    $editar->idPersona = $_POST["idPersona"];
    $editar->ajaxEditarUsuario();
}

//Buscar Usuario recarga
if(isset($_POST["idPlayer"]))
{
    
    $editar = new ajaxUsuarios();
    $editar->idPlayer = $_POST["idPlayer"];
    $editar->ajaxBuscarCliente();
}

//listar Movimientos
if(isset($_POST["idPersonaMovimientos"]))
{
    
    $editar = new ajaxUsuarios();
    $editar->idPersonaMovimientos = $_POST["idPersonaMovimientos"];
    $editar->ajaxMovimienosUsuario();
}