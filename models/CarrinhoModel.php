<?php
class CarrinhoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

   
    public function getCarrinhoByUsuario(int $usuario_id): array {
        $sql = "SELECT produto_id FROM carrinho WHERE usuario_id = :usuario_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['usuario_id' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, 0) ?: [];
    }

    
    public function adicionarCarrinho(int $usuario_id, int $produto_id): bool {
        try {
            $sql = "INSERT INTO carrinho (usuario_id, produto_id) VALUES (:usuario_id, :produto_id)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'usuario_id' => $usuario_id,
                'produto_id' => $produto_id
            ]);
        } catch (PDOException $e) {
            
            if ($e->getCode() == 23000) {
                return true;
            }
            return false;
        }
    }

   
    public function removerCarrinho(int $usuario_id, int $produto_id): bool {
        $sql = "DELETE FROM carrinho WHERE usuario_id = :usuario_id AND produto_id = :produto_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'usuario_id' => $usuario_id,
            'produto_id' => $produto_id
        ]);
    }

    
    public function limparCarrinho(int $usuario_id): bool {
        $sql = "DELETE FROM carrinho WHERE usuario_id = :usuario_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['usuario_id' => $usuario_id]);
    }
}
