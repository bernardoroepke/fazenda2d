<!-- Page Heading -->
<div class="container container-xl">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">INVENTÁRIO</h1>
      
  </div>

  <!-- Content Row -->

  <div class="row">

      <?php
        session_start();

        $usuario        = $_SESSION['usuario'];
        $usuario_id     = $usuario->usuario_id;
      
        include_once("functions.php");

        $inventario = mostraInventario($usuario_id);

        include_once("messages.php");
        messagesInventario();
      ?>

        <table class="table table-dark">
          <tr>
            <th scope="col">Nome</td>
            <th scope="col">Estoque</th>
            <th scope="col">Preço</th>
            <th scope="col">Quantidade</th>
          </tr>
          <?php $invVazio = true; ?>              
          <?php foreach ($inventario as $itemInventario) { ?>
            <?php if ($itemInventario["mercado_qtd"] > 0) { ?> 
              <?php $invVazio = false; ?>
              <tr>
                <td><?php echo $itemInventario["mercado_desc"]?></td>
                <td><?php echo $itemInventario["mercado_qtd"]?></td>
                <td><?php echo $itemInventario["mercado_preco"]?></td>
                <td>
                  <form action="validaInventario.php" method="POST">
                    <input type="hidden" name="mercado_id" value="<?php echo $itemInventario["mercado_id"];?>">
                    <input type="number" name="quantidade" placeholder="Quantidade" class="form-control form-control-user input-sm col-xs-2">
                    <input type="submit" class="btn btn-danger" value="Vender"></input>
                  </form>            
                </td>
              </tr>
            <?php } ?>           
          <?php } ?>             
        </table>
        <?php if($invVazio) { ?>  
          <h2>Seu inventário está vazio!</h2>  
        <?php } ?>
  </div>
</div> 