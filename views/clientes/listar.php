<h1>Clientes</h1>
<a href="index.php?page=clientes_cadastrar">Novo Cliente</a>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ações</th>
  </tr>
  <?php foreach ($clientes as $c): ?>
    <tr>
      <td><?= $c['id'] ?></td>
      <td><?= htmlspecialchars($c['nome']) ?></td>
      <td><?= htmlspecialchars($c['email']) ?></td>
      <td>
        <a href="index.php?page=clientes_editar&id=<?= $c['id'] ?>">Editar</a>
        <a href="index.php?page=clientes_excluir&id=<?= $c['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
