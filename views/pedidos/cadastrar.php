<h1>Cadastrar Pedido</h1>
<form method="post">
    Cliente:
    <select name="cliente_id" required>
        <option value="">Selecione</option>
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    Total: <input type="number" step="0.01" name="total" required><br><br>

    <button type="submit">Cadastrar</button>
</form>
