<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Comentario extends CI_Model
{
    public function todos($id, $padre_comentario = NULL, $nivel = 0)
    {
        $res = $this->db->get_where('comentarios',
            array('padre_juego' => $id, 'padre_comentario' => $padre_comentario));

        if ($res->num_rows() === 0)
        {
            return FALSE;
        }

        $resultado = array();

        foreach ($res->result_array() as $r)
        {
            $r['nivel'] = $nivel;
            $resultado[] = $r;
            $h = $this->todos($id, $r['id'], $nivel + 1);
            if ($h !== FALSE)
            {
                $resultado = array_merge($resultado, $h);
            }
        }

        return $resultado;
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





}
