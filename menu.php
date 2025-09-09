<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="imagens/logo.png" alt="Logo" height="110" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item"><a class="nav-link" href="index.php#inicio">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#cardapio">Cardápio</a></li>
        <li class="nav-item"><a class="nav-link" href="sobre.php">Sobre</a></li>

        <?php if (isset($_SESSION['usuario_id'])): ?>
          <li class="nav-item">
         <a class="nav-link pedido-btn" href="views/clientes/favoritos.php" title="Meus Favoritos">❤️ Favoritos</a>
          </li>
         <li class="nav-item">
  <a class="nav-link btn btn-danger text-white ms-2" href="logout.php" title="Sair">
    <i class="fa-solid fa-right-from-bracket"></i>
  </a>
</li>
        <?php else: ?>
          <li class="nav-item">
            <a class="nav-link pedido-btn" href="index.php?page=login">Login</a>
          </li>
        <?php endif; ?>
      </ul>

      <div class="nav-underline"></div> 
    </div>
  </div>
</nav>