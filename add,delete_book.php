<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao'])) {
        
        if ($_POST['acao'] === 'adicionar') {
            if (!empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['ano'])) {
                $titulo = $_POST['titulo'];
                $autor = $_POST['autor'];
                $ano = (int) $_POST['ano'];

                $stmt = $db->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (?, ?, ?)");
                $stmt->execute([$titulo, $autor, $ano]);
            }
        }
        if ($_POST['acao'] === 'excluir' && isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $stmt = $db->prepare("DELETE FROM livros WHERE id = ?");
            $stmt->execute([$id]);
        }
    }
    header("Location: index.php");
    exit;
}
?>