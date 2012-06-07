<?php 
/**
 * clarity.php
 *
 * The magic starts here.
 *
 * @package Clarity
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007-2012, Jeremy Madea
 * @version 0.0.1
 * @filesource
 */

$clarity_library = dirname( __FILE__ ); 
set_include_path( get_include_path() . PATH_SEPARATOR . $clarity_library );

/**
 * Exception handling stuff. 
 */
require_once( 'exceptions.php' );

/**
 * Autoload functionality for convenience. 
 */
require_once( 'autoload.php' );

/**
 * Database class will always be used.  
 */
require_once( 'database.class.php' );

/**
 * Session class will always be used.  
 */
require_once( 'session.class.php' ); 

?>
