<?php

// livro do catalogo; pertence a uma categoria por categoria_id
class Produto
{
    use Magica;

    private $id;
    private $titulo;
    private $autor;
    private $preco;
    private $categoria_id;

    public function __toString()
    {
        return $this->titulo;
    }
}
