<?php

class ControladorTag
{
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/tags.php');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        $nome = trim($_POST['nome'] ?? '');
        if ($nome === '') {
            header('location: views/tags.php?erro=nome');
            exit;
        }

        // nome de tag e unico
        $busca = $conexao->prepare('SELECT id FROM tag WHERE nome = ?');
        $busca->execute([$nome]);
        if ($busca->fetch()) {
            header('location: views/tags.php?erro=repetida');
            exit;
        }

        // grava a tag
        $tag = new Tag();
        $tag->nome = $nome;

        $insere = $conexao->prepare('INSERT INTO tag (nome) VALUES (?)');
        $insere->execute([$tag->nome]);

        header('location: views/tags.php?sucesso=1');
        exit;
    }
}
