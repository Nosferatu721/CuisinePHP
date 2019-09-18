<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
    <p class="titulo">Control de Archivos</p>
    <?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'Registrado') : ?>
      <div class="alert alert-secondary text-success p-1 text-center animated zoomIn faster" role="alert">
        <b>Registrado <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Eliminado <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoSePuede') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>No Se Puede Eliminar - No es tuyo <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'YaExiste') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Ya Existe <i class="far fa-times-circle"></i></b>
      </div>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'NoAdmitido') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Seleccione Un Archivo Apropiado <i class="fas fa-ban"></i></b>
      </div>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'Error') : ?>
      <div class="alert alert-secondary text-danger p-1 text-center animated zoomIn faster" role="alert">
        <b>Error <i class="fas fa-check-double"></i></b>
      </div>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <div class="alert alert-danger p-1 text-center animated zoomIn faster" role="alert">
        <?= vacios ?>
      </div>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('save') ?>
    <?php Utils::deleteSession('delete') ?>
    <?php Utils::deleteSession('notData') ?>
    <form action="<?= baseUrl; ?>archivo/registrar" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="form-label-group col-12 col-lg-6 py-2">
          <label for="descripcion">Descripción del Archivo <span class="maxN"></span></label>
          <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-label-group col-12 col-lg-6 py-2">
          <label>Seleccionar Archivo - Word <i class="fas fa-file-word"></i> - PDF <i class="fas fa-file-pdf"></i></label>
          <input type="file" class="form-control-file btn btn-outline-dark" id="archivo" name="archivo">
          <div class="col-4 offset-4 py-2">
            <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="Subir">
          </div>
        </div>
      </div>
    </form>
    <hr>
    <table class="table table-bordered table-hover" id="tabla">
      <caption class="text-center">Lista De Documentos</caption>
      <thead class="table-dark">
        <tr class="font-italic">
          <th scope="col">ID</th>
          <th scope="col">Descripción</th>
          <th scope="col">Nombre Archivo</th>
          <th scope="col">Subido Por</th>
          <th scope="col"><?= acciones ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($doc = $docs->fetch_object()) : ?>
          <tr>
            <th scope="row"><?= $doc->idArchivo; ?></th>
            <td><?= $doc->descripcion; ?></td>
            <td><?= $doc->document; ?></td>
            <td><?= $doc->idUser == $_SESSION['identity']->idusuarios ? 'Yo' : $doc->nombre . ' ' . $doc->apellido ?></td>
            <td class="d-flex justify-content-around border border-light">
              <a href="<?= baseUrl; ?>archivo/eliminar&id=<?= $doc->idArchivo; ?>" class="btn btn-outline-danger btn-sm <?= $doc->idUser == $_SESSION['identity']->idusuarios ? '' : 'disabled' ?>"><i class="far fa-trash-alt"></i> <?= eliminar ?></a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>