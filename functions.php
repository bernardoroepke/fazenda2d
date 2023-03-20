<?php

function checaRegistro($email, $login) {
    try {
    
        include("bd/conexao.php");   
        
        $sql    = "SELECT * FROM g_usuarios WHERE usuario_login = ? OR usuario_email = ?";
        $rs     = $PDO->prepare($sql);

        $rs->bindParam(1, $login);
        $rs->bindParam(2, $email);

        if($rs->execute()) {

            $registros = $rs->rowCount();
            //$row = $rs->fetch(PDO::FETCH_OBJ);

            if($registros >= 1)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
    catch (Exception $e) {
        echo 'Exceção capturada: ',  $e->getMessage(), "\n";
    }
        
}

function checaLogin($login, $senha) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_usuarios WHERE usuario_login = ? AND usuario_senha = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $login);
    $rs->bindParam(2, $senha);

    if($rs->execute()) {
        $registrado = $rs->rowCount();
        $row = $rs->fetch(PDO::FETCH_OBJ);

        if($registrado == 1) {
            session_start();
            return $_SESSION['usuario'] = $row;
        } else {
            return false;
        }
    }
}

function verificarLogin() {
    session_start();

    if(isset($_SESSION['logado'])) {        
        if($_SESSION['logado'] == 1) {
        return 1;
        }
    } 
    else {
        return 0;
    }
}

function mostraMercado() {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_mercado";
    $rs     = $PDO->prepare($sql);

    if($rs->execute()) {
        $mercado = $rs->fetchAll();
        return $mercado;
    }
}

function mostraInventario($usuario_id) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_mercado AS m, g_inventario AS i
    WHERE i.mercado_id = m.mercado_id AND i.usuario_id = ?";    
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);

    if($rs->execute()) {
        $inventario = $rs->fetchAll();
    }
    
    return $inventario;
}

function verificaMercadoria($mercado_id) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_mercado WHERE mercado_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $mercado_id);

    if($rs->execute()) {
        $mercadoria = $rs->fetch(PDO::FETCH_OBJ);
    
        return $mercadoria;
    }
}

function verificaSaldo($usuario_id) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_usuarios WHERE usuario_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);

    if($rs->execute()) {
        $row = $rs->fetch(PDO::FETCH_OBJ);
        $saldo = $row->usuario_moedas;

        return $saldo;
    }
}

function verificaNivel($usuario_id) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_usuarios WHERE usuario_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);

    if($rs->execute()) {
        $row = $rs->fetch(PDO::FETCH_OBJ);
        $nivel = $row->usuario_nivel;

        return $nivel;
    }
}

function verificaInventario($usuario_id, $mercado_id) {
    include("bd/conexao.php");   
            
    $sql    = "SELECT * FROM g_inventario WHERE usuario_id = ? AND mercado_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);
    $rs->bindParam(2, $mercado_id);

    if($rs->execute()) {
        $row = $rs->fetch(PDO::FETCH_OBJ);
        $mercado_qtd = $row->mercado_qtd;        
        
        return $mercado_qtd;
    }
}

function addMoeda($usuario_id, $moedas) {
    include("bd/conexao.php");   
    
    $sql    = "UPDATE g_usuarios SET usuario_moedas = usuario_moedas + ? WHERE usuario_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $moedas);
    $rs->bindParam(2, $usuario_id);

    $rs->execute();
}

function subMoeda($usuario_id, $moedas) {
    include("bd/conexao.php");   
    
    $sql    = "UPDATE g_usuarios SET usuario_moedas = usuario_moedas - ? WHERE usuario_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $moedas);
    $rs->bindParam(2, $usuario_id);

    $rs->execute();
}

function addInventario($usuario_id, $mercado_id, $quantidade) {
    include("bd/conexao.php");   
        
    $sql    = "SELECT * FROM g_inventario WHERE usuario_id = ? AND mercado_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);
    $rs->bindParam(2, $mercado_id);

    if($rs->execute()){
        $existe_mercado = $rs->rowCount();
        if ($existe_mercado == 1) {
            $sql    = "UPDATE g_inventario SET mercado_qtd = mercado_qtd + ? WHERE usuario_id = ? AND mercado_id = ?";
            $rs     = $PDO->prepare($sql);

            $rs->bindParam(1, $quantidade);
            $rs->bindParam(2, $usuario_id);
            $rs->bindParam(3, $mercado_id);

        
            $rs->execute();
        } else {
            $sql    = "INSERT INTO g_inventario(inv_id, usuario_id, mercado_id, mercado_qtd) VALUES(?,?,?,?)";
            $rs     = $PDO->prepare($sql);

            $inv_id = null;

            $rs->bindParam(1, $inv_id);
            $rs->bindParam(2, $usuario_id);
            $rs->bindParam(3, $mercado_id);
            $rs->bindParam(4, $quantidade);

            $rs->execute();
        }
    }
}
    
function subInventario($usuario_id, $mercado_id, $quantidade) {
    include("bd/conexao.php");
            
    $sql    = "SELECT * FROM g_inventario WHERE usuario_id = ? AND mercado_id = ?";
    $rs     = $PDO->prepare($sql);

    $rs->bindParam(1, $usuario_id);
    $rs->bindParam(2, $mercado_id);

    if($rs->execute()){
        $item                  = $rs->fetch(PDO::FETCH_OBJ);          
        $quantidade_inventario = $item->mercado_qtd;
        
        if (verificaInventario($usuario_id, $mercado_id)>0) {
            if($quantidade <= $quantidade_inventario) {
                $sql    = "UPDATE g_inventario SET mercado_qtd = mercado_qtd - ? WHERE usuario_id = ? AND mercado_id = ?";
                $rs     = $PDO->prepare($sql);
    
                $rs->bindParam(1, $quantidade);
                $rs->bindParam(2, $usuario_id);
                $rs->bindParam(3, $mercado_id);    
            
                if ($rs->execute()) {
                    $resultado = true;                    
                }
            } else {
                $resultado = false;
            }
        } else {
            $resultado = false;
        }
    }
    
    return $resultado;
}

?>