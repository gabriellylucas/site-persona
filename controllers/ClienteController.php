<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private Cliente $model;

    public function __construct(PDO $pdo) {
        $this->model = new Cliente($pdo);
    }

    
    public function listar() {
        $search = $_GET['search'] ?? '';

        if ($search !== '') {
           
            $clientes = $this->model->search($search);
        } else {
           
            $clientes = $this->model->getAll();
        }

       
        if (!empty($search) && isset($_GET['ajax'])) {
            if (!empty($clientes)) {
                foreach ($clientes as $c) {
                    echo '<div class="client-card">
                            <div class="card-icon"><i class="fas fa-user-circle"></i></div>
                            <div class="card-content">
                                <p class="client-name">'.htmlspecialchars($c['nome']).'</p>
                                <p class="client-info">'.htmlspecialchars($c['email']).'</p>
                            </div>
                          </div>';
                }
            } else {
                echo '<div class="no-clients">Nenhum cliente encontrado.</div>';
            }
            exit;
        }

        
        include __DIR__ . '/../views/clientes/listar.php';
    }

    
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';

           
            $this->model->createByAdmin($nome, $email);

            header("Location: index.php?page=clientes_listar");
            exit;
        }

        include __DIR__ . '/../views/clientes/cadastrar.php';
    }

    
    public function editar() {
        $id = (int)($_GET['id'] ?? 0);
        $cliente = $this->model->getById($id);

        if (!$cliente) {
            echo "Cliente não encontrado!";
            exit;
        }

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

        if ($this->model->temPedidos($id)) {
            echo "⚠️ Não é possível excluir este cliente porque ele já possui pedidos.";
            exit;
        }

        $this->model->delete($id);
        header("Location: index.php?page=clientes_listar");
        exit;
    }
}
