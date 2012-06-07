<?php
/**
 * config.php
 *
 * Required to configure the application.
 *
 * @package Clarity
 * @author Jeremy Madea <jeremymadea@gmail.com>
 * @copyright (C) 2007, Jeremy Madea
 * @version SVN: $Id: config.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * The global $CONFIG array holds our application configuration values.
 *
 * @global array $CONFIG 
 */
global $CONFIG; 

$CONFIG['dbtype']   = 'mysql';
$CONFIG['username'] = 'clarity';
$CONFIG['password'] = 'clarity';
$CONFIG['hostspec'] = 'localhost';
$CONFIG['database'] = 'clarity';

?>
