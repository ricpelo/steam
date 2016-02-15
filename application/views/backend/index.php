<?php template_set('title', 'Listado de artículos') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Listado de Juegos</h3>
        </div>
        <div class="panel-body">
          <table border="1"
                 class="table table-striped table-bordered table-hover table-condensed">
            <thead>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Imágenes</th>
              <th>Valoración</th>
              <th colspan="2">Acciones</th>
            </thead>
            <tbody>
              <?php foreach ($filas as $fila): ?>
                <tr>
                  <td><?= $fila['descripcion'] ?></td>
                  <td><?= $fila['precio'] ?></td>
                  <td><?= img('images/'.$fila['id'].'.jpg') ?></td>
                  <td><?= $fila['valoracion'] ?></td>
                  <td align="center">
                    <?= anchor('/juegos/borrar/' . $fila['id'], 'Borrar',
                               'class="btn btn-danger btn-xs" role="button"') ?>
                  </td>
                  <td align="center">
                    <?= anchor('/juegos/editar/' . $fila['id'], 'Editar',
                               'class="btn btn-warning btn-xs" role="button"') ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <p align="center">
            <?= anchor('juegos/insertar', 'Insertar',
                       'class="btn btn-success" role="button"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>