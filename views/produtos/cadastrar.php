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

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <form method="post" action="processar_cadastro_produto.php">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
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