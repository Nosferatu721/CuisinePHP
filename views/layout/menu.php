<nav class="navbar navbar-<?= theme == 'light' ? 'light' : 'dark' ?> bg-<?= theme == 'light' ? 'light' : 'dark' ?> navbar-expand-lg shadow container my-2">
  <span class="navbar-brand mb-0 h1"><i class="fas fa-angle-double-down"></i></span>
  <button class="navbar-toggler btn-outline-danger" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= baseUrl; ?>usuario/index"><i class="fas fa-home pr-1"></i><?= inicio; ?></a>
      </li>
      <?php if ($_SESSION['identity']->nombreCargo == 'Administrador') : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-store-alt"></i> <?= restaurantes; ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="merma">
            <a class="dropdown-item" href="<?= baseUrl; ?>restaurante/gestion"><?= gestionRestaurante; ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>usuario/registro"><?= registrarUsuario; ?></a>
            <a class="dropdown-item" href="<?= baseUrl; ?>usuario/consultarUsuarios"><?= consultUsuarios; ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>cargo/gestion"><?= gestionCargos; ?></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> <?= productos; ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>producto/gestion"><?= registrarProduct; ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#"><?= otro ?></a>
          </div>
        </li>
      <?php elseif ($_SESSION['identity']->nombreCargo == 'Jefe de Cocina') : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> <?= stock; ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>stock/consultar"><?= consultStock ?></a>
            <a class="dropdown-item" href="<?= baseUrl; ?>stock/registro"><?= registrarStock ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#"><?= otro ?></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> <?= merma; ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>merma/registro"><?= registrarMerma; ?></a>
            <a class="dropdown-item" href="<?= baseUrl; ?>merma/consultarMerma"><?= consultMerma; ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>tipoMerma/gestion"><?= gestionTipoMerma; ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#"><?= otro ?></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="Stock" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i>
            <?= pedido ?> </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>pedido/gestion"><?= viewOrd ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#"><?= otro ?></a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="Stock" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i>
            <?= sale ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>venta/gestion"><?= conSale ?></a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#"><?= otro ?></a>
          </div>
        </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= baseUrl; ?>archivo/gestion">
          <?= subir ?>
        </a>
      </li>
    </ul>
    <div class="btn-group" role="group">
      <a href="<?= baseUrl; ?>usuario/lang&lang=<?= lang; ?>" class="btn btn-outline-dark" role="button">
        <i class="fas fa-globe-americas"></i> <span id="btnLang"><?= idioma; ?></span>
      </a>
      <a href="<?= baseUrl; ?>usuario/theme&t=<?= theme == 'light' ? 'dark' : 'light' ?>" class="btn btn-dark" role="button">
        <i class="<?= theme == 'light' ? 'far fa-moon' : 'fas fa-sun' ?>"></i>
      </a>
    </div>
  </div>
</nav>