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
    case "findAll":
        findAll();
        break;
    case "findOne":
        findOne();
        break;
    case "delete":
        delete();
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
    } catch (Exception $exception) {
        $_SESSION["msg_error"] = "Ops, houve um erro inesperado em nossa base de dados";
        $log = $exception->getFile() . " - " . $exception->getLine() . " - " . $exception->getMessage();
        Logger::writeLog($log);
    } finally {
        header("location:../View/message.php");
        exit;
    }
}

function findAll()
{
    $call_repository = new CallRepository();
    $_SESSION["list_of_calls"] = $call_repository->findAll();
    header("location:../View/list-of-calls.php");
}

function findOne()
{
    $id = $_GET["code"];
    if (empty($id)) {
        $_SESSION["msg_error"] = "O código do chamado é inválido!!!";
        header("location:../View/message.php");
        exit;
    }
    $call_repository = new CallRepository();
    $_SESSION["call"] = $call_repository->findOne($id);
    header("location:../View/call-edit.php");
}

function delete()
{
    $id = $_GET["code"];
    if (empty($id)) {
        $_SESSION["msg_error"] = "O código do chamado é inválido!!!";
        header("location:../View/message.php");
        exit;
    }
    try {
        $call_repository = new CallRepository();
        $result = $call_repository->delete($id);
        if ($result) {
            $_SESSION["msg_success"] = "Chamado registrado com sucesso!!!";
        } else {
            $_SESSION["msg_warning"] = "Lamento, não foi possível remover o chamado!!!";
        }
    } catch (Exception $exception) {
        $_SESSION["msg_error"] = "Ops. Houve um erro inesperado em nossa base de dados!!!";
        $log = $exception->getFile() . " - " . $exception->getFile() . " - " . $exception->getMessage();
        Logger::writeLog($log);
    } finally {
        header("location:../View/message.php");
    }
}
