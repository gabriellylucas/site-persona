<?php
class Produto {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM produtos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?array {
        $stmt = $this->pdo->prepare("SELECT * FROM produtos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $nome, string $descricao, float $preco): int {
        $stmt = $this->pdo->prepare(
            "INSERT INTO produtos (nome, descricao, preco) 
             VALUES (:nome, :descricao, :preco)"
        );
        $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, string $nome, string $descricao, float $preco): bool {
        $stmt = $this->pdo->prepare(
            "UPDATE produtos 
             SET nome = :nome, descricao = :descricao, preco = :preco 
             WHERE id = :id"
        );
        return $stmt->execute([
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':preco' => $preco,
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM produtos WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
