<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não logado']);
    exit;
}

$usuario_id = $_SESSION['usuario_id'];

// entrega e pagamento vindos do fetch
$entrega = $_POST['entrega'] ?? '';
$pagamento = $_POST['pagamento'] ?? '';
$total = $_POST['total'] ?? 0;

if ($entrega == '' || $pagamento == '') {
    echo json_encode(['success' => false, 'message' => 'Selecione entrega e pagamento.']);
    exit;
}

// --- 1) Buscar produtos do carrinho
require_once __DIR__ . '/CarrinhoController.php';
$controller = new CarrinhoController($pdo);

$produtosIds = $controller->listarCarrinho($usuario_id);

if (empty($produtosIds)) {
    echo json_encode(['success' => false, 'message' => 'Carrinho vazio']);
    exit;
}

// Pegar produtos
$placeholders = implode(',', array_fill(0, count($produtosIds), '?'));
$stmt = $pdo->prepare("SELECT id, nome, preco, producao_disponivel 
                       FROM produtos 
                       WHERE id IN ($placeholders)");
$stmt->execute($produtosIds);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- 2) Verificação de estoque
foreach ($produtos as $p) {
    if ($p['producao_disponivel'] <= 0) {
        echo json_encode([
            'success' => false,
            'message' => "Produto sem estoque: " . $p['nome']
        ]);
        exit;
    }
}

// --- 3) Criar o pedido
$stmt = $pdo->prepare("
    INSERT INTO pedidos (cliente_id, total, entrega, pagamento, data_pedido, status)
    VALUES (?, ?, ?, ?, NOW(), 'Pendente')
");
$stmt->execute([$usuario_id, $total, $entrega, $pagamento]);

$pedido_id = $pdo->lastInsertId();

// --- 4) Salvar produto_nome (COMO SUA TABELA TEM APENAS UM PRODUTO POR PEDIDO)
$nomesProdutos = array_column($produtos, 'nome');
$produtosTexto = implode(', ', $nomesProdutos);

$stmt = $pdo->prepare("UPDATE pedidos SET produto_nome = ? WHERE id = ?");
$stmt->execute([$produtosTexto, $pedido_id]);

// --- 5) Baixar estoque
foreach ($produtos as $p) {
    $stmt = $pdo->prepare("
        UPDATE produtos 
        SET producao_disponivel = producao_disponivel - 1 
        WHERE id = ?
    ");
    $stmt->execute([$p['id']]);
}

// --- 6) Limpar carrinho
$controller->limparCarrinho($usuario_id);

echo json_encode([
    'success' => true,
    'message' => 'Pedido realizado com sucesso!',
    'pedido_id' => $pedido_id
]);
