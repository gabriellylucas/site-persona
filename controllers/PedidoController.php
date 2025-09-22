<?php
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Produto.php';

class PedidoController {
    private Pedidos $model;
    private Cliente $clienteModel;
    private Produto $produtoModel;

    public function __construct(PDO $pdo) {
        $this->model = new Pedidos($pdo);
        $this->clienteModel = new Cliente($pdo);
        $this->produtoModel = new Produto($pdo);
    }

    public function listar() {
        $pedidos = $this->model->getAll();
        include __DIR__ . '/../views/pedidos/listar.php';
    }

    public function cadastrar() {
        $clientes = $this->clienteModel->getAll();
        $produtos = $this->produtoModel->getAllAtivos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteId = (int)($_POST['cliente_id'] ?? 0);
            $produtoId = (int)($_POST['produto_id'] ?? 0);

            if ($clienteId && $produtoId) {
                $produtoNome = $this->produtoModel->getNomeById($produtoId);
                $this->model->create($clienteId, $produtoNome);

                header("Location: index.php?page=pedidos_listar");
                exit;
            } else {
                $erro = "Selecione um cliente e um produto válidos.";
            }
        }

        include __DIR__ . '/../views/pedidos/cadastrar.php';
    }

    public function excluir() {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        header("Location: index.php?page=pedidos_listar");
        exit;
    }

    public function atualizarStatus() {
        $id = (int)($_GET['id'] ?? 0);
        $acao = $_GET['acao'] ?? '';

        if ($id) {
            if ($acao === 'confirmar') $this->model->updateStatus($id, 'confirmado');
            elseif ($acao === 'cancelar') $this->model->updateStatus($id, 'cancelado');
        }

        header("Location: index.php?page=pedidos_listar");
        exit;
    }
}
