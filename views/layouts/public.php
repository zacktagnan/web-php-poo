<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $mainTitle ?></title>
  <?= $this->section('headJS') ?>
  <?= $this->section('headCSS') ?>
  <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
<?php $this->insert('partials/header-navbar', [
    'router' => $router,
]); ?>

  <main>
    <?= $this->section('content') ?>
  </main>

  <footer>
    © Copyright... PJCM
    <?= $this->section('footerLinks') ?>
  </footer>

  <!-- Ejemplo de Carga de Sección para JS :: ini -->
  <!-- <script src="ruta/jquery"></script> -->
  <?= $this->section('footerJS') ?>
  <!-- Ejemplo de Carga de Sección para JS :: fin -->
</body>
</html>