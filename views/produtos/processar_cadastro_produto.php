<?php
include __DIR__ . '/../../conexao.php';
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
   
    $nome = $_POST['nome'] ?? '';
    $preco = $_POST['preco'] ?? 0;

    
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $arquivoTmp = $_FILES['imagem']['tmp_name'];
        $nomeArquivo = time() . '_' . basename($_FILES['imagem']['name']); 
        
       
        $pastaDestino = __DIR__ . '/../../imagens/';
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0777, true);
        }

        $caminhoFinal = $pastaDestino . $nomeArquivo;

        
        if (move_uploaded_file($arquivoTmp, $caminhoFinal)) {
            $imagemUrl = 'imagens/' . $nomeArquivo; 

           
            $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, imagem_url, ativo) VALUES (?, ?, ?, 1)");
            $stmt->execute([$nome, $preco, $imagemUrl]);

           
            header("Location: cadastrar.php?sucesso=1");
            exit;

        } else {
            echo "Erro ao mover a imagem para a pasta.";
            exit;
        }

    } else {
        echo "Nenhuma imagem selecionada ou ocorreu um erro no upload.";
        exit;
    }

} else {
    echo "Acesso inválido.";
    exit;
}
?>
