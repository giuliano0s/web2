<?php // cabecalho comum: meta plagio, Bootstrap e menu de navegacao ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="plagiarism" content="Trabalho individual de Web 2. Conteudo autoral.">
    <title><?= $titulo ?? 'Sebo Online' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Sebo Online</a>
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="lista.php">Livros</a></li>
            <li class="nav-item"><a class="nav-link" href="categorias.php">Categorias</a></li>
            <li class="nav-item"><a class="nav-link" href="produtos.php">Novo livro</a></li>
            <li class="nav-item"><a class="nav-link" href="tags.php">Tags</a></li>
            <li class="nav-item"><a class="nav-link" href="produto_tags.php">Vincular tags</a></li>
            <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastro</a></li>
            <li class="nav-item"><a class="nav-link" href="contato.php">Fale conosco</a></li>
            <li class="nav-item"><a class="nav-link" href="termos.php">Termos</a></li>
            <li class="nav-item"><a class="nav-link" href="carrinho.php">Carrinho</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php">Entrar</a></li>
        </ul>
    </div>
</nav>
<main class="container my-4">
