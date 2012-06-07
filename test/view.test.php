<?php
/**
 * view.test.php
 *
 * Tests for the View class.
 *
 * @package Clarity
 * @subpackage tests
 * @author Jeremy Madea <jdmadea@gmail.com> 
 * @copyright (C) 2007, Jeremy Madea 
 * @filesource
 */

/**
 * Load the class we are testing.
 */
require_once '../include/view.class.php';


/**
 * Load the unit testing framework.
 */
require_once 'test_framework.php';

/**
 * ViewTest 
 * 
 * @uses PHPUnit
 * @package Clarity
 * @subpackage tests 
 */
class ViewTest extends PHPUnit_TestCase
{
    private $object;

    function __construct($name) {
       $this->PHPUnit_TestCase($name);
    }

    function setUp() {
        $this->object = new View( "dummy" );
    }

    function testConstructor()
    {
        $this->assertTrue( is_object( $this->object ));
    }

    function tearDown() {
        unset( $this->object );
    }
}

run_me( "ViewTest" );

?>
