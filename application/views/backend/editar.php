<?php template_set('title', 'Editar un juegos') ?>

<?= miga_pan() ?>

<div class="container-fluid" style="padding-top:20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Editar artículo</h3>
        </div>
        <div class="panel-body">
          <?php if ( ! empty(error_array())): ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors() ?>
            </div>
          <?php endif ?>
          <?= form_open("backend/juegos/editar/$id") ?>
            <div class="form-group">
              <?= form_label('Nombre:', 'descripcion') ?>
              <?= form_input('nombre',
                             set_value('nombre', $nombre, FALSE),
                             'id="nombre" class="form-control"') ?>
            </div>
            <div class="form-group">
              <?= form_label('Resumen:', 'resumen') ?>
              <?= form_textarea('resumen',
                             set_value('resumen', $resumen, FALSE),
                             'id="resumen"  class="form-control"') ?>
            </div>
            <div class="form-group">
              <?= form_label('Descripción:', 'descripcion') ?>
              <?= form_textarea('descripcion',
                             set_value('descripcion', $descripcion, FALSE),
                             'id="descripcion" class="form-control"') ?>
            </div>
            <div class="form-group">
              <?= form_label('Precio:', 'precio') ?>
              <?= form_input('precio',
                             set_value('precio', $precio, FALSE),
                             'id="precio" class="form-control"') ?>
            </div>
            <?= form_submit('editar', 'Editar', 'class="btn btn-success"') ?>
            <?= anchor('/juegos/index', 'Cancelar',
                       'class="btn btn-danger" role="button"') ?>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
