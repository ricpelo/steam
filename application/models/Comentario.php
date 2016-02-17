<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comentario extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from comentarios')->result_array();
    }
    public function por_juego($id)
    {
        $res = $this->db->get_where('comentarios', array('padre_juego' => $id));
        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }
    public function por_comentario($id)
    {
        $res = $this->db->get_where('comentarios', array('padre_comentario' => $id));
        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }
    public function insertar($valores)
    {
        return $this->db->insert('comentarios', $valores);
    }

    public function borrar($id)
    {
        return $this->db->query("delete from comentarios where id = ?",
                                array($id));
    }

    /* PINTAR COMENTARIOS

CON LISTA DE JUEGOS
    <?php foreach ($comentarios as $comentario)
      {
          if ($comentario['padre_juego'] === $fila['id'])
          {
              if ($comentario['padre_comentario'] === null)
              {
              ?>
              <td><?= $comentario['comentario'] ?></td>
              <?php
              }
              foreach ($comentarios as $com)
              {
                  if ($com['padre_comentario'] === $comentario['id'])
                  {
                      ?>
                      <td><?= $com['comentario'] ?></td>
                      <?php
                  }
              }
          }
      }?>
EN UN SOLO JUEGO
      <?php foreach ($comentarios as $comentario)
        {

            if ($comentario['padre_comentario'] === null)
            {
            ?>
            <td><?= $comentario['comentario'] ?></td>
            <?php
            }
            foreach ($comentarios as $com)
            {
                if ($com['padre_comentario'] === $comentario['id'])
                {
                    ?>
                    <td><?= $com['comentario'] ?></td>
                    <?php
                }
            }

        }?>


        //PRUEBA

        $this->load->model('Comentario');
        $data['comentarios'] = $this->Comentario->todos();

http://www.bootply.com/andrewnite/qotUOFAL7N
        //PRUEBA
        <section class="comment-list">
                  <!-- First Comment -->
                  <div class="row">
                    <div class="col-md-2 col-sm-2 hidden-xs">
                      <figure class="thumbnail">
                        <figcaption class="text-center">username</figcaption>
                      </figure>
                    </div>
                    <div class="col-md-10 col-sm-10">
                      <div class="panel panel-default arrow left">
                        <div class="panel-body">
                          <header class="text-left">
                            <div class="comment-user"><i class="fa fa-user"></i> username</div>
                            <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                          </header>
                          <div class="comment-post">
                            <p>
                              <?= $comentario['comentario'] ?>
                            </p>
                          </div>
                          <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> Responder</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Second Comment Reply -->
          <div class="row">
            <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
              <figure class="thumbnail">
                <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg">
                <figcaption class="text-center">username</figcaption>
              </figure>
            </div>
            <div class="col-md-9 col-sm-9">
              <div class="panel panel-default arrow left">
                <div class="panel-heading right">Reply</div>
                <div class="panel-body">
                  <header class="text-left">
                    <div class="comment-user"><i class="fa fa-user"></i> username</div>
                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
                  </header>
                  <div class="comment-post">
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                  </div>
                  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                </div>
              </div>
            </div>
          </div>
          </section>



      */


}
