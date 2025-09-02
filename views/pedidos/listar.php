<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<h1>Pedidos</h1>
<a href="index.php?page=pedidos_cadastrar">Novo Pedido</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pedidos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['cliente_nome'] ?? 'N/A') ?></td>
            <td><?= number_format($p['total'], 2, ',', '.') ?></td>
            <td>
                <a href="index.php?page=pedidos_excluir&id=<?= $p['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>