<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model
{
    public function todos()
    {
        return $this->db->get('usuarios')->result_array();
    }

    public function borrar($id)
    {
        return $this->db->delete('usuarios', array('id' => $id));
    }

    public function por_id($id)
    {
        $res = $this->db->get_where('usuarios', array('id' => $id));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function por_nick($nick)
    {
        $res = $this->db->get_where('usuarios', array('nick' => $nick));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function por_nick_registrado($nick) {
        $res = $this->db->get_where('v_usuarios_valido', array('nick' => $nick));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function por_email($email)
    {
        $res = $this->db->get_where('usuarios', array('email' => $email));
        return $res->num_rows() > 0 ? $res->row_array() : FALSE;
    }

    public function existe_nick($nick)
    {
        return $this->por_nick($nick) !== FALSE;
    }

    public function existe_nick_registrado($nick) {
        return $this->por_nick_registrado($nick) !== FALSE;
    }

    public function logueado()
    {
        return $this->session->has_userdata('usuario');
    }

    // public function es_admin() {
    //     $usuario = $this->session->userdata("usuario");
    //     return $usuario['rol_id'] === '1';
    // }

    public function insertar($valores)
    {
        return $this->db->insert('usuarios', $valores);
    }

    public function editar($valores, $nick)
    {
        return $this->db->where('nick', $nick)->update('usuarios', $valores);
    }

    public function actualizar_password($id, $nueva_password) {
        return $this->db->query("update usuarios set password = ? where id::text = ?",
                          array($nueva_password, $id));
    }
}
