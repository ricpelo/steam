<?php template_set('title', 'Perfil') ?>
<div class="container-fluid" style="padding-top:20px">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Perfil</h3>
        </div>
        <div class="panel-body">
          <?php if ( ! empty(error_array())): ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors() ?>
            </div>
          <?php endif ?>
          <?= form_open_multipart('usuarios/foto/' . $id) ?>
            <div class="form-group">
              <?= form_label('Foto:', 'foto') ?>
              <?= form_upload('foto', set_value('foto', '', FALSE),
                             'id="foto" accept="image/*" class="form-control"') ?>
            </div>
            <?= form_submit('insertar', 'Insertar', 'class="btn btn-success"') ?>
            <?= anchor('/usuarios/login', 'Volver', 'class="btn btn-info" role="button"') ?>
          <?= form_close() ?>
        </div>
      </div>
    </div>
  </div>
</div>
