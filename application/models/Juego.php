<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Juego extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from juegos')->result_array();
    }
}


