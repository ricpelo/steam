<?php template_set('title', 'Ficha del juego') ?>

<?= miga_pan() ?>

<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-custom">
        <div class="panel-body">
            <div class="ficha">
                <div>
                    <td><?= img('images/juegos/'.$juego['id'].'.jpg') ?></td>
                </div>
                <div>
                    <h1><?= $juego['nombre'] ?></h1>
                    <h2><?= $juego['precio'] ?>€</h2>
                    <p><?= $juego['descripcion'] ?></p>
                    <?php if (!isset($rating) OR $rating !== FALSE): ?>
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
                            <?= anchor('/portal/juegos/comprar/' . $juego['id'],
                                       'Comprar (' . $juego["precio"] . ' €)',
                                       'class="btn btn-primary" role="button"'); ?>
                        </form>
                    <?php else: ?>
                        <h3>Disponible: <?= $juego['fecha_salida'] ?></h3>
                    <?php endif; ?>
                </div>
            </div>
            <br />
            <?php if (logueado()): ?>
                <?= form_open('portal/juegos/ficha/'.$juego['id']) ?>
                <input type="hidden" id="padre" name="padre_comentario"/>
                  <div id="comentar" class="form-group">
                    <p id="referencia"></p>
                    <?= form_label('Introduce un comentario:', 'comentario') ?>
                    <?= form_textarea('comentario', '', 'id="comentario" class="form-control" required') ?>
                  </div>
                  <?= form_submit('enviar', 'Enviar', 'class="btn btn-success"') ?>
                <?= form_close() ?>
                <br />
            <?php else: ?>
                <div>
                    <form>
                      <fieldset class="form-group">
                        <label for="nuevoComentario"><?= anchor('/usuarios/login', 'Logueate') ?> o <?= anchor('/usuarios/registrar', 'Registrarse') ?>  para escribir comentarios. </label>
                      </fieldset>
                    </form>
                </div>
            <?php endif;

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
                                      <div class="comment-user"><i class="fa fa-user"><h4><?= nick($comentario['autor']) ?></h4></i> </div>
                                     </header>
                                    <div class="comment-post">
                                      <p id="contenido<?= $comentario['id'] ?>">
                                        <?= $comentario['contenido'] ?>
                                      </p>
                                    </div>
                                    <p class="text-right"><a id=<?= $comentario['id'] ?> href='#comentar' class="btn btn-default btn-sm respuesta"><i class="fa fa-reply"></i> Responder</a></p>

                                    <?php
                                        if(logueado() && $comentario['autor'] === $actual)
                                        {?>

                                            <?= form_open('portal/juegos/ficha/'.$juego['id']) ?>
                                            <input type="hidden" value="<?= $comentario['id'] ?>" name="idmsj">
                                            <?= form_submit('borrar', 'Borrar', 'class="btn btn-success"') ?>
                                            <?= form_close() ?>
                                            <?php
                                        }
                                    ?>


                                  </div>
                                  <time class="comment-date" datetime=<?= $comentario['created_at'] ?> ><i class="fa fa-clock-o"></i> Escrito el: <?= $comentario['created_at'] ?></time>

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


    $("a.respuesta").click(pintar);
    function pintar()
    {
        $("#padre").val(this.id);
        $("#referencia").text("Comentario respuesta a:"+$("#contenido"+this.id).text());
        $("#comentario").focus();

    }
</script>
