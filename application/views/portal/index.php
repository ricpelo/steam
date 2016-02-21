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
                            <td><?= anchor('/portal/juegos/ficha/' . $valorada['id'],
                                    img('images/juegos/'.$valorada['id'].'.jpg')) ?></td>
                        </div>
                        <div>
                            <h5><?= anchor('/portal/juegos/ficha/' . $valorada['id'],
                                    $valorada['nombre']) ?></h5>
                            <p><?= $valorada['precio'] ?>€</p>
                            <form>
                                <input id="input-1" class="rating" data-min="0" data-max="5"
                                    data-step="1" value="<?= $valorada['valoracion'] ?>" data-readonly="true"
                                    data-show-clear="false" data-show-caption="false" data-size="xs">
                            </form>
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
                            <td><?= anchor('/portal/juegos/ficha/' . $fecha['id'],
                                    img('images/juegos/'.$fecha['id'].'.jpg')) ?></td>
                        </div>
                        <div>
                            <h5><?= anchor('/portal/juegos/ficha/' . $fecha['id'],
                                    $fecha['nombre']) ?></h5>
                            <p><?= $fecha['precio'] ?>€</p>
                            <form>
                                <input id="input-1" class="rating" data-min="0" data-max="5"
                                    data-step="1" value="<?= $fecha['valoracion'] ?>" data-readonly="true"
                                    data-show-clear="false" data-show-caption="false" data-size="xs">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php if ($proximos !== FALSE): ?>
    <div class="row col-md-12 col-md-offset-0">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Proximamente</h3>
          </div>
          <div class="panel-body horizontal">
              <?php foreach ($proximos as $proximo): ?>
                  <div class="col-sm-2">
                      <div class="valoradas">
                          <div>
                              <td><?= anchor('/portal/juegos/ficha/' . $proximo['id'],
                                      img('images/juegos/'.$proximo['id'].'.jpg')) ?></td>
                          </div>
                          <div>
                              <h5><?= anchor('/portal/juegos/ficha/' . $proximo['id'],
                                      $proximo['nombre']) ?></h5>
                              <p><?= $proximo['precio'] ?>€</p>
                              <p>Disponible: <?= $proximo['fecha_salida'] ?> </p>
                          </div>
                      </div>
                  </div>
              <?php endforeach; ?>
          </div>
      </div>
    </div>
<?php endif; ?>

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
                    <td><?= anchor('/portal/juegos/ficha/' . $fila['id'],
                            img('images/juegos/'.$fila['id'].'.jpg')) ?></td>
                </div>
                <div>
                    <h1><?= anchor('/portal/juegos/ficha/' . $fila['id'],
                                    $fila['nombre']) ?></h1>
                    <h2><?= $fila['precio'] ?>€</h2>
                    <p><?= $fila['resumen'] ?></p>
                    <form>
                        <input id="input-1" class="rating" data-min="0" data-max="5"
                            data-step="1" value="<?= $fila['valoracion'] ?>" data-readonly="true"
                            data-show-clear="false" data-show-caption="false" data-size="xs">
                    </form>
                </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</div>
