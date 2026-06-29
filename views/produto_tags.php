<?php $titulo = 'Tags do livro'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<h1 class="mb-4">Tags do livro</h1>

<?php // escolha do livro; recarrega a pagina com o produto_id na URL ?>
<form method="get" class="col-md-6 mb-4">
    <label class="form-label">Livro</label>
    <div class="input-group">
        <select name="produto_id" class="form-select" required>
            <option value="">Escolha...</option>
            <?php foreach ($conexao->query('SELECT id, titulo FROM produto ORDER BY titulo') as $p): ?>
                <option value="<?= $p['id'] ?>" <?= ($_GET['produto_id'] ?? '') == $p['id'] ? 'selected' : '' ?>><?= $p['titulo'] ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn btn-dark">Abrir</button>
    </div>
</form>

<?php $produto_id = $_GET['produto_id'] ?? ''; ?>
<?php if ($produto_id !== ''): ?>

    <?php // tags ja associadas a este livro, cada uma com a opcao de remover ?>
    <h2 class="h5">Tags associadas</h2>
    <ul>
        <?php
        $associadas = $conexao->prepare(
            'SELECT t.id, t.nome FROM tag t
             JOIN produto_tag pt ON pt.tag_id = t.id
             WHERE pt.produto_id = ? ORDER BY t.nome'
        );
        $associadas->execute([$produto_id]);
        ?>
        <?php foreach ($associadas as $t): ?>
            <li>
                <?= $t['nome'] ?>
                <a href="../factory.php?controlador=produtoTag&acao=remover&produto_id=<?= $produto_id ?>&tag_id=<?= $t['id'] ?>">remover</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php // associa uma tag ainda nao vinculada ao livro ?>
    <h2 class="h5">Associar tag</h2>
    <form method="post" action="../factory.php?controlador=produtoTag&acao=associar" class="col-md-6">
        <input type="hidden" name="produto_id" value="<?= $produto_id ?>">
        <div class="input-group">
            <select name="tag_id" class="form-select" required>
                <option value="">Escolha...</option>
                <?php
                $livres = $conexao->prepare(
                    'SELECT id, nome FROM tag
                     WHERE id NOT IN (SELECT tag_id FROM produto_tag WHERE produto_id = ?)
                     ORDER BY nome'
                );
                $livres->execute([$produto_id]);
                ?>
                <?php foreach ($livres as $t): ?>
                    <option value="<?= $t['id'] ?>"><?= $t['nome'] ?></option>
                <?php endforeach; ?>
            </select>
            <button class="btn btn-dark">Associar</button>
        </div>
    </form>

<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
