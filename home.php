<?php
include 'conexao.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? 0;


$stmt = $pdo->query("SELECT * FROM produtos WHERE ativo = 1");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$favoritos = [];
if ($usuario_id) {
    $stmtFav = $pdo->prepare("SELECT produto_id FROM favoritos WHERE usuario_id = ?");
    $stmtFav->execute([$usuario_id]);
    $favoritos = $stmtFav->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lia: Bolos e Cia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="imagens/logo.png">
</head>
<body>

<?php include 'menu.php'; ?>


<div class="banner-container">
  <img src="imagens/bolo4.png" alt="Banner" class="img-fluid w-100">
  <div class="banner-texto">
    <h1>Bem-vindo à Lia: Bolos e Cia</h1>
    <p>Delícias feitas com carinho para todos os momentos especiais.</p>
    <a href="#cardapio" class="btn btn-primary">Faça seu pedido</a>
  </div>
</div>


<section id="cardapio" class="container categorias-section my-5">
  <h2 class="text-center mb-4 titulo-produtos">Minhas Delícias</h2>

  <div class="row g-4 categorias-flex-container text-center">
    <div class="categoria-item-flex col-6 col-md-3 mb-3">
      <div class="categoria-card p-2" id="filtro-bolos">
        <img src="imagens/4.PNG" class="img-fluid rounded mb-2" alt="Bolos">
        <h5>Bolos</h5>
      </div>
    </div>
    <div class="categoria-item-flex col-6 col-md-3 mb-3">
      <div class="categoria-card p-2" id="filtro-docinhos">
        <img src="imagens/docinho.PNG" class="img-fluid rounded mb-2" alt="Docinhos">
        <h5>Docinhos</h5>
      </div>
    </div>
    <div class="categoria-item-flex col-6 col-md-3 mb-3">
      <div class="categoria-card p-2" id="filtro-sobremesas">
        <img src="imagens/pudim2.PNG" class="img-fluid rounded mb-2" alt="Sobremesas">
        <h5>Sobremesas</h5>
      </div>
    </div>
    <div class="categoria-item-flex col-6 col-md-3 mb-3">
      <div class="categoria-card p-2" id="filtro-bolos-personalizados">
        <img src="imagens/pers.PNG" class="img-fluid rounded mb-2" alt="Bolo Personalizado">
        <h5>Bolo Personalizado</h5>
      </div>
    </div>
  </div>
</section>


<section class="container mb-2">
  <div class="filter-section text-center mb-4">
    <label for="filter" class="form-label">Ou escolha seu ingrediente favorito:</label>
    <select class="form-select w-auto d-inline-block" id="filter">
      <option value="todos">Todos os ingredientes</option>
      <option value="morango">Morango</option>
      <option value="chocolate">Chocolate</option>
      <option value="abacaxi">Abacaxi</option>
      <option value="creme belga">Creme Belga</option>
      <option value="ninho">Ninho</option>
      <option value="brigadeiro">Brigadeiro</option>
      <option value="beijinho">Beijinho</option>
      <option value="amendoim">Amendoim</option>
      <option value="nata">Nata</option>
      <option value="quatro leites">Quatro Leites</option>
      <option value="maracuja">Maracujá</option>
      <option value="pessego">Pêssego</option>
      <option value="doce de leite">Doce de Leite</option>
      <option value="coco">Coco</option>
      <option value="tres leites">Três Leites</option>
      <option value="suspiro">Suspiro</option>
      <option value="nutella">Nutella</option>
      <option value="chocolate branco">Chocolate Branco</option>
      <option value="amendoa">Amêndoa</option>
      <option value="cereja">Cereja</option>
      <option value="ameixa">Ameixa</option>
      <option value="limao">Limão</option>
      <option value="cenoura">Cenoura</option>
      <option value="laranja">Laranja</option>
      <option value="caramelo">Caramelo</option>
      <option value="leite condensado">Leite Condensado</option>
      <option value="canela">Canela</option>
    </select>
  </div>

  <div class="row g-4" id="product-list">
    <?php foreach($produtos as $p): ?>
      <div class="col-6 col-md-3 mb-4">
        <div class="card h-100 text-center position-relative">
          <button class="favorite-btn position-absolute top-0 end-0 m-2" data-produto-id="<?= $p['id'] ?>">
            <i class="<?= in_array($p['id'], $favoritos) ? 'fa-solid' : 'fa-regular' ?> fa-heart fs-3" style="color:pink"></i>
          </button>
          <div class="img-container">
            <img src="<?= $p['img'] ?>" alt="<?= $p['nome'] ?>" class="card-img-top">
          </div>
          <div class="card-body">
            <h5 class="card-title mt-2"><?= $p['nome'] ?></h5>
            <div class="d-flex justify-content-center mt-2">
             <button class="btn btn-eu-quero" 
               data-nome="<?= $p['nome'] ?>" data-categoria="<?= $p['categoria'] ?>">Eu Quero</button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'footer.php'; ?>

<script>
  window.favoritos = <?= json_encode($favoritos) ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
