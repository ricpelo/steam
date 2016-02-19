<?php template_set('title', 'Listado de artículos') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row col-md-12 col-md-offset-0">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Juegos más valorados</h3>
        </div>
        <div class="panel-body horizontal">
            <?php foreach ($valoradas as $valorada): ?>
                <div class="col-sm-2">
                    <div class="valoradas">
                        <div>
                            <td><?= img('images/juegos/'.$valorada['id'].'.jpg') ?></td>
                        </div>
                        <div>
                            <h5><?= $valorada['nombre'] ?></h5>
                            <p><?= $valorada['precio'] ?>€</p>
                            <form>
                                <input id="input-1" class="rating" data-min="0" data-max="5"
                                    data-step="1" value="<?= $valorada['valoracion'] ?>" data-readonly="true"
                                    data-show-clear="false" data-show-caption="false" data-size="xs">
                            </form>
                            <p>
                                <?= anchor('/portal/juegos/ficha/' . $valorada['id'], 'Ver ficha',
                                    'class="btn btn-danger btn-xs" role="button"') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
      </div>
  </div>

  <div class="row col-md-12 col-md-offset-0">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Juegos recientes</h3>
        </div>
        <div class="panel-body horizontal">
            <?php foreach ($fechas as $fecha): ?>
                <div class="col-sm-2">
                    <div class="valoradas">
                        <div>
                            <td><?= img('images/juegos/'.$fecha['id'].'.jpg') ?></td>
                        </div>
                        <div>
                            <h5><?= $fecha['nombre'] ?></h5>
                            <p><?= $fecha['precio'] ?>€</p>
                            <form>
                                <input id="input-1" class="rating" data-min="0" data-max="5"
                                    data-step="1" value="<?= $fecha['valoracion'] ?>" data-readonly="true"
                                    data-show-clear="false" data-show-caption="false" data-size="xs">
                            </form>
                            <p>
                                <?= anchor('/portal/juegos/ficha/' . $fecha['id'], 'Ver ficha',
                                    'class="btn btn-danger btn-xs" role="button"') ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

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
                    <td><?= img('images/juegos/'.$fila['id'].'.jpg') ?></td>
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
                        <?= anchor('/portal/juegos/ficha/' . $fila['id'], 'Ver ficha',
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
