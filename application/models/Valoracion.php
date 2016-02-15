<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Valoracion extends CI_Model
{
    public function por_ids($id_usuario, $id_juego)
    {
        return $this->db->query('select valoracion
                                   from valoraciones
                                  where id_usuario = ? and id_juego = ?',
                                array($id_usuario, $id_juego))->row_array();
    }

    public function tiene_valoracion($id_usuario, $id_juego)
    {
        $res = $this->db->query('select *
                                   from valoraciones
                                  where id_juego = ? and id_usuario = ?',
                                array($id_juego, $id_usuario));
        return $res->num_rows() > 0;
    }

    public function insertar($valores)
    {
        return $this->db->insert('valoraciones', $valores);
    }

    public function editar($id_juego, $id_usuario, $valoracion)
    {
        return $this->db->where('id_juego', $id_juego)
                        ->where('id_usuario', $id_usuario)
                        ->update('valoraciones', array($valoracion));
    }
}
