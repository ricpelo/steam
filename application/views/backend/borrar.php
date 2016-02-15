<?php template_set('title', 'Borrar un juego') ?>
<h3>¿Seguro que desea borrar el siguiente juego?</h3>
<p><?= $descripcion ?></p>
<?= form_open('juegos/borrar') ?>
    <?= form_hidden('id', $id) ?>
    <?= form_submit('borrar', 'Sí') ?>
    <?= anchor('juegos/index', form_button('no', 'No')) ?>
<?= form_close() ?>
