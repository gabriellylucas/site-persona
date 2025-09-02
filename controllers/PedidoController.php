<?php
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Cliente.php';

class PedidoController {
    private Pedidos $model;
    private Cliente $clienteModel;

    public function __construct(PDO $pdo) {
        $this->model = new Pedidos($pdo);
        $this->clienteModel = new Cliente($pdo);
    }

    public function listar() {
        $pedidos = $this->model->getAll();
        include __DIR__ . '/../views/pedidos/listar.php';
    }

    public function cadastrar() {
        $clientes = $this->clienteModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteId = (int)($_POST['cliente_id'] ?? 0);
            $total = (float)($_POST['total'] ?? 0);

            $this->model->create($clienteId, $total);
            header("Location: index.php?page=pedidos_listar");
            exit;
        }

        include __DIR__ . '/../views/pedidos/cadastrar.php';
    }

    public function excluir() {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        header("Location: index.php?page=pedidos_listar");
        exit;
    }
}
