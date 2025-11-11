<?php
require_once __DIR__ . '/../models/CarrinhoModel.php';

class CarrinhoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new CarrinhoModel($pdo);
    }

    
    public function listarCarrinho(int $usuario_id): array {
        return $this->model->getCarrinhoByUsuario($usuario_id);
    }

   
    public function removerCarrinho(int $usuario_id, int $produto_id): bool {
        return $this->model->removerCarrinho($usuario_id, $produto_id);
    }

  
    public function adicionarCarrinho(int $usuario_id, int $produto_id): bool {
        $carrinho = $this->model->getCarrinhoByUsuario($usuario_id);

       
        if (in_array($produto_id, $carrinho)) {
            return true; 
        }

        return $this->model->adicionarCarrinho($usuario_id, $produto_id);
    }
}
