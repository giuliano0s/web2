<?php

// usuario do sistema; a senha e guardada como hash, nunca em texto
class Usuario
{
    use Magica;

    private $id;
    private $nome;
    private $email;
    private $senha;

    public function __toString()
    {
        return $this->nome;
    }
}
