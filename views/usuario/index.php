<!-- El Morris -->
<link rel="stylesheet" href="<?= baseUrl; ?>assets/morris/morris.css">
<script src="<?= baseUrl; ?>assets/morris/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<!-- Estilo Propio -->
<link rel="stylesheet" href="<?= baseUrl; ?>assets/css/styleAll.css">
<title>CusineSoft</title>
</head>

<body class="animated fadeIn faster">
  <!--------------Header-------------->
  <?php require_once 'views/layout/banner.php'; ?>
  <!---------------Nav--------------->
  <?php require_once 'views/layout/menu.php'; ?>
  <!--------------Main-------------->
  <main class="main">
    <section class="group group--color">
      <div class="containersito">
        <h2 class="main__title">Bienvenido al Sistema para tu Restaurante</h2>
        <p class="main__txt">Este Sistema facilitara el control de materias primas, menaje, mermas, alerta de
          agotamiento del Stock, para el restaurante Andrés Carne de Res.</p>
        <p class="main__txt">Cambiando el metodo de realizar los procesos de forma manual y pasarlos a este Sistema de
          Información.</p>
      </div>
    </section>
    <section class="group main__about__description">
      <div class="containersito container--flex">
        <div class="column column--50">
          <img src="<?= baseUrl; ?>assets/img/logo-AR.png" alt="" class="img__descrip">
        </div>
        <div class="column column--50">
          <h3 class="column__title">Al Inicio</h3>
          <p class="column__txt">Lo que comenzó con unas pocas mesas, fabricadas por él mismo con sus dotes de
            carpintero, un letrero hecho a mano, un sol, una luna, y una estrella, se comvirtió poco a poco, con
            empuje,
            talento y verraquera, en un universo que brillo y da calor con su propio fuego.</p>
          <a href="" class="btn btn-danger">Contact</a>
        </div>
      </div>
    </section>
    <!---------------------------------->
    <section class="group today-special">
      <h2 class="group__title">Especial de hoy</h2>
      <div class="containersito container--flex">
        <div class="column column--50--25">
          <img src="<?= baseUrl; ?>assets/img/Plato1.jpeg" alt="" class="today-special__img">
          <div class="today-special__title">Algun Titulo</div>
          <div class="today-special__price">$1</div>
        </div>
        <div class="column column--50--25">
          <img src="<?= baseUrl; ?>assets/img/Plato2.jpeg" alt="" class="today-special__img">
          <div class="today-special__title">Algun Titulo</div>
          <div class="today-special__price">$1</div>
        </div>
        <div class="column column--50--25">
          <img src="<?= baseUrl; ?>assets/img/Plato3.jpeg" alt="" class="today-special__img">
          <div class="today-special__title">Algun Titulo</div>
          <div class="today-special__price">$1</div>
        </div>
        <div class="column column--50--25">
          <img src="<?= baseUrl; ?>assets/img/Plato4.jpeg" alt="" class="today-special__img">
          <div class="today-special__title">Algun Titulo</div>
          <div class="today-special__price">$1</div>
        </div>
      </div>
    </section>
    <?php if (isset($_SESSION['identity'])) : ?>
    <?php if (isset($_SESSION['Admin'])) : ?>
    <h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Administrador</h4>
    <?php elseif (isset($_SESSION['JefeCocina'])) : ?>
    <h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Jefe de Cocina</h4>
    <?php elseif (isset($_SESSION['JefeZona'])) : ?>
    <h4 class="nameUser"><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?> - Jefe de Zona</h4>
    <?php endif; ?>
    <?php else : ?>
    <?php header('Location: ' . baseUrl); ?>
    <?php endif; ?>
    <div class="containersito">
      <h1>Graficas</h1>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h2>Grafica Linea</h2>
          <hr>
          <div id="myfirstchart"></div>
        </div>
        <div class="col-md-6">
          <h2>Grafica Area</h2>
          <hr>
          <div id="myfirstchart"></div>
        </div>
      </div>
    </div>

  </main>
  <!---------------Footer--------------->
  <?php require_once 'views/layout/footer2.php'; ?>
  <!---->



</body>

</html>