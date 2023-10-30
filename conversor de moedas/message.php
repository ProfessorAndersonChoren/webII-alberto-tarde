<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagem do sistema</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main style="flex-direction:column;">
        <h1>Mensagem do sistema</h1>
        <p>
            <?php
            session_start();
            echo "$ " . number_format($_SESSION["result"], 2);
            ?>
        </p>
    </main>
</body>

</html>