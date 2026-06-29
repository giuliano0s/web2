<?php

class ControladorUsuario
{
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/cadastro.php');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // validacao no backend, um erro por campo
        if ($nome === '') {
            header('location: views/cadastro.php?erro=nome');
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('location: views/cadastro.php?erro=email_invalido');
            exit;
        }
        if (strlen($senha) < 6) {
            header('location: views/cadastro.php?erro=senha');
            exit;
        }

        // email ja cadastrado
        $busca = $conexao->prepare('SELECT id FROM usuario WHERE email = ?');
        $busca->execute([$email]);
        if ($busca->fetch()) {
            header('location: views/cadastro.php?erro=email');
            exit;
        }

        // grava com a senha em hash
        $usuario = new Usuario();
        $usuario->nome = $nome;
        $usuario->email = $email;
        $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);

        $insere = $conexao->prepare('INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)');
        $insere->execute([$usuario->nome, $usuario->email, $usuario->senha]);

        header('location: views/cadastro.php?sucesso=1');
        exit;
    }

    public function verificar()
    {
        include __DIR__ . '/../conexao.php';

        // responde ao AJAX se o email ja esta cadastrado
        $email = trim($_GET['email'] ?? '');
        $busca = $conexao->prepare('SELECT id FROM usuario WHERE email = ?');
        $busca->execute([$email]);
        echo $busca->fetch() ? 'existe' : 'livre';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/index.php');
            exit;
        }

        session_start();
        include __DIR__ . '/../conexao.php';

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';

        // busca o usuario pelo email
        $busca = $conexao->prepare('SELECT id, nome, senha FROM usuario WHERE email = ?');
        $busca->execute([$email]);
        $usuario = $busca->fetch();

        // confere a senha e abre a sessao
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header('location: views/index.php');
            exit;
        }

        header('location: views/index.php?erro=login');
        exit;
    }

    public function sair()
    {
        // encerra a sessao do usuario
        session_start();
        session_destroy();
        header('location: views/index.php?saiu=1');
        exit;
    }
}
