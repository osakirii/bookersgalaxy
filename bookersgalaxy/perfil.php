<?php
    session_start();
    include_once("modulos/loadingscreen.php");
    include_once("modulos/header.php");
    $con = Connect::getInstance();
    if (isset($_SESSION['cliente_id'])) {
        $userId = $_SESSION['cliente_id'];
        echo $userId;
    }
?>

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/perfil.css">
        <title>Perfil</title>
    </head>
    <body>
        <main id="corpo">
            <h1>MEU PERFIL</h1>

            <div id="perfil">
                <img src="img/usuario/placeholder.png" alt="placeholder.png">
                <div id="perfilContainer">
                    <p>| JORGE VALENTIM</p>
                    <p>| Biografia: x x x x x xxxxx xxxxxxxxx xxx xxx xxxxx xx xxx xxxx x xx
                         xxxxxx xx xx xxx xx xx xxxxxx x x x x x </p>
                    <span>
                        <i class="fas fa-pen-to-square"></i><p>Editar Perfil</p>
                        <i class="fas fa-address-book"></i><p>Dados Pessoais</p>
                    </span>
                </div>
                <div class="perfilContainer"></div>
            </div>
        </main>
    </body>
</html>