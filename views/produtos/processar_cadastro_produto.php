<?php
session_start();
include __DIR__ . '/conexao.php'; // caminho para o banco

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];

    if (isset($_SESSION['imagem_selecionada'])) {
        $imagem = $_SESSION['imagem_selecionada'];

        $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, imagem_url) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $preco, $imagem]);

        unset($_SESSION['imagem_selecionada']);

        header("Location: cadastrar.php?sucesso=1");
        exit;
    } else {
        echo "Erro: Nenhuma imagem enviada. Volte e envie a imagem antes de cadastrar.";
    }
}
?>