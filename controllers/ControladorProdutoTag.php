<?php

class ControladorProdutoTag
{
    public function associar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/produto_tags.php');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        $produto_id = $_POST['produto_id'] ?? '';
        $tag_id = $_POST['tag_id'] ?? '';

        // grava a associacao; INSERT IGNORE descarta um par repetido
        if ($produto_id !== '' && $tag_id !== '') {
            $insere = $conexao->prepare('INSERT IGNORE INTO produto_tag (produto_id, tag_id) VALUES (?, ?)');
            $insere->execute([$produto_id, $tag_id]);
        }

        header("location: views/produto_tags.php?produto_id=$produto_id");
        exit;
    }

    public function remover()
    {
        include __DIR__ . '/../conexao.php';

        $produto_id = $_GET['produto_id'] ?? '';
        $tag_id = $_GET['tag_id'] ?? '';

        // desfaz a associacao do par produto/tag
        if ($produto_id !== '' && $tag_id !== '') {
            $remove = $conexao->prepare('DELETE FROM produto_tag WHERE produto_id = ? AND tag_id = ?');
            $remove->execute([$produto_id, $tag_id]);
        }

        header("location: views/produto_tags.php?produto_id=$produto_id");
        exit;
    }
}
