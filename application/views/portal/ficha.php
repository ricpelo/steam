<?php template_set('title', 'Ficha del juego') ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $juego['nombre'] ?></h3>
        </div>
        <div class="panel-body">
            <div class="ficha">
                <div>
                    <td><?= img('images/juegos/'.$juego['id'].'.jpg') ?></td>
                </div>
                <div>
                    <h1><?= $juego['nombre'] ?></h1>
                    <h2><?= $juego['precio'] ?>€</h2>
                    <p><?= $juego['descripcion'] ?></p>
                    <form>
                        <label>Valoración total</label>
                        <input id="input-1" class="rating" data-min="0" data-max="5"
                            data-step="1" value="<?= $juego['valoracion'] ?>" data-readonly="true"
                            data-show-clear="false" data-show-caption="false" data-size="xs">
                        <?php if (logueado()): ?>
                            <label>Tu valoración</label>
                            <input id="input-2" class="rating" data-min="0" data-max="5"
                            data-step="1" value="<?= $usuario['valoracion'] ?>"
                            data-show-clear="false" data-show-caption="false" data-size="xs">
                        <?php endif; ?>
                    </form>


                </div>

            </div>
            <?php
                if ($comentarios !== FALSE)
                {
                    foreach ($comentarios as $comentario)
                    { ?>
                        <div class='row'>
                          <div class='col-md-offset-<?= $comentario['nivel'] > 3 ? 3: $comentario['nivel']  ?>' >
                              <div class="col-md-2 col-sm-2 hidden-xs">
                                <figure class="thumbnail">
                                  <figcaption class="text-center"><?= img('images/usuarios/'.$comentario['autor'].'.jpeg') ?></figcaption>
                                </figure>
                              </div>
                              <div class="col-md-10 col-sm-10">
                                <div class="panel panel-default arrow left">
                                  <div class="panel-body">
                                    <header class="text-left">
                                      <div class="comment-user"><i class="fa fa-user"></i> <?= $comentario['autor'] ?></div>
                                      <time class="comment-date" datetime="<?= $comentario['created_at'] ?> "><i class="fa fa-clock-o"></i> Escrito el: <?= $comentario['created_at'] ?></time>
                                    </header>
                                    <div class="comment-post">
                                      <p>
                                        <?= $comentario['contenido'] ?>
                                      </p>
                                    </div>
                                    <p class="text-right"><a href=<?= $comentario['id'] ?> class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Responder</a></p>
                                  </div>
                                </div>
                              </div>
                        </div>
                      </div><?php
                    }
                }
                ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $("#input-2").change(valoracion);

    function valoracion() {
        var val = $(this).val();
        $.getJSON("<?= base_url() ?>portal/juegos/valoracion/<?= usuario_id() ?>/<?= $juego['id'] ?>/" +
                val, enviar);
    }

    function enviar(r) {
        $("#input-1").rating('update', r.total);
    }
</script>
