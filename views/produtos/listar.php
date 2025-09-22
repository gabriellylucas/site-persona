<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<div class="main-container container py-4">
    <h2 class="section-title mb-4">Gestão de Produtos</h2>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="search-box position-relative">
            <i class="fas fa-search position-absolute" style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
            <input type="text" id="search-input" class="form-control ps-4" placeholder="Procurar produtos...">
        </div>
       <a href="index.php?page=produtos_cadastrar" class="btn btn-add-product">
    <i class="fas fa-plus me-2"></i>Adicionar Novo Produto
</a>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 products-grid">
        <?php
        $produtos = [
    ["Bolo de Ameixa", "R$ 50,00/kg", "imagens/ameixa.png"],
    ["Bolo Belga com Abacaxi e Coco", "R$ 50,00/kg", "imagens/belga com abacaxi e coco.png"],
    ["Bolo Belga com Abacaxi", "R$ 50,00/kg", "imagens/belga com abacaxi.png"],
    ["Bolo Belga com Morango", "R$ 50,00/kg", "imagens/belga com morango.png"],
    ["Bolo Belga com Morango e Suspiro", "R$ 50,00/kg", "imagens/creme belga com morango e suspiro.png"],
    ["Bolo Belga com Pêssego", "R$ 50,00/kg", "imagens/creme belga com pessego.png"],
    ["Bolo de Doce de Leite com Abacaxi", "R$ 50,00/kg", "imagens/doce de leite com abacaxi.png"],
    ["Bolo de Dois Amores e Maracujá", "R$ 50,00/kg", "imagens/dois amores e maracuja.png"],
    ["Bolo de Maracujá com Chocolate Branco", "R$ 50,00/kg", "imagens/maracuja com chocolate branco.png"],
    ["Bolo de Mousse de Maracujá", "R$ 50,00/kg", "imagens/mousse de maracuja.png"],
    ["Bolo de Ninho com Morango", "R$ 50,00/kg", "imagens/ninho com morango.png"],
    ["Bolo de Ninho Trufado com Morango", "R$ 50,00/kg", "imagens/ninho trufado com morango.png"],
    ["Bolo Quatro Leite com Abacaxi e Coco", "R$ 50,00/kg", "imagens/quatro leite com abacaxi e coco.png"],
    ["Bolo Quatro Leite com Morango", "R$ 50,00/kg", "imagens/quatro leite com morango.png"],
    ["Bolo de Três Leites com Morango", "R$ 50,00/kg", "imagens/tres leites com morango.png"],
    ["Bolo de Trufado de Abacaxi com Chocolate Branco", "R$ 50,00/kg", "imagens/trufado de abacaxi com chocolate branco.png"],
    ["Bolo de Cenoura com Cobertura de Chocolate", "R$ 65,00/kg", "imagens/bolo de cenoura com cobertura de chocolate.png"],
    ["Bolo de Chocolate", "R$ 65,00/kg", "imagens/bolo de chocolate.png"],
    ["Bolo de Laranja", "R$ 40,00/un", "imagens/bolo de laranja.png"],
    ["Bolo de Chocolate com Cereja", "R$ 65,00/kg", "imagens/Chocolate com Cereja.png"],
    ["Bolo de Chocolate com Maracujá", "R$ 65,00/kg", "imagens/chocolate com maracuja.png"],
    ["Bolo de Chocolate com Morango", "R$ 65,00/kg", "imagens/chocolate com morango.png"],
    ["Bolo de Coco com Amêndoa", "R$ 65,00/kg", "imagens/Coco com Amendoa.png"],
    ["Bolo de Creme de Amendoim", "R$ 65,00/kg", "imagens/creme de ameindoim.png"],
    ["Bolo de Doce de Leite com Coco", "R$ 65,00/kg", "imagens/doce de leite com coco.png"],
    ["Bolo de Doce de Leite", "R$ 65,00/kg", "imagens/doce de leite.png"],
    ["Bolo de Dois Amores", "R$ 65,00/kg", "imagens/dois amores.png"],
    ["Bolo de Mousse de Limão", "R$ 65,00/kg", "imagens/mousse de limão.png"],
    ["Bolo de Nata com Morango e Chocolate", "R$ 65,00/kg", "imagens/nata com morango e chocolate.png"],
    ["Bolo de Nata com Morango e Suspiro", "R$ 65,00/kg", "imagens/nata com morango e suspiro.png"],
    ["Bolo de Nata com Morango", "R$ 65,00/kg", "imagens/nata com morango.png"],
    ["Bolo de Ninho com Chocolate", "R$ 65,00/kg", "imagens/ninho com chocolate.png"],
    ["Bolo de Ninho com Nutella", "R$ 65,00/kg", "imagens/ninho com nutella.png"],
    ["Bolo de Prestígio", "R$ 65,00/kg", "imagens/prestígio.png"],
    ["Bolo Quatro Leite com Chocolate", "R$ 65,00/kg", "imagens/quatro leite com chocolate.png"],
    ["Bolo Quatro Leite", "R$ 65,00/kg", "imagens/quatro leite.png"],
    ["Bolo de Três Leites", "R$ 65,00/kg", "imagens/três leites.png"],
    ["Bolo Personalizado", "R$ 65,00/kg", "imagens/pers.png"],
    ["Brigadeiro", "R$ 2,50/un", "imagens/brigadeiro.png"],
    ["Churros", "R$ 2,50/un", "imagens/churros.png"],
    ["Beijinho", "R$ 2,50/un", "imagens/beijinho.png"],
    ["Docinhos em Flor", "R$ 3,00/un", "imagens/docinhos em flor.png"],
    ["Ninho com Nutela", "R$ 3,50/un", "imagens/ninho com nutella docinho.png"],
    ["Pudim", "R$ 45,00/un", "imagens/pudim2.png"]
        ];

        foreach ($produtos as $produto) {
            echo '
            <div class="col">
                <div class="card h-100 text-center p-2">
                    <img src="' . htmlspecialchars($produto[2]) . '" alt="' . htmlspecialchars($produto[0]) . '" class="card-img-top img-fluid rounded mb-2" style="height:120px; object-fit:cover;">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($produto[0]) . '</h5>
                        <p class="card-text">' . htmlspecialchars($produto[1]) . '</p>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>
</div>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-input');
    const productGrid = document.querySelector('.products-grid');
    const cards = productGrid.querySelectorAll('.col');

    searchInput.addEventListener('keyup', function() {
        const filtro = searchInput.value.toLowerCase();
        cards.forEach(card => {
            const nome = card.querySelector('.card-title').textContent.toLowerCase();
            card.style.display = nome.includes(filtro) ? '' : 'none';
        });
    });
});
</script>

</body>
</html>