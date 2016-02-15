<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rol extends CI_Model
{
    public function todos()
    {
        return $this->db->get('roles')->result_array();
    }

    public function por_id($id)
    {
        $res = $this->db->query('select *
                                   from roles
                                  where id::text = ?', array($id));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function lista()
    {
        $a = $this->todos();
        $ids = array_column($a, 'id');
        $descripciones = array_column($a, 'descripcion');
        return array_combine($ids, $descripciones);
    }

/*
    public function borrar($id)
    {
        return $this->db->delete('usuarios', array('id' => $id));
    }

    public function insertar($valores)
    {
        return $this->db->insert('usuarios', $valores);
    }

    public function editar($valores, $id)
    {
        return $this->db->where('id', $id)->update('usuarios', $valores);
    }
*/
}
