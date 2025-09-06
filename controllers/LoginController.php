<?php
require_once 'models/Usuario.php'; 

class LoginController {
    private $usuarioModel;
    private $pdo;

    public function __construct($pdo) {
        $this->usuarioModel = new Usuario($pdo);
        $this->pdo = $pdo; // guardar o PDO para usar no registrar
    }

    public function index() {
        require 'views/login/login.php';
    }

    public function autenticar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['username']; 
            $senha = $_POST['password'];

            $user = $this->usuarioModel->login($email, $senha);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['nome']; // ajustei para 'nome' que existe no banco
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
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
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare(
                "INSERT INTO clientes (nome, email, senha, role) VALUES (?, ?, ?, 'cliente')"
            );

            try {
                $stmt->execute([$nome, $email, $senha]);
                header('Location: index.php?page=login');
                exit;
            } catch (PDOException $e) {
                $error = "Erro ao cadastrar: " . $e->getMessage();
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