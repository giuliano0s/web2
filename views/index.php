<?php session_start(); ?>
<?php $titulo = 'Entrar'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Entrar</h1>

<?php // mensagens de login, logout e bloqueio de area restrita ?>
<?php if (($_GET['erro'] ?? '') === 'login'): ?>
    <div class="alert alert-danger">Email ou senha incorretos.</div>
<?php elseif (($_GET['saiu'] ?? '') === '1'): ?>
    <div class="alert alert-info">Você saiu da sua conta.</div>
<?php elseif (($_GET['restrito'] ?? '') === '1'): ?>
    <div class="alert alert-warning">Faça login para acessar essa página.</div>
<?php endif; ?>

<?php // logado mostra o nome e o sair; deslogado mostra o formulario ?>
<?php if (isset($_SESSION['usuario_id'])): ?>
    <p>Logado como <strong><?= $_SESSION['usuario_nome'] ?></strong>.</p>
    <a href="../factory.php?controlador=usuario&acao=sair" class="btn btn-outline-dark">Sair</a>
<?php else: ?>
    <form method="post" action="../factory.php?controlador=usuario&acao=login" class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark">Entrar</button>
    </form>
    <p class="mt-3">Não tem conta? <a href="cadastro.php">Cadastre-se</a>.</p>
<?php endif; ?>

<?php include __DIR__ . '/footer.php'; ?>
