<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aloha!!</title>
</head>
<body>
<?php
use Libs\BreadCrumbs;

include '../Libs/BreadCrumbs.php';
$crumbs = new BreadCrumbs();
$crumbs->add('/link', 'Sección');
$crumbs->show();
?>

    <h1>Aloha!!</h1>
    <p>&copy; <?php echo date('Y'); ?></p>
</body>
</html>