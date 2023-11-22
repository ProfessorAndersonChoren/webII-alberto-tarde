<?php

namespace QI\SistemaDeChamados\Controller;

use Exception;
use QI\SistemaDeChamados\Model\Equipment;
use QI\SistemaDeChamados\Model\Repository\CallRepository;
use QI\SistemaDeChamados\Model\User;
use QI\SistemaDeChamados\Model\Call;

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
        header("location:../View/message.php");
        exit;
    }
    $equipment = new Equipment(
        intval($_POST["floor"]),
        $_POST["room"]
    );
    $equipment->id = $_POST["pc_number"];

    $user = new User($_POST["user_email"]);
    $user->id = 1;

    $call = new Call(
        $user,
        $equipment,
        $_POST["classification"],
        $_POST["description"],
    );
    // TODO Validar os dados recebidos
    $errors = array();

    if (!empty($errors)) {
    }

    try {
        $call_repository = new CallRepository();
        $result = $call_repository->insert($call);

        if ($result) {
            $_SESSION["msg_success"] = "Chamado registrado com sucesso!!!";
        } else {
            $_SESSION["msg_warning"] = "Lamento, não foi possível registrar o chamado!!!";
        }
    } catch (Exception $e) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado em nossa base de dados";
    } finally {
        header("location:../View/message.php");
        exit;
    }
}
