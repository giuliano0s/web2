<?php

class ControladorProduto
{
    public function criar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/produtos.php');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        $titulo = trim($_POST['titulo'] ?? '');
        $autor = trim($_POST['autor'] ?? '');
        $preco = $_POST['preco'] ?? '';
        $categoria_id = $_POST['categoria_id'] ?? '';

        // validacao no backend
        if ($titulo === '' || $autor === '' || !is_numeric($preco) || $preco <= 0 || $categoria_id === '') {
            header('location: views/produtos.php?erro=dados');
            exit;
        }

        // grava o livro
        $produto = new Produto();
        $produto->titulo = $titulo;
        $produto->autor = $autor;
        $produto->preco = $preco;
        $produto->categoria_id = $categoria_id;

        $insere = $conexao->prepare('INSERT INTO produto (titulo, autor, preco, categoria_id) VALUES (?, ?, ?, ?)');
        $insere->execute([$produto->titulo, $produto->autor, $produto->preco, $produto->categoria_id]);

        header('location: views/produtos.php?sucesso=1');
        exit;
    }
}
