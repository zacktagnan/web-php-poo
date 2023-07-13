<?php if (count($errors) !== 0): ?>
  <div class="notification errors">
    Hubo errores en el proceso llevado a cabo:
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach ?>
    </ul>
  </div>
<?php endif; ?>