
<?php
class Pedido {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $sql = "SELECT p.*, c.nome as cliente_nome 
                FROM pedidos p 
                LEFT JOIN clientes c ON c.id = p.cliente_id 
                ORDER BY p.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(int $clienteId, float $total): int {
        $stmt = $this->pdo->prepare("INSERT INTO pedidos (cliente_id, total) VALUES (:cliente_id, :total)");
        $stmt->execute([':cliente_id' => $clienteId, ':total' => $total]);
        return (int)$this->pdo->lastInsertId();
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM pedidos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}