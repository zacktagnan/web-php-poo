<?php if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0): ?>
<?php
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
?>
  <div class="notification errors">
    Hubo errores en el proceso ejecutado:
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif; ?>