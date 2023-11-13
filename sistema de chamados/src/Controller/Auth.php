<?php

namespace QI\SistemaDeChamados\Controller;

session_start();

switch ($_GET["operation"]) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    default:
        $_SESSION['msg_warning'] = 'Operação inválida!!!';
        header("location:../View/message.php");
        break;
}

function logout()
{
    unset($_SESSION["user_data"]);
    header("location:../../index.html");
    exit;
}

function login()
{
    $users = array(
        array(
            "name" => "João",
            "username" => "joao",
            "password" => password_hash("123456", PASSWORD_DEFAULT),
        ),
        array(
            "name" => "Maria",
            "username" => "maria",
            "password" => password_hash("123456", PASSWORD_DEFAULT),
        )
    );
    if (empty($_POST)) {
        $_SESSION["msg_error"] = "
    <p>Ops, houve um erro inesperado!!!</p>
    <a href='../index.html'>Voltar</a>
    ";
        header("location:../View/message.php");
        exit;
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    foreach ($users as $user) {
        if ($user["username"] == $username && password_verify($password, $user["password"])) {
            // Autenticado com sucesso!!!
            $_SESSION["user_data"] = $user;
            header("location:../View/dashboard.php");
            exit;
        }
    }

    $_SESSION["msg_warning"] = "<p>Usuário ou senha inválidos!!!</p>";
    header("location:../View/message.php");
    exit;
}
