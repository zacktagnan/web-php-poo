<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Layout<?= ' :: ' . $mainTitle; ?></title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <header>
        <img src="/assets/images/logo.svg">
    </header>

    <main>
        <?= $this->section('content'); ?>
    </main>

    <footer>
        &copy; PJCM
        <?= $this->section('footerLinks') ?>
    </footer>
</body>
</html>