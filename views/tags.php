<?php $titulo = 'Tags'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<h1 class="mb-4">Tags</h1>

<?php $erro = $_GET['erro'] ?? ''; ?>
<?php if (($_GET['sucesso'] ?? '') === '1'): ?>
    <div class="alert alert-success">Tag criada.</div>
<?php elseif ($erro === 'nome'): ?>
    <div class="alert alert-danger">Informe o nome da tag.</div>
<?php elseif ($erro === 'repetida'): ?>
    <div class="alert alert-danger">Essa tag já existe.</div>
<?php endif; ?>

<?php // formulario de nova tag ?>
<form method="post" action="../factory.php?controlador=tag&acao=criar" class="col-md-6 mb-4">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-dark">Criar tag</button>
</form>

<?php // tags ja cadastradas ?>
<h2 class="h5">Tags cadastradas</h2>
<ul>
    <?php foreach ($conexao->query('SELECT nome FROM tag ORDER BY nome') as $linha): ?>
        <li><?= $linha['nome'] ?></li>
    <?php endforeach; ?>
</ul>

<?php include __DIR__ . '/footer.php'; ?>
