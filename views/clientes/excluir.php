<?php
require_once '../../conexao.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php?page=clientes_listar&msg=deleted');
exit;
