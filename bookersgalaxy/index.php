<?php
session_start();
include_once(__DIR__ . '/config.php'); // Inclui todas as configurações e funções globais
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
    <title>Booker's Galaxy</title>
    <link rel="stylesheet" href="css/index.css">
    <style>
        #corpo button.slide {
            margin-top: 141px;
        }
    </style>
</head>

<body>
    <main id="corpo">
        <img style="width: 200px; height: auto;" src="<?php echo Busca(6) ?>">
        <h1>TOP 10 DO MÊS</h1>
        <section class="carrossel">
            <?php
            $livros = BuscaLivro(); // Chama a função BuscaLivro()

            // Verifica se encontrou livros
            if ($livros) {
                foreach ($livros as $livro) {
                    echo '<div class="book_card">';
                    echo '<a href="Livro.php?id_livro=' . urlencode($livro['id_livro']) . '">';
                    echo '<img src="/bookersgalaxy/' . htmlspecialchars($livro['path']) . '" alt="Imagem de ' . htmlspecialchars($livro['Titulo']) . '">';
                    echo htmlspecialchars($livro['Titulo']) . " - " . htmlspecialchars($livro['Autor']);
                    echo "<br>R$ " . htmlspecialchars(number_format($livro['Preco'], 2, ',', '.'));
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo 'Nenhum livro encontrado para exibir.';
            }
            ?>
            <button class="slide slide-esquerda" onclick="slidee()" type="button"><i class="fas fa-arrow-left"></i></button>
            <button class="slide slide-direita" onclick="slided()" type="button"> <i class="fas fa-arrow-right"></i></button>
        </section>

        <h1>DESTAQUES DE 2023</h1>
        <section class="estante">
            <button class="ir-esquerda" type="button" onclick="esquerda(0)"><i class="fas fa-arrow-left"></i></button>
            <button class="ir-direita" type="button" onclick="direita(0)"> <i class="fas fa-arrow-right"></i></button>
        </section>

        <h1>DESTAQUES DE 2023</h1>


        <?php
            $livros = BuscaLivro(); // Chama a função BuscaLivro()

            // Verifica se encontrou livros
            if ($livros) {
                foreach ($livros as $livro) {
                    echo '<div class="book_card">';
                    echo '<a href="Livro.php?id_livro=' . urlencode($livro['id_livro']) . '">';
                    echo '<img src="/bookersgalaxy/' . htmlspecialchars($livro['path']) . '" alt="Imagem de ' . htmlspecialchars($livro['Titulo']) . '">';
                    echo htmlspecialchars($livro['Titulo']) . " - " . htmlspecialchars($livro['Autor']);
                    echo "<br>R$ " . htmlspecialchars(number_format($livro['Preco'], 2, ',', '.'));
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo 'Nenhum livro encontrado para exibir.';
            }
            ?>

            <button class="ir-esquerda" type="button" onclick="esquerda(1)"><i class="fas fa-arrow-left"></i></button>
            <button class="ir-direita" type="button" onclick="direita(1)"><i class="fas fa-arrow-right"></i></button>
        </section>
    </main>

    <?php
    include_once("modulos/footer.php");
    ?>
    <script>
        function slidee() {
            document.getElementsByClassName("carrossel")[0].scrollLeft -= 444;
        }

        function slided() {
            document.getElementsByClassName("carrossel")[0].scrollLeft += 444;
        }

        function direita(i) {
            document.getElementsByClassName('estante')[i].scrollLeft += 400;
        }

        function esquerda(i) {
            document.getElementsByClassName('estante')[i].scrollLeft -= 400;
        }
    </script>
</body>

</html>