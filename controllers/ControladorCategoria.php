<?php

class ControladorCategoria
{
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/categorias.php');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        $nome = trim($_POST['nome'] ?? '');
        if ($nome === '') {
            header('location: views/categorias.php?erro=nome');
            exit;
        }

        // nome de categoria e unico
        $busca = $conexao->prepare('SELECT id FROM categoria WHERE nome = ?');
        $busca->execute([$nome]);
        if ($busca->fetch()) {
            header('location: views/categorias.php?erro=repetida');
            exit;
        }

        // grava a categoria
        $categoria = new Categoria();
        $categoria->nome = $nome;

        $insere = $conexao->prepare('INSERT INTO categoria (nome) VALUES (?)');
        $insere->execute([$categoria->nome]);

        header('location: views/categorias.php?sucesso=1');
        exit;
    }
}
