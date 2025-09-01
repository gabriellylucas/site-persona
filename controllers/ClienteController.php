<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private Cliente $model;

    public function __construct(PDO $pdo) {
        $this->model = new Cliente($pdo);
    }

    public function listar() {
        $clientes = $this->model->getAll();
        include __DIR__ . '/../views/clientes/listar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';

            $this->model->create($nome, $email);
            header("Location: index.php?page=clientes_listar");
            exit;
        }
        include __DIR__ . '/../views/clientes/cadastrar.php';
    }

    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $cliente = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';

            $this->model->update($id, $nome, $email);
            header("Location: index.php?page=clientes_listar");
            exit;
        }

        include __DIR__ . '/../views/clientes/editar.php';
    }

    public function excluir() {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        header("Location: index.php?page=clientes_listar");
        exit;
    }
}
