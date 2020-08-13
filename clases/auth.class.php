<?php
require_once 'conexion/conexion.php';
require_once 'respuestas.class.php';


class auth extends conexion{

    public function login($json){
      
        $_respustas = new respuestas;
        $datos = json_decode($json,true);
        if(!isset($datos['usuario']) || !isset($datos["password"])){
            //error con los campos
            return $_respustas->error_400();
        }else{
            //todo esta bien 
            $usuario = $datos['usuario'];
            $password = $datos['password'];
            $datos = $this->obtenerDatosUsuario($usuario);
            if($datos){
                //si existe el usuario
            }else{
                //no existe el usuario
                return $_respustas->error_200("El usuaro $usuario  no existe ");
            }

        }
    }



    private function obtenerDatosUsuario($correo){
        $query = "SELECT UsuarioId,Password,Estado FROM usuarios WHERE Usuario = '$correo'";
        $datos = parent::obtenerDatos($query);
        if(isset($datos[0]["UsuarioId"])){
            return $datos;
        }else{
            return 0;
        }
    }


}




?>