
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
      ["id" => "filtro-bolos-personalizados", "img" => "pers.PNG", "nome" => "Bolos Personalizados"]
    ];

    foreach ($categorias as $cat) {
      echo '
       <div class="categoria-item-flex"> 
        <div class="categoria-card text-center" id="'.$cat["id"].'">
          <img src="imagens/'.$cat["img"].'" class="img-fluid rounded" alt="'.$cat["nome"].'" />
          <h5 class="mt-2">'.$cat["nome"].'</h5>
        </div>
      </div>';
    }
    ?>

  </div>
</section>

<section class="container">
  <div class="filter-section text-center">
    <label for="filter" class="form-label">Ou escolha seu ingrediente favorito:</label>
    <select class="form-select w-auto d-inline-block" id="filter">
      <option value="todos">Todos os ingredientes</option>
      <option value="morango">Morango</option>
      <option value="chocolate">Chocolate</option>
      <option value="abacaxi">Abacaxi</option>
    </select>
  </div>
</section>

<section class="container mt-0 mb-5">
  <div class="row g-4" id="product-list">
  </div>
</section>

<?php include 'footer.php'; ?>

<div id="lista-bolos"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
