<?php
    require_once '../clases/token.class.php';
    $_token = new token;
    $fecha = date('Y-m-d H:i');
    echo $_token->actualizarTokens($fecha);
?>