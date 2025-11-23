<?php
require_once __DIR__ . '/../conexao.php';
include __DIR__ . '/../admin/navbar_admin.php';

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gestão de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="page-produtos">

<div class="container py-4">
    <h2>Gestão de Produtos</h2>

    <a href="teste_cadastro_produto.php" class="btn btn-success mb-4">+ Adicionar Produto</a>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($p = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100 text-center p-2">
                    <img src="<?php echo $p['imagem_url']; ?>" class="card-img-top" style="height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5><?php echo $p['nome']; ?></h5>
                        <p>Preço: R$ <?php echo number_format($p['preco'], 2, ',', '.'); ?></p>
                        <p><strong>Estoque:</strong> <?php echo $p['estoque']; ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

</div>

</body>
</html>
