<?php template_set('title', 'Listado de artículos') ?>

<?= miga_pan() ?>

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
              <th>Nombre</th>
              <th>Precio</th>
              <th>Valoracion</th>
              <th colspan="3">Acciones</th>
            </thead>
            <tbody>
              <?php foreach ($filas as $fila): ?>
                <tr>
                  <td><?= $fila['nombre'] ?></td>
                  <td><?= $fila['precio'] ?></td>
                  <td><?= $fila['valoracion'] ?></td>
                  <td align="center">
                    <?= anchor('/backend/juegos/borrar/' . $fila['id'], 'Borrar',
                               'class="btn btn-danger btn-xs" role="button"') ?>
                  </td>
                  <td align="center">
                    <?= anchor('/backend/juegos/editar/' . $fila['id'], 'Editar',
                               'class="btn btn-warning btn-xs" role="button"') ?>
                  </td>
                  <td align="center">
                    <?= anchor('/backend/juegos/subida/' . $fila['id'], 'Subir/Cambiar imagen',
                               'class="btn btn-success btn-xs" role="button"') ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

          <p align="center">
            <?= anchor('/backend/juegos/insertar', 'Insertar',
                       'class="btn btn-success" role="button"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
