<h1>Itens do Pedido <?= $pedidoId ?></h1>
<a href="index.php?page=pedido_itens_adicionar&pedido_id=<?= $pedidoId ?>">Adicionar Produto</a>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>Subtotal</th>
        <th>Ações</th>
    </tr>
    <?php 
    $total = 0;
    foreach ($itens as $item): 
        $subtotal = $item['quantidade'] * $item['preco'];
        $total += $subtotal;
    ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= htmlspecialchars($item['produto_nome']) ?></td>
            <td><?= $item['quantidade'] ?></td>
            <td><?= number_format($item['preco'], 2, ',', '.') ?></td>
            <td><?= number_format($subtotal, 2, ',', '.') ?></td>
            <td>
                <a href="index.php?page=pedido_itens_remover&pedido_id=<?= $pedidoId ?>&item_id=<?= $item['id'] ?>" onclick="return confirm('Remover item?')">Remover</a>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4"><strong>Total</strong></td>
        <td colspan="2"><strong><?= number_format($total, 2, ',', '.') ?></strong></td>
    </tr>
</table>
