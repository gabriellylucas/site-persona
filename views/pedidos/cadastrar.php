<?php
include __DIR__ . '/../../conexao.php';
require_once __DIR__ . '/../../models/Cliente.php';
require_once __DIR__ . '/../../models/Produto.php';
require_once __DIR__ . '/../../models/Pedido.php';

$clienteModel = new Cliente($pdo);
$produtoModel = new Produto($pdo);
$pedidoModel = new Pedidos($pdo);

$clientes = $clienteModel->getAll();
$produtos = $produtoModel->getAllAtivos();
$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteId = (int)($_POST['cliente_id'] ?? 0);
    $produtoId = (int)($_POST['produto_id'] ?? 0);

    if ($clienteId && $produtoId) {
        $produtoNome = $produtoModel->getNomeById($produtoId);

    
        $pedidoModel->create($clienteId, $produtoNome);

        header("Location: index.php?page=pedidos_listar");
        exit;
    } else {
        $erro = "Selecione um cliente e um produto válidos.";
    }
}
?>

<link rel="stylesheet" href="admin.css">

<div class="container py-4">
    <h2 class="text-center mb-4">Cadastrar Pedido</h2>

    <?php if($erro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="post" class="card p-4 mx-auto" style="max-width: 500px;">
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente:</label>
            <select name="cliente_id" id="cliente_id" class="form-select" required>
                <option value="">Selecione o cliente</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto:</label>
            <select name="produto_id" id="produto_id" class="form-select" required>
                <option value="">Selecione o produto</option>
                <?php foreach ($produtos as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Cadastrar Pedido</button>
    </form>
</div>
