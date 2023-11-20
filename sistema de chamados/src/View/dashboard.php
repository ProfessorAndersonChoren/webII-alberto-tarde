<?php require_once "../Controller/Auth_Verify.php"; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Desk Help - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <nav class="bg-info p-3 m-1 d-flex justify-content-between">
        <div>
            <a href="add-new-call.php" class="text-decoration-none text-white">Novo chamado</a>
            <a href="list-calls.html" class="text-decoration-none text-white">Exibir chamados</a>
        </div>
        <a href="../Controller/Auth.php?operation=logout" class="text-decoration-none text-white">Sair</a>
    </nav>
    <main class="text-center">
        <h1>Bem-vindo de volta <?= $_SESSION["user_data"]["name"]; ?></h1>
        <img src="https://cdn-icons-png.flaticon.com/512/3861/3861075.png" alt="Pessoa com Headset" width=200>
    </main>
</body>

</html>