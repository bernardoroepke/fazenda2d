<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Checando se todos os dados foram informados
if (isset($_POST['login']) AND isset($_POST['senha'])) {
    $login        = $_POST['login'];
    $senha      = $_POST['senha'];

    include("functions.php");
    $registrado = checaLogin($login, md5($senha));

    if($registrado) {
        session_start();
        $usuario            = $_SESSION['usuario']; 
        $usuario_ban        = $usuario->usuario_ban; 
        $usuario_ativo      = $usuario->usuario_ativo; 
        if ($usuario_ban == 0 AND $usuario_ativo == 1) {
            $_SESSION['logado'] = 1;
            Header("Location: index.php");
        } else {
            Header("Location: login.php?m=e2");
        }
    } else {
        Header("Location: login.php?m=e1");
    }
}

?>