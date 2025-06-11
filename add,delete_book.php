<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'] ?? '';

    if ($acao === 'adicionar') {
        $titulo = $_POST['titulo'] ?? '';
        $autor = $_POST['autor'] ?? '';
        $ano = (int) ($_POST['ano'] ?? 0);

        if ($titulo && $autor && $ano) {
            $stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (?, ?, ?)");
            $stmt->execute([$titulo, $autor, $ano]);
        }

    } elseif ($acao === 'excluir' && isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $db->prepare("DELETE FROM livros WHERE id = ?");
        $stmt->execute([$id]);
    }

    header('Location: index.php');
    exit;
}
?>