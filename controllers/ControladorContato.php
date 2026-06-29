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

        // envia pela funcao de email do PHP quando a hospedagem a disponibiliza
        $destino = 'giulianoos@grupopanvel.com.br';
        $assunto = 'Fale conosco - Sebo Online';
        $corpo = "Nome: $nome\nEmail: $email\n\n$mensagem";
        $cabecalho = "From: nao-responda@sebo.com\r\nReply-To: $email";
        if (function_exists('mail')) {
            @mail($destino, $assunto, $corpo, $cabecalho);
        }

        header('location: views/contato.php?enviado=1');
        exit;
    }
}
