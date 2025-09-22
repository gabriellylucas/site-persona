<?php
class Pedidos {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

   
    public function getAll(): array {
        $stmt = $this->pdo->query("
            SELECT pedidos.id, pedidos.cliente_id, pedidos.produto_nome, pedidos.data_pedido, pedidos.status,
                   clientes.nome AS cliente_nome
            FROM pedidos
            LEFT JOIN clientes ON clientes.id = pedidos.cliente_id
            ORDER BY pedidos.data_pedido DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function create(int $clienteId, string $produtoNome): void {
        $stmt = $this->pdo->prepare("
            INSERT INTO pedidos (cliente_id, produto_nome, data_pedido, status)
            VALUES (?, ?, NOW(), 'pendente')
        ");
        $stmt->execute([$clienteId, $produtoNome]);
    }

  
    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM pedidos WHERE id = ?");
        $stmt->execute([$id]);
    }

    
    public function updateStatus(int $id, string $status): void {
        $stmt = $this->pdo->prepare("UPDATE pedidos SET status = ? WHERE id = ?");
        $stmt->execute([$status, $id]);
    }
}
