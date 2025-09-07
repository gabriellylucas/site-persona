<?php
require_once 'conexao.php'; 

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'clientes_listar':
        require 'controllers/ClienteController.php';
        $controller = new ClienteController($pdo);
        $controller->listar();
        break;

    case 'clientes_cadastrar':
        require 'controllers/ClienteController.php';
        $controller = new ClienteController($pdo);
        $controller->cadastrar();
        break;

    case 'clientes_editar':
        require 'controllers/ClienteController.php';
        $controller = new ClienteController($pdo);
        $controller->editar();
        break;

    case 'clientes_excluir':
        require 'controllers/ClienteController.php';
        $controller = new ClienteController($pdo);
        $controller->excluir();
        break;

    case 'produtos_listar':
        require 'controllers/ProdutoController.php';
        $controller = new ProdutoController($pdo);
        $controller->listar();
        break;

    case 'produtos_cadastrar':
        require 'controllers/ProdutoController.php';
        $controller = new ProdutoController($pdo);
        $controller->cadastrar();
        break;

    case 'produtos_editar':
        require 'controllers/ProdutoController.php';
        $controller = new ProdutoController($pdo);
        $controller->editar();
        break;

    case 'produtos_excluir':
        require 'controllers/ProdutoController.php';
        $controller = new ProdutoController($pdo);
        $controller->excluir();
        break;

    case 'pedidos_listar':
        require 'controllers/PedidoController.php';
        $controller = new PedidoController($pdo);
        $controller->listar();
        break;

    case 'pedidos_cadastrar':
        require 'controllers/PedidoController.php';
        $controller = new PedidoController($pdo);
        $controller->cadastrar();
        break;

    case 'pedidos_editar':
        require 'controllers/PedidoController.php';
        $controller = new PedidoController($pdo);
        $controller->editar();
        break;

    case 'pedidos_excluir':
        require 'controllers/PedidoController.php';
        $controller = new PedidoController($pdo);
        $controller->excluir();
        break;

    case 'pedido_itens_listar':
        require 'controllers/PedidoItensController.php';
        $pedidoId = (int)($_GET['pedido_id'] ?? 0);
        $controller = new PedidoItensController($pdo);
        $controller->listarItens($pedidoId);
        break;

    case 'pedido_itens_adicionar':
        require 'controllers/PedidoItensController.php';
        $pedidoId = (int)($_GET['pedido_id'] ?? 0);
        $controller = new PedidoItensController($pdo);
        $controller->adicionarItem($pedidoId);
        break;

    case 'pedido_itens_remover':
        require 'controllers/PedidoItensController.php';
        $pedidoId = (int)($_GET['pedido_id'] ?? 0);
        $itemId = (int)($_GET['item_id'] ?? 0);
        $controller = new PedidoItensController($pdo);
        $controller->removerItem($pedidoId, $itemId);
        break;

    case 'login':
        require 'controllers/LoginController.php';
        $controller = new LoginController($pdo);
        $controller->index();
        break;

    case 'autenticar':
        require 'controllers/LoginController.php';
        $controller = new LoginController($pdo);
        $controller->autenticar();
        break;

    case 'logout':
        require 'controllers/LoginController.php';
        $controller = new LoginController($pdo);
        $controller->logout();
        break;

    case 'cadastro':
        require 'views/login/cadastro.php';
        break;

    case 'registrar':
        require 'controllers/LoginController.php';
        $controller = new LoginController($pdo);
        $controller->registrar();
        break;

    case 'admin':
        require 'views/admin/dashboard.php';
        break;

    case 'area_cliente':
        require 'views/home.php';
        break;

    case 'home':
        include 'home.php';
        break;

    default:
        include '404.php';
        break;
}
?>
