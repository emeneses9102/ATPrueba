<?php
require_once 'conexion.php';

class VentasModel
{

    static public function mdlRegistrarVenta($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCliente,monto_recarga,codigo_recarga,banco_recarga,canalComunicacion_recarga,medioPago_recarga,idEmpleado) VALUES (?,?,?,?,?,?,?)");
        $respuesta = $stmt->execute([$datos['idCliente'], $datos['monto_recarga'], $datos['codigo_recarga'], $datos['banco_recarga'], $datos['canalComunicacion_recarga'], $datos['medioPago_recarga'], $datos['idEmpleado']]);

        $cliente = Conexion::conectar()->prepare("UPDATE cliente SET saldo = saldo +  ? WHERE idPlayer = ?");
        $respuestaCliente = $cliente->execute([$datos['monto_recarga'], $datos['idPlayer']]);
        
        if ( $respuesta == true && $respuestaCliente == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    static public function MdlRecargasRecientes($tabla)
    {
        $stmt = Conexion::conectar()->prepare("SELECT monto_recarga, CONCAT (p.nombre_persona,' ',p.apellido_persona) AS nombreCompleto, fecha_recarga FROM $tabla AS r
        INNER JOIN cliente AS c
        ON r.idCliente = c.idCliente
        INNER JOIN persona AS p
        ON c.relacion_persona = p.idPersona
        ORDER BY fecha_recarga DESC LIMIT 8
        ");
        $stmt->execute();
        
        
        return $stmt->fetchAll();
    }
}
