<?php template_set('title', 'Subir') ?>

<?= miga_pan() ?>

<div class="container-fluid" style="padding-top:20px">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Subir Foto</h3>
        </div>
        <div class="panel-body">
          <?php if ( ! empty($error)): ?>
            <div class="alert alert-danger" role="alert">
              <?= $error ?>
            </div>
          <?php endif ?>
          <div class="alert alert-success" role="alert">

          </div>
          <?= form_open_multipart('backend/juegos/subida/' . $id) ?>
            <h1>Solo imagenes jpg</h1>
            <div class="form-group">
              <?= form_label('Foto:', 'foto') ?>
              <?= form_upload('foto', set_value('foto', '', FALSE),
                             'id="foto" accept="image/*" class="form-control"') ?>
            </div>
            <?= form_submit('insertar', 'Insertar', 'class="btn btn-success"') ?>
            <?= anchor('/backend/juegos/index', 'Volver', 'class="btn btn-info" role="button"') ?>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
