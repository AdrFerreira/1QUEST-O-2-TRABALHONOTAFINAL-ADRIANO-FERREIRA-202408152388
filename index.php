<?php
// index.php
require 'database.php';

// Pega os livros cadastrados
$stmt = $db->query("SELECT * FROM livros ORDER BY id DESC");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Livraria</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input, button {
            padding: 8px;
            margin: 4px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Adicionar Livro</h2>
<form action="add_book.php" method="post">
    <input type="text" name="titulo" placeholder="Título" required>
    <input type="text" name="autor" placeholder="Autor" required>
    <input type="number" name="ano" placeholder="Ano" required>
    <button type="submit">Adicionar</button>
</form>

<h2>Lista de Livros</h2>
<?php if (count($livros) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano</th>
            <th>Ação</th>
        </tr>
        <?php foreach ($livros as $livro): ?>
            <tr>
                <td><?= htmlspecialchars($livro['id']) ?></td>
                <td><?= htmlspecialchars($livro['titulo']) ?></td>
                <td><?= htmlspecialchars($livro['autor']) ?></td>
                <td><?= htmlspecialchars($livro['ano']) ?></td>
                <td>
                    <form action="delete_book.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                        <button type="submit" onclick="return confirm('Tem certeza?')">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nenhum livro cadastrado.</p>
<?php endif; ?>

</body>
</html