<?php 
/**
 * htmlutil.php
 *
 * Contains utility functions for generating HTML.
 *
 * @package Clarity
 * @subpackage utility
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea
 * @filesource
 */

/**
 * select
 *
 * Builds an HTML select string. 
 *
 * @param string $name
 * @param array $opts
 * @param string $id
 * @param string $xtra
 */
function select( $name, $opts, $default=null, $id=null, $xtra=null ) 
{    
    $id_txt = isset( $id )   ? "id='{$id}' " : '';
    $xtra   = isset( $xtra ) ? " {$xtra}"    : '';

    $html = "<select {$id_txt}name='{$name}'{$xtra}>";

    foreach ( $opts as $value => $text ) {
        $html .= '<option ' . 'value="' . $value . '"';
        if ( $value == $default ) {
            $html .= ' selected="selected"';
        }
        $html .= '>' . $text . '</option>'; 
    }

    $html .= '</select>';
    return $html;
}

?>
