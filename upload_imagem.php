<?php
include __DIR__ . '/conexao.php'; 
session_start();

$mensagem = '';
$produto_id = (int)($_GET['produto_id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {

    if ($produto_id > 0 && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {

        $arquivoTmp = $_FILES['imagem']['tmp_name'];
        $nomeArquivo = time() . '_' . basename($_FILES['imagem']['name']);

       
        $pastaDestino = __DIR__ . '/imagens/';

       
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        $caminhoFinal = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
          
            $imagemUrl = 'imagens/' . $nomeArquivo;

           
            $stmt = $pdo->prepare("UPDATE produtos SET imagem_url = ? WHERE id = ?");
            $stmt->execute([$imagemUrl, $produto_id]);

            $mensagem = "Imagem enviada com sucesso!";
        } else {
            $mensagem = "Erro ao mover a imagem para a pasta do projeto.";
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-4">
    <h2 class="text-center mb-4">Adicionar Imagem ao Produto</h2>

    <?php if ($mensagem): ?>
        <div class="alert alert-info text-center"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
        <div class="mb-3">
            <label for="imagem" class="form-label">Selecione a imagem:</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar Imagem</button>
    </form>

    <div class="text-center mt-3">
        <a href="index.php?page=produtos_listar" class="btn btn-secondary">Voltar para Produtos</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
