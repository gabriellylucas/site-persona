<?php

class FavoritosModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getFavoritosByUsuario($usuario_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.id, p.nome, p.preco
            FROM favoritos f
            JOIN produtos p ON f.produto_id = p.id
            WHERE f.usuario_id = :usuario_id
        ");

        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function adicionarFavorito($usuario_id, $produto_id) {
        $stmt = $this->pdo->prepare("
            INSERT INTO favoritos (usuario_id, produto_id) 
            VALUES (:usuario_id, :produto_id)
        ");
        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'produto_id' => $produto_id
        ]);
    }

    public function removerFavorito($usuario_id, $produto_id) {
        $stmt = $this->pdo->prepare("
            DELETE FROM favoritos 
            WHERE usuario_id = :usuario_id AND produto_id = :produto_id
        ");
        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'produto_id' => $produto_id
        ]);
    }
}
