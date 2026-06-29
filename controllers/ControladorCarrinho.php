<?php

class ControladorCarrinho
{
    public function adicionar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/lista.php');
            exit;
        }

        // exige login para mexer no carrinho
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('location: views/index.php?restrito=1');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        // adiciona o livro ao carrinho do usuario; repetido soma a quantidade
        $usuario_id = $_SESSION['usuario_id'];
        $produto_id = $_POST['produto_id'] ?? '';
        if ($produto_id !== '') {
            $insere = $conexao->prepare(
                'INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, 1)
                 ON DUPLICATE KEY UPDATE quantidade = quantidade + 1'
            );
            $insere->execute([$usuario_id, $produto_id]);
        }

        header('location: views/carrinho.php');
        exit;
    }

    public function finalizar()
    {
        // exige login para finalizar a compra
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('location: views/index.php?restrito=1');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        // esvazia o carrinho do usuario, simulando a compra concluida
        $usuario_id = $_SESSION['usuario_id'];
        $limpa = $conexao->prepare('DELETE FROM carrinho WHERE usuario_id = ?');
        $limpa->execute([$usuario_id]);

        header('location: views/carrinho.php?finalizado=1');
        exit;
    }

    public function remover()
    {
        // exige login para mexer no carrinho
        session_start();
        if (!isset($_SESSION['usuario_id'])) {
            header('location: views/index.php?restrito=1');
            exit;
        }

        include __DIR__ . '/../conexao.php';

        // remove o livro do carrinho do usuario
        $usuario_id = $_SESSION['usuario_id'];
        $produto_id = $_GET['produto_id'] ?? '';
        if ($produto_id !== '') {
            $remove = $conexao->prepare('DELETE FROM carrinho WHERE usuario_id = ? AND produto_id = ?');
            $remove->execute([$usuario_id, $produto_id]);
        }

        header('location: views/carrinho.php');
        exit;
    }
}
