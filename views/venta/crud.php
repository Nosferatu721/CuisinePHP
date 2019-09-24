<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft - Venta</title>
</head>

<body class="animated fadeIn faster">
    <!-- ------------ Header ------------ -->
    <?php require_once 'views/layout/banner.php'; ?>
    <!-- ------------- Nav ------------- -->
    <?php require_once 'views/layout/menu.php'; ?>

    <div class="container">
        <p class="titulo">Control de Ventas</p>
        <?php if (isset($_SESSION['saveEdit']) && $_SESSION['saveEdit'] == 'Registrado') : ?>
            <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
                <b>Venta Registrada Exitosamente <i class="fas fa-check-double"></i></b>
            </div>
        <?php else : ?>
            <hr>
        <?php endif; ?>
        <?php Utils::deleteSession('saveEdit') ?>
        <div class="row my-2">
            <div class="col-md-4 d-flex justify-content-center">
                <div class="card mb-3 border-0">
                    <div class="card-header font-italic text-center bg-secondary text-danger">

                        <span class="titulo text-success">Nueva Venta</span>
                    </div>
                    <form action="<?= baseUrl ?>venta/registrar" method="POST">

                        <div class="p-2 border-top">
                            <input type="submit" class="btn btn-outline-success btn-block" id="enviar" value="Crear Venta">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered table-hover" id="tabla">
                    <caption class="text-center">Lista de Ventas</caption>
                    <thead class="table-dark">
                        <tr class="font-italic">
                            <th scope="col">ID</th>
                            <th scope="col">Fecha Venta</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ven = VentaController::getAll(); ?>
                        <?php while ($v = $ven->fetch_object()) : ?>
                            <tr>
                                <th scope="row"><?= $v->idventa; ?></th>
                                <td><?= $v->fechaVenta; ?></td>
                                <td class="d-flex justify-content-around border border-light">
                                    <a href="<?= baseUrl; ?>ventaHP/ver&id=<?= $v->idventa; ?>" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Ver</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- ------------- Footer ------------- -->
    <?php require_once 'views/layout/footer2.php'; ?>

    <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>
    <script src="<?= baseUrl; ?>assets/js/validacionRestaurante.js"></script>

</body>

</html>