<nav class="navbar navbar-dark bg-dark navbar-expand-lg shadow container my-2">
  <span class="navbar-brand mb-0 h1"><i class="fas fa-angle-double-down"></i></span>
  <button class="navbar-toggler btn-outline-danger" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="menu">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= baseUrl; ?>usuario/index"><i class="fas fa-home pr-1"></i>Inicio</a>
      </li>
      <?php if ($_SESSION['identity']->nombreCargo == 'Administrador') : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="merma" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-store-alt"></i> Restaurantes <?= $_SESSION['identity']->nombreCargo == 'Jefe de Cocina'; ?>
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="merma">
            <a class="dropdown-item" href="<?= baseUrl; ?>restaurante/gestion">Gestionar Restaurantes</a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>usuario/registro">Registrar Usuario</a>
            <a class="dropdown-item" href="<?= baseUrl; ?>usuario/consultarUsuarios">Consultar Usuarios</a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>cargo/gestion">Gestionar Cargos</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="Stock" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> Productos
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>producto/gestion">Registrar Producto</a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#">Otro</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="Stock" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> Merma
          </a>
          <div class="dropdown-menu animated jackInTheBox faster" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>producto/gestion">Registrar Merma</a>
            <a class="dropdown-item" href="<?= baseUrl; ?>producto/gestion">Consultar Merma</a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="<?= baseUrl; ?>tipoMerma/gestion">Gestionar Tipos de Merma</a>
            <div class="dropdown-divider border-warning"></div>
            <a class="dropdown-item" href="#">Otro</a>
          </div>
        </li>
      <?php elseif ($_SESSION['identity']->nombreCargo == 'Jefe de Cocina') : ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="Stock" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cubes"></i> Stock
          </a>
          <div class="dropdown-menu" aria-labelledby="Stock">
            <a class="dropdown-item" href="<?= baseUrl; ?>stock/consultar">Consultar Stock</a>
            <a class="dropdown-item" href="<?= baseUrl; ?>stock/registro">Registrar Stock</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Otro</a>
          </div>
        </li>
      <?php endif; ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="merma" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menaje
        </a>
        <div class="dropdown-menu" aria-labelledby="merma">
          <a class="dropdown-item" href="#">Registrar Eventualidad</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Otro</a>
        </div>
      </li>
    </ul>
    <div class="float-right">
      <a class="nav-link btn btn-outline-danger" href="<?= baseUrl; ?>usuario/logout"><i class="fas fa-door-open"></i> Salir</a>
    </div>
  </div>
</nav>