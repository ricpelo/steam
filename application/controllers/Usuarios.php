<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller{
    private $reglas_comunes = array(
        array(
            'field' => 'nick',
            'label' => 'Nick',
            'rules' => 'trim|required|max_length[15]'
        ),
        array(
            'field' => 'password',
            'label' => 'Contraseña',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'password_confirm',
            'label' => 'Confirmar contraseña',
            'rules' => 'trim|required|matches[password]'
        )
    );
    public function login()
    {
        if ($this->Usuario->logueado()) {
            redirect('usuarios/index');
        }
        if ($this->input->post('login') !== NULL)
        {
            $nick = $this->input->post('nick');

            $reglas = array(
                array(
                    'field' => 'nick',
                    'label' => 'Nick',
                    'rules' => array(
                        'trim', 'required',
                        array('existe_nick', array($this->Usuario, 'existe_nick'))
                    ),
                    'errors' => array(
                        'existe_nick' => 'El nick debe existir.',
                    ),
                ),
                array(
                    'field' => 'password',
                    'label' => 'Contraseña',
                    'rules' => "trim|required|callback__password_valido[$nick]"
                )
            );

            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() === TRUE)
            {
                $usuario = $this->Usuario->por_nick($nick);
                $this->session->set_userdata('usuario', array(
                    'id' => $usuario['id'],
                    'nick' => $nick
                ));
                redirect('usuarios/index');
            }
        }
        $this->template->load('usuarios/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('usuarios/login');
    }

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->template->load('usuarios/index', array('asd' => 'asd'));
    }

}
