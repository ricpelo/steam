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
        $out .= '<hr/>';
    endif;

    return $out;
}
