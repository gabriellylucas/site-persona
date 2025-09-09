<?php
require_once __DIR__ . '/../models/FavoritosModel.php';

class FavoritosController {
    private $model;

    public function __construct($pdo) {
        $this->model = new FavoritosModel($pdo);
    }

    public function listarFavoritos($usuario_id) {
        return $this->model->getFavoritosByUsuario($usuario_id);
    }

    public function removerFavorito($usuario_id, $produto_id) {
        return $this->model->removerFavorito($usuario_id, $produto_id);
    }

    public function adicionarFavorito($usuario_id, $produto_id) {
        return $this->model->adicionarFavorito($usuario_id, $produto_id);
    }
}
