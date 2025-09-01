<h1>Produtos</h1>
<a href="index.php?page=produtos_cadastrar">Novo Produto</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($produtos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['nome']) ?></td>
            <td><?= htmlspecialchars($p['descricao']) ?></td>
            <td><?= number_format($p['preco'], 2, ',', '.') ?></td>
            <td>
                <a href="index.php?page=produtos_editar&id=<?= $p['id'] ?>">Editar</a> |
                <a href="index.php?page=produtos_excluir&id=<?= $p['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
