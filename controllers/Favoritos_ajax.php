<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/FavoritosController.php';
require_once __DIR__ . '/../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$acao = $_POST['acao'] ?? '';
$produto_id = $_POST['produto_id'] ?? '';

if (!$produto_id) {
    echo json_encode(['success' => false, 'message' => 'Produto não informado']);
    exit;
}

$produto_id = (int)$produto_id; 

$controller = new FavoritosController($pdo);

switch ($acao) {
    case 'adicionar':
        $result = $controller->adicionarFavorito($usuario_id, $produto_id);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Produto adicionado aos favoritos' : 'Erro ao adicionar favorito'
        ]);
        break;

    case 'remover':
        $result = $controller->removerFavorito($usuario_id, $produto_id);
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Produto removido dos favoritos' : 'Erro ao remover favorito'
        ]);
        break;

    default:
        echo json_encode(['success' => false, 'message' => 'Ação inválida']);
        break;
}
