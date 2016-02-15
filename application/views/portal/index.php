<?php template_set('title', 'Listado de artículos') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Listado de Juegos</h3>
        </div>
        <div class="panel-body">
          <?php foreach ($filas as $fila): ?>
            <div class="ficha">
                <div>
                    <td><?= img('images/'.$fila['id'].'.jpg') ?></td>
                </div>
                <div>
                    <h1><?= $fila['nombre'] ?></h1>
                    <h2><?= $fila['precio'] ?>€</h2>
                    <p><?= $fila['resumen'] ?></p>
                    <p>
                        <?= anchor('/portal/juego/ficha' . $fila['id'], 'Ver ficha',
                            'class="btn btn-danger btn-xs" role="button"') ?>
                    </p>
                </div>
            </div>
          <?php endforeach ?>
          <p align="center">
            <?= anchor('juegos/insertar', 'Insertar',
                       'class="btn btn-success" role="button"') ?>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
