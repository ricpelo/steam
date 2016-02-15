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
                    <td><?= img('images/'.$juego['id'].'.jpg') ?></td>
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
                        <label>Tu valoración</label>
                        <input id="input-2" class="rating" data-min="0" data-max="5"
                            data-step="1" value="<?= $juego['valoracion'] ?>"
                            data-show-clear="false" data-show-caption="false" data-size="xs">
                    </form>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
    $("#input-2").click(valoracion);

    function valoracion() {
        var val = $(this).val();
        $.post("<?= base_url() ?>portal/juegos/valoracion/<?= usuario_id() ?>/<?= $juego['id'] ?>/" + val, enviar(r));
    }

    function enviar(r) {
        $("input:first-of-type").val(r.total);
        $("input:nth-of-type(2)").val(r.val);
    }
</script>
