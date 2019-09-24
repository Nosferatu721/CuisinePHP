<h1>Hola</h1>
<?php $p = PedidoHPController::getAll(); ?>
<?php while($pHP = $p->fetch_object()): ?>
  <h4><?= $pHP->pedido_idpedido ?></h4>
  <h4><?= $pHP->producto_idproducto ?></h4>
  <h4><?= $pHP->cantidadProdPed ?></h4>
  <hr>
<?php endwhile; ?>