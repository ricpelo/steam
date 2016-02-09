<?php template_set('title', 'Insertar un juego') ?>
<?= validation_errors() ?>
<?= form_open('juegos/insertar') ?>
    <?= form_label('Código:', 'codigo') ?>
    <?= form_input('codigo', set_value('codigo', '', FALSE), 'id="codigo"') ?><br/>
    <?= form_label('Descripción:', 'descripcion') ?>
    <?= form_input('descripcion', set_value('descripcion', '', FALSE), 'id="descripcion"') ?><br/>
    <?= form_label('Precio:', 'precio') ?>
    <?= form_input('precio', set_value('precio', '', FALSE), 'id="precio"') ?><br/>
    <?= form_submit('insertar', 'Insertar') ?>
    <?= anchor('/juegos/index', form_button('cancelar', 'Cancelar')) ?>
<?= form_close() ?>
