<?php
session_start();

$mensagem = '';

// Salva nome e preço na sessão se vier via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['nome_produto'] = $_POST['nome'] ?? '';
    $_SESSION['preco_produto'] = $_POST['preco'] ?? '';
}

// Processa upload de imagem
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
    if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['imagem']['tmp_name'];
        $nomeArquivo = time() . '_' . basename($_FILES['imagem']['name']); 
        $pastaDestino = __DIR__ . '/../imagens/';

        if (!is_dir($pastaDestino)) mkdir($pastaDestino, 0777, true);

        $caminhoFinal = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
            $mensagem = "Imagem enviada com sucesso!";
        } else {
            $mensagem = "Erro ao mover a imagem para a pasta de destino.";
        }
    } else {
        $mensagem = "Nenhuma imagem selecionada ou erro no upload.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload de Imagem</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="admin.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="page-produtos">

<?php include __DIR__ . '/views/admin/navbar_admin.php'; ?>

<div class="container py-4">
    <h2 class="text-center mb-4">Adicionar Imagem</h2>

    <?php if ($mensagem): ?>
        <div class="alert alert-info text-center"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="imagem" class="form-label">Selecione a imagem:</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
        </div>

        <div class="d-grid mt-4">
            <button type="submit" class="btn btn-success">
                <i class="fas fa-upload me-2"></i>Enviar Imagem
            </button>
        </div>
    </form>

    <div class="text-center mt-3">
        <a href="index.php?page=produtos_cadastrar" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Voltar para Cadastro
        </a>
    </div>
</div>

<?php include __DIR__ . '/views/admin/footer_admin.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
