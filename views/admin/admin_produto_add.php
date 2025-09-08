<?php
require_once 'conexao.php';
session_start();

if(!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}


$stmt = $pdo->query("SELECT id, nome FROM categorias ORDER BY nome ASC");
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['salvar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $categoria_id = $_POST['categoria_id'];

    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0){
        $ext = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novo_nome = time().".".$ext;
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../uploads/".$novo_nome);
    } else {
        $novo_nome = null;
    }

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, categoria_id) 
            VALUES (:nome, :descricao, :preco, :imagem, :categoria_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':descricao' => $descricao,
        ':preco' => $preco,
        ':imagem' => $novo_nome,
        ':categoria_id' => $categoria_id
    ]);

    header("Location: admin_produtos.php");
    exit;
}
?>

<h1>Adicionar Produto</h1>
<form method="post" enctype="multipart/form-data">
    Nome: <input type="text" name="nome" required><br><br>
    Descrição: <textarea name="descricao"></textarea><br><br>
    Preço: <input type="text" name="preco" required><br><br>
    Categoria:
    <select name="categoria_id" required>
        <option value="">Selecione</option>
        <?php foreach($categorias as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Imagem: <input type="file" name="imagem"><br><br>
    <button type="submit" name="salvar">Salvar</button>
</form>
