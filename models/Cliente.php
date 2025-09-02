
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

    public function create(string $nome, string $email): int {
        $stmt = $this->pdo->prepare("INSERT INTO clientes (nome, email) VALUES (:nome, :email)");
        $stmt->execute([':nome' => $nome, ':email' => $email]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, string $nome, string $email): bool {
        $stmt = $this->pdo->prepare("UPDATE clientes SET nome = :nome, email = :email WHERE id = :id");
        return $stmt->execute([':nome' => $nome, ':email' => $email, ':id' => $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}