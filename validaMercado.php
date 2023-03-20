<?php

include("functions.php");
$logado = verificarLogin();

if($logado <> 1) {
    header("Location: login.php");
}

$usuario        = $_SESSION['usuario'];
$usuario_id     = $usuario->usuario_id;

if (isset($_POST['mercado_id']) AND isset($_POST['quantidade'])) {
    if($_POST['quantidade']) {
        $mercado_id = $_POST['mercado_id'];
        $quantidade = $_POST['quantidade'];
    
        $saldo      = verificaSaldo($usuario_id);
        $mercadoria = verificaMercadoria($mercado_id);
       
        $preco = $mercadoria->mercado_preco;
        $total = $preco * $quantidade;
    
        if($total > $saldo) {
            Header("Location: index.php?p=2&m=e1");
        } else {
            subMoeda($usuario_id, $total);
            addInventario($usuario_id, $mercado_id, $quantidade);
            Header("Location: index.php?p=2&m=s");
        }
    } else {
        Header("Location: index.php?p=2");
    }
}

?>