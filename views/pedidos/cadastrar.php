<?php
include __DIR__ . '/../../conexao.php';
require_once __DIR__ . '/../../models/Cliente.php';
require_once __DIR__ . '/../../models/Produto.php';
require_once __DIR__ . '/../../models/Pedido.php';

$clienteModel = new Cliente($pdo);
$produtoModel = new Produto($pdo);
$pedidoModel = new Pedidos($pdo);

// Pega todos os clientes e produtos
$clientes = $clienteModel->getAll();
$produtos = $produtoModel->getAll(); // Pega todos do banco

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clienteId = (int)($_POST['cliente_id'] ?? 0);
    $produtoId = (int)($_POST['produto_id'] ?? 0);

    if ($clienteId && $produtoId) {
        $produtoNome = $produtoModel->getById($produtoId)['nome'] ?? '';
        $pedidoModel->create($clienteId, $produtoNome);

        header("Location: index.php?page=pedidos_listar");
        exit;
    } else {
        $erro = "Selecione um cliente e um produto válidos.";
    }
}
?>

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<div class="page-pedidos">
    <div class="card-form">
        <div class="card-header">
            <h2>Cadastrar Pedido</h2>
        </div>

        <?php if($erro): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="post" class="form">
            <div class="form-group">
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" required>
                    <option value="">Selecione o cliente</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="produto_id">Produto:</label>
                <select name="produto_id" id="produto_id" required>
                    <option value="">Selecione o produto</option>
                    <?php foreach ($produtos as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Cadastrar Pedido</button>
                <a href="index.php?page=pedidos_listar" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
<link rel="stylesheet" href="admin.css">

<style>
.page-pedidos {
    display: flex;
    justify-content: center;
    padding-top: 35px; 
    padding-bottom: 30px; 
}

.card-form {
    width: 90%;
    max-width: 400px;
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    padding: 20px 30px;
    display: flex;
    flex-direction: column;
}


.card-header h2 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    color: #333;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: #555;
    font-size: 1rem;
}

.form-group select,
.form-group input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group select:focus,
.form-group input:focus {
    border-color: #5C4033;
    outline: none;
}

.form-actions {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 20px;
}

.form-actions .btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-primary {
    background-color: #e89aaf;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #e89aaf;
}

.btn-secondary {
    background-color: #e0e0e0;
    color: #555;
    border: none;
}

.btn-secondary:hover {
    background-color: #d4d4d4;
}

@media (max-width: 768px) {
    .card-form {
        width: 95%;
        padding: 15px 20px;
    }
}
</style>
