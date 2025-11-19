<?php
session_start();

require_once __DIR__ . '/../../controllers/CarrinhoController.php';
require_once __DIR__ . '/../../models/CarrinhoModel.php';
require_once __DIR__ . '/../../conexao.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /site-persona/index.php?page=login");
    exit;
}

$usuario_id = $_SESSION['usuario_id'];
$controller = new CarrinhoController($pdo);
$carrinhoIds = $controller->listarCarrinho($usuario_id);

$produtosCarrinho = [];
$total = 0;

if (!empty($carrinhoIds)) {
    $placeholders = implode(',', array_fill(0, count($carrinhoIds), '?'));
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id IN ($placeholders) AND ativo = 1");
    $stmt->execute($carrinhoIds);
    $produtosCarrinho = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtosCarrinho as $p) {
        $total += $p["preco"];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Meu Carrinho - Lia: Bolos e Cia</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="/site-persona/style.css">
</head>
<body>

<?php include __DIR__ . '/../../menu.php'; ?>

<main class="content container">

<h1 class="text-center mb-4">Meu Carrinho</h1>

<div class="row">
    
   
    <div class="col-md-8">
        <h3>Itens do Pedido</h3>

        <div class="row g-4">

        <?php if (!empty($produtosCarrinho)): ?>
            <?php foreach ($produtosCarrinho as $produto): ?>
            <div class="col-md-6">
                <div class="card h-100 position-relative">

                    <button class="remove-item position-absolute top-0 end-0 m-2" data-produto-id="<?= $produto['id'] ?>">
                        <i class="fa-solid fa-trash fs-4" style="color:red;"></i>
                    </button>

                    <img src="/site-persona/<?= $produto['imagem_url'] ?>" class="card-img-top">

                    <div class="card-body">
                        <h5><?= $produto['nome'] ?></h5>
                        <p>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

                        <label>Quantidade:</label>
                        <div class="d-flex">
                            <button class="btn btn-sm btn-secondary">-</button>
                            <input type="number" value="1" min="1" class="form-control mx-2" style="width:80px;">
                            <button class="btn btn-sm btn-secondary">+</button>
                        </div>

                    </div>

                </div>
            </div>
            <?php endforeach; ?>
        
        <?php else: ?>
            <p>Seu carrinho está vazio.</p>
        <?php endif; ?>

        </div>
    </div>

    
    <div class="col-md-4">

        <h3>Resumo do Pedido</h3>

        <p><strong>Subtotal:</strong> R$ <?= number_format($total, 2, ',', '.') ?></p>

        <p><strong>Total:</strong> 
            <span id="totalFinal">
                R$ <?= number_format($total + 20, 2, ',', '.') ?>
            </span>
        </p>

        <hr>
        <h4>Opção de Entrega</h4>

        <label>
            <input type="radio" name="entrega" value="local" checked>
            Retirada no Local (Grátis)
        </label><br>

        <label>
            <input type="radio" name="entrega" value="entrega">
            Entrega (R$ 20,00)
        </label>

        <hr>
        <h4>Pagamento</h4>

        <label><input type="radio" name="pagamento" value="credito"> Cartão de Crédito</label><br>
        <label><input type="radio" name="pagamento" value="debito"> Cartão de Débito</label><br>
        <label><input type="radio" name="pagamento" value="pix"> PIX</label>

        <hr>

        <button class="btn btn-success w-100 mt-3" id="btnFinalizar">
            Finalizar Pedido
        </button>

    </div>

</div>

</main>

<?php include __DIR__ . '/../../footer.php'; ?>

<script>

document.querySelectorAll("input[name='entrega']").forEach(radio => {
    radio.addEventListener("change", () => {
        const valorBase = <?= $total ?>;
        const total = radio.value === "entrega" ? valorBase + 20 : valorBase;
        document.getElementById("totalFinal").innerText = 
            "R$ " + total.toFixed(2).replace(".", ",");
    });
});


document.querySelectorAll(".remove-item").forEach(btn => {
    btn.addEventListener("click", () => {
        const id = btn.getAttribute("data-produto-id");
        if (!confirm("Remover este item?")) return;

        fetch("/site-persona/controllers/Carrinho_ajax.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `acao=remover&produto_id=${id}`
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) location.reload();
        });
    });
});


document.getElementById("btnFinalizar").addEventListener("click", () => {
    alert("Pedido finalizado! (Simulação)");
});
</script>

</body>
</html>
