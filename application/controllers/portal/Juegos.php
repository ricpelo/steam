<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

    private $reglas_comunes = array(
        array(
            'field' => 'descripcion',
            'label' => 'Descripción',
            'rules' => 'trim|required|max_length[50]'
        ),
        array(
            'field' => 'precio',
            'label' => 'Precio',
            'rules' => 'trim|required|numeric|less_than_equal_to[9999.99]'
        ),
        array(
            'field' => 'existencias',
            'label' => 'Existencias',
            'rules' => 'trim|integer|greater_than_equal_to[-2147483648]|less_than_equal_to[+2147483647]'
        )
    );

    public function index()
    {
        $this->output->cache(1);
        $data['filas'] = $this->Juego->todos();
        $this->template->load('portal/index', $data, array('title' => 'Listado de juegos'));
    }
}
