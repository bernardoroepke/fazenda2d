<div class="container">

<?php

    //-> setando tamanho da tabela:
    $col    = 9;
    $lin    = 7;

    $style = "padding: 0px;";

    $imagem = "<a href='https://google.com.br'> <img src='img/html5.gif' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
  
    $linCont = 1;
    $colCont = 1;
   
    echo "<table border = 0 style = 'background-color: green; border-spacing: 0px;' >";

    while($linCont <= $lin)         //-> impressão das linhas
    {
        echo "<tr>";

        while($colCont <= $col)     //-> impressão das colunas
        {   

            $coord = coord($linCont, $colCont);     //verificando o que vai imprimir nessa coordenada

            echo "<td style='$style'> $coord </td>";
            $colCont = $colCont + 1; 
        }
        
        echo "</tr>";
        $linCont = $linCont + 1;
        $colCont = 1;
    }

    echo "</table>";


    function coord($lin, $col)
    {
        $c = $lin."|".$col;


        switch ($c) {
            case '3|3':
                $imagem = "<a href='https://google.com.br'> <img src='img/forest.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

            case '3|5':
                $imagem = "<a href='https://google.com.br'> <img src='img/barracks.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

            case '2|1':
                $imagem = "<a href='https://google.com.br'> <img src='img/church.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

            case '4|4':
                $imagem = "<a href='https://google.com.br'> <img src='img/forest2.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

            case '4|6':
                $imagem = "<a href='https://google.com.br'> <img src='img/v5.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

            case '7|7':
                $imagem = "<a href='index.php?p=2'> <img src='img/v2.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;
            
            default:
                $imagem = "<a href='https://google.com.br'> <img src='img/gras.png' alt='HTML5 Icon' style='width:80px;height:80px;'> </a>";
                break;

        }

        return $imagem;



        
    }

?>
</div>