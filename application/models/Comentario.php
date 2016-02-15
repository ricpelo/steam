<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from comentarios')->result_array();
    }

    public function por_padre($id)
    {
        return $this->db->get_where('comentarios', array('padre_comentario' => $id));
    }

}
