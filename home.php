<?php
include 'conexao.php';

$stmt = $pdo->query("SELECT * FROM produtos WHERE ativo = 1");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lia: Bolos e Cia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="imagens/logo.png" />
</head>
<body>

<?php include 'menu.php'; ?>

<div class="banner-container">
  <img src="imagens/bolo4.png" alt="logo" class="img-fluid w-100" />
  <div class="banner-texto">
    <h1>Bem-vindo à Lia: Bolos e Cia</h1>
    <p>Delícias feitas com carinho para todos os momentos especiais.  
      Encomende bolos personalizados, sobremesas irresistíveis e muito mais!
    </p>
    <a href="#cardapio" class="btn btn-primary">Faça seu pedido</a>
  </div>
</div>

<section id="cardapio" class="container categorias-section">
  <h2 class="text-center mb-4 titulo-produtos">Minhas Delícias</h2>
  <div class="row g-4 categorias-flex-container">
    <?php
    $categorias = [
      ["id" => "filtro-bolos", "img" => "4.PNG", "nome" => "Bolos"],
      ["id" => "filtro-docinhos", "img" => "docinho.PNG", "nome" => "Docinhos"],
      ["id" => "filtro-sobremesas", "img" => "pudim2.PNG", "nome" => "Sobremesas"],
      ["id" => "filtro-bolos-personalizados", "img" => "pers.PNG", "nome" => "Bolo Personalizado"]
    ];

    foreach ($categorias as $cat) {
      echo '
      <div class="categoria-item-flex col-6 col-md-3 text-center mb-3"> 
        <div class="categoria-card p-2" id="'.$cat["id"].'">
          <img src="imagens/'.$cat["img"].'" class="img-fluid rounded mb-2" alt="'.$cat["nome"].'" />
          <h5>'.$cat["nome"].'</h5>
        </div>
      </div>';
    }
    ?>
  </div>
</section>

<section class="container mb-5">
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
      <div class="col-md-4">
        <div class="card h-100">
          <img src="<?php echo !empty($p['imagem_url']) ? $p['imagem_url'] : 'imagens/default.png'; ?>" class="card-img-top" alt="<?php echo $p['nome']; ?>">

          <div class="card-body">
            <h5 class="card-title"><?php echo $p['nome']; ?></h5>
            <p class="card-text"><?php echo $p['descricao']; ?></p>
            <p class="card-text"><strong>R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></strong></p>

            <div class="d-flex justify-content-between align-items-center mt-2">
              <button class="btn btn-primary btn-eu-quero">Eu Quero</button>
              <button class="favorite-btn" data-name="<?php echo $p['nome']; ?>">
                <i class="fa-regular fa-heart"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
