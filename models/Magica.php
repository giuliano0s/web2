<?php

trait Magica
{
    // acessores genericos: grava e le qualquer atributo privado do model
    public function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    public function __get($atributo)
    {
        return $this->$atributo;
    }
}
