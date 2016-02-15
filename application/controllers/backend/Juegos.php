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
        if (ENVIRONMENT === 'production')
        {
            $this->output->cache(1);
        }
        
        $data['filas'] = $this->Juego->todos();
        $this->template->load('backend/index', $data, array('title' => 'Listado de juegos'));
    }

    public function borrar($id = NULL)
    {
        if ($this->input->post('borrar') !== NULL)
        {
            $id = $this->input->post('id');
            if ($id !== NULL)
            {
                $this->Juego->borrar($id);
                $this->output->delete_cache('/juegos/index');
            }
            redirect('juegos/index');
        }
        else
        {
            if ($id === NULL)
            {
                redirect('juegos/index');
            }
            else
            {
                $res = $this->Juego->por_id($id);
                if ($res === FALSE)
                {
                    redirect('juegos/index');
                }
                else
                {
                    $data = $res;
                    $this->template->load('juegos/borrar', $data);
                }
            }
        }
    }

    public function insertar()
    {
        if ($this->input->post('insertar') !== NULL)
        {
            $reglas = $this->reglas_comunes;
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

    private function limpiar($accion, $valores)
    {
        unset($valores[$accion]);
        return $valores;
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
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE)
            {
                $valores = $this->limpiar('editar', $this->input->post());
                $this->Juego->editar($valores, $id);
                $this->output->delete_cache('/juegos/index');
                redirect('juegos/index');
            }
        }
        $valores = $this->Juego->por_id($id);
        if ($valores === FALSE)
        {
            redirect('juegos/index');
        }
        $data = $valores;
        $this->template->load('juegos/editar', $data);
    }
}
