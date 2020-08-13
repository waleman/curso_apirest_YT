<?php 
require_once 'clases/auth.class.php';
require_once 'clases/respuestas.class.php';

$_auth = new auth;
$_respuestas = new respuestas;



if($_SERVER['REQUEST_METHOD'] == "POST"){

    $postBody = file_get_contents("php://input");
    $datosArray = $_auth->login($postBody);
    print_r(json_encode($datosArray));


}else{

    echo " metodo no permitido";
}


?>