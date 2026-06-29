<?php

// categoria de livro; lado "um" da relacao com produto
class Categoria
{
    use Magica;

    private $id;
    private $nome;

    public function __toString()
    {
        return $this->nome;
    }
}
