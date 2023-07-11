<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aloha!!</title>
</head>
<body>
<?php
require '../vendor/autoload.php';

use Libs\BreadCrumbs;
use Carbon\Carbon;

include '../Libs/BreadCrumbs.php';
$crumbs = new BreadCrumbs();
$crumbs->add('/link', 'Sección');
$crumbs->show();

$date = Carbon::now();
$carbonYear = $date->format('Y');
?>

    <h1>Aloha!!</h1>
    <p>&copy; <?php echo date('Y'); ?></p>
    <p>&copy; <?php echo $carbonYear . ' con CARBON'; ?></p>
</body>
</html>