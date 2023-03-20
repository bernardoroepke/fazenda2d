<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

//Checando se todos os dados foram informados
if (isset($_POST['nome']) AND isset($_POST['senha1']) AND isset($_POST['senha2']) AND isset($_POST['email']) AND isset($_POST['login'])) { 

    $nome        = $_POST['nome'];
    $senha1      = $_POST['senha1'];
    $senha2      = $_POST['senha2'];
    $email       = $_POST['email'];
    $login       = $_POST['login'];

    if ($senha1 == $senha2)  // se as senhas informadas forem identicas
    { 
        
        include("functions.php");
        $registro = checaRegistro($email, $login);

        echo "registro" . $registro; 

        if($registro == 0) //não existe cadastro
        {
            include("bd/conexao.php");
            
            $sql    = "INSERT INTO g_usuarios(usuario_id, usuario_nome, usuario_login, usuario_senha, usuario_email, usuario_confirm, usuario_ativo, usuario_ban, usuario_moedas, usuario_nivel) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $rs     = $PDO->prepare($sql);
            
            $usuario_id         = null;
            $usuario_nome       = $nome;
            $usuario_login      = $login;
            $usuario_senha      = md5($senha1);
            $usuario_email      = $email;
            $usuario_confirm    = 1;
            $usuario_ativo      = 1;
            $usuario_ban        = 0;
            $usuario_moedas     = 100; //moedas iniciais
            $usuario_nivel      = 1;

            $rs->bindParam(1, $usuario_id);
            $rs->bindParam(2, $usuario_nome);
            $rs->bindParam(3, $usuario_login);
            $rs->bindParam(4, $usuario_senha);
            $rs->bindParam(5, $usuario_email);
            $rs->bindParam(6, $usuario_confirm);
            $rs->bindParam(7, $usuario_ativo);
            $rs->bindParam(8, $usuario_ban);
            $rs->bindParam(9, $usuario_moedas);

            if($rs->execute())
            {
                Header("Location: registrar.php?m=s");
            }
        }
        else
        {
            Header("Location: registrar.php?m=e2");
        }         
        
    }
    else
    {
        Header("Location: registrar.php?m=e1");
    }
}
else
{
    //retornar com mensagem de erro
}

?>
