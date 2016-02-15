<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

    public function index()
    {
        $this->output->cache(1);
        $data['filas'] = $this->Juego->todos();
        $this->template->load('portal/index', $data, array('title' => 'Listado de juegos'));
    }
}
