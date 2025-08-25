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

    case 'home':
        include 'home.php';
        break;

    default:
        include '404.php';
}
?>

