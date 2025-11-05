<?php
session_start();

require_once __DIR__ . '/../../controllers/FavoritosController.php';
require_once __DIR__ . '/../../models/FavoritosModel.php';
require_once __DIR__ . '/../../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php?page=login");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new FavoritosController($pdo);
$favoritosIds = $controller->listarFavoritos($usuario_id);

$produtosFavoritos = [];
if (!empty($favoritosIds)) {
    $placeholders = implode(',', array_fill(0, count($favoritosIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id IN ($placeholders) AND ativo = 1");
    $stmt->execute($favoritosIds);
    $produtosFavoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Meus Favoritos - Lia: Bolos e Cia</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../../style.css">
</head>
<body class="page-produtos">

<?php include '../../menu.php'; ?>

<main class="content">
  <section class="container mb-5">
    <h1 class="text-center mb-4">Meus Favoritos</h1>

    <div class="row g-4" id="product-list">
      <?php if (!empty($produtosFavoritos)): ?>
        <?php foreach ($produtosFavoritos as $produto): 
          $categoriaLower = strtolower($produto['categoria']);
          $prefixo = "produto"; 
          if ($categoriaLower === "bolos" || $categoriaLower === "bolos-personalizados") $prefixo = "bolo";
          elseif ($categoriaLower === "docinhos") $prefixo = "docinho";
          elseif ($categoriaLower === "sobremesas") $prefixo = "sobremesa";
          $mensagem = "Olá! Gostaria de encomendar o {$prefixo} de {$produto['nome']}, por favor.";
        ?>
          <div class="col-6 col-md-3 mb-4 produto-item"
               data-categoria="<?= htmlspecialchars($categoriaLower) ?>"
               data-ingredientes="<?= htmlspecialchars($produto['descricao']) ?>">
            <div class="card h-100 text-center position-relative">

            
<button class="favorite-btn position-absolute top-0 end-0 m-2" data-produto-id="<?= $produto['id'] ?>">
    <i class="fa-solid fa-cart-shopping fs-3" style="color: pink;"></i>
</button>


             
               <div class="img-container">
               <img src="../../<?= htmlspecialchars($produto['imagem_url']) ?>" 
     alt="<?= htmlspecialchars($produto['nome']) ?>" 
     class="card-img-top">
                </div>

              <div class="card-body">
                <h5 class="card-title mt-2"><?= htmlspecialchars($produto['nome']) ?></h5>

                <div class="d-flex justify-content-center mt-2">
                  <a href="https://wa.me/5544988563181?text=<?= urlencode($mensagem) ?>"
                     target="_blank"
                     class="btn btn-success btn-eu-quero"
                     data-produto="<?= htmlspecialchars($produto['nome']) ?>"
                     data-categoria="<?= htmlspecialchars($categoriaLower) ?>">
                    Eu Quero
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
            <div class="col-12 text-center empty-state">
            <p class="empty-state-message">Você ainda não adicionou nenhum produto aos favoritos.</p>
            <a href="../../index.php#cardapio" class="btn-call-to-action">Ver Produtos</a>
            </div>
          <?php endif; ?>
    </div>
  </section>
</main>

<?php include '../../footer.php'; ?>

<script>
  window.favoritos = <?= json_encode($favoritosIds) ?>;

  document.addEventListener("DOMContentLoaded", function () {
   
    document.querySelectorAll(".favorite-btn").forEach(button => {
      const heartIcon = button.querySelector("i");
      const produtoId = Number(button.getAttribute("data-produto-id"));

      button.addEventListener("click", function () {
        const isFavorito = heartIcon.classList.contains("fa-solid");
        const acao = isFavorito ? "remover" : "adicionar";

        heartIcon.classList.toggle("fa-solid", acao === "adicionar");
        heartIcon.classList.toggle("fa-regular", acao === "remover");

        fetch("../../controllers/favoritos_ajax.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: `acao=${acao}&produto_id=${produtoId}`
        })
        .then(res => res.json())
        .then(data => {
          if (!data.success) {
            alert(data.message || "Erro ao atualizar favorito!");
            heartIcon.classList.toggle("fa-solid", acao === "remover");
            heartIcon.classList.toggle("fa-regular", acao === "adicionar");
          } else if (acao === "remover") {
            button.closest(".col-6, .col-md-3").remove();
          }
        })
        .catch(err => {
          console.error(err);
          heartIcon.classList.toggle("fa-solid", acao === "remover");
          heartIcon.classList.toggle("fa-regular", acao === "adicionar");
        });
      });
    });

   
    document.querySelectorAll(".btn-eu-quero").forEach(btn => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        window.open(this.href, "_blank");
      });
    });
  });
</script>

<script src="script.js"></script>
</body>
</html>
