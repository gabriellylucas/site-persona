<h1>Adicionar Produto ao Pedido <?= $pedidoId ?></h1>
<form method="post">
    Produto:
    <select name="produto_id" required>
        <option value="">Selecione</option>
        <?php foreach ($produtos as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?> - R$ <?= number_format($p['preco'],2,',','.') ?></option>
        <?php endforeach; ?>
    </select><br><br>

    Quantidade: <input type="number" name="quantidade" min="1" value="1" required><br><br>
    Preço unitário: <input type="number" step="0.01" name="preco" required><br><br>

    <button type="submit">Adicionar</button>
</form>
