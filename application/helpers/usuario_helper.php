<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function login()
{
    $CI =& get_instance();

    $out = "";

    if ($CI->Usuario->logueado()):
        $usuario = $CI->session->userdata('usuario');
        $out .= '<div class="row">';
          $out .= '<div class="col-md-2 col-md-offset-10">';
            $out .= form_open('usuarios/logout', 'class="form-inline"');
              $out .= '<div class="form-group">';
                $out .= form_label($usuario['nick'], 'logout');
                $out .= form_submit('logout', 'Logout',
                                    'id="logout" class="btn btn-primary btn-xs"');
              $out .= '</div>';
            $out .= form_close();
          $out .= '</div>';
        $out .= '</div>';
    else:
        $out .= '<div class="row">';
          $out .= '<div class="col-md-2 col-md-offset-10">';
                $out .= anchor('/usuarios/login', 'Iniciar sesión',
                                'class="btn btn-primary btn-xs" role="button"');
          $out .= '</div>';
        $out .= '</div>';
    endif;

    return $out;
}

function usuario_id()
{
        $CI =& get_instance();
        return $CI->session->userdata('usuario')['id'];
}

function logueado() {
    $CI =& get_instance();
    return $CI->Usuario->logueado();
}
