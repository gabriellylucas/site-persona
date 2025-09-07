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
                    header('Location: index.php?page=area_cliente');
                }
                exit;
            } else {
                $error = "Email ou senha incorretos!";
                require 'views/login/login.php';
            }
        }
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $success = $this->usuarioModel->registrar($nome, $email, $senha);

            if ($success) {
                header('Location: index.php?page=login');
                exit;
            } else {
                $error = "Erro ao cadastrar usuário!";
                require 'views/login/cadastro.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php?page=login');
        exit;
    }
}
