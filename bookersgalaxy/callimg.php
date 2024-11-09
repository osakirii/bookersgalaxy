<?php
function Busca($id) {

    include_once("connect.php");
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT path FROM arquivossite WHERE id = :id"); // Confirme se 'path' é o nome correto do campo
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($mostrar = $stmt->fetch(PDO::FETCH_ASSOC)) {
        return $mostrar['path'];
    } else {
        return '../img/icons/blocked_icon.png'; // Caminho para imagem padrão
    }
}
?>
