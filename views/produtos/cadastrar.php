<?php include __DIR__ . '/../admin/navbar_admin.php'; ?>

<h1>Cadastrar Produto</h1>
<form method="post">
    Nome: <input type="text" name="nome" required><br><br>
    Descrição: <input type="text" name="descricao" required><br><br>
    Preço: <input type="number" step="0.01" name="preco" required><br><br>
    <button type="submit">Cadastrar</button>
</form>

<?php include __DIR__ . '/../admin/footer_admin.php'; ?>