<?php
/**
 * compatibility/library.php
 *
 * This file pulls in compatibility functions when they are needed.
 *
 * @package Clarity
 * @subpackage compatibility 
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007-2012, Jeremy Madea 
 * @filesource
 */


/**
 * Require ctype compatibility routines if necessary.
 */
if ( ! is_callable( "ctype_digit" )) require_once( 'ctype.php' );

?>
