<?php
require_once 'conexao.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php?page=login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    if ($nome !== '') {
        $stmt = $pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->execute([$nome]);
        header('Location: index.php?page=admin_categorias_list');
        exit;
    }
}
?>

<h1>Adicionar Categoria</h1>
<form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <button type="submit">Salvar</button>
</form>
<p><a href="index.php?page=admin_categorias_list">Voltar à Lista</a></p>
