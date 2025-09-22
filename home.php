<?php
include 'conexao.php';
session_start();

$usuario_id = $_SESSION['usuario_id'] ?? 0;


$stmt = $pdo->query("SELECT * FROM produtos WHERE ativo = 1 ORDER BY id DESC");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$favoritos = [];
if ($usuario_id) {
    $stmtFav = $pdo->prepare("SELECT produto_id FROM favoritos WHERE usuario_id = ?");
    $stmtFav->execute([$usuario_id]);
    $favoritos = $stmtFav->fetchAll(PDO::FETCH_COLUMN);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lia: Bolos e Cia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="imagens/logo.png">
</head>
<body class="page-produtos">

<?php include 'menu.php'; ?>

<main class="content">

   
    <div class="banner-container">
        <img src="imagens/bolo4.png" alt="Banner" class="img-fluid w-100">
        <div class="banner-texto">
            <h1>Bem-vindo à Lia: Bolos e Cia</h1>
            <p>Delícias feitas com carinho para todos os momentos especiais.
               Encomende bolos personalizados, sobremesas irresistíveis e muito mais!</p>
            <a href="#cardapio" class="btn btn-primary">Faça seu pedido</a>
        </div>
    </div>

 
    <section id="cardapio" class="container categorias-section my-5">
        <h2 class="text-center mb-4 titulo-produtos">Minhas Delícias</h2>
        <div class="row g-4 categorias-flex-container text-center">
            <?php
            $categorias = [
                "bolos" => "4.PNG",
                "docinhos" => "docinho.PNG",
                "sobremesas" => "pudim2.PNG",
                "bolos-personalizados" => "pers.PNG"
            ];
            foreach ($categorias as $cat => $img): ?>
                <div class="categoria-item-flex col-6 col-md-3 mb-3">
                    <div class="categoria-card p-2" id="filtro-<?= $cat ?>">
                        <img src="imagens/<?= $img ?>" class="img-fluid rounded mb-2" alt="<?= ucfirst($cat) ?>">
                        <h5><?= ucfirst(str_replace("-", " ", $cat)) ?></h5>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <section class="container mb-5">
        <div class="filter-section text-center mb-4">
            <label for="filter" class="form-label">Ou escolha seu ingrediente favorito:</label>
            <select class="form-select w-auto d-inline-block" id="filter">
                <option value="todos">Todos os ingredientes</option>
                <option value="morango">Morango</option>
                <option value="chocolate">Chocolate</option>
                <option value="abacaxi">Abacaxi</option>
                <option value="creme belga">Creme Belga</option>
                <option value="ninho">Ninho</option>
                <option value="brigadeiro">Brigadeiro</option>
                <option value="beijinho">Beijinho</option>
                <option value="amendoim">Amendoim</option>
                <option value="nata">Nata</option>
                <option value="quatro leites">Quatro Leites</option>
                <option value="maracuja">Maracujá</option>
                <option value="pessego">Pêssego</option>
                <option value="doce de leite">Doce de Leite</option>
                <option value="coco">Coco</option>
                <option value="tres leites">Três Leites</option>
                <option value="suspiro">Suspiro</option>
                <option value="nutella">Nutella</option>
                <option value="chocolate branco">Chocolate Branco</option>
                <option value="amendoa">Amêndoa</option>
                <option value="cereja">Cereja</option>
                <option value="ameixa">Ameixa</option>
                <option value="limao">Limão</option>
                <option value="cenoura">Cenoura</option>
                <option value="laranja">Laranja</option>
                <option value="caramelo">Caramelo</option>
                <option value="leite condensado">Leite Condensado</option>
                <option value="canela">Canela</option>
            </select>
        </div>

       <div class="row g-4" id="product-list">
    <?php if (!empty($produtos)): ?>
        <?php foreach ($produtos as $produto): 
            
        ?>
            <div class="col-6 col-md-3 mb-4 produto-item"
                 data-produto-id="<?= $produto['id'] ?>"
                 data-categoria="<?= htmlspecialchars($categoriaLower) ?>"
                 data-ingredientes="<?= htmlspecialchars($ingredientesFinal) ?>">
                <div class="card h-100 text-center position-relative">
                    <?php $isFav = in_array($produto['id'], $favoritos ?? []); ?>
                    <button class="favorite-btn position-absolute top-0 end-0 m-2" data-produto-id="<?= $produto['id'] ?>">
                       <i class="<?= $isFav ? 'fa-solid' : 'fa-regular' ?> fa-heart fs-3" style="color: pink;"></i>
                    </button>
                    
                
                  <img src="<?= !empty($produto['imagem_url']) ? htmlspecialchars($produto['imagem_url']) : 'imagens/placeholder.png'; ?>"
     alt="<?= htmlspecialchars($produto['nome']) ?>"
     class="card-img-top" style="height: 150px; object-fit: cover;" />
                    
              
                    <div class="card-body">
                        <h5 class="card-title mt-2"><?= htmlspecialchars($produto['nome']) ?></h5>
                        <div class="d-flex justify-content-center mt-2">
                            <a href="https://wa.me/5544988563181?text=<?= urlencode($mensagem) ?>"
                               target="_blank"
                               class="btn btn-success btn-eu-quero"
                               data-produto="<?= htmlspecialchars($produto['nome']) ?>"
                               data-categoria="<?= htmlspecialchars($categoriaLower) ?>">
                                Eu Quero
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12 text-center"><p>Nenhum produto encontrado.</p></div>
    <?php endif; ?>
</div>
    </section>

</main>

<?php include 'footer.php'; ?>

<script>
    window.favoritos = <?= json_encode($favoritos) ?>;
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
