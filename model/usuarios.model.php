<?php
require_once 'conexion.php';

class UsuariosModel
{
    //MostrarUsuarios
    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {

        if ($item != null) {
            /*$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as u 
            INNER JOIN 
            rol as r ON u.rol = r.rol_id 
            WHERE u.$item =:$item AND u.estado !=0");*/

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where $item = ?");
            $stmt->execute([$valor]);
            $resultConsulta = $stmt->fetch(PDO::FETCH_OBJ);

            if ($resultConsulta->tipo == 2) {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as p 
                INNER JOIN empleado as e
                ON e.rel_persona = p.idPersona
                WHERE p.$item =:$item AND e.estado !=0");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();
                //print_r($stmt->errorInfo());
                return $stmt->fetch();
            } else {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla as p 
                INNER JOIN cliente as c
                ON c.relacion_persona = p.idPersona
                WHERE p.$item =:$item AND c.estado !=0");
                $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

                $stmt->execute();
                //print_r($stmt->errorInfo());
                return $stmt->fetch();
            }
        } else { //usamos esta consulta para listar todos los usuarios
            $stmt = Conexion::conectar()->prepare("SELECT *  FROM $tabla AS p
            INNER JOIN cliente AS c
            ON c.relacion_persona = p.idPersona
            ORDER BY p.idPersona asc
            ");
            //$stmt -> bindParam(":".$item,$valor , PDO::PARAM_STR);

            $stmt->execute();
            //print_r($stmt->errorInfo());
            return $stmt->fetchAll();
        }
    }

    static public function mdlRegistrarUsuarios($tabla, $datos)
    {
        //validamos si el usuario se repite
        $consultaID = Conexion::conectar()->prepare('SELECT * FROM persona WHERE documento_persona = ? or usuario=?');
        $consultaID->execute([$datos['documento_persona'], $datos['usuario']]);
        $result = $consultaID->fetch(PDO::FETCH_OBJ);

        if ($result > 0) {
            return 'repet';
        } else {
            //realizamor el insert del usuario

            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_persona,apellido_persona,sexo_persona,direccion_persona,correo_persona,telefono_persona,documento_persona,fechaNacimiento_persona,nacionalidad_persona,usuario,password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
            $respuesta = $stmt->execute([$datos['nombre_persona'], $datos['apellido_persona'], $datos['sexo_persona'], $datos['direccion_persona'], $datos['correo_persona'], $datos['telefono_persona'], $datos['documento_persona'], $datos['fechaNacimiento_persona'], $datos['nacionalidad_persona'], $datos['usuario'], $datos['password']]);

            //buscamos por dni
            $cliente = Conexion::conectar()->prepare("SELECT * FROM persona where documento_persona = ?");
            $cliente->execute([$datos['documento_persona']]);
            $resCliente = $cliente->fetch(PDO::FETCH_OBJ);
            $idPlayerRand = rand(100000, 999999);

            $stmt2 = Conexion::conectar()->prepare("INSERT INTO cliente(idPlayer,relacion_persona) VALUES (?,?)");
            $respuesta2 = $stmt2->execute([$idPlayerRand, $resCliente->idPersona]);

            //print_r($stmt->errorInfo());
            if ($respuesta2 == true && $respuesta == true) {
                return "ok";
            } else {
                return "error";
            }
        }
    }

    static public function mdlEditarUsuarios($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_persona = ?, apellido_persona = ?, direccion_persona = ?, correo_persona = ?, telefono_persona = ?,  documento_persona = ?,fechaNacimiento_persona= ? ,nacionalidad_persona = ?, usuario = ?, password = ?, sexo_persona = ? WHERE idPersona = ?");
        $respuesta = $stmt->execute([$datos['nombre_persona'], $datos['apellido_persona'], $datos['direccion_persona'], $datos['correo_persona'], $datos['telefono_persona'], $datos['documento_persona'], $datos['fechaNacimiento_persona'], $datos['nacionalidad_persona'], $datos['usuario'], $datos['password'], $datos['sexo_persona'], $datos['idPersona']]);

        if ($respuesta == true) {
            return "ok";
        } else {
            return "error";
        }
    }

    //MostrarCliente
    static public function mdlMostrarCliente($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT nombre_persona, apellido_persona, idCliente FROM $tabla as c
             INNER JOIN persona AS p
             ON c.relacion_persona = p.idPersona
             where $item = ?");

        $stmt->execute([$valor]);
        $resultConsulta = $stmt->fetch();
        
        if ($resultConsulta > 0) {
            return $resultConsulta;
        } else {
            return 'error';
        }
        
    }

    //MostrarCliente
    static public function mdlMostrarMovimientos($tabla, $item, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla AS c
        INNER JOIN recargas AS r
        ON c.idCliente = r.idCliente
        WHERE $item = ?");

        $stmt->execute([$valor]);
        $resultConsulta = $stmt->fetchAll();
        //print_r($stmt->errorInfo());
        if ($resultConsulta > 0) {
            return $resultConsulta;
        } else {
            return 'error';
        }
        
    }
}
