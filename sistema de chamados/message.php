<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem do sistema</title>
</head>

<body>
    <?php
    session_start();
    echo $_SESSION["msg_error"];
    ?>
</body>

</html>