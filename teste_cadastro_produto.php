<?php
include __DIR__ . '/conexao.php'; // Conexão com o banco
session_start();

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'] ?? '';
    $preco = (float)($_POST['preco'] ?? 0);
    $estoque = (int)($_POST['estoque'] ?? 0); // <-- estoque adicionado

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $arquivoTmp = $_FILES['imagem']['tmp_name'];
        $nomeArquivo = time() . '_' . basename($_FILES['imagem']['name']);
        $pastaDestino = __DIR__ . '/imagens/';

        
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        $caminhoFinal = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {

            $imagemUrl = 'imagens/' . $nomeArquivo;

            // SALVA NO BANCO COM ESTOQUE
            $stmt = $pdo->prepare("
                INSERT INTO produtos (nome, preco, estoque, imagem_url, ativo) 
                VALUES (?, ?, ?, ?, 1)
            ");
            $stmt->execute([$nome, $preco, $estoque, $imagemUrl]);

            $mensagem = "Produto cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao mover a imagem.";
        }
    } else {
        $mensagem = "Erro no upload da imagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastrar Produto</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/views/admin/navbar_admin.php'; ?>

<div class="main-container container py-4">
    <h2 class="section-title mb-4 text-center">Cadastrar Novo Produto</h2>

    <?php if ($mensagem): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4">
               <form method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">Nome do Produto</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="text" name="preco" class="form-control" placeholder="R$ 0,00" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Estoque Inicial</label>
                        <input type="number" name="estoque" class="form-control" min="0" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagem do Produto</label>
                        <input type="file" name="imagem" class="form-control" accept="image/*" required>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-pink">
                            <i class="fas fa-plus me-2"></i>Cadastrar Produto
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/views/admin/footer_admin.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
