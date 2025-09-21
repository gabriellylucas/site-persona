<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto ao Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<?php
// Pega o pedido_id da URL (ex: cadastrar.php?pedido_id=5)
$pedidoId = $_GET['pedido_id'] ?? null;

if (!$pedidoId) {
    echo "<div class='alert alert-danger text-center'>Nenhum pedido selecionado.</div>";
    include __DIR__ . '/../admin/footer_admin.php';
    exit;
}

// buscar produtos do banco
require __DIR__ . '/../../conexao.php'; // ajuste o caminho se necessário
$stmt = $pdo->query("SELECT id, nome, preco FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-4 flex-grow-1">
    <h1 class="mb-4 text-center">Adicionar Produto ao Pedido <?= htmlspecialchars($pedidoId) ?></h1>

    <form method="post" action="processar_adicao_item.php" class="card p-4 mx-auto" style="max-width: 500px;">
        <input type="hidden" name="pedido_id" value="<?= htmlspecialchars($pedidoId) ?>">

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto:</label>
            <select class="form-select" id="produto_id" name="produto_id" required>
                <option value="">Selecione</option>
                <?php foreach ($produtos as $p): ?>
                    <option value="<?= htmlspecialchars($p['id']) ?>">
                        <?= htmlspecialchars($p['nome']) ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade:</label>
            <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço unitário:</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Adicionar</button>
    </form>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
