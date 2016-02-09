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
<<<<<<< HEAD
    }

    public function index() {
        $this->template->load('usuarios/index', array('asd' => 'asd'));
    }

=======

        $accion = $this->uri->rsegment(2);

        if ( ! in_array($accion, array('login', 'recordar', 'regenerar', 'registrar')) &&
             ! $this->Usuario->logueado()) {
            redirect('usuarios/login');
        }

        if ( ! in_array($accion, array('login', 'logout', 'recordar', 'regenerar', 'registrar'))) {
            if( ! $this->Usuario->es_admin()) {
                $mensajes = $this->session->flashdata('mensajes');
                $mensajes = isset($mensajes) ? $mensajes : array();
                $mensajes[] = array('error' =>
                    "No tiene permisos para acceder a $accion");

                $this->session->set_flashdata("mensajes", $mensajes);

                redirect('usuarios/index');
            }
        }
    }

    public function index() {

        $this->template->load('usuarios/index', array());

    }

    public function recordar() {
        if ($this->input->post('recordar') !== NULL) {
            $reglas = array(
                array(
                    'field' => 'nick',
                    'label' => 'Nick',
                    'rules' => array(
                        'trim',
                        'required',
                        array('existe_usuario', array(
                                $this->Usuario, 'existe_nick'
                            )
                        )
                    ),
                    'errors' => array(
                        'existe_usuario' => 'Ese usuario no existe'
                    )
                )
            );
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) {
                # Preparar correo

                $nick = $this->input->post('nick');
                $usuario = $this->Usuario->por_nick($nick);
                $usuario_id = $usuario['id'];
                $email = $usuario['email'];

                $this->load->model('Token');
                $enlace = anchor('/usuarios/regenerar/' . $usuario_id . '/' .
                                 $this->Token->generar($usuario_id));

                # Mandar correo

                $this->load->library('email');
                $this->email->from('jdkdejava@gmail.com');
                $this->email->to($email);
                $this->email->subject('Regenerar Contraseña');
                $this->email->message($enlace);
                $this->email->send();

                ################################################################

                $mensajes[] = array('info' =>
                    "Se ha enviado un correo a su direccion de email");
                $this->flashdata->load($mensajes);

                redirect('/usuarios/login');
            }
        }

        $this->template->load('/usuarios/recordar');
    }

    public function registrar() {
        if ($this->input->post('registrar') !== NULL) {
            $reglas = array(
                array(
                    'field' => 'nick',
                    'label' => 'Nick',
                    'rules' => array(
                        'trim',
                        'required',
                        array('existe_usuario', array(
                                $this->Usuario, 'existe_nick'
                            )
                        )
                    ),
                    'errors' => array(
                        'existe_usuario' => 'Ese usuario no existe'
                    )
                )
            );
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) {
                # Preparar correo

                $nick = $this->input->post('nick');
                $usuario = $this->Usuario->por_nick($nick);
                $usuario_id = $usuario['id'];
                $email = $usuario['email'];

                $this->load->model('Token');
                $enlace = anchor('/usuarios/regenerar/' . $usuario_id . '/' .
                                 $this->Token->generar($usuario_id));

                # Mandar correo

                $this->load->library('email');
                $this->email->from('jdkdejava@gmail.com');
                $this->email->to($email);
                $this->email->subject('Regenerar Contraseña');
                $this->email->message($enlace);
                $this->email->send();

                ################################################################

                $mensajes[] = array('info' =>
                    "Se ha enviado un correo a su direccion de email");
                $this->flashdata->load($mensajes);

                redirect('/usuarios/login');
            }
        }
        $this->template->load('usuarios/registrar');
    }

    public function _password_valido($password, $nick)
    {
        $usuario = $this->Usuario->por_nick($nick);

        if ($usuario !== FALSE &&
            password_verify($password, $usuario['password']) === TRUE)
        {
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('_password_valido',
                'La {field} no es válida.');
            return FALSE;
        }
    }

    private function limpiar($accion, $valores)
    {
        unset($valores[$accion]);
        $valores['password'] = password_hash($valores['password'], PASSWORD_DEFAULT);
        unset($valores['password_confirm']);

        return $valores;
    }
>>>>>>> Insercion de usuarios en bd.sql
}
