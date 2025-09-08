<?php
require_once 'conexao.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin'] != 1) {
    header('Location: ../../index.php?page=login');
    exit;
}

$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll();
?>

<h1>Categorias</h1>
<p><a href="index.php?page=admin_categorias_add">Adicionar Nova Categoria</a></p>

<ul>
<?php foreach ($categorias as $c): ?>
    <li>
        <?= htmlspecialchars($c['nome']) ?>
        <a href="index.php?page=admin_categorias_edit&id=<?= $c['id'] ?>">Editar</a>
        <a href="index.php?page=admin_categorias_delete&id=<?= $c['id'] ?>">Excluir</a>
    </li>
<?php endforeach; ?>
</ul>
