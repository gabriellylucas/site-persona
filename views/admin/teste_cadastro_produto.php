<?php
require_once __DIR__ . '/../conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>Cadastrar Novo Produto</h2>

<form action="salvar_produto.php" method="POST" enctype="multipart/form-data" class="mt-3">

    <label>Nome:</label>
    <input type="text" name="nome" class="form-control" required>

    <label class="mt-3">Preço:</label>
    <input type="number" name="preco" step="0.01" class="form-control" required>

    <label class="mt-3">Descrição:</label>
    <textarea name="descricao" class="form-control"></textarea>

    <label class="mt-3">Categoria:</label>
    <input type="text" name="categoria" class="form-control">

    <label class="mt-3">Imagem:</label>
    <input type="file" name="imagem" class="form-control">

    <label class="mt-3">Estoque:</label>
    <input type="number" name="estoque" min="0" class="form-control" required>

    <button class="btn btn-primary mt-4">Salvar Produto</button>
</form>

</body>
</html>
