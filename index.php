  <?php
  require 'database.php';

  $stmt = $db->query("SELECT * FROM livros ORDER BY id ASC");
  $livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <!DOCTYPE html>
  <html lang="pt-br">
  <head>
    <link rel="stylesheet" href="CSS.css">
  </head>
  <body>

  <h2>Nome do Livro</h2>
  <form action="add,delete_book.php" method="post">
      <input type="hidden" name="acao" value="adicionar">
      <input type="text" name="titulo" placeholder="Título" required>
      <input type="text" name="autor" placeholder="Autor" required>
      <input type="number" name="ano" placeholder="Ano" required>
      <button type="submit">Adicionar</button>
  </form>

  <h2>Escolha o Livro</h2>
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
                      <form action="add,delete_book.php" method="post" style="display:inline;">
                          <input type="hidden" name="acao" value="excluir">
                          <input type="hidden" name="id" value="<?= $livro['id'] ?>">
                          <button type="submit" onclick="return confirm('Confirme a Operação?')">Excluir</button>
                      </form>
                  </td>
              </tr>
          <?php endforeach; ?>
      </table>
  <?php else: ?>
      <p>Livro não cadastrado.</p>
  <?php endif; ?>

  </body>
  </html>