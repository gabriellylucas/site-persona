<?php
require_once __DIR__ . '/../models/FavoritosModel.php';

class FavoritosController {
    private $model;

    public function __construct($pdo) {
        $this->model = new FavoritosModel($pdo);
    }

    
    public function listarFavoritos(int $usuario_id): array {
        return $this->model->getFavoritosByUsuario($usuario_id);
    }

    
    public function removerFavorito(int $usuario_id, int $produto_id): bool {
        return $this->model->removerFavorito($usuario_id, $produto_id);
    }

  
    public function adicionarFavorito(int $usuario_id, int $produto_id): bool {
        
        $favoritos = $this->model->getFavoritosByUsuario($usuario_id);
        if (in_array($produto_id, $favoritos)) {
            return true; 
        }

        return $this->model->adicionarFavorito($usuario_id, $produto_id);
    }
}
