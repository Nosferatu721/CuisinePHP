<link rel="stylesheet" type="text/css" href="<?= baseUrl; ?>assets/datatables/datatables.min.css" />
</head>

<body class="animated fadeIn faster">
  <!-- ------------ Header ------------ -->
  <?php require_once 'views/layout/banner.php'; ?>
  <!-- ------------- Nav ------------- -->
  <?php require_once 'views/layout/menu.php'; ?>

  <div class="container">
	  <p class="titulo"><?=controlfile?></p>
    <?php if (isset($_SESSION['save']) && $_SESSION['save'] == 'Registrado') : ?>
      <?= Utils::alerta('success', fileup, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Eliminado') : ?>
      <?= Utils::alerta('danger',filedel, 'fas fa-check-double') ?>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'NoSePuede') : ?>
      <?= Utils::alerta('danger',nodel, 'far fa-surprise') ?>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'YaExiste') : ?>
      <?= Utils::alerta('warning', filerep, 'far fa-times-circle') ?>
    <?php elseif (isset($_SESSION['save']) && $_SESSION['save'] == 'NoAdmitido') : ?>
      <?= Utils::alerta('danger', noext, 'fas fa-ban') ?>
    <?php elseif (isset($_SESSION['notData']) && $_SESSION['notData'] == 'ErrorDatos') : ?>
      <?= Utils::alerta('danger', vacios) ?>
    <?php else : ?>
      <hr>
    <?php endif; ?>
    <?php Utils::deleteSession('save') ?>
    <?php Utils::deleteSession('delete') ?>
    <?php Utils::deleteSession('notData') ?>
    <!-- Formulario Para Subir Archivos -->
    <form action="<?= baseUrl; ?>archivo/registrar" method="POST" enctype="multipart/form-data">
      <div class="row">
        <div class="form-label-group col-12 col-lg-6 py-2">
	<label for="descripcion"><?=descr?> <span class="maxN"></span></label>
          <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="form-label-group col-12 col-lg-6 py-2">
	<label><?=selectfile?><i class="fas fa-file-word"></i> - PDF <i class="fas fa-file-pdf"></i></label>
          <input type="file" class="form-control-file btn btn-outline-dark" id="archivo" name="archivo">
          <div class="col-4 offset-4 py-2">
	  <input type="submit" class="btn btn-outline-primary btn-block" id="enviar" value="<?=subir?>">
          </div>
        </div>
      </div>
    </form>
    <hr>
    <!-- Tabla de Documentos -->
    <table class="table table-bordered table-hover" id="tabla">
      <caption class="text-center">listfile</caption>
      <thead class="table-dark">
        <tr class="font-italic">
          <th scope="col">ID</th>
	  <th scope="col"><?=descr?></th>
	  <th scope="col"><?=filename?></th>
	  <th scope="col"><?=subidopor?></th>
          <th scope="col"><?= acciones ?></th>
        </tr>
      </thead>
      <tbody>
        <?php while ($doc = $docs->fetch_object()) : ?>
          <tr>
            <th scope="row"><?= $doc->idArchivo; ?></th>
            <td><?= $doc->descripcion; ?></td>
            <td>
              <div class="d-flex justify-content-between">
                <?= $doc->document; ?>
                <a href="<?= baseUrl ?>dist/public/<?= $doc->document; ?>" class="btn btn-outline-success btn-sm" target="mostrar"><i class="far fa-eye"></i></a>
              </div>
            </td>
            <td><?= $doc->idUser == $_SESSION['identity']->idusuarios ? 'Yo' : $doc->nombre . ' ' . $doc->apellido ?></td>
            <td>
              <div class="d-flex justify-content-center">
                <!-- Boton Eliminar -->
                <button class="btn btn-outline-<?= $doc->idUser == $_SESSION['identity']->idusuarios ? 'danger' : 'dark' ?> btn-sm" data-toggle="modal" <?= $doc->idUser == $_SESSION['identity']->idusuarios ? '' : 'disabled' ?> data-target=".modal<?= $doc->idArchivo ?>"> <?= eliminar ?> <i class="far fa-trash-alt"></i></button>
                <!-- Modal Eliminar -->
                <div class="modal fade modal<?= $doc->idArchivo ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?= confirmar ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Desea eliminar el archivo?
                      </div>
                      <div class="modal-footer p-2">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal"><?= cancelar ?></button>
                        <a href="<?= baseUrl; ?>archivo/eliminar&id=<?= $doc->idArchivo; ?>" class="btn btn-outline-danger btn-sm"> <?= eliminar ?> <i class="far fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <br>
  </div>

  <!-- ------------- Footer ------------- -->
  <?php require_once 'views/layout/footer2.php'; ?>

  <script type="text/javascript" src="<?= baseUrl; ?>assets/js/tablas.js"></script>

</body>

</html>
