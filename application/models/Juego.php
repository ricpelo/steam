<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Juego extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from juegos')->result_array();
    }
    
    public function borrar($id)
    {
        return $this->db->query("delete from juegos where id = ?",
                                array($id));
    }
    
    public function por_id($id)
    {
        $res = $this->db->query('select * from juegos where id = ?',
                                array($id));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }
    
    public function insertar($valores)
    {
        return $this->db->insert('juegos', $valores);
    }
    
    public function por_codigo($codigo)
    {
        $res = $this->db->query('select * from juegos where codigo = ?',
                                array($codigo));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }
    
    public function editar($valores, $id)
    {
        return $this->db->where('id', $id)->update('juegos', $valores);
    }
}


