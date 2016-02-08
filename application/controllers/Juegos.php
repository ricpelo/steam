<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

    private $reglas_comunes = array(
        array(
            'field' => 'codigo',
            'label' => 'Código',
            'rules' => 'trim|required|ctype_digit|max_length[13]',
            'errors' => array(
                'ctype_digit' => 'El campo %s debe contener sólo dígitos.'
            )
        ),
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
        $this->template->load('juegos/index', $data, array('title' => 'Listado de juegos'));
    }

    public function insertar() 
    {
        if ($this->input->post('insertar') !== NULL) 
        {
            $reglas = $this->reglas_comunes;
            $reglas[0]['rules'] .= '|is_unique[juegos.codigo]';
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) 
            {
                $valores = $this->limpiar('insertar', $this->input->post());
                $this->Juego->insertar($valores);
                $this->output->delete_cache('/juegos/index');
                redirect('juegos/index');
            }
        }
        $this->template->load('juegos/insertar');
    }
    
    public function editar($id = NULL)
    {
        if ($id === NULL)
        {
            redirect('juegos/index');
        }

        $id = trim($id);

        if ($this->input->post('editar') !== NULL)
        {
            $reglas = $this->reglas_comunes;
            $reglas[0]['rules'] .= "|callback__codigo_unico[$id]";
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE)
            {
                $valores = $this->limpiar('editar', $this->input->post());
                $this->Juego->editar($valores, $id);
                $this->output->delete_cache('/juegos/index');
                redirect('juegos/index');
            }
        }
        $valores = $this->Articulo->por_id($id);
        if ($valores === FALSE)
        {
            redirect('articulos/index');
        }
        $data = $valores;
        $this->template->load('articulos/editar', $data);
    }

}
