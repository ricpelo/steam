<?php template_set('title', 'Listado de usuarios') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Listado de usuarios</h3>
        </div>
        <div class="panel-body">
          <p>
              <?= $asd ?>
          </p>
          <p align="center">
            <?= anchor('usuarios/insertar', 'Insertar',
                       'class="btn btn-success" role="button"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
