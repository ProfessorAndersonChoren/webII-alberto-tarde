<?php

namespace QI\SistemaDeChamados\Controller;

use QI\SistemaDeChamados\Model\Equipment;
use QI\SistemaDeChamados\Model\User;
use QI\SistemaDeChamados\Model\Call;
use QI\SistemaDeChamados\Model\Repository\Connection;

require_once dirname(dirname(__DIR__)) . "/vendor/autoload.php";

session_start();
switch ($_GET["operation"]) {
    case "insert":
        insert();
        break;
    default:
        $_SESSION["msg_warning"] = "Operação inválida!!!";
        header("location:../View/message.php");
        exit;
}

function insert()
{
    if (empty($_POST)) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado!!!";
        header("../View/message.php");
        exit;
    }
    $equipment = new Equipment(
        intval($_POST["floor"]),
        $_POST["room"]
    );
    $user = new User($_POST["user_email"]);
    $call = new Call(
        $user,
        $equipment,
        $_POST["classification"],
        $_POST["description"],
    );
    // TODO Validar os dados recebidos
    $errors = array();

    // TODO Realizar a persistência
    if(empty($errors)){
        $conn = Connection::getConnection();
        var_dump($conn);
    }
}
