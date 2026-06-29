<?php

// barra o acesso sem login; incluido no topo das paginas restritas
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('location: index.php?restrito=1');
    exit;
}
