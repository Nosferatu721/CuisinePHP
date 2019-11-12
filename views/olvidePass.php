<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleLogin.css">
</head>

<body class="animated fadeIn faster">
  <div class="container-fluid">
    <div class="row no-gutter">
      <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image imagen" style="box-shadow: 1px 0px 10px <?= theme == 'light' ? 'black' : 'gray' ?>"></div>
      <div class="col-md-8 col-lg-6 elForm" style="background: <?= theme == 'light' ? 'white' : 'black' ?>;">
        <div class="login d-flex align-items-center py-5">
          <div class="container">
            <div class="row">
              <div class="col-md-9 col-lg-8 mx-auto">
                <h3 class="login-heading mb-4 <?= theme == 'light' ? 'text-dark' : 'text-ligth' ?>"><?= tituloRecuperarPass; ?></h3>
                <?php if (isset($_SESSION['recuperar']) && $_SESSION['recuperar'] == 'ErrorDatos') : ?>
                  <?= Utils::alerta('danger', notExists, 'fas fa-poo') ?>
                <?php elseif (isset($_SESSION['recuperar']) && $_SESSION['recuperar'] == 'Vacios') : ?>
                  <?= Utils::alerta('danger', vacios) ?>
                <?php else : ?>
                  <hr>
                <?php endif; ?>
                <?php Utils::deleteSession('recuperar') ?>
                <form action="<?= baseUrl; ?>usuario/d" method="POST">
                  <div class="form-label-group">
                    <input type="text" id="id" name="id" class="form-control" placeholder="Code User">
                    <label for="id"><i class="fab fa-keycdn"></i> <?= codigo; ?></label>
                  </div>
                  <!-- 
                  <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Recordarme</label>
                  </div> -->
                  <div class="row">
                    <a href="<?= baseUrl; ?>" class="btn btn-outline-dark col-3"><i class="fas fa-arrow-left"></i></a>
                    <button type="submit" class="btn btn-outline-success btn-block col-9"><i class="far fa-paper-plane"></i> <?= btnEnviarEmail; ?></button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>