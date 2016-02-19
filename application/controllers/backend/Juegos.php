<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Juegos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ( ! $this->Usuario->logueado())
        {
            redirect('usuarios/login');
        }

        if ( ! $this->Usuario->es_admin())
        {
            redirect('portal/juegos');
        }
    }

    private $reglas_comunes = array(
        array(
            'field' => 'nombre',
            'label' => 'Nombre',
            'rules' => 'trim|required|max_length[50]'
        ),
        array(
            'field' => 'resumen',
            'label' => 'Resumen',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'descripcion',
            'label' => 'Descripcion',
            'rules' => 'trim|required'
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

    public function index() {
        if (ENVIRONMENT === 'production') {
            $this->output->cache(1);
        }

        $data['filas'] = $this->Juego->todos();
        $this->template->load('backend/index', $data, array('title' => 'Listado de juegos'));
    }

    public function borrar($id = NULL) {
        if ($this->input->post('borrar') !== NULL) {
            $id = $this->input->post('id');
            if ($id !== NULL) {
                $this->Juego->borrar($id);
                $this->output->delete_cache('/backend/index');
            }
            redirect('backend/juegos/index');
        } else {
            if ($id === NULL) {
                redirect('backend/juegos/index');
            } else {
                $res = $this->Juego->por_id($id);
                if ($res === FALSE) {
                    redirect('backend/juegos/index');
                } else {
                    $data = $res;
                    $this->template->load('/backend/borrar', $data);
                }
            }
        }
    }

    public function insertar() {
        if ($this->input->post('insertar') !== NULL) {
            $reglas = $this->reglas_comunes;
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) {
                $valores = $this->limpiar('insertar', $this->input->post());
                $this->Juego->insertar($valores);
                $this->output->delete_cache('/backend/index');
                redirect('backend/juegos/index');
            }
        }
        $this->template->load('backend/insertar');
    }

    public function subida($id = NULL) {

        if ($id === NULL) {
            $mensajes[] = array('error' =>
                "La imagen no es correta");
            $this->flashdata->load($mensajes);
            redirect('backend/juegos/index');
        }
        $data['id'] = $id;
        $data['error'] = array();

        if ($this->input->post('insertar') !== NULL) {
            $config['upload_path'] = 'images/juegos/';
            $config['allowed_types'] = 'jpg';
            $config['overwrite'] = TRUE;
            $config['max_width'] = '300';
            $config['max_height'] = '400';
            $config['max_size'] = '40000';
            $config['file_name'] = $id . '.jpg';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data = array('upload_data' => $this->upload->data());
                redirect('backend/juegos/index');
            }
        }
        $this->template->load('backend/subida', $data);
    }

    private function limpiar($accion, $valores) {
        unset($valores[$accion]);
        return $valores;
    }

    public function editar($id = NULL) {
        if ($id === NULL) {
            redirect('backend/juegos/index');
        }

        $id = trim($id);

        if ($this->input->post('editar') !== NULL) {
            $reglas = $this->reglas_comunes;
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) {
                $valores = $this->limpiar('editar', $this->input->post());
                $this->Juego->editar($valores, $id);
                $this->output->delete_cache('/backend/index');
                redirect('backend/juegos/index');
            }
        }
        $valores = $this->Juego->por_id($id);
        if ($valores === FALSE) {
            redirect('backend/juegos/index');
        }
        $data = $valores;
        $this->template->load('backend/editar', $data);
    }

}
