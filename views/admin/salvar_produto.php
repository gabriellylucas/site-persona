<?php
require_once __DIR__ . '/../conexao.php';

$nome = $_POST['nome'];
$preco = $_POST['preco'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$estoque = $_POST['estoque'];

$imagem_url = null;

if (!empty($_FILES['imagem']['name'])) {
    $pasta = "imagens/";
    $arquivo = $pasta . basename($_FILES['imagem']['name']);

    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $arquivo)) {
        $imagem_url = $arquivo;
    }
}

$sql = "INSERT INTO produtos (nome, preco, descricao, categoria, imagem_url, estoque, ativo) 
        VALUES (?, ?, ?, ?, ?, ?, 1)";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("sdsssi", $nome, $preco, $descricao, $categoria, $imagem_url, $estoque);

if ($stmt->execute()) {
    header("Location: produtos.php?sucesso=1");
    exit;
} else {
    echo "Erro ao cadastrar produto!";
}
