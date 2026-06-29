<?php

class ControladorContato
{
    public function enviar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('location: views/contato.php');
            exit;
        }

        // validacao no backend
        $nome = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $mensagem = trim($_POST['mensagem'] ?? '');
        if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $mensagem === '') {
            header('location: views/contato.php?erro=dados');
            exit;
        }

        // envia o email; entrega de fato na versao hospedada
        $destino = 'giulianoos@grupopanvel.com.br';
        $assunto = 'Fale conosco - Sebo Online';
        $corpo = "Nome: $nome\nEmail: $email\n\n$mensagem";
        $cabecalho = "From: nao-responda@sebo.com\r\nReply-To: $email";
        $ok = function_exists('mail') ? @mail($destino, $assunto, $corpo, $cabecalho) : false;

        header('location: views/contato.php?enviado=' . ($ok ? '1' : 'falhou'));
        exit;
    }
}
