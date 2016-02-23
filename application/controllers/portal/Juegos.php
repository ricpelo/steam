<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

    public function index()
    {
        //$this->output->cache(1);
        $data['filas'] = $this->Juego->todos();
        $data['valoradas'] = $this->Juego->order_valoraciones();
        $data['fechas'] = $this->Juego->order_fechas();
        $data['proximos'] = $this->Juego->proximos();
        $data['destacados'] = $this->Juego->destacados();
        $data['generos'] = $this->Juego->generos();
        $this->template->load('portal/index', $data);
    }

    public function ficha($id_juego = NULL)
    {
        if ($id_juego === NULL)
        {
            redirect('portal/index');
        }

        $this->load->model('Comentario');

        if ($this->input->post('enviar') !== NULL)
        {
            $comentario['contenido'] = $this->input->post('comentario');
            $comentario['padre_juego'] = $id_juego;
            $comentario['autor'] = $this->session->userdata('usuario')['id'];
            $this->Comentario->insertar($comentario);
        }


        $data['comentarios'] = $this->Comentario->todos($id_juego);
        $data['juego'] = $this->Juego->por_id($id_juego);
        if ($data['juego'] === FALSE)
        {
            $data['juego'] = $this->Juego->por_id_proximo($id_juego);
            $data['rating'] = FALSE;
        }
        $this->load->model('Valoracion');
        $id_usuario = $this->session->userdata('usuario')['id'];
        $data['usuario'] = $this->Valoracion->por_ids($id_usuario, $id_juego);
        $this->template->load('portal/ficha', $data);
    }

    public function valoracion($id_usuario, $id_juego, $valoracion) {
        $this->load->model('Valoracion');
        if ($this->Valoracion->tiene_valoracion($id_usuario, $id_juego))
        {
            $this->Valoracion->editar($id_juego, $id_usuario, $valoracion);
        }
        else {
            $valores = array('id_juego'   => $id_juego,
                             'id_usuario' =>$id_usuario,
                             'valoracion' => $valoracion);
            $this->Valoracion->insertar($valores);
        }
        $total = $this->Valoracion->por_id($id_juego);
        echo json_encode(array(
                            'total' => $total['valoracion']
        ));
    }

    public function genero($id = NULL) {
        if ($id === NULL) {
            redirect('/portal');
        }

        $data['filas'] = $this->Juego->por_genero($id);
        $data['generos'] = $this->Juego->generos();
        $this->template->load('portal/index', $data);

    }
    public function masvalorados($offset) {
        echo json_encode($this->Juego->mas_valoraciones($offset));
    }

    public function maxpags() {
        echo $this->Juego->maxpags();
    }

    public function comprar($id = NULL) {
        if($id === NULL || !$this->Usuario->logueado()) {
            redirect('portal/juegos');
        }

        $id_usuario = 1;

        $data['juegos'] = $this->Usuario->juegos_comprados($id_usuario);

        $this->template->load('portal/comprar', $data);
    }
}
