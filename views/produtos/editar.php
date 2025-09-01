<h1>Editar Produto</h1>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br><br>
    Descrição: <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" required><br><br>
    Preço: <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br><br>
    <button type="submit">Atualizar</button>
</form>
