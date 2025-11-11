<?php
session_start();
header('Content-Type: application/json');


if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}


if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}


$acao = $_POST['acao'] ?? '';
$produto_id = isset($_POST['produto_id']) ? (int)$_POST['produto_id'] : 0;

if ($produto_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Produto inválido']);
    exit;
}


switch ($acao) {
    case 'adicionar':
        if (!in_array($produto_id, $_SESSION['carrinho'])) {
            $_SESSION['carrinho'][] = $produto_id;
        }
        echo json_encode(['success' => true, 'message' => 'Produto adicionado ao carrinho']);
        break;

    case 'remover':
        if (($key = array_search($produto_id, $_SESSION['carrinho'])) !== false) {
            unset($_SESSION['carrinho'][$key]);
        }
        echo json_encode(['success' => true, 'message' => 'Produto removido do carrinho']);
        break;

    case 'limpar':
        $_SESSION['carrinho'] = [];
        echo json_encode(['success' => true, 'message' => 'Carrinho limpo']);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Ação inválida']);
        break;
}
