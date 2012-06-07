<?php
/**
 * session.test.php
 *
 * Tests for the Session class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jeremymadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @version SVN: $Id: session.test.php 7 2007-09-26 19:51:18Z jeremy $
 * @filesource
 */

/**
 * Load the class we are testing.
 */
require_once '../include/session.class.php';


/**
 * Load the unit testing framework.
 */
require_once 'test_framework.php';

/**
 * SessionTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class SessionTest extends PHPUnit_TestCase
{
    private $object;

    function __construct($name) 
    {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() 
    {
        $this->object = Session::instance();
    }

    function testSingleton() 
    {
        $this->assertTrue( $this->object === Session::instance() );
    }

    function testSessionVariableSetting()
    {
        $this->object->foo = 42;
        $this->assertTrue( $_SESSION['foo'] == 42 );
    }

    function testSessionVariableGetting()
    {
        $this->assertTrue( $this->object->foo == 42 ); 
    }

    function tearDown() 
    {
        unset( $this->object );
    }
}

run_me( "SessionTest" );

?>
