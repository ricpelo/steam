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
                    <form>
                        <input id="input-1" class="rating" data-min="0" data-max="5"
                            data-step="1" value="<?= $fila['valoracion'] ?>" data-readonly="true"
                            data-show-clear="false" data-show-caption="false" data-size="xs">
                    </form>
                    <p>
                        <?= anchor('/portal/juego/ficha' . $fila['id'], 'Ver ficha',
                            'class="btn btn-danger btn-xs" role="button"') ?>
                    </p>
                </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>
