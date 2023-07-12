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
use Libs\Dates;

use League\Plates\Engine;

$templates = new Engine('../views');

$crumbs = new BreadCrumbs();
$crumbs->add('/link', 'Sección');
$crumbs->show();

$date = Carbon::now();
$carbonYear = $date->format('Y');
?>

    <h1>Aloha!!</h1>

    <p>
        <?= 'Hoy, todavía, es <strong>' . Dates::longDate(Dates::today()) . '</strong>.'; ?>
    </p>

    <p>
        <?= 'Mañana será <strong>' . Dates::longDate(Dates::tomorrow()) . '</strong>.'; ?>
    </p>


<?= $templates->render('template-test', [
  'titleH2' => 'Este es el Título H2',
]); ?>

    <p>&copy; <?php echo date('Y'); ?></p>
    <p>&copy; <?php echo $carbonYear . ' con CARBON'; ?></p>
</body>
</html>