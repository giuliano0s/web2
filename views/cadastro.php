<?php $titulo = 'Cadastro'; ?>
<?php include __DIR__ . '/header.php'; ?>

<h1 class="mb-4">Cadastro de usuário</h1>

<?php // mensagens de validacao, uma por campo, vindas do controller ?>
<?php $erro = $_GET['erro'] ?? ''; ?>
<?php if (($_GET['sucesso'] ?? '') === '1'): ?>
    <div class="alert alert-success">Cadastro realizado. Você já pode fazer login.</div>
<?php elseif ($erro === 'nome'): ?>
    <div class="alert alert-danger">Informe o nome.</div>
<?php elseif ($erro === 'email_invalido'): ?>
    <div class="alert alert-danger">Email inválido. Use um endereço completo, como nome@dominio.com.</div>
<?php elseif ($erro === 'senha'): ?>
    <div class="alert alert-danger">A senha precisa de ao menos 6 caracteres.</div>
<?php elseif ($erro === 'email'): ?>
    <div class="alert alert-danger">Esse email já está cadastrado.</div>
<?php endif; ?>

<?php // formulario de cadastro com validacao no front (required, type, minlength) ?>
<form method="post" action="../factory.php?controlador=usuario&acao=criar" class="col-md-6">
    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
        <div id="avisoEmail" class="form-text text-danger"></div>
    </div>
    <div class="mb-3">
        <label class="form-label">Senha</label>
        <input type="password" name="senha" class="form-control" minlength="6" required>
    </div>
    <button type="submit" class="btn btn-dark">Cadastrar</button>
</form>

<script>
    // checa via AJAX se o email ja existe 
    const campoEmail = document.getElementById('email')
    const avisoEmail = document.getElementById('avisoEmail')

    campoEmail.addEventListener('blur', () => {
        const email = campoEmail.value.trim()
        if (email === '') {
            avisoEmail.textContent = ''
            return
        }

        fetch('../factory.php?controlador=usuario&acao=verificar&email=' + encodeURIComponent(email))
            .then(resposta => resposta.text())
            .then(texto => {
                avisoEmail.textContent = texto === 'existe' ? 'Esse email ja esta cadastrado.' : ''
            })
    })
</script>

<?php include __DIR__ . '/footer.php'; ?>
