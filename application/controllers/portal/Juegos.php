<?php

defined('BASEPATH') OR exit('No direct script access allowed');

header("Access-Control-Allow-Origin: *");
class Juegos extends CI_Controller {

    public function index()
    {
        $this->output->cache(1);
        $data['filas'] = $this->Juego->todos();
        $this->template->load('portal/index', $data);
    }

    public function ficha($id = NULL)
    {
        if ($id === NULL)
        {
            redirect('portal/index');
        }

        $data['juego'] = $this->Juego->por_id($id);
        $this->template->load('portal/ficha', $data);
    }

    public function valoracion($id_usuario, $id_juego, $valoracion) {
        $this->load->model('Valoracion');
        if ($this->Valoracion->tiene_valoracion($id_usuario, $id_juego))
        {
            $this->Valoracion->editar($id_juego, $id_usuario, $valoracion);
        }
        else {
            $valores = array($id_juego, $id_usuario, $valoracion);
            $this->Valoraciones->insertar($valores);
        }
        $total = $this->Valoracion->por_ids($id_usuario, $id_juego);
        return json_encode(array(
                            total => $total['valoracion'],
                            val   => $valoracion
        ));
    }
}
