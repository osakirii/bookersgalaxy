<?php
session_start();
header('Content-Type: application/json');

class CarrinhoFunc
{
    public function adicionarCarrinho($idLivro)
    {
        if (!isset($idLivro) || !is_numeric($idLivro)) {
            echo json_encode(['success' => false, 'error' => 'ID do livro inválido.']);
            return;
        }

        // Inicializar a sessão do carrinho como array associativo se não existir
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }

        // Incrementa a quantidade do livro no carrinho
        if (isset($_SESSION['carrinho'][$idLivro])) {
            $_SESSION['carrinho'][$idLivro]++;
        } else {
            $_SESSION['carrinho'][$idLivro] = 1;
        }

        echo json_encode(['success' => true, 'carrinho' => $_SESSION['carrinho']]);

    }
    public function toggleFavorite($idLivro, $idUsuario)
    {
        $idUsuario = $_SESSION['user_id'];
        $idLivro = $_POST['id_livro'];

        $sql = "SELECT * FROM favoritos WHERE id_usuario = ? AND id_livro = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$idUsuario, $idLivro]);

        if ($stmt->rowCount() > 0) {
            // O livro já está favoritado, vamos removê-lo
            $sql = "DELETE FROM favoritos WHERE id_usuario = :idUsuario AND id_livro = :idLivro";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':idLivro', $idLivro, PDO::PARAM_INT);
            $stmt->execute();
            return "removido";
        } else {
            // O livro não está favoritado, vamos adicioná-lo
            $dataAdicao = date('Y-m-d H:i:s');
            $sql = "INSERT INTO favoritos (id_usuario, id_livro, data_adicao, estado) VALUES (:idUsuario, :idLivro, :dataAdicao, 1)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_INT);
            $stmt->bindParam(':idLivro', $idLivro, PDO::PARAM_INT);
            $stmt->bindParam(':dataAdicao', $dataAdicao);
            $stmt->execute();
            return "favoritado";
        }
    }
    public function removerDoCarrinho($idLivro)
    {
        if (isset($_SESSION['carrinho'][$idLivro])) {
            // Reduz a quantidade ou remove se for 1
            if ($_SESSION['carrinho'][$idLivro] > 1) {
                $_SESSION['carrinho'][$idLivro]--;
            } else {
                unset($_SESSION['carrinho'][$idLivro]);
            }
            echo json_encode(['success' => true, 'carrinho' => $_SESSION['carrinho']]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Livro não encontrado no carrinho.']);
        }
    }

    public function listarCarrinho()
    {
        if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
            echo json_encode(['success' => true, 'carrinho' => []]);
        } else {
            echo json_encode(['success' => true, 'carrinho' => $_SESSION['carrinho']]);
        }
    }
}

// Verifica se a requisição é POST e processa a ação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $func = new CarrinhoFunc();

    if (isset($data['acao'])) {
        switch ($data['acao']) {
            case 'adicionarCarrinho':
                $func->adicionarCarrinho($data['id_livro']);
                break;
            case 'removerDoCarrinho':
                $func->removerDoCarrinho($data['id_livro']);
                break;
            case 'listarCarrinho':
                $func->listarCarrinho();
                break;
                case 'favoritar':
                    if (isset($data['user_id']) && isset($data['id_livro'])) {
                        $idUsuario = $data['cliente_id'];
                        $idLivro = $data['id_livro'];
                        $resultado = $func->toggleFavorite($idLivro, $idUsuario);
                        echo $resultado;
                    } else {
                        echo json_encode(['success' => false, 'error' => 'ID do usuário ou do livro não fornecido.']);
                    }
                    break;
            default:
                echo json_encode(['success' => false, 'error' => 'Ação inválida.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Ação não especificada.']);
    }

    exit;
}
?>