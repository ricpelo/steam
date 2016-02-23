<?php template_set('title', 'Carrito') ?>

<?= miga_pan() ?>

<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Carrito de <?= $usuario['nombre'] ?></h3>
        </div>
        <div class="panel-body">
            <div class="ficha">
                <div class="">
                    <?php if($juegos !== FALSE): ?>
                        <p>
                            No hay juegos comprados.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
