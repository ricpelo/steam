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
                        array('existe_nick', array($this->Usuario, 'existe_nick')),
                        array('existe_nick_registrado', array($this->Usuario, 'existe_nick_registrado'))
                    ),
                    'errors' => array(
                        'existe_nick' => 'El nick debe existir.',
                        'existe_nick_registrado' => 'Esta cuenta todavía no ha sido validada por' .
                                                    ' los medios correspondientes. Por favor, ' .
                                                    'valide su cuenta.'
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
                //echo $nick;
                //var_dump($usuario); die();

                $this->session->set_userdata('usuario', array(
                    'id' => $usuario['id'],
                    'nick' => $nick
                ));
                redirect('usuarios/index');
            }
        }
        $this->output->delete_cache('/juegos/index');
        $this->template->load('usuarios/login');
    }

    public function logout() {
        $this->output->delete_cache('/juegos/index');
        $this->session->sess_destroy();
        redirect('usuarios/login');
    }

    public function __construct() {
        parent::__construct();

        $accion = $this->uri->rsegment(2);

        if ( ! in_array($accion, array('login', 'recordar', 'regenerar', 'registrar', 'validar')) &&
             ! $this->Usuario->logueado()) {
            redirect('usuarios/login');
        }

        if ( ! in_array($accion, array('login', 'logout', 'recordar', 'regenerar', 'registrar', 'validar'))) {
            // if( ! $this->Usuario->es_admin()) {
                // $mensajes = $this->session->flashdata('mensajes');
                // $mensajes = isset($mensajes) ? $mensajes : array();
                // $mensajes[] = array('error' =>
                //     "No tiene permisos para acceder a $accion");
                //
                // $this->session->set_flashdata("mensajes", $mensajes);
                redirect('juegos/index');
            // }
        }
    }

    public function index() {
        $this->template->load('usuarios/index');
    }

    public function validar($usuario_id = NULL, $token = NULL) {
        if($usuario_id === NULL || $token === NULL) {
            redirect('/usuarios/login');
        }

        $usuario_id = trim($usuario_id);
        $token = trim($token);
        $this->load->model('Token');
        $res = $this->Token->comprobar($usuario_id, $token);

        if ($res === FALSE) {
            $mensajes[] = array('error' =>
                "Parametros incorrectos para la validación de la cuenta.");
            $this->flashdata->load($mensajes);

            redirect('/usuarios/login');
        }

        ######################################################

        $usuario = $this->Usuario->por_id($usuario_id);
        $nick = $usuario['nick'];
        $valores = array(
            'registro_verificado' => TRUE
        );

        $this->Usuario->editar($valores, $nick);
        $this->Token->borrar($usuario_id);

        $mensajes[] = array('info' =>
            "Cuenta validada. Ya puede logear en el sistema.");
        $this->flashdata->load($mensajes);

        redirect('/usuarios/login');
    }

    public function registrar() {

        if ($this->input->post('registrar') !== NULL)
        {

            $reglas = array(
                array(
                    'field' => 'nick',
                    'label' => 'Nick',
                    'rules' => array(
                        'trim', 'required',
                        array('existe_nick', array($this->Usuario, 'no_existe_nick'))
                    ),
                    'errors' => array(
                        'existe_nick' => 'El nick ya existe, por favor, escoja otro.',
                    ),
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'password',
                    'label' => 'Contraseña',
                    'rules' => "trim|required"
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'Confirmar contraseña',
                    'rules' => 'trim|required|matches[password]'
                )
            );

            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() === TRUE)
            {

                $valores = $this->input->post();
                unset($valores['registrar']);
                unset($valores['password_confirm']);
                $valores['password'] = password_hash($valores['password'], PASSWORD_DEFAULT);
                $valores['registro_verificado'] = FALSE;

                $this->Usuario->insertar($valores);

                ################################################################

                $this->load->model('Token');
                # Prepara correo
                $usuario = $this->Usuario->por_nick($valores['nick']);
                $usuario_id = $usuario['id'];

                # Mandar correo
                $enlace = anchor('/usuarios/validar/' . $usuario_id . '/' .
                                 $this->Token->generar($usuario_id));

                $this->load->library('email');
                $this->email->from('steamClase@gmail.com');
                $this->email->to($valores['email']);
                $this->email->subject('Confirmar Registro');
                $this->email->message($enlace);
                $this->email->send();

                ################################################################

                $mensajes[] = array('info' =>
                        "Confirme su cuenta a traves de su correo electrónico.");

                $this->flashdata->load($mensajes);

                redirect('usuarios/login');
            }
        }
        $this->template->load('usuarios/registrar');
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
                        array('existe_usuario', array($this->Usuario, 'existe_nick')
                        )
                    ),
                    'errors' => array(
                        'existe_usuario' => 'Ese usuario no existe.'
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
                $this->email->from('steamClase@gmail.com');
                $this->email->to($email);
                $this->email->subject('Regenerar Contraseña');
                $this->email->message($enlace);
                $this->email->send();

                ################################################################

                $mensajes[] = array('info' =>
                    "Se ha enviado un correo a su dirección de email.");
                $this->flashdata->load($mensajes);

                redirect('/usuarios/login');
            }
        }

        $this->template->load('/usuarios/recordar');
    }

    public function regenerar($usuario_id = NULL, $token = NULL) {
        if($usuario_id === NULL || $token === NULL) {
            redirect('/usuarios/login');
        }

        $usuario_id = trim($usuario_id);
        $token = trim($token);
        $this->load->model('Token');
        $res = $this->Token->comprobar($usuario_id, $token);

        if ($res === FALSE) {
            $mensajes[] = array('error' =>
                "Párametros incorrectos para la regeneración de contraseña.");
            $this->flashdata->load($mensajes);

            redirect('/usuarios/login');
        }

        ######################################################

        if ($this->input->post('regenerar') !== NULL) {
            $reglas = array(
                array(
                    'field' => 'password',
                    'label' => 'Contraseña',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'password_confirm',
                    'label' => 'Confirmar Contraseña',
                    'rules' => 'trim|required|matches[password]'
                )
            );
            $this->form_validation->set_rules($reglas);
            if ($this->form_validation->run() !== FALSE) {
                $password = $this->input->post('password');
                $nueva_password = password_hash($password, PASSWORD_DEFAULT);
                $this->Usuario->actualizar_password($usuario_id, $nueva_password);
                $this->Token->borrar($usuario_id);

                $mensajes[] = array('info' =>
                    "Su contraseña se ha regenerado correctamente");
                $this->flashdata->load($mensajes);

                redirect('/usuarios/login');
            }
        }

        ########################################################

        $data = array(
            'usuario_id' => $usuario_id,
            'token' => $token
        );
        $this->template->load('usuarios/regenerar', $data);
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

}
