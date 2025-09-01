<?php
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController {
    private Produto $model;

    public function __construct(PDO $pdo) {
        $this->model = new Produto($pdo);
    }

    public function listar() {
        $produtos = $this->model->getAll();
        include __DIR__ . '/../views/produtos/listar.php';
    }

    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $preco = (float)($_POST['preco'] ?? 0);

            $this->model->create($nome, $descricao, $preco);
            header("Location: index.php?page=produtos_listar");
            exit;
        }
        include __DIR__ . '/../views/produtos/cadastrar.php';
    }

    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $produto = $this->model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $preco = (float)($_POST['preco'] ?? 0);

            $this->model->update($id, $nome, $descricao, $preco);
            header("Location: index.php?page=produtos_listar");
            exit;
        }

        include __DIR__ . '/../views/produtos/editar.php';
    }

    public function excluir() {
        $id = (int)($_GET['id'] ?? 0);
        $this->model->delete($id);
        header("Location: index.php?page=produtos_listar");
        exit;
    }
}
