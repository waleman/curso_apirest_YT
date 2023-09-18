<?php



class conexion {

    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;


    function __construct(){
        $listadatos = $this->datosConexion();
        foreach ($listadatos as $key => $value) {
            $this->server = $value['server'];
            $this->user = $value['user'];
            $this->password = $value['password'];
            $this->database = $value['database'];
            $this->port = $value['port'];
        }


        $connStr = "host=".$this->server." port=".$this->port." dbname=".$this->database." user=".$this->user." password=".$this->password;
        //$this->conexion = new mysqli($this->server,$this->user,$this->password,$this->database,$this->port);
        $this->conexion =   pg_connect($connStr);
        
        if(!$this->conexion){
            echo "algo va mal con la conexion";
            die();
        }

    }

    private function datosConexion(){
        $direccion = dirname(__FILE__);
        $jsondata = file_get_contents($direccion . "/" . "config");
        return json_decode($jsondata, true);
    }


    private function convertirUTF8($array){
        array_walk_recursive($array,function(&$item,$key){
            if(!mb_detect_encoding($item,'utf-8',true)){
                $item =  mb_convert_encoding($item, "UTF-8", mb_detect_encoding($item));
            }
        });
        return $array;
 
    }


    public function obtenerDatos($sqlstr){
        $resultArray = Array();
        $results = pg_query($this->conexion,$sqlstr);
        $data = pg_fetch_all($results);
        return  $this->convertirUTF8($data);
    }



    public function nonQuery($sqlstr){
        //$results = $this->conexion->query($sqlstr);
        $results = pg_query($this->conexion,$sqlstr);
        //return $this->conexion->affected_rows;
        return  pg_num_rows($results);
    }


    //INSERT 
    public function nonQueryId($sqlstr){
         //$results = $this->conexion->query($sqlstr);
         $results = pg_query($this->conexion,$sqlstr);
         //$filas = $this->conexion->affected_rows;
         $filas =  pg_num_rows($results);
         if($filas >= 1){
            $resultados = pg_fetch_array($results);
            return  $resultados[0];
         }else{
             return 0;
         }

    }
     
    //encriptar

    protected function encriptar($string){
        return md5($string);
    }





}



?>