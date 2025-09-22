<?php
include '../conexao.php';
session_start();


header('Content-Type: application/json');


$usuario_id = $_SESSION['usuario_id'] ?? 0;
$produto_nome = $_POST['produto_nome'] ?? '';

if (!$usuario_id) {
    echo json_encode(['success' => false, 'error' => 'Usuário não logado']);
    exit;
}

if (!$produto_nome) {
    echo json_encode(['success' => false, 'error' => 'Produto não informado']);
    exit;
}


$stmtPedido = $pdo->prepare("
    INSERT INTO pedidos (cliente_id, produto_nome, data_pedido, status)
    VALUES (?, ?, NOW(), 'pendente')
");

$sucesso = $stmtPedido->execute([$usuario_id, $produto_nome]);

if ($sucesso) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Erro ao salvar pedido']);
}
