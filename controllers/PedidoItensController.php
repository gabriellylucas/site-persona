<?php
require_once __DIR__ . '/../models/PedidoItens.php';
require_once __DIR__ . '/../models/Produto.php';

class PedidoItensController {
    private PedidoItens $model;
    private Produto $produtoModel;

    public function __construct(PDO $pdo) {
        $this->model = new PedidoItens($pdo);
        $this->produtoModel = new Produto($pdo);
    }

    public function listarItens(int $pedidoId) {
        $itens = $this->model->getByPedido($pedidoId);
        include __DIR__ . '/../views/pedido_itens/listar.php';
    }

    public function adicionarItem(int $pedidoId) {
        $produtos = $this->produtoModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $produtoId = (int)($_POST['produto_id'] ?? 0);
            $quantidade = (int)($_POST['quantidade'] ?? 0);
            $preco = (float)($_POST['preco'] ?? 0);

            $this->model->create($pedidoId, $produtoId, $quantidade, $preco);
            header("Location: index.php?page=pedido_itens_listar&pedido_id=$pedidoId");
            exit;
        }

        include __DIR__ . '/../views/pedido_itens/adicionar.php';
    }

    public function removerItem(int $pedidoId, int $itemId) {
        $this->model->deleteByPedido($pedidoId);
        header("Location: index.php?page=pedido_itens_listar&pedido_id=$pedidoId");
        exit;
    }
}
