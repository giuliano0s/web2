<?php $titulo = 'Detalhe'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<?php
// busca o livro pelo id recebido na URL, com o nome da categoria
$id = $_GET['id'] ?? '';
$consulta = $conexao->prepare(
    'SELECT p.id, p.titulo, p.autor, p.preco, c.nome AS categoria
     FROM produto p JOIN categoria c ON c.id = p.categoria_id
     WHERE p.id = ?'
);
$consulta->execute([$id]);
$livro = $consulta->fetch();
?>

<?php if (!$livro): ?>
    <div class="alert alert-warning">Livro não encontrado.</div>
<?php else: ?>

    <?php // dados do livro ?>
    <h1 class="mb-1"><?= $livro['titulo'] ?></h1>
    <p class="text-muted"><?= $livro['autor'] ?> &bull; <?= $livro['categoria'] ?></p>
    <p class="h4 mb-4">R$ <?= number_format($livro['preco'], 2, ',', '.') ?></p>

    <?php
    // tags do livro pela tabela de juncao
    $tags = $conexao->prepare(
        'SELECT t.nome FROM tag t
         JOIN produto_tag pt ON pt.tag_id = t.id
         WHERE pt.produto_id = ? ORDER BY t.nome'
    );
    $tags->execute([$id]);
    ?>
    <p>
        <?php foreach ($tags as $t): ?>
            <span class="badge bg-secondary"><?= $t['nome'] ?></span>
        <?php endforeach; ?>
    </p>

    <?php // botao de compra: leva o livro para o carrinho ?>
    <form method="post" action="../factory.php?controlador=carrinho&acao=adicionar">
        <input type="hidden" name="produto_id" value="<?= $livro['id'] ?>">
        <button type="submit" class="btn btn-dark">Comprar</button>
    </form>

<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
