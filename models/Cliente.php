<?php
class Cliente {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM clientes ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    
    public function getByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

   
    public function create(string $nome, string $email, string $senha): int {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)"
        );
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $hash
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function createByAdmin(string $nome, string $email): int {
        $senha = bin2hex(random_bytes(4)); // senha aleatória
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare(
            "INSERT INTO clientes (nome, email, senha) VALUES (:nome, :email, :senha)"
        );
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $hash
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    
    public function update(int $id, string $nome, string $email): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE clientes SET nome = :nome, email = :email WHERE id = :id"
        );
        return $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    
    public function temPedidos(int $clienteId): bool {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) FROM pedidos WHERE cliente_id = :id"
        );
        $stmt->execute([':id' => $clienteId]);
        return $stmt->fetchColumn() > 0;
    }

    public function search(string $term): array {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM clientes WHERE nome LIKE :like OR email LIKE :like ORDER BY id DESC"
        );
        $like = "%$term%";
        $stmt->bindParam(':like', $like, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
