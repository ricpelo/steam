<?php template_set('title', 'Listado de artículos') ?>

<?= miga_pan() ?>

<div class="row col-md-12 col-md-offset-0">
    <div class="panel panel-custom">
      <div class="panel-body horizontal">
          <?php foreach ($generos as $genero): ?>
              <div class="col-sm-2 genero">
                  <?= anchor('portal/juegos/genero/' . $genero['id'], $genero['nombre'],
                             'role="button" class="btn btn-custom"') ?>
              </div>
          <?php endforeach; ?>
      </div>
    </div>
</div>

<?php if(isset($destacados)): ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row col-md-8 col-md-offset-2">
        <div id="destacados" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#destacados" data-slide-to="0" class="active"></li>
            <li data-target="#destacados" data-slide-to="1"></li>
            <li data-target="#destacados" data-slide-to="2"></li>
            <li data-target="#destacados" data-slide-to="3"></li>
            <li data-target="#destacados" data-slide-to="4"></li>
          </ol>

          <!-- Wrapper for slides -->
         <div class="carousel-inner" role="listbox">
             <?php foreach($destacados as $destacado): ?>
               <div class="item <?= isset($primera) ? '' : 'active' ?>">
                   <?= anchor('/portal/juegos/ficha/' . $destacado['id'],
                           img('images/juegos/'.$destacado['id'].'.jpg')) ?>
                 <div class="carousel-caption">
                   <h3><?= anchor('/portal/juegos/ficha/' . $destacado['id'],
                                    $destacado['nombre']) ?></h3>
                   <p><?= anchor('/portal/juegos/ficha/' . $destacado['id'],
                                    $destacado['resumen']) ?></p>
                 </div>
               </div>
               <?php $primera = true; ?>
             <?php endforeach; ?>
         </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#destacados" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#destacados" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
  </div>
<?php endif; ?>

<?php if(isset($valoradas)): ?>
  <div class="row col-md-12 col-md-offset-0">
      <div class="panel panel-custom">
        <div class="panel-heading">
          <h3 class="panel-title">Juegos más valorados</h3>
        </div>
        <div class="panel-body horizontal">
            <button id="ant-valorados" class="btn btn-custom"><</button>
            <div class="valoraciones">
                <?php foreach ($valoradas as $valorada): ?>
                    <div class="col-sm-2">
                        <div class="valoradas">
                            <div>
                                <?= anchor('/portal/juegos/ficha/' . $valorada['id'],
                                        img('images/juegos/'.$valorada['id'].'.jpg')) ?>
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
            <button id="sig-valorados" class="btn btn-custom">></button>
        </div>
      </div>
  </div>
<?php endif; ?>

<?php if(isset($fechas)): ?>
  <div class="row col-md-12 col-md-offset-0">
      <div class="panel panel-custom">
        <div class="panel-heading">
          <h3 class="panel-title">Juegos recientes</h3>
        </div>
        <div class="panel-body horizontal">
            <button id="ant-fechas" class="btn btn-custom"><</button>
            <div class="fechados">
                <?php foreach ($fechas as $fecha): ?>
                    <div class="col-sm-2">
                        <div class="fechas">
                            <div>
                                <?= anchor('/portal/juegos/ficha/' . $fecha['id'],
                                        img('images/juegos/'.$fecha['id'].'.jpg')) ?>
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
            <button id="sig-fechas" class="btn btn-custom">></button>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if (isset($proximos) && $proximos !== FALSE): ?>
    <div class="row col-md-12 col-md-offset-0">
        <div class="panel panel-custom">
          <div class="panel-heading">
            <h3 class="panel-title">Próximamente</h3>
          </div>
          <div class="panel-body horizontal">
              <button id="ant-proximos" class="btn btn-custom"><</button>
              <div class="aproximados">
                  <?php foreach ($proximos as $proximo): ?>
                      <div class="col-sm-2">
                          <div class="proximos">
                              <div>
                                  <?= anchor('/portal/juegos/ficha/' . $proximo['id'],
                                          img('images/juegos/'.$proximo['id'].'.jpg')) ?>
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
              <button id="sig-proximos" class="btn btn-custom">></button>
          </div>
      </div>
    </div>
<?php endif; ?>

