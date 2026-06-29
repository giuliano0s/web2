<?php

// credenciais do banco
$host  = 'localhost';
$banco = 'sebo';
$usuario = 'root';
$senha = '';

// conexao PDO com utf8mb4
$dsn = "mysql:host=$host;dbname=$banco;charset=utf8mb4";
$conexao = new PDO($dsn, $usuario, $senha);
$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
