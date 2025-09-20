<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<link rel="stylesheet" href="admin.css">

<div class="pedido-itens-container">
    <div class="pedido-card">
        <!-- Cabeçalho -->
        <div class="pedido-header">
            <div>
                <span><strong>Pedido ID:</strong> <?= $pedidoId ?></span>
                <span style="margin-left:20px;"><strong>Cliente:</strong> <?= htmlspecialchars($clienteNome ?? 'Não informado') ?></span>
            </div>
            <h2>Itens do Pedido</h2>
            <a href="index.php?page=pedido_itens_adicionar&pedido_id=<?= $pedidoId ?>" class="btn-add">+ Adicionar Produto</a>
        </div>

        <!-- Tabela de Itens -->
        <table class="pedido-table">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                foreach ($itens as $item): 
                    $subtotal = $item['quantidade'] * $item['preco'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <?php if (!empty($item['imagem'])): ?>
                                <img src="uploads/<?= htmlspecialchars($item['imagem']) ?>" alt="Imagem Produto" class="produto-thumb">
                            <?php else: ?>
                                <span>—</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($item['produto_nome']) ?></td>
                        <td><?= $item['quantidade'] ?></td>
                        <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                        <td>
                            <a href="index.php?page=pedido_itens_remover&pedido_id=<?= $pedidoId ?>&item_id=<?= $item['id'] ?>" class="btn-remove" onclick="return confirm('Remover item?')">Remover</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Resumo -->
        <div class="pedido-resumo">
            <p><strong>Subtotal:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p>
            <p><strong>Frete:</strong> R$ <?= number_format($frete ?? 0, 2, ',', '.') ?></p>
            <p class="total"><strong>Total:</strong> R$ <?= number_format($total + ($frete ?? 0), 2, ',', '.') ?></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>                                                                                             