<?php if(isset($filas) && $filas !== FALSE): ?>
<div class="container-fluid" style="padding-top: 20px">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-custom">
        <div class="panel-heading">
          <h3 class="panel-title">Listado de Juegos</h3>
        </div>
        <div class="panel-body">
            <div class="fichas">
              <?php foreach ($filas as $fila): ?>
                <div class="ficha">
                    <div>
                        <?= anchor('/portal/juegos/ficha/' . $fila['id'],
                                img('images/juegos/'.$fila['id'].'.jpg')) ?>
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
              <?php else: ?>
                  <div>
                      <div>
                          No hay ningun resultado
                      </div>
                  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<script>
    var valorados = 0;
    var fechas    = 0;
    var proximos  = 0;
    var total     = 0;
    var maxfilas;
    var maxproximos;

    function inicializa() {
        $.get("<?= base_url('portal/juegos/maxpags') ?>",
                    function(r) {
                        maxfilas = parseInt(r);
                        $("#sig-valorados").on("click", masValorados);
                        $("#ant-valorados").on("click", menosValorados);
                        $("#sig-fechas").on("click", masFechas);
                        $("#ant-fechas").on("click", menosFechas);
                        $(window).scroll(function() {
                                if($(window).scrollTop() + $(window).height() == $(document).height()) {
                                    cargarMas();
                            }
                        });
                        if (valorados === 0) { $("#ant-valorados").hide(); }
                        if (maxfilas <= valorados) { $("#sig-valorados").hide(); }
                        if (fechas === 0) { $("#ant-fechas").hide(); }
                        if (maxfilas <= fechas) { $("#sig-fechas").hide(); }
                        $.get("<?= base_url('portal/juegos/maxproximos') ?>",
                            function(res) {
                                maxproximos = parseInt(res);
                                $("#sig-proximos").on("click", masProximos);
                                $("#ant-proximos").on("click", menosProximos);
                                if (proximos === 0) { $("#ant-proximos").hide(); }
                                if (maxproximos <= proximos) { $("#sig-proximos").hide(); }
            })});
        };

    inicializa();

    function masValorados() {
        valorados++;
        llamar('valoracion', valorados, insertaValorados);
        if (maxfilas <= valorados) { $("#sig-valorados").prop("disabled", true).fadeOut(1000); }
        if (valorados !== 0) { $("#ant-valorados").prop("disabled", '').fadeIn(1000); }
    }

    function menosValorados() {
        valorados--;
        llamar('valoracion', valorados, insertaValorados);
        if (maxfilas > valorados) { $("#sig-valorados").prop("disabled", '').fadeIn(1000); }
        if (valorados === 0) { $("#ant-valorados").prop("disabled", true).fadeOut(1000); }
    }

    function insertaValorados(r) {
        $(".valoraciones").fadeOut(500, function() {
            var html = '';
            $(".valoraciones").empty()
            for (var i = 0; i < r.length; i++) {
                html += '<div class="col-sm-2">'+
                                '<div class="valoradas">'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<img src="<?= base_url('/images/juegos') ?>/'+ r[i].id + '.jpg" /></a>'+
                                    '</div>'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<h5>'+r[i].nombre+'</h5></a>'+
                                        '<form>'+
                                            '<input id="input-1" class="rating" data-min="0" data-max="5"'+
                                                ' data-step="1" value="'+ r[i].valoracion + '"' + ' data-readonly="true"'+
                                                ' data-show-clear="false" data-show-caption="false" data-size="xs">'+
                                        '</form>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            }
            $(".valoraciones").html(html);
            load_js();
            $(".valoraciones").fadeIn(500);
        });
    }

    function masFechas() {
        fechas++;
        llamar('fecha_salida', fechas, insertaFechas);
        if (maxfilas <= fechas) { $("#sig-fechas").prop("disabled", true).fadeOut(1000); }
        if (fechas !== 0) { $("#ant-fechas").prop("disabled", '').fadeIn(1000); }
    }

    function menosFechas() {
        fechas--;
        llamar('fecha_salida', fechas, insertaFechas);
        if (maxfilas > fechas) { $("#sig-fechas").prop("disabled", '').fadeIn(1000); }
        if (fechas === 0) { $("#ant-fechas").prop("disabled", true).fadeOut(1000); }
    }

    function insertaFechas(r) {
        $(".fechados").fadeOut(500, function() {
            var html = '';
            $(".fechados").empty()
            for (var i = 0; i < r.length; i++) {
                html += '<div class="col-sm-2">'+
                                '<div class="fechas">'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<img src="<?= base_url('/images/juegos') ?>/'+ r[i].id + '.jpg" /></a>'+
                                    '</div>'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<h5>'+r[i].nombre+'</h5></a>'+
                                        '<form>'+
                                            '<input id="input-1" class="rating" data-min="0" data-max="5"'+
                                                ' data-step="1" value="'+ r[i].valoracion + '"' + ' data-readonly="true"'+
                                                ' data-show-clear="false" data-show-caption="false" data-size="xs">'+
                                        '</form>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            }
            $(".fechados").html(html);
            load_js();
            $(".fechados").fadeIn(500);
        });
    }

    function masProximos() {
        proximos++;
        llamar('proximos', proximos, insertaProximos);
        if (maxproximos <= proximos) { $("#sig-proximos").prop("disabled", true).fadeOut(1000); }
        if (proximos !== 0) { $("#ant-proximos").prop("disabled", '').fadeIn(1000); }
    }

    function menosProximos() {
        proximos--;
        llamar('proximos', proximos, insertaProximos);
        if (maxproximos > proximos) { $("#sig-proximos").prop("disabled", '').fadeIn(1000); }
        if (proximos === 0) { $("#ant-proximos").prop("disabled", true).fadeOut(1000); }
    }

    function insertaProximos(r) {
        $(".aproximados").fadeOut(500, function() {
            var html = '';
            $(".aproximados").empty()
            for (var i = 0; i < r.length; i++) {
                html += '<div class="col-sm-2">'+
                                '<div class="fechas">'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<img src="<?= base_url('/images/juegos') ?>/'+ r[i].id + '.jpg" /></a>'+
                                    '</div>'+
                                    '<div>'+
                                        '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                                        '<h5>'+r[i].nombre+'</h5></a>'+
                                        '<form>'+
                                            '<input id="input-1" class="rating" data-min="0" data-max="5"'+
                                                ' data-step="1" value="'+ r[i].valoracion + '"' + ' data-readonly="true"'+
                                                ' data-show-clear="false" data-show-caption="false" data-size="xs">'+
                                        '</form>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
            }
            $(".aproximados").html(html);
            load_js();
            $(".aproximados").fadeIn(500);
        });
    }

    function cargarMas() {
        if (maxfilas <= total) { return; }
        total++;
        $.getJSON("<?= base_url('portal/juegos') ?>/cargarmas/" + total, function(r) { insertarTotal(r); });
    }

    function insertarTotal(r) {
        var html = '';
        //$(".fichas").empty();
        for (var i = 0; i < r.length; i++) {
            html += '<div class="ficha">'+
                        '<div>'+
                            '<a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                            '<img src="<?= base_url('/images/juegos') ?>/'+ r[i].id + '.jpg" /></a>'+
                        '</div>'+
                        '<div>'+
                            '<h1><a href="<?= base_url('/portal/juegos/ficha') ?>/' + r[i].id + '">'+
                            r[i].nombre+'</a></h1>'+
                            '<h2>' + r[i].precio + '€</h2>'+
                            '<p>' + r[i].resumen + '</p>'+
                            '<form>'+
                                '<input id="input-1" class="rating" data-min="0" data-max="5"'+
                                    ' data-step="1" value="'+r[i].valoracion+'" data-readonly="true"' +
                                    ' data-show-clear="false" data-show-caption="false" data-size="xs">'+
                            '</form>'+
                        '</div>'+
                    '</div>';
        }
        $(".ficha:last-of-type").after(html);
        load_js();
    }

    function llamar(orden, offset, funcion) {
        $.getJSON("<?= base_url('portal/juegos') ?>/mas/" + orden + "/" + offset, function(r) { funcion(r); });
    }

    function load_js()
   {
       $("#rating").remove();
      var head= document.getElementsByTagName('head')[0];
      var script= document.createElement('script');
      script.type= 'text/javascript';
      script.id = 'rating';
      script.src= '<?= base_url() ?>js/star-rating.min.js';
      head.appendChild(script);
   }
</script>
