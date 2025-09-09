<?php
require_once 'models/Usuario.php'; 

class LoginController {
    private $usuarioModel;
    private $pdo;

    public function __construct($pdo) {
        $this->usuarioModel = new Usuario($pdo); 
        $this->pdo = $pdo;
    }


    public function index() {
        $error = "";
        require 'views/login/login.php';
    }

 
    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['username'];
            $senha = $_POST['password'];


            $user = $this->usuarioModel->login($email, $senha);

            if ($user) {
                session_start();
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['tipo'] = $user['tipo'];

                if ($user['tipo'] === 'admin') {
                    header('Location: index.php?page=admin');
                } else {
                    header('Location: index.php?page=home');
                }
                exit;
            } else {

                require_once __DIR__ . '/../models/Cliente.php';
                $clienteModel = new Cliente($this->pdo);
                $cliente = $clienteModel->getByEmail($email);

                if ($cliente && password_verify($senha, $cliente['senha'])) {
                    session_start();
                    $_SESSION['usuario_id'] = $cliente['id'];
                    $_SESSION['nome'] = $cliente['nome'];
                    $_SESSION['tipo'] = 'cliente';
                    header('Location: index.php?page=home');
                    exit;
                } else {
                    $error = "Email ou senha incorretos!";
                    require 'views/login/login.php';
                }
            }
        }
    }

    public function registrar() {
        $error = '';
        if (isset($_POST['registrar'])) {
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            require_once __DIR__ . '/../models/Cliente.php';
            $clienteModel = new Cliente($this->pdo);

            if ($clienteModel->getByEmail($email)) {
                $error = "Email já cadastrado!";
            } else {
                $clienteModel->create($nome, $email, $senha);
                header("Location: index.php?page=login");
                exit;
            }
        }

        include __DIR__ . '/../views/login/cadastro.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
