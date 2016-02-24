<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Juego extends CI_Model
{
    public function todos()
    {
        return $this->db->query('select * from v_juegos')->result_array();
    }

    public function order_valoraciones()
    {
        return $this->db->query('select *
                                   from v_juegos
                               order by valoracion desc
                                  limit 5 offset 0')->result_array();
    }

    public function mas($orden, $offset) {
        return $this->db->query('select *
                                   from v_juegos
                               order by '.$orden.' desc
                                  limit 5 offset ? * 5', array($offset))->result_array();
    }

    public function masproximos($offset) {
        return $this->db->query('select *
                                   from v_proximos
                               order by fecha_salida desc
                                  limit 5 offset ? * 5', array($offset))->result_array();
    }

    public function maxpags() {
        return floor($this->db->query('select * from v_juegos')->num_rows()/5);
    }

    public function maxproximos() {
        return floor($this->db->query('select * from v_proximos')->num_rows()/5);
    }

    public function order_fechas()
    {
        return $this->db->query('select *
                                   from v_juegos
                               order by fecha_salida desc
                                  limit 5')->result_array();
    }

    public function proximos() {
        $res = $this->db->query('select * from v_proximos limit 5');

        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }

    public function destacados() {
        $res = $this->db->query('select *
                                   from juegos
                               order by floor(random()*5+1)
                                  limit 5');

        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }

    public function generos() {
        $res = $this->db->query('select * from generos');
        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }

    public function borrar($id)
    {
        return $this->db->query("delete from juegos where id = ?",
                                array($id));
    }

    public function por_id($id)
    {
        $res = $this->db->query('select * from v_juegos where id = ?',
                                array($id));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function por_id_proximo($id)
    {
        $res = $this->db->query('select * from v_proximos where id = ?',
                                array($id));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function insertar($valores)
    {
        return $this->db->insert('juegos', $valores);
    }

    public function por_codigo($codigo)
    {
        $res = $this->db->query('select * from v_juegos where codigo = ?',
                                array($codigo));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function editar($valores, $id)
    {
        return $this->db->where('id', $id)->update('juegos', $valores);
    }

    public function por_genero($genero_id) {
        $res = $this->db->query("select * from v_juegos where genero_id = ?", array($genero_id));

        return $res->num_rows() > 0 ? $res->result_array() : FALSE;
    }
}
