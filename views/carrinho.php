<?php include __DIR__ . '/restrito.php'; ?>
<?php $titulo = 'Carrinho'; ?>
<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/../conexao.php'; ?>

<h1 class="mb-4">Meu carrinho</h1>

<?php if (($_GET['finalizado'] ?? '') === '1'): ?>
    <div class="alert alert-success">Compra finalizada. Obrigado!</div>
<?php endif; ?>

<?php
// itens do carrinho do usuario logado, com os dados do livro
$usuario_id = $_SESSION['usuario_id'];
$itens = $conexao->prepare(
    'SELECT p.id, p.titulo, p.preco, ca.quantidade
     FROM carrinho ca JOIN produto p ON p.id = ca.produto_id
     WHERE ca.usuario_id = ? ORDER BY p.titulo'
);
$itens->execute([$usuario_id]);
$resultado = $itens->fetchAll();
?>

<?php if (count($resultado) === 0): ?>
    <p>Seu carrinho está vazio. <a href="lista.php">Ver livros</a>.</p>
<?php else: ?>

    <?php // tabela dos itens com subtotal por linha e total no rodape ?>
    <table class="table">
        <thead>
            <tr><th>Livro</th><th>Qtd</th><th>Subtotal</th><th></th></tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($resultado as $item): ?>
                <?php $subtotal = $item['preco'] * $item['quantidade']; ?>
                <?php $total += $subtotal; ?>
                <tr>
                    <td><?= $item['titulo'] ?></td>
                    <td><?= $item['quantidade'] ?></td>
                    <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
                    <td><a href="../factory.php?controlador=carrinho&acao=remover&produto_id=<?= $item['id'] ?>">remover</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr><th>Total</th><th></th><th>R$ <?= number_format($total, 2, ',', '.') ?></th><th></th></tr>
        </tfoot>
    </table>

    <?php // finaliza a compra, esvaziando o carrinho ?>
    <form method="post" action="../factory.php?controlador=carrinho&acao=finalizar">
        <button type="submit" class="btn btn-success">Finalizar compra</button>
    </form>

<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
