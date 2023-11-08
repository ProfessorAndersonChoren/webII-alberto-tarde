<?php
session_start();
switch($_GET["operation"]){
    case "insert":
        insert();
        break;
    default:
        $_SESSION["msg_warning"] = "Operação inválida!!!";
        header("location:../View/message.php");
        exit;
}

function insert(){
    if(empty($_POST)){
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado!!!";
        header("../View/message.php");
        exit;
    }
    // TODO Implementar o objeto
    // TODO Validar os dados recebidos
    $error = array();
}