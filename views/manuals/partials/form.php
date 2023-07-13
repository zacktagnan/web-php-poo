<form action="<?= $action; ?>" method="post" class="f_manual">
    <div>
        <label for="title">Título <span>*</span>:</label>
        <input type="text" name="title" id="title" value="<?= $data['title'] ?? $manual['title'] ?>" />
    </div>
    <div>
        <label for="excerpt">Extracto <span>*</span>:</label>
        <textarea name="excerpt" id="excerpt" cols="30" rows="5"><?= $data['excerpt'] ?? $manual['excerpt'] ?></textarea>
    </div>
    <div>
        <label for="order">Orden <span>*</span>:</label>
        <input type="text" name="order" id="order" value="<?= $data['order'] ?? $manual['order'] ?>" />
    </div>
    <div>
        <label for="description">Descripción <span>*</span>:</label>
        <textarea name="description" id="description" cols="30" rows="10"><?= $data['description'] ?? $manual['description'] ?></textarea>
    </div>
    <div>
        <div class="label"></div>
        <div class="f_btn">
            <button>Enviar</button>
        </div>
    </div>
</form>
