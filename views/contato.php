<?php $titulo = 'Fale conosco'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Fale conosco</h1>

<?php // confirmacao de envio ou erro de validacao ?>
<?php if (($_GET['enviado'] ?? '') === '1'): ?>
    <div class="alert alert-success">Mensagem enviada. Obrigado pelo contato.</div>
<?php elseif (($_GET['erro'] ?? '') === 'dados'): ?>
    <div class="alert alert-danger">Preencha o nome, um email válido e a mensagem.</div>
<?php endif; ?>

<?php // formulario de contato com validacao no front ?>
<form method="post" action="../factory.php?controlador=contato&acao=enviar" class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mensagem</label>
        <textarea name="mensagem" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Enviar</button>
</form>

<?php include __DIR__ . '/footer.php'; ?>
