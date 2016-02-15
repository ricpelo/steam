<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comentario extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from comentarios')->result_array();
    }
    public function por_juego($id)
    {
        $res = $this->db->get_where('comentarios', array('padre_juego' => $id, 'padre_comentario' => NULL));
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
    /* PINTAR COMENTARIOS


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

      */


}
