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
        <h2 class="main__title"><?= tituloIndex; ?></h2>
        <p class="main__txt"><?= textoIndex1 ?></p>
        <p class="main__txt"><?= textoIndex2 ?></p>
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
          <a href="#" class="btn btn-danger">Contact</a>
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

  </main>
  <!---------------Footer--------------->
  <?php require_once 'views/layout/footer2.php'; ?>
  <!---->

</body>

</html>