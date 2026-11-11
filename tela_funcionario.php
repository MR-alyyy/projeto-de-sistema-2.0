<?php
session_start();

if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'funcionario') {
    header('Location: login_funcionario.php');
    exit;
}

header('Location: menu_fun.php');
exit;
