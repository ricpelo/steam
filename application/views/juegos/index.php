<?php template_set('title', 'Listado de artículos') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Listado de artículos</h3>
        </div>
        <div class="panel-body">
          <table border="1"
                 class="table table-striped table-bordered table-hover table-condensed">
            <thead>
              <th>Código</th>
              <th>Descripción</th>
              <th colspan="2">Acciones</th>
            </thead>
            <tbody>
              <?php foreach ($filas as $fila): ?>
                <tr>
                  <td><?= $fila['codigo'] ?></td>
                  <td><?= $fila['descripcion'] ?></td>
                  <td align="center">
                    <?= anchor('/articulos/borrar/' . $fila['id'], 'Borrar',
                               'class="btn btn-danger btn-xs" role="button"') ?>
                  </td>
                  <td align="center">
                    <?= anchor('/articulos/editar/' . $fila['id'], 'Editar',
                               'class="btn btn-warning btn-xs" role="button"') ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
          <p align="center">
            <?= anchor('articulos/insertar', 'Insertar',
                       'class="btn btn-success" role="button"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>