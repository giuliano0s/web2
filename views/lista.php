<?php $titulo = 'Livros'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<h1 class="mb-4">Livros</h1>

<?php $categoria_id = $_GET['categoria_id'] ?? ''; ?>

<?php // filtro por categoria; vazio mostra todos os livros ?>
<form method="get" class="col-md-6 mb-4">
    <label class="form-label">Filtrar por categoria</label>
    <div class="input-group">
        <select name="categoria_id" class="form-select">
            <option value="">Todas as categorias</option>
            <?php foreach ($conexao->query('SELECT id, nome FROM categoria ORDER BY nome') as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $categoria_id == $c['id'] ? 'selected' : '' ?>><?= $c['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn btn-dark">Filtrar</button>
    </div>
</form>

<?php
// monta a consulta: todos os livros ou filtrados por categoria
$sql = 'SELECT p.id, p.titulo, p.autor, p.preco, c.nome AS categoria
        FROM produto p JOIN categoria c ON c.id = p.categoria_id';
if ($categoria_id !== '') {
    $sql .= ' WHERE p.categoria_id = ? ORDER BY p.titulo';
    $consulta = $conexao->prepare($sql);
    $consulta->execute([$categoria_id]);
    $produtos = $consulta->fetchAll();
} else {
    $produtos = $conexao->query($sql . ' ORDER BY p.titulo')->fetchAll();
}
?>

<?php // cards dos livros, cada um com link para o detalhe ?>
<div class="row">
    <?php foreach ($produtos as $p): ?>
        <div class="col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title"><?= $p['titulo'] ?></h2>
                    <p class="card-text mb-1"><?= $p['autor'] ?></p>
                    <p class="card-text text-muted"><?= $p['categoria'] ?></p>
                    <p class="card-text fw-bold">R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
                    <a href="detalhe.php?id=<?= $p['id'] ?>" class="btn btn-outline-dark btn-sm">Ver detalhe</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
