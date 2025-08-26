
<?php
class PedidoItem {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getByPedido(int $pedidoId): array {
        $sql = "SELECT pi.*, pr.nome as produto_nome 
                FROM pedido_items pi
                LEFT JOIN produtos pr ON pr.id = pi.produto_id
                WHERE pi.pedido_id = :pedido_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':pedido_id' => $pedidoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(int $pedidoId, int $produtoId, int $quantidade, float $preco): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO pedido_items (pedido_id, produto_id, quantidade, preco) 
             VALUES (:pedido_id, :produto_id, :quantidade, :preco)"
        );
        $stmt->execute([
            ':pedido_id' => $pedidoId,
            ':produto_id' => $produtoId,
            ':quantidade' => $quantidade,
            ':preco' => $preco
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function deleteByPedido(int $pedidoId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM pedido_items WHERE pedido_id = :pedido_id");
        return $stmt->execute([':pedido_id' => $pedidoId]);
    }
}