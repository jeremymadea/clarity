<?php
/**
 * index.php
 *
 * The main controller file.
 *
 * @package ClarityDemo
 * @author Jeremy Madea <jdmadea@gmail.com>
 * @copyright (C) 2007, Jeremy Madea
 * @version 0.0.1
 * @filesource
 */

/**
 * This is a VALID_ENTRY_POINT. 
 */
define( 'VALID_ENTRY_POINT', true );

/**
 * Use the Clarity framework. 
 */
require_once( 'include/clarity.php' ); 


$view = new View( 'default' );
$view->render();

?>

