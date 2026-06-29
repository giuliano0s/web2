<?php

// tag associavel a varios produtos pela tabela de juncao produto_tag
class Tag
{
    use Magica;

    private $id;
    private $nome;

    public function __toString()
    {
        return $this->nome;
    }
}
