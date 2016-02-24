<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function miga_pan() {
    $CI =& get_instance();

    $uri = $CI->uri->segment_array();
    $uri_string = site_url();

    $out = '<div class="miga">';

    $total = count($uri);
    foreach ($uri as $parte) {
        $uri_string .= $parte . "/";
        $out .= '<a href="' . $uri_string . '">' . $parte . '</a> >> ';
    }

    $out .= '</div>';

    return $out;
}
