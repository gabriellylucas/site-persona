<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto ao Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<?php

$pedidoId = $_GET['pedido_id'] ?? null;

if (!$pedidoId) {
    echo "<div class='alert alert-danger text-center'>Nenhum pedido selecionado.</div>";
    include __DIR__ . '/../admin/footer_admin.php';
    exit;
}


require __DIR__ . '/../../conexao.php'; 
$stmt = $pdo->query("SELECT id, nome, preco FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="main-container container py-4 flex-grow-1">
    <h2 class="section-title mb-4 text-center">Adicionar Produto ao Pedido <?= htmlspecialchars($pedidoId) ?></h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <form method="post" action="processar_adicao_item.php">
                    <input type="hidden" name="pedido_id" value="<?= htmlspecialchars($pedidoId) ?>">

                    <div class="mb-3">
                        <label for="produto_id" class="form-label">Produto</label>
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
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço unitário</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-plus me-2"></i>Adicionar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
