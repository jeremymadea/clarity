<?php
/**
 * compatibility/ctype.php
 *
 * Compatibility routines for ctype functions needed when PHP is compiled 
 * without them.
 *
 * @package Clarity
 * @subpackage compatibility
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */

/**
 * ctype_digit()
 *
 * Checks to see whether a passed string contains all digits. 
 *
 * @param string The string to check.
 * @return boolean True if the parameter contains only digits, false otherwise.
 *
 */
function ctype_digit( $string ) 
{
    if ( !is_string( $string ) )
        return false;
    if ( preg_match( '/^\d+$/', $string )) return true;
    return false;
}

?>
