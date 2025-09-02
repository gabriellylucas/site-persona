<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css"> 
</head>
<body class="login-page">
  <div class="login-container">
    <h2>Entrar</h2>

    <form action="index.php?page=autenticar" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="username" required>

      <label for="password">Senha:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>
    </form>


    <?php if (!empty($error)): ?>
      <p style="color:red;">
        <?= htmlspecialchars($error) ?>
      </p>
    <?php endif; ?>

    <p>Ainda não tem cadastro? <a href="index.php?page=cadastro">Clique aqui</a></p>
  </div>
</body>
</html>
