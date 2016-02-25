<?php template_set('title', 'Carrito') ?>

<?= miga_pan() ?>

<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Carrito de <?= $usuario['nick'] ?></h3>
        </div>
        <div class="panel-body">
            <div class="ficha">
                <div class="lista">
                    <?php if($juegos === FALSE): ?>
                        <p>
                            No hay juegos comprados.
                        </p>
                    <?php else: ?>
                        <?php foreach($juegos as $juego): ?>
                            <div class="seccion">
                                <div class="imagen">
                                    <?= img('images/juegos/' . $juego['id'] . '.jpg') ?>
                                </div>
                                <div class="info">
                                    <p>
                                        Precio: <?= $juego['precio'] ?> €
                                    </p>
                                    <p>
                                        Nombre: <?= $juego['nombre'] ?>
                                    </p>
                                </div>
                                <button type="button" aria-label="Left Align"
                                        class="btn btn-default quitar glyphicon glyphicon-remove"
                                        aria-hidden="true" value="<?= $juego['id'] ?>">
                                </button>
                            </div>
                        <?php endforeach; ?>
                        <p class="total">
                            Total: <?= $total['sum'] ?> €
                        </p>
                        <?= anchor('', 'Comprar todos',
                                   'class="btn btn-success" role="button"') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $("button.quitar").on("click", quitar);

    function quitar() {
        $.post('<?= base_url('usuarios/quitar/') ?>'+$(this).val());
        $(this).parent().fadeOut("slow", function () {
            $(this).remove();
        });
    }
</script>
