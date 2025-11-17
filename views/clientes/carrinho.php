<?php
session_start();

require_once __DIR__ . '/../../controllers/CarrinhoController.php';
require_once __DIR__ . '/../../models/CarrinhoModel.php';
require_once __DIR__ . '/../../conexao.php';

$root = realpath(__DIR__ . '/../../..') . '/site-persona';


if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php?page=login");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new CarrinhoController($pdo);
$carrinhoIds = $controller->listarCarrinho($usuario_id);

$produtosCarrinho = [];
if (!empty($carrinhoIds)) {
    $placeholders = implode(',', array_fill(0, count($carrinhoIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id IN ($placeholders) AND ativo = 1");
    $stmt->execute($carrinhoIds);
    $produtosCarrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meu Carrinho - Lia: Bolos e Cia</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../style.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/../../menu.php'; ?>


<main class="content">
  <section class="container mb-5">
    <h1 class="text-center mb-4">Meu Carrinho</h1>

    <div class="row g-4" id="product-list">
      <?php if (!empty($produtosCarrinho)): ?>
        <?php foreach ($produtosCarrinho as $produto): 
          $categoriaLower = strtolower($produto['categoria']);
        ?>
          <div class="col-6 col-md-3 mb-4 produto-item"
               data-categoria="<?= htmlspecialchars($categoriaLower) ?>"
               data-ingredientes="<?= htmlspecialchars($produto['descricao']) ?>">
            <div class="card h-100 text-center position-relative">

              <button class="favorite-btn position-absolute top-0 end-0 m-2" data-produto-id="<?= $produto['id'] ?>">
                <i class="fa-solid fa-trash fs-4" style="color: red;"></i>
              </button>

              <div class="img-container">
                <img src="../../<?= htmlspecialchars($produto['imagem_url']) ?>" 
                     alt="<?= htmlspecialchars($produto['nome']) ?>" 
                     class="card-img-top">
              </div>

              <div class="card-body">
                <h5 class="card-title mt-2"><?= htmlspecialchars($produto['nome']) ?></h5>
                <p class="price text-muted mb-2">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

                <div class="d-flex justify-content-center mt-2">
                  <a href="pagamento.php?id=<?= $produto['id'] ?>" 
                     class="btn btn-success btn-comprar-agora">
                    Comprar Agora
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center empty-state">
          <p class="empty-state-message">Seu carrinho está vazio.</p>
          <a href="../../index.php#cardapio" class="btn-call-to-action">Ver Produtos</a>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../../footer.php'; ?>


<script>
document.addEventListener("DOMContentLoaded", function () {

  document.querySelectorAll(".favorite-btn").forEach(button => {
    const produtoId = Number(button.getAttribute("data-produto-id"));

    button.addEventListener("click", function () {
      if (confirm("Tem certeza que deseja remover este produto do carrinho?")) {
        fetch("../../controllers/carrinho_ajax.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `acao=remover&produto_id=${produtoId}`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            button.closest(".col-6, .col-md-3").remove();
          } else {
            alert(data.message || "Erro ao remover produto do carrinho!");
          }
        })
        .catch(err => {
          console.error(err);
          alert("Erro ao processar remoção.");
        });
      }
    });
  });

});
</script>

<script src="script.js"></script>
</body>
</html>
