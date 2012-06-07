<?php
/**
 * database.test.php
 *
 * Tests for the Database class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jeremymadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @version SVN: $Id: database.test.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * Load the class we are testing.
 */
require_once '../include/database.class.php';


/**
 * Load the unit testing framework.
 */
require_once 'test_framework.php';

/**
 * DatabaseTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class DatabaseTest extends PHPUnit_TestCase
{
    private $object;

    function __construct($name) 
    {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() 
    {
        $this->object = Database::instance();
    }

    function testSingleton() 
    {
        $this->assertTrue( $this->object === Database::instance() );
    }

    function testPearDB()
    {
        $this->assertTrue( is_object( $this->object->db()));
    }

    function testIdExists()
    {
        $t = Database::id_exists( 'resources', 1 );
        $f = Database::id_exists( 'resources', 999 );
        $this->assertTrue( $t && !$f );
    }

    function tearDown() 
    {
        unset( $this->object );
    }
}

run_me( "DatabaseTest" );

?>
