<?php 
include __DIR__ . '/../admin/navbar_admin.php'; 
?>

<div class="container py-4">
    <h2 class="mb-4 text-center">Editar Produto</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
                <form method="post" enctype="multipart/form-data">
                  
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                    </div>

                  
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="preco" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>" placeholder="Ex: 50kg ou 5un" required>
                        <small class="text-muted">Digite o valor seguido da unidade, ex: 50kg ou 5un</small>
                    </div>

                   
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Atualizar Imagem</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*">
                        <?php if(!empty($produto['imagem'])): ?>
                            <small class="text-muted">Imagem atual: <img src="<?= $produto['imagem'] ?>" alt="Imagem do produto" width="50"></small>
                        <?php endif; ?>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Atualizar Produto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>
