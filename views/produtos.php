<?php $titulo = 'Produtos'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<h1 class="mb-4">Cadastro de livro</h1>

<?php if (($_GET['sucesso'] ?? '') === '1'): ?>
    <div class="alert alert-success">Livro cadastrado.</div>
<?php elseif (($_GET['erro'] ?? '') === 'dados'): ?>
    <div class="alert alert-danger">Preencha título, autor, preço maior que zero e escolha a categoria.</div>
<?php endif; ?>

<?php // formulario de cadastro de livro; categoria vem de um select do banco ?>
<form method="post" action="../factory.php?controlador=produto&acao=criar" class="col-md-6 mb-4">
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Autor</label>
        <input type="text" name="autor" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Preço</label>
        <input type="number" name="preco" step="0.01" min="0.01" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Categoria</label>
        <select name="categoria_id" class="form-select" required>
            <option value="">Escolha...</option>
            <?php foreach ($conexao->query('SELECT id, nome FROM categoria ORDER BY nome') as $linha): ?>
                <option value="<?= $linha['id'] ?>"><?= $linha['nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-dark">Cadastrar livro</button>
</form>

<?php // livros ja cadastrados, com a categoria pelo join ?>
<h2 class="h5">Livros cadastrados</h2>
<ul>
    <?php
    $sql = 'SELECT p.titulo, p.autor, p.preco, c.nome AS categoria
            FROM produto p JOIN categoria c ON c.id = p.categoria_id
            ORDER BY p.titulo';
    ?>
    <?php foreach ($conexao->query($sql) as $linha): ?>
        <li><?= $linha['titulo'] ?> - <?= $linha['autor'] ?> (<?= $linha['categoria'] ?>) R$ <?= number_format($linha['preco'], 2, ',', '.') ?></li>
    <?php endforeach; ?>
</ul>

<?php include __DIR__ . '/footer.php'; ?>
