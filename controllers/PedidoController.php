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

    //Lista todos os pedidos
     
    public function listar() {
        $pedidos = $this->model->getAll();
        include __DIR__ . '/../views/pedidos/listar.php';
    }

    // Cadastrar um novo pedido
    
    public function cadastrar() {
        $clientes = $this->clienteModel->getAll();
        $todosProdutos = $this->produtoModel->getAll();

        // filtra apenas produtos com status 'ativo' (se houver essa coluna)
        $produtos = array_filter($todosProdutos, function($p) {
            return isset($p['status']) ? strtolower($p['status']) === 'ativo' : true;
        });

        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteId = (int)($_POST['cliente_id'] ?? 0);
            $produtoId = (int)($_POST['produto_id'] ?? 0);

            if ($clienteId > 0 && $produtoId > 0) {
                // pega o nome do produto a partir do model Produto
                $produtoNome = $this->produtoModel->getNomeById($produtoId);
                if (!$produtoNome) {
                    $erro = "Produto não encontrado.";
                } else {
                    $this->model->create($clienteId, $produtoNome);
                    header("Location: index.php?page=pedidos_listar");
                    exit;
                }
            } else {
                $erro = "Selecione um cliente e um produto válidos.";
            }
        }

        include __DIR__ . '/../views/pedidos/cadastrar.php';
    }

    //Excluir um pedido

    public function excluir() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id > 0) {
            $this->model->delete($id);
        }
        header("Location: index.php?page=pedidos_listar");
        exit;
    }

    
    public function atualizarStatus() {
        $id = (int)($_GET['id'] ?? 0);
        $acao = $_GET['acao'] ?? '';

        if ($id > 0 && $acao) {
            if ($acao === 'confirmar') {
                $this->model->updateStatus($id, 'confirmado');
            } elseif ($acao === 'cancelar') {
                $this->model->updateStatus($id, 'cancelado');
            }
        }

        header("Location: index.php?page=pedidos_listar");
        exit;
    }

   
    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        if ($id <= 0) {
            header("Location: index.php?page=pedidos_listar");
            exit;
        }

        // busca pedido existente
        $pedido = $this->model->getById($id);
        if (!$pedido) {
            header("Location: index.php?page=pedidos_listar");
            exit;
        }

        // dados para selects
        $clientes = $this->clienteModel->getAll();
        $todosProdutos = $this->produtoModel->getAll();
        $produtos = array_filter($todosProdutos, function($p) {
            return isset($p['status']) ? strtolower($p['status']) === 'ativo' : true;
        });

        $erro = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteId = (int)($_POST['cliente_id'] ?? 0);
            $produtoId = (int)($_POST['produto_id'] ?? 0);
            $status = $_POST['status'] ?? ($pedido['status'] ?? 'Pendente');

            if ($clienteId > 0 && $produtoId > 0) {
                $produtoNome = $this->produtoModel->getNomeById($produtoId);
                if (!$produtoNome) {
                    $erro = "Produto não encontrado.";
                } else {
                    // Atualiza via model 
                    $this->model->update($id, $clienteId, $produtoNome, $status);

                    header("Location: index.php?page=pedidos_listar");
                    exit;
                }
            } else {
                $erro = "Selecione um cliente e um produto válidos.";
            }
        }

        include __DIR__ . '/../views/pedidos/editar.php';
    }
}
