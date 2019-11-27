<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - <?= Sale ?></title>
</head>

<body class="animated fadeIn faster">
	<!-- ------------ Header ------------ -->
	<?php require_once 'views/layout/banner.php'; ?>
	<!-- ------------- Nav ------------- -->
	<?php require_once 'views/layout/menu.php'; ?>
    <?php require_once 'controllers/productoController.php'; ?>

	<div class="container">
		<p class="titulo"><?= sales ?></p>
		<?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'Registrado') : ?>
			<?= Utils::alerta('success', prodVen, 'fas fa-check-double') ?>
		<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
			<?= Utils::alerta('danger', prodVen2, 'fas fa-check-double') ?>
		<?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'Vacios') : ?>
			<?= Utils::alerta('danger', vacios) ?>
		<?php else : ?>
			<hr>
		<?php endif; ?>
		<?php Utils::deleteSession('save') ?>
		<?php Utils::deleteSession('delete') ?>
		<div class="row my-2">
			<div class="col-md-4 d-flex justify-content-center">
				<div class="card mb-3 border-0">
					<div class="card-header font-italic text-center bg-secondary text-danger">
						<span class="titulo text-success"><?= saleId ?> = <b><?= $_GET['id'] ?></b></span>
					</div>
					<div class="card-body">
						<form action="<?= baseUrl ?>ventaHP/registrar&id=<?= $_GET['id']; ?>" method="POST">
							<div class="p-2">
								<span><?= selectProducto ?> <i class="fas fa-carrot"></i></span><br>
								<?php $ptos = ProductoController::getAll(); ?>
								<select class="custom-select mr-sm-2 mt-1" name="producto" id="producto">
									<option><?= elija ?></option>
									<?php while ($p = $ptos->fetch_object()) : ?>
										<option value="<?= $p->idproducto; ?>"><?= $p->nombreProducto; ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="form-label-group p-2">
								<label for="cantidad"><?= canSale ?></label>
								<input type="text" id="cantidad" name="cantidad" class="form-control">
							</div>
							<div class="p-2 border-top">
								<input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= addSale ?>">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<table class="table table-responsive-sm table-bordered table-hover" id="tabla">
					<caption class="text-center"><?= tittleTableProducto ?></caption>
					<thead class="table-dark">
						<tr class="font-italic">
							<th scope="col"><?= prod ?></th>
							<th scope="col"><?= cantidad ?></th>
							<th scope="col"><?= proyDate ?></th>
							<th scope="col"><?= proyAmount ?></th>
							<th scope="col"><?= saleAction ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $v = VentaHPController::getAll($_GET['id']) ?>
						<?php while ($venHP = $v->fetch_object()) : ?>
							<tr>
								<td><?= $venHP->nombreProducto; ?></td>
								<td><?= $venHP->cantidadVendida; ?></td>
								<td><?= $venHP->proyectadoA; ?></td>
								<td><?= $venHP->cantProyectada; ?></td>
								<td class="d-flex justify-content-around border border-light">
									<a href="<?= baseUrl; ?>ventaHP/eliminar&id=<?= $venHP->producto_idproducto; ?>&idv=<?= $_GET['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> <?= eliminar ?></a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<hr>
		<div id="container" style="height: 400px" class="my-3"></div>
		<div id="container2" style="height: 400px" class="my-3"></div>
	</div>

	<script type="text/javascript">
		$(function() {
			$('#container').highcharts({
				chart: {
					type: 'column',
					margin: 75,
					options3d: {
						enabled: true,
						alpha: 10,
						beta: 25,
						depth: 70
					}
				},
				title: {
				text: '<?=prodvenpdf?>'
				},
				plotOptions: {
					column: {
						depth: 20,
					},
				},
				xAxis: {
					categories: [
						<?php
						foreach ($v as $vHP) {
							?>

							['<?php echo $vHP['nombreProducto']; ?>'],


						<?php
						}
						?>
					]
				},
				yAxis: {
					title: {
					text: '<?=cantidad?>'
					}
				},
				series: [{
				name: '<?=productos?>',
					data: [
						<?php
						foreach ($v as $vHP) {
							?>[<?= $vHP['cantidadVendida'] ?>],
						<?php
						}
						?>
					]
				}]
			});
		});
	</script>

	<script type="text/javascript">
		$(function() {
			$('#container2').highcharts({
				chart: {
					type: 'column',
					margin: 75,
					options3d: {
						enabled: true,
						alpha: 10,
						beta: 25,
						depth: 70
					}
				},
				title: {
				text: '<?=proyvsprod?>'
				},
				plotOptions: {
					column: {
						depth: 20,
					},
				},
				xAxis: {
					categories: [
						<?php
						foreach ($v as $vHP) {
							?>['<?php echo $vHP['nombreProducto']; ?>'],
						<?php
						}
						?>
					]
				},
				yAxis: {
					title: {
					text: '<?=cantidad?>'
					}
				},
				series: [{
				name: '<?=sale?>',
						data: [
							<?php
							foreach ($v as $vHP) {
								?>[<?= $vHP['cantidadVendida'] ?>],
							<?php
							}
							?>
						]
					},
					{
						name: '<?=proy?>',
						data: [
							<?php
							foreach ($v as $vHP) {
								?>[<?= $vHP['cantProyectada'] ?>],
							<?php
							}
							?>
						]
					}
				]
			});
		});
	</script>

	<!-- ------------- Footer ------------- -->
	<?php require_once 'views/layout/footer2.php'; ?>

	<script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

	<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts.js"></script>
	<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/highcharts-3d.js"></script>
	<script src="<?= baseUrl ?>assets/Highcharts-4.1.5/js/modules/exporting.js"></script>

	<script type="text/javascript" src="<?= baseUrl; ?>assets/js/validarVentaHP.js"></script>

</body>

</html>
