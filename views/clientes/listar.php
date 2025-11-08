<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-clientes">

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<div class="main-container">
    <h2 class="section-title">Gestão de Clientes</h2>

    <div class="header-controls">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="search-input" class="search-input" placeholder="Procurar clientes...">
        </div>
        <a href="index.php?page=clientes_cadastrar" class="add-new-client">
            Adicionar Novo Cliente <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="clients-grid">
        <?php if (!empty($clientes)): ?>
            <?php foreach ($clientes as $c): ?>
                <div class="client-card">
                    <!-- AÇÕES: editar / excluir -->
                    <div class="card-actions">
                        <a href="index.php?page=clientes_editar&id=<?= urlencode($c['id']) ?>" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="index.php?page=clientes_excluir&id=<?= urlencode($c['id']) ?>"
                           title="Excluir"
                           onclick="return confirm('Tem certeza que deseja excluir este cliente?');">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>

                    <div class="card-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <div class="card-content">
                        <p class="client-name"><?= htmlspecialchars($c['nome']) ?></p>
                        <p class="client-info"><?= htmlspecialchars($c['email']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-clients">Nenhum cliente cadastrado.</div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const clientsGrid = document.querySelector('.clients-grid');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = searchInput.value;

        fetch(`index.php?page=clientes_listar&search=${encodeURIComponent(searchTerm)}&ajax=1`)
            .then(response => response.text())
            .then(data => clientsGrid.innerHTML = data)
            .catch(error => console.error('Erro ao buscar clientes:', error));
    });
});
</script>

</body>
</html>
