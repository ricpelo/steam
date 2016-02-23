<?php template_set('title', 'Borrar un juego') ?>

<?= miga_pan() ?>

<h3>¿Seguro que desea borrar el siguiente juego?</h3>
<p><?= $nombre ?></p>
<?= form_open('backend/juegos/borrar') ?>
    <?= form_hidden('id', $id) ?>
    <?= form_submit('borrar', 'Sí') ?>
    <?= anchor('backend/juegos/index', form_button('no', 'No')) ?>
<?= form_close() ?>
