<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Página Não Encontrada - 404 - Lia: Bolos e Cia</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins&display=swap" rel="stylesheet" />

  <style>
    .pagina-404 {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 80px 20px;
      text-align: center;
      background: linear-gradient(to right, #ffe9e9, #fddcd8);
      border-radius: 20px;
      max-width: 800px;
      margin: 60px auto;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      font-family: 'Poppins', sans-serif;
    }

    .pagina-404 h1 {
      font-size: 6rem;
      color: #e89aaf;
      margin-bottom: 20px;
      font-family: 'Playfair Display', serif;
    }

    .pagina-404 p {
      font-size: 1.4rem;
      color: #5C4033;
      margin-bottom: 30px;
    }

    .pagina-404 a {
      padding: 14px 30px;
      font-size: 1rem;
      border-radius: 25px;
      background-color: #F3B6C9;
      color: #fff;
      border: none;
      text-decoration: none;
      transition: all 0.3s ease;
      font-weight: 600;
    }

    .pagina-404 a:hover {
      background-color: #e89aaf;
      transform: scale(1.05);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      color: #fff;
    }

    @media (max-width: 600px) {
      .pagina-404 h1 {
        font-size: 4rem;
      }

      .pagina-404 p {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>

  <?php include 'menu.php'; ?> 

  <main>
    <div class="pagina-404">
      <h1>404</h1>
      <p>Ops! A página que você tentou acessar não foi encontrada.</p>
      <a href="index.php">Voltar para a página inicial</a>
    </div>
  </main>

  <?php include 'footer.php'; ?> 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
