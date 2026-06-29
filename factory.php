<?php

// liga o autoload antes de instanciar qualquer classe
require __DIR__ . '/util/autoload.php';

// roteamento: controlador e acao vindos da URL
$controlador = $_GET['controlador'] ?? 'usuario';
$acao = $_GET['acao'] ?? 'criar';

$classe = 'Controlador' . ucfirst($controlador);
$objeto = new $classe();
$objeto->{$acao}();
