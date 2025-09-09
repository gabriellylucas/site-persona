<?php
session_start();

require_once __DIR__ . '/../../controllers/FavoritosController.php';
require_once __DIR__ . '/../../models/FavoritosModel.php';
require_once __DIR__ . '/../../conexao.php';


if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php?page=login");
    exit;
}


$controller = new FavoritosController($pdo);
$favoritos = $controller->listarFavoritos($_SESSION['usuario_id']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Meus Favoritos - Lia: Bolos e Cia</title>
  <link href="../../css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
   <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="imagens/logo.png" />
</head>
<body>

  <?php include '../../menu.php'; ?>
  
  <section class="favoritos-container mt-4">
    <div class="container">
      <h1 class="mb-4">Meus Favoritos</h1>

      <?php if (!empty($favoritos)): ?>
          <div class="row">
              <?php foreach ($favoritos as $produto): ?>
                  <div class="col-md-4 mb-3">
                      <div class="card h-100 text-center">
                          <img src="<?= $produto['img'] ?>" class="card-img-top" alt="<?= $produto['nome'] ?>">
                          <div class="card-body">
                              <h5 class="card-title"><?= $produto['nome'] ?></h5>
                              <p class="card-text">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                              <a href="../../favoritosController.php?acao=remover&produto_id=<?= $produto['id'] ?>" class="btn btn-danger">
                                  Remover
                              </a>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>
      <?php else: ?>
          <p>Você ainda não adicionou nenhum produto aos favoritos.</p>
          <a href="../../produtos.php" class="btn btn-primary mt-2">Ver Produtos</a>
      <?php endif; ?>
    </div>
  </section>


  <?php include '../../footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
