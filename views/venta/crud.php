<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - <?= sale ?></title>
</head>

<body class="animated fadeIn faster">
	<!-- ------------ Header ------------ -->
	<?php require_once 'views/layout/banner.php'; ?>
	<!-- ------------- Nav ------------- -->
	<?php require_once 'views/layout/menu.php'; ?>

	<div class="container">
		<p class="titulo"><?= sales ?></p>
		<?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
			<?= Utils::alerta('success', saleRegis, 'fas fa-check-double') ?>
		<?php else : ?>
			<hr>
		<?php endif; ?>
		<?php Utils::deleteSession('saveEdit') ?>
		<div class="row my-2">
			<div class="col-md-4 d-flex justify-content-center">
				<div class="card mb-3 border-0">
					<div class="card-header font-italic text-center bg-secondary text-danger">

						<span class="titulo text-success"><?= newSale ?></span>
					</div>
					<form action="<?= baseUrl ?>venta/registrar" method="POST">

						<div class="p-2 border-top">
							<input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="<?= regisVen ?>">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-8">
				<table class="table table-bordered table-hover" id="tabla">
					<caption class="text-center"><?= saleList ?></caption>
					<thead class="table-dark">
						<tr class="font-italic">
							<th scope="col">ID</th>
							<th scope="col"><?= saleDate ?></th>
							<th scope="col"><?= saleAction ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $ven = VentaController::getAll(); ?>
						<?php while ($v = $ven->fetch_object()) : ?>
							<tr>
								<th scope="row"><?= $v->idventa; ?></th>
								<td><?= $v->fechaVenta; ?></td>
								<td class="d-flex justify-content-around border border-light">
									<a href="<?= baseUrl; ?>ventaHP/ver&id=<?= $v->idventa; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> <?= saleView ?></a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php if (isset($_SESSION['pdfFechas']) && $_SESSION['pdfFechas'] == 'FechasVacias') : ?>
			<?= Utils::alerta('warning', vacios) ?>
		<?php else : ?>
			<hr>
		<?php endif; ?>
		<?php Utils::deleteSession('pdfFechas') ?>

		<form action="<?= baseUrl; ?>venta/PDFFecha" method="POST" class="row justify-content-around">
			<div class="form-label-group col-3">
				<label for="fechaInicial">Fecha Inicial </label>
				<input type="date" id="fechaInicial" name="fechaInicial" class="form-control">
			</div>
			<div class="form-label-group col-3">
				<label for="fechaFinal">Fecha Final </label>
				<input type="date" id="fechaFinal" name="fechaFinal" class="form-control">
			</div>
			<div class="d-flex align-items-center">
				<button type="submit" id="generarPDF" class="btn btn-outline-danger"><?= generarPDF ?> <i class="fas fa-file-pdf"></i></button>
			</div>
		</form>
		<hr>
	</div>

	<!-- ------------- Footer ------------- -->
	<?php require_once 'views/layout/footer2.php'; ?>

	<script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
	<script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>