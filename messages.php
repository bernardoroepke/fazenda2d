<?php

function messagesRegistro() {
  if(isset($_GET['m'])) {    
    $msg = $_GET['m'];

    if ($msg == 's')
    {
        echo "<div class='alert alert-success' role='alert'>Conta criada com sucesso!</div>";
    }

    if ($msg == 'e1')
    {
        echo "<div class='alert alert-danger' role='alert'>As senhas informadas não correspondem!</div>";
    }

    if ($msg == 'e2')
    {
        echo "<div class='alert alert-danger' role='alert'>E-mail ou Login já existem!</div>";
    }
  }
}

function messagesLogin() {
  if(isset($_GET['m'])) {            
    $msg = $_GET['m'];

    if ($msg == 'e1')
    {
        echo "<div class='alert alert-danger' role='alert'>Usuário ou senha inválida!</div>";
    }

    if ($msg == 'e2')
    {
        echo "<div class='alert alert-danger' role='alert'>Sua conta está banida!</div>";
    }
  }
}

function messagesMercado() {
  if(isset($_GET['m'])) {            
    $msg = $_GET['m'];

    if ($msg == 's')
    {
        echo "<div class='alert alert-success' role='alert'>Compra efetuada com sucesso!</div>";
    }

    if ($msg == 'e1')
    {
        echo "<div class='alert alert-danger' role='alert'>Você não tem moedas o suficiente!</div>";
    }
  }
}

function messagesInventario() {
  if(isset($_GET['m'])) {            
    $msg = $_GET['m'];

    if ($msg == 's')
    {
        echo "<div class='alert alert-success' role='alert'>Venda efetuada com sucesso!</div>";
    }

    if ($msg == 'e1')
    {
        echo "<div class='alert alert-danger' role='alert'>Você não tem no estoque o suficiente para a venda!</div>";
    }
  }
}

?>