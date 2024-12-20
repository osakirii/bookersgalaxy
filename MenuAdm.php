<?php
    include_once 'modulos/loadingscreen.php';
    include_once 'modulos/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booker's Galaxy</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f5f5f5;
            }
            main#corpo {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                text-align: center;
            }
            main#corpo h1 {
                margin-bottom: 20px;
                color: #333;
            }
            .menu-crud {
                display: flex;
                gap: 15px;
            }
            .menu-crud a {
                text-decoration: none;
                padding: 10px 20px;
                background-color: #007BFF;
                color: white;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
            .menu-crud a:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <main id="corpo">
            <h1>Gerenciamento de Livros</h1>
            <div class="menu-crud">
                <a href="Livro/uploadLivro.php">Adicionar Livro</a>
                <a href="Livro/buscarLivro.php">Buscar/Alterar Livro</a>
                <a href="Livro/verLivro.php">Ver Livro</a>
            </div>
            <h1>Gerenciamento de Editora</h1>
            <div class="menu-crud">
                <a href="Editora/uploadEditora.php">Adicionar Editora</a>
                <a href="Editora/buscarEditora.php">Buscar/Alterar Editora</a>
                <a href="Editora/verEditora.php">Ver Editora</a>
            </div>
            <h1>Gerenciamento de Autor</h1>
            <div class="menu-crud">
                <a href="Autor/uploadAutor.php">Adicionar Autor</a>
                <a href="Autor/buscarAutor.php">Buscar/Alterar Autor</a>
                <a href="Autor/verAutor.php">Ver Autor</a>
            </div>
        </main>
        
        <?php
            include_once 'modulos/footer.php';
         ?>
    </body>
</html>
