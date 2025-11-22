<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../conexao.php'; 
require_once __DIR__ . '/CarrinhoController.php'; 
require_once __DIR__ . '/../models/CarrinhoModel.php'; 

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new CarrinhoController($pdo);

$acao = $_POST['acao'] ?? '';
$produto_id = isset($_POST['produto_id']) ? (int)$_POST['produto_id'] : 0;

if ($produto_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Produto inválido']);
    exit;
}

$success = false;
$message = 'Ação inválida';

switch ($acao) {

    case 'adicionar':

        
        $stmt = $pdo->prepare("SELECT producao_disponivel FROM produtos WHERE id = ?");
        $stmt->execute([$produto_id]);
        $disponivel = $stmt->fetchColumn();

        if ($disponivel <= 0) {
            echo json_encode([
                'success' => false, 
                'message' => 'Produção esgotada para esta semana.'
            ]);
            exit;
        }
        

        $success = $controller->adicionarCarrinho($usuario_id, $produto_id);
        $message = $success ? 'Produto adicionado ao carrinho.' : 'Erro ao adicionar o produto.';
        break;

    case 'remover':
        $success = $controller->removerCarrinho($usuario_id, $produto_id);
        $message = $success ? 'Produto removido do carrinho.' : 'Erro ao remover o produto.';
        break;

    case 'limpar':
        $success = $controller->limparCarrinho($usuario_id);
        $message = $success ? 'Carrinho limpo.' : 'Erro ao limpar o carrinho.';
        break;

    default:
        $message = 'Ação inválida.';
        break;
}

echo json_encode(['success' => $success, 'message' => $message]);
