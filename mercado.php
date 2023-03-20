<!-- Page Heading -->
<div class="container container-xl">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">MERCADO</h1>
      
  </div>

  <!-- Content Row -->

  <div class="row">

      <?php
        session_start();

        $usuario        = $_SESSION['usuario'];
        $usuario_id     = $usuario->usuario_id;

        include_once("functions.php");

        $mercado = mostraMercado();

        include_once("messages.php");
        messagesMercado();

      ?>

        <table class="table table-dark">
          <tr>
            <th scope="col">Nome</td>
            <th scope="col">Estoque</th>
            <th scope="col">Preço</th>
            <th scope="col">Quantidade</th>
          </tr>              
          <?php foreach ($mercado as $itemMercado) { ?>
            <?php $mercado_qtd = verificaInventario($usuario_id, $itemMercado["mercado_id"]); ?>
              <tr>
                <td><?php echo $itemMercado["mercado_desc"]?></td>
                <td><?php if ($mercado_qtd) {
                   echo $mercado_qtd;
                  } else {
                    echo "0";
                  } ?></td>
                <td><?php echo $itemMercado["mercado_preco"]?></td>
                <td>
                  <form action="validaMercado.php" method="POST">
                    <input type="hidden" name="mercado_id" value="<?php echo $itemMercado["mercado_id"];?>">
                    <input type="number" name="quantidade" placeholder="Quantidade" class="form-control form-control-user input-sm col-xs-2">
                    <input type="submit" class="btn btn-success" value="Comprar"></input>
                  </form>            
                </td>
                <!-- <td><input type="submit" class="btn btn-success" value="Comprar"></td> -->
              </tr>
          <?php  } ?>
          </table>
  </div>
</div>