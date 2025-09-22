<?php
session_start();

// Recupera nome e preço da sessão, se existirem
$nome = $_SESSION['nome_produto'] ?? '';
$preco = $_SESSION['preco_produto'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastrar Produto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<div class="main-container container py-4">
    <h2 class="section-title mb-4 text-center">Cadastrar Novo Produto</h2>

    <?php if(isset($_GET['sucesso'])): ?>
        <div class="alert alert-success text-center">Produto cadastrado com sucesso!</div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <!-- Form principal -->
                <form method="post" action="processar_cadastro_produto.php">
                    <div class="mb-3">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($nome) ?>" placeholder="Ex: Bolo de Morango" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="text" name="preco" class="form-control" value="<?= htmlspecialchars($preco) ?>" placeholder="Ex: 50 kg ou 10 un" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem</label><br>
                        <!-- Botão para ir para upload de imagem -->
                        <button type="button" class="btn btn-secondary" onclick="window.location='upload_imagem.php';">
                            <i class="fas fa-image me-2"></i>Adicionar Imagem
                        </button>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-plus me-2"></i>Cadastrar Produto
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
