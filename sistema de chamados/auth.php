<?php
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

session_start();
if (empty($_POST)) {
    $_SESSION["msg_error"] = "
    <p>Ops, houve um erro inesperado!!!</p>
    <a href='index.html'>Voltar</a>
    ";
    header("location:message.php");
    exit;
}

$username = $_POST["username"];
$password = $_POST["password"];

foreach ($users as $user) {
    if ($user["username"] == $username && password_verify($password, $user["password"])) {
        // Autenticado com sucesso!!!
        $_SESSION["name"] = $user["name"];
        header("location:dashboard.php");
        exit;
    }
}

$_SESSION["msg_warning"] = "
<p>Usuário ou senha inválidos!!!</p>
<a href='index.html'>Voltar</a>
";
header("location:message.php");
