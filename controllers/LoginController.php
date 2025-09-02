<?php
require_once 'models/Usuario.php'; 

class LoginController {
    private $usuarioModel;

    public function __construct($pdo) {
        $this->usuarioModel = new Usuario($pdo);
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
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header('Location: index.php?page=admin');
                } else {
                    header('Location: index.php?page=area_cliente');
                }
                exit;
            } else {
                $error = "Email ou senha incorretos!";
                require 'views/login.php';
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
