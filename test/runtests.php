#!/usr/bin/php5
<?php
/**
 * runtests.php
 *
 * Script for running all unit tests.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jeremymadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @version SVN: $Id: runtests.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * This turns testing on in files that use it.
 */
define( 'TESTING', 1);

require_once 'session.test.php';    // Session test first to avoid warnings.
require_once 'passwd.test.php';
#require_once 'database.test.php';
#require_once 'user.test.php';
require_once 'view.test.php';
require_once 'error.test.php';
require_once 'htmlutil.test.php';

?>
