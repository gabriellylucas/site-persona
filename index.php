
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


<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <img src="imagens/logo.png" alt="Logo" height="110" />
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link active" href="#inicio">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="#cardapio">Cardápio</a></li>
        <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="contato.php">Contato</a></li>
        <li class="nav-item"><a class="nav-link perma-hover hovered" href="#cardapio">Faça seu pedido</a></li>
      </ul>
    </div>
  </div>
</nav>

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
  <div class="row g-4">

    <?php
    $categorias = [
      ["id" => "filtro-bolos", "img" => "chocolate com morango.PNG", "nome" => "Bolos"],
      ["id" => "filtro-docinhos", "img" => "docinho.PNG", "nome" => "Docinhos"],
      ["id" => "filtro-sobremesas", "img" => "pudim.PNG", "nome" => "Sobremesas"],
      ["id" => "filtro-bolos-personalizados", "img" => "bolo personalizado.PNG", "nome" => "Bolos Personalizados"]
    ];

    foreach ($categorias as $cat) {
      echo '
      <div class="col-6 col-md-3">
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

<footer class="footer">
  <div class="footer-container">
    <div class="footer-logo">
      <h2>Lia: Bolos e Cia</h2>
      <p>Delícias feitas com carinho ♥</p>
    </div>

    <div class="footer-contact">
      <h4>Contato</h4>
      <p><i class="fab fa-whatsapp"></i> (44)98856-3181 </p>
      <div class="footer-social">
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://wa.me/5599999999999" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Lia: Bolos e Cia. Todos os direitos reservados.</p>
  </div>
</footer>

<div id="lista-bolos"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>

</body>
</html>
