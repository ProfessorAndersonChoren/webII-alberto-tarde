<?php
session_start();
if (!empty($_POST)) {
    $money = $_POST["money"];
    $coin = $_POST["coin"];

    switch ($coin) {
        case "dolar":
            $_SESSION["result"] = convertToDolar($money);
            header("location:message.php");
            break;
        case "euro":
            $_SESSION["result"] = convertToEuro($money);
            header("location:message.php");
            break;
    }
} else {
    $_SESSION["error"] = "Ops, houve um erro inesperado!!!";
    header("location:message.php");
}

function convertToDolar($money)
{
    return $money / 5.02;
}

function convertToEuro($money)
{
    return $money / 5.35;
}